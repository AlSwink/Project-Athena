<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Import extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    }

    public function wms_users()
    {

        $xpo = $this->load->database('wms',TRUE);
        $q = "SELECT * FROM us_f";
        $user = $xpo->query($q)->result();
        
        $this->db->where('imported',1);
        $this->db->delete('users_login');

        foreach($user as $u){
            $insert[] = array(
                            'username' => trim($u->opr),
                            'password' => trim($u->password),
                            'login_attempt' => 0,
                            'first_login' => 1,
                            'creator_id' => 1,
                            'active' => 1,
                            'deleted' => 0,
                            'locked_out' => 0,
                            'created' => date('Y-m-d H:i:s'),
                            'imported' => 1
                            );
        }

        $this->db->insert_batch('users_login',$insert);
        echo count($insert).' Users from us_f imported successfully';
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

    public function eroster_employees()
    {
        $deleted = 0;
        $xpo = $this->load->database('xpo',TRUE);
        $employees = $xpo->get('tbl_employees')->result();

        $this->db->where('added_by',1);
        $this->db->delete('employees');

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
                                'added_by' => 1,
                                'deleted' => 0,
                                'active' => 1
                            );
            }else{
                $deleted++;
            }
        }

        $this->db->insert_batch('employees',$insert);
        
        $this->db->select('user_id,supervisor_id');
        $this->db->group_by('supervisor_id');
        $supers = $this->db->get('employees')->result();

        foreach($supers as $super){
            if($super->supervisor_id){
                $this->db->set('supervisor_id',$super->user_id);
                $this->db->where('supervisor_id',$super->supervisor_id);
                $this->db->where('added_by',1);
                $this->db->update('employees');
            }
        }


        echo count($insert).' Employees from xpo.tbl_employees imported successfully<br>';
        
        if($deleted){
            echo $deleted.' Employees were not imported because they are not in users_login table<br>';
            echo 'to ensure full import run '.site_url('import/wms_users').' to import wms users before being crossed checked with eroster';
        }
    }
}
