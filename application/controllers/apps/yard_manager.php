<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Yard_manager extends CI_Controller {

	public function __construct()
    {
        parent::__construct();

        $this->app_info = $this->Applications_model->get_app_info('argus');
        $this->load->model('applications/yard_manager_model');
        $this->page_dir = 'applications/yard_manager';
    }

    public function transaction_save()
    {
    	parse_str($this->input->post('post'),$post_data);
    	$this->yard_manager_model->saveTransaction($post_data);
    	echo json_encode($post_data);
    }
}
