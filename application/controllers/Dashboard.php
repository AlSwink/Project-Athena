<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    
	private $session_info;

	public function __construct()
    {
        parent::__construct();
        //$this->session_info = $this->session->userdata();
        check_session();
        $this->load->model('notifications_model');
    }


    public function index()
    {
    	$data['page'] = 'dashboard/default_home';
    	$this->load->view('page_w_nav',$data);
    }

    
}
