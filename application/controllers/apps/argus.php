<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Argus extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        check_session();
        $this->load->model('applications/argus_model');
        $this->page_dir = 'applications/argus';
    }

    public function display()
    {
    	$this->page = $this->page_dir.'/argus_display';
        $this->load->view('page');
    }
}
