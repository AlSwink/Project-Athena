<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class It_5s extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('applications/It_5s_model');
    }
	
	public function saveStatus(){
		
		parse_str($this->input->post('post'),$post);
		$this->It_5s_model->id=$post['id'];
		$this->It_5s_model->completed=$post['status'];
		$this->It_5s_model->progress=$post['progress'];
		$this->It_5s_model->save();
		$data = array(
			'complete' => $this->getList('complete'),
			'incomplete' => $this->getList('incomplete'),
			'percent' => $this->It_5s_model->getPercentComplete()
			);
		
		
		echo json_encode($data);
		
	}
	
	public function getList($status){
		$completed = ($status == 'incomplete'?0:1);
			
		$data[$status] = $this->It_5s_model->getTasks($completed);
		return $view = $this->load->view('applications/It_5s/it_5s_'.$status,$data,TRUE);
		
	}

    
}
