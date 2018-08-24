<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Redirect extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    }

	public function index($status=null)
	{
		$this->page = 'includes/missing_page';
		$this->load->view('page');
	}

	public function referral($class,$method)
	{
		$route = site_url($class.'/'.$method);
		$this->session->set_userdata('referral_url',$route);
		var_dump($this->session->userdata('user_id'));
		if($this->session->userdata('user_id') !== NULL){
			redirect($route);
		}else{
			redirect('login');
		}
	}
}
