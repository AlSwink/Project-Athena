<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Argus extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        check_session();
        $this->app_info = $this->Applications_model->get_app_info('argus');
        $this->load->model('applications/argus_model');
        $this->page_dir = 'applications/argus';
    }

    public function display()
    {
    	$this->page = $this->page_dir.'/argus_display';
        $this->load->view('page');
    }

    public function accept_trailer()
    {
        $data['carriers'] = $this->XPO_model->getCarriers();
        $this->page = $this->page_dir.'/argus_accept_trailer';
        $this->load->view('page',$data); 
    }

    public function release_trailer()
    {
        $this->page = $this->page_dir.'/argus_release_trailer';
        $this->load->view('page'); 
    }

    public function check805($shipment=null)
    {
    	$this->argus_model->check805($shipment);
    }

    public function syncShipments()
    {
    	$page = '';
    	$this->argus_model->updateShipments();
    	$this->check805();
    	$this->argus_model->getShipments();
    	$template = $this->page_dir.'/argus_shipment_card';
    	$shipments = $this->argus_model->shipments;
    	
    	foreach($shipments as $shipment){
    		$data['shipment'] = $shipment;
    		$page .= $this->load->view($template,$data,TRUE);
    	}

    	echo json_encode($page);
    }

    public function getDetails($shipment=null)
    {
    	if(!$shipment){
    		$shipment = $this->input->post('post');
    	}
    	
    	$this->argus_model->getShipmentDetails($shipment);
    	$data['shipment'] = $this->argus_model->shipment;
    	$page = $this->page_dir.'/argus_shipment_details';
    	$view = $this->load->view($page,$data,TRUE);
    	if($data['shipment']['wms']){
    		echo json_encode($view);	
    	}else{
    		echo json_encode(false);
    	}
    }

    public function getShipment($shipment=null)
    {
    	if(!$shipment){
    		$shipment = $this->input->post('post');
    	}
    	
    	$this->argus_model->getShipmentDetails($shipment);
    	$this->argus_model->getVerification();
    	echo json_encode($this->argus_model->shipment);
    }

    public function updateShipment()
    {
    	$post = $this->input->post();

    	$this->argus_model->getShipment($post['shipment']);

    	$this->argus_model->type = $post['type'];
    	$this->argus_model->stage = $post['stage'];
    	$this->argus_model->shipment_name = $post['shipment'];
    	$this->argus_model->updateShipment();
    }

    public function updateShipmentLock()
    {
    	$post = $this->input->post();
    	$this->argus_model->getShipment($post['shipment']);
    	$this->db->set('locked',$post['lock']);
    	$this->argus_model->save();
    }

    public function clearTables()
    {
    	$this->db->truncate('argus_shipments');
    	$this->db->truncate('argus_transactions');
    }

    public function verifyNesting($shipment=null)
    {
    	if(!$shipment){
    		$shipment = $this->input->post('shipment');
    	}

    	$this->argus_model->getShipment($shipment);
    	$this->argus_model->getUnnested();
    	$this->argus_model->unnested = array_values($this->argus_model->unnested);
    	if(count($this->argus_model->unnested)){
    		echo json_encode($this->argus_model->unnested);
    	}else{
    		echo json_encode(false);
    	}
    }

    public function submitVerification()
    {
    	$post = $this->input->post();
    	$this->argus_model->insertVerification($post);
    	echo json_encode($post);
    }

    public function submitQA()
    {
    	$post = $this->input->post();
    	$this->argus_model->updateVerification($post);
    	echo json_encode($post);
    }

    public function getDockDoors()
    {
        //$post = $this->input->post();
        $this->db->where('dept_id',1);
        $data['doors'] = $this->XPO_model->getDoor();

        foreach($data['doors'] as $door){

        }

        $this->page = $this->page_dir.'/argus_dock_select';
        $this->load->view('page',$data);
        //echo json_encode($post);
    }

    public function dock_manager()
    {
        $this->page = $this->page_dir.'/argus_dock_manager';
        $this->load->view('page');
    }

    private function checkIfExpected($detail)
    {

    }

}
