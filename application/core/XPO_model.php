<?php

class XPO_Model extends CI_Model {

	protected $max_login_attempt;
  protected $lastdayofmonth;
  protected $firstdayofmonth;
	public $site_name;
  public $user_id;

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

  public function getOptions($table,$cond=array())
  {
    if(isset($cond)){
      foreach($cond as $w){
        $this->db->where($w);
      }
    }
    $options = $this->db->get_where($table,array('deleted'=>'0'))->result();
    return $options;
  }

  public function getDepartment($id)
  {
    $department = $this->db->get_where('departments',array('department_id'=>$id))->row();
    return $department->department;
  }

  public function getEmployeesByStaffing($staffing_id)
  {
    $this->db->where('staffing',$staffing_id);
    $this->db->where('deleted',0);
    $this->db->order_by('e_fname','ASC');
    $employees = $this->db->get('employees')->result();
    return $employees;
  }

  public function getEmployeesByDepartment($dept_id)
  {
    $this->db->where('department',$dept_id);
    $this->db->where('deleted',0);
    $this->db->order_by('e_fname','ASC');
    $employees = $this->db->get('employees')->result();
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
}