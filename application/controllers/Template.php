<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->session->keep_flashdata('errors'); 
        $this->load->helper('arrays');
        $this->load->model('XPO_model');
        $this->load->model('notifications_model');
    }

    public function getLoading($test=false)
    {
    	$view = $this->load->view('loading','',TRUE);
    	if($test){
    		$this->load->view('loading');
    	}else{
			echo json_encode($view);
		}
    }

	public function getTemplateJSON($dir=null,$data=null,$html=false)
	{

		$dir = ($dir ? $dir : $this->input->post('url'));
		$post = ($this->input->post('post') ? $this->input->post('post') : NULL);

		if($post){
			if(isset($post['sub_menu'])){
				$main_menu = $this->session->userdata('user_menu');
				$index = search_key_val('name',$post['sub_menu'],$main_menu);
				$data['sub_menu'] = $main_menu[$index];
			}

			if(isset($post[0]) && $post[0] == 'announcements'){
				$data['announcements'] = generateAnnouncements($this->XPO_model->getAnnouncements());
			}
		}

		$view = $this->load->view($dir,$data,TRUE);
		if($html){
			return $view;
		}else{
			echo json_encode($view);
		}
	}

	public function getNotifications($user_id=null)
    {
    	$notifications = $this->notifications_model->getNotifications($user_id);
        $data['notifications'] = (count($notifications) > 10 ? array_slice($notifications,0,10) : $notifications);
        $data['count'] = count($notifications);
        $this->getTemplateJSON('includes/notification',$data);
        //$this->notifications_model->readNotifs();
    }

    public function getNotificationCount($user_id=null)
    {
    	$data['count'] = $this->notifications_model->getCount($user_id);
    	$this->getTemplateJSON('includes/badge',$data);
    }

    public function getAnnouncements()
    {
        
    }
}
