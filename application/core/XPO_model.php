<?php

class XPO_Model extends CI_Model {

	protected $max_login_attempt;
  protected $lastdayofmonth;
  protected $firstdayofmonth;
	public $site_name;
  public $user_id;
  public $wms;
  public $wms_test;

  function __construct()
  {
      parent::__construct();

     	$settings = $this->db->get('site_settings')->result();
     	foreach($settings as $setting){
     		$column = $setting->setting;
     		$value = $setting->value;
     		$this->$column = $value;
     	}

      if($this->session->userdata('user_id') != ''){
        $this->user_id =  $this->session->userdata('user_id');
      }
      
      $this->firstdayofmonth = date('Y-m-01 00:00:00');
      $this->lastdayofmonth = date('Y-m-t 23:59:59');

      $this->xpo = $this->load->database('xpo',TRUE);
      $this->wms = $this->load->database('wms',TRUE);
      $this->wms_test = $this->load->database('wms_test',TRUE);
  }

  public function getSetting($key)
  {
    return $this->$key;
  }
  
  public function getAnnouncements($id = null)
  {
    $announcements = $this->db->get_where('announcements',array('active'=>1,'deleted'=>0))->result();
    return $announcements;
  }

  public function getOptions($table,$cond=array(),$order=null)
  {
    if(isset($cond)){
      foreach($cond as $w){
        $this->db->where($w);
      }
    }
    
    if($order)
      $this->db->order_by($order,'ASC');
      $options = $this->db->get_where($table,array('deleted'=>'0'))->result();
    
    return $options;
  }

  public function getDepartment($id)
  {
    $department = $this->db->get_where('departments',array('department_id'=>$id))->row();
    $this->db->flush_cache();
    return $department->department;
  }

  public function setEmployeeStaffing($staffingid)
  {
    $this->db->where_in('employees.staffing',$staffingid);
  }

  public function setEmployeeDepartment($deptid)
  {
    $this->db->where_in('employees.department',$deptid);
  }

  public function getEmployees($emp_id=null)
  {
    $this->db->select('*');
    $this->db->select('employees.user_id as user_id');
    $this->db->select('employees.e_fname,employees.e_lname');
    $this->db->select('CONCAT(super.e_fname," ",super.e_lname) as supervisor');
    $this->db->select('departments.department as department_name');
    if($emp_id){
      $this->db->where('employees.emp_id',$emp_id);
    }
    $this->db->join('site_staffing','site_staffing.staffing_id = employees.staffing','LEFT');
    $this->db->join('departments','departments.department_id = employees.department');
    $this->db->join('employees as super','super.user_id = employees.supervisor_id','LEFT');
    $this->db->where('employees.deleted',0);
    $this->db->order_by('employees.e_fname','ASC');
    $employees = $this->db->get('employees')->result();
    $this->db->flush_cache();
    return $employees;
  }

  public function getBuldingDepartment($id=null)
  {
    if($id){
      $this->db->where('bldg_id',$id);
    }

    $bldgs = $this->db->get_where('building',array('deleted'=>0))->result();
  
    foreach($bldgs as $bldg){
      $dept_ids = explode('-',$bldg->dept_ids);
      foreach($dept_ids as $dept_id){
        $department = $this->db->get_where('departments',array('department_id'=>$dept_id,'deleted'=>0))->row();
        $dept[] = $department->department;
      }

      $final[] = array(
                  'bldg_id' => $bldg->bldg_id,
                  'building' => $bldg->bldg_name,
                  'department_ids' => $dept_ids,
                  'departments' => $dept
                );
    }

    return $final;
  }

  public function get_department_with_document($id=array())
  {
    $this->db->select('dept_id');
    if(count($id)){
      $this->db->where_in('dept_id',$id);
    }else{
      $this->db->group_by('dept_id');
    }

    $this->db->where('deleted',0);
    $dd = $this->db->get('swi_documents')->result();
    return $dd;
  }

  public function getDoor($door=null)
  {
    if($door){
      $this->db->where('door',$door);
    }

    $this->db->where('deleted',0);
    return $this->db->get('site_docks')->result_array();
  }
}