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
        $post = $this->input->post('post');
        parse_str($post,$post_data);
        $this->dock_manager_model->dock_id = $post_data['dock_id_queue'];
        $this->dock_manager_model->insertQueue($post_data);
        echo json_encode($post_data);
    }

    public function add_dock()
    {
        $post = $this->input->post('post');
        parse_str($post,$post_data);
        $this->XPO_model->addDock($post_data);
        echo json_encode($post_data);
    }

    public function getDockQueue($dock_id)
    {
        $this->dock_manager_model->dock_id = $dock_id;
        $data['queues'] = $this->dock_manager_model->getQueue($dock_id);
        $this->page = $this->page_dir.'/dock_manager_queue';
        $queues = $this->load->view($this->page,$data,TRUE);
        echo $queues;
    }

    public function getDockInfo($dock_id)
    {
        $info = $this->XPO_model->getDoor($dock_id);
        echo json_encode($info[0]);
    }

    public function checkDoorExist($dock)
    {
        $this->dock_manager_model->dock = $dock;
        $info = $this->dock_manager_model->getDoorInfo();
        echo json_encode($info);
    }

    public function save_dock_info()
    {
        $post = $this->input->post('post');
        parse_str($post,$post_data);
        $this->XPO_model->saveDock($post_data);
        $info = $this->XPO_model->getDoor($post_data['dock_id']);
        echo json_encode($info[0]);
    }
}
