<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class E_roster extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('applications/E_roster_model');
		$this->page_dir = 'applications/e_roster';
    }

    public function add_employee(){
		$post = $this->input->post();
		//add photo functionality later
		//
		$data = $this->E_roster_model->insert_employee($post,'');
		$log = array(
                'for' => $post['emp_fname'].' '.$post['emp_lname'],
                'action' => "Employee added",
                'reason' => 'System Log'
                );
		$this->Logger_model->create('eroster_logs',$log);
		echo json_encode($data);
	}
	
	public function update_employee(){
		$post = $this->input->post();
		$data = $this->E_roster_model->update_employee($post,'');
		$log = array(
                'for' => $post['emp_fname'].' '.$post['emp_lname'],
                'action' => "Employee updated",
                'reason' => 'System Log'
                );
		$this->Logger_model->create('eroster_logs',$log);
		echo json_encode($data);
	}
	
	public function get_employee($id){
		
		$employee = $this->E_roster_model->get_employee($id);
		echo json_encode($employee);
		
	}
	
	public function delete_employees($emps=null){
		if(!$emps){
			$emps = $this->input->post('emps');
		}
		$test = array();
		foreach($emps as $emp){
			$test[] = $emp;
			$this->E_roster_model->delete_employee($emp);
		}
		
		$log = array(
				'for' => 'Employee ID : '.implode(',',$emps),
				'action' => "Deleted employees",
				'reason' => 'System Log'
				);
		$this->Logger_model->create('eroster_logs',$log);
		
		echo json_encode($test);		
		
	}
	
	public function add_setting(){
		$post = $this->input->post();
		$this->E_roster_model->add_setting($post);
		$log = array(
				'for' => $post['setting'],
				'action' => $post['type']." added",
				'reason' => 'System log'
				);
		$this->Logger_model->create('eroster_logs',$log);
		echo json_encode("Added setting");
	}
	
	//public function get_wms_employee($wms){
		
}
?>