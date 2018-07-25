<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->helper('directory');
        $this->session->keep_flashdata('errors'); 
    }

	public function index()
	{
		//landing and redirect catch page
		if($this->session->userdata('user_id') != ''){
			redirect('dashboard');
		}


		$data['template'] = 'landing/login';
		$data['dependencies']['css'] = ['landing'];
		$data['dependencies']['js'] = ['landing'];
		$this->load->view('landing',$data);
	}

	public function getLandingPhotos()
	{
		//grabs all photos in assets/img/landing directory and return it as json. see assets/js/landing.js
		$photos = directory_map('./assets/img/landing/');
		echo json_encode($photos);
	}

	public function request_login()
	{
		//independent page catcher for request_login
		$data['template'] = 'landing/request_login';
		$data['dependencies']['css'] = ['landing'];
		$data['dependencies']['js'] = ['landing'];
		$this->load->view('landing',$data);
	}

	public function having_troubles()
	{
		//independent page catcher for request_login
		$data['template'] = 'landing/having_troubles';
		$data['dependencies']['css'] = ['landing'];
		$data['dependencies']['js'] = ['landing'];
		$this->load->view('landing',$data);
	}
}
