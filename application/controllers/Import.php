<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Import extends CI_Controller {

    private $in_athena;
    private $in_wms;
    private $wms_users;


	public function __construct()
    {
        parent::__construct();
    }

    public function xpo_athena_update()
    {
        $this->db->join('employees','users_login.user_id = employees.user_id','LEFT');
        $this->db->where('username !=','athena');
        $in_athena = $this->db->get('users_login')->result_array();
        $in_athena = array_column($in_athena,'username');
        $this->in_athena = $in_athena;
        
        $this->get_wms_users();
        $in_wms = array_column($this->wms_users,'opr');
        
        $this->in_wms = $in_wms;
        $this->get_xpo_employees();

        $this->update_supervisors();
    }

    public function get_wms_users()
    {
        $xpo = $this->load->database('wms',TRUE);
        $where_not_in = implode("','",$this->in_athena);

        $q = "SELECT TRIM(opr) as opr,password 
                FROM us_f 
                WHERE opr NOT IN ('".$where_not_in."','OPER') AND user_grp NOT IN ('ITADMIN','ADMIN','DEVEL')";
        $users = $xpo->query($q)->result_array();
        
        foreach($users as $u){
            $insert[] = array(
                            'username' => trim($u['opr']),
                            'password' => trim($u['password']),
                            'login_attempt' => 0,
                            'first_login' => 1,
                            'creator_id' => 2,
                            'active' => 1,
                            'deleted' => 0,
                            'locked_out' => 0,
                            'created' => date('Y-m-d H:i:s'),
                            'imported' => 1
                            );
        }

        $this->db->insert_batch('users_login',$insert);
        $this->wms_users = $users;
    }

    public function get_xpo_employees()
    {
        $deleted = 0;
        $xpo = $this->load->database('xpo',TRUE);
        
        $xpo->where_in('wms',$this->in_wms);
        $employees = $xpo->get('tbl_employees')->result();

        foreach($employees as $employee){

            $info = $this->db->get_where('users_login',array('username'=>strtoupper($employee->wms)))->row();

            if(isset($info)){
                $insert[] = array(
                                'user_id' => $info->user_id,
                                'e_fname' => ucwords(strtolower($employee->emp_fname)),
                                'e_lname' => ucwords(strtolower($employee->emp_lname)),
                                'department' => $employee->dept_id,
                                'p_position' => $employee->primary,
                                's_position' => $employee->secondary,
                                'kronos'=> $employee->emp_id,
                                'ssn' => $employee->ssn,
                                'staffing' => $employee->temp_id,
                                'door_badge'=> $employee->sb,
                                'xpo_email' => $employee->emp_email,
                                'parking_tag' => $employee->park_tag,
                                'supervisor_id' => $employee->supervisor,
                                'added_on' => date('Y-m-d H:i:s'),
                                'added_by' => 2,
                                'deleted' => 0,
                                'active' => 1
                            );
            }else{
                $deleted_users[] = '('.$employee->id.') -'.$employee->emp_fname.' '.$employee->emp_lname.'- ['.$employee->wms.']';
                $deleted++;
            }
        }

        $this->db->insert_batch('employees',$insert);

        echo count($insert).' Employees from xpo.tbl_employees imported successfully<br>';
        
        if($deleted){
            echo $deleted.' Employees were not imported because they are not in WMS<br>';
            echo '<hr>';
            foreach($deleted_users as $deleted){
                echo $deleted.'<br>';
            }
            echo '<hr>';
            echo 'to ensure full import run '.site_url('import/wms_users').' to import wms users before being crossed checked with eroster';
        }
        
    }

    public function eroster_positions()
    {
        $xpo = $this->load->database('xpo',TRUE);
        $er_positions = $xpo->get('tbl_xpo_positions')->result();

        $this->db->where('added_by',1);
        $this->db->delete('positions');

        foreach($er_positions as $position){
            $insert[] = array(
                            'position_id' => $position->id,
                            'position' => $position->position,
                            'added_by' => 1,
                            'added_on' => date('Y-m-d H:i:s'),
                            'deleted' => 0
                        );
        }

        $this->db->insert_batch('positions',$insert);
        echo count($insert).' Positions from xpo.tbl_xpo_positions imported successfully';
    }

    public function update_supervisors()
    {
        $this->db->select('user_id,supervisor_id');
        $this->db->group_by('supervisor_id');
        $supers = $this->db->get('employees')->result();
        
        foreach($supers as $super){
            if($super->supervisor_id){
                $this->db->set('supervisor_id',$super->user_id);
                $this->db->where('supervisor_id',$super->supervisor_id);
                $this->db->update('employees');
            }
        }
    }
}
