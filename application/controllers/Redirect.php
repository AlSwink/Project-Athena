<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Redirect extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    }

	public function index($status)
	{
		$data['page']['css'] = ['landing'];
		$this->load->view('redirects',$data);
	}
}
