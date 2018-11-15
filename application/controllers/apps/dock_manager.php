<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dock_manager extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->app_info = $this->Applications_model->get_app_info('argus');
        $this->load->model('applications/dock_manager_model');
        $this->page_dir = 'applications/dock_manager';
    }

    public function add_dock_queue()
    {
        $post = $this->input->post();
        $this->dock_manager_model->dock_id = $post['dock_id_queue'];
        $this->dock_manager_model->insertQueue($post);
        
    }

    public function getDockQueue($dock_id)
    {
        $this->Dock_manager->dock_id = $dock_id;

    }
}
