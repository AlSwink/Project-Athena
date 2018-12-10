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

    public function getMatchingDocks()
    {
        $post = $this->input->post('post');
        parse_str($post,$post_data);

        $this->db->where('status',0);
        $docks = $this->XPO_model->getDoor();
        $data['suggestions'] = $this->checkIfExpected($docks,$post_data);
        $page = $this->load->view('includes/suggestions',$data,TRUE);
        echo json_encode($page);
    }

    private function checkIfExpected($detail,$post)
    {
        $suggestions = array();
        
        foreach($detail as $dock){
            
            //check if pickup number exist in notes
            if($post['pickup_number']){
                if(strpos($dock['note'],$post['pickup_number'])){
                    $suggestions[] = array(
                                        'type' => 'Pickup Number Found!',
                                        'msg' => 'Related note found for this pickup number "'.$dock['note'].'" -'.$dock['e_fname'].' '.$dock['e_lname'],
                                        'dock' => $dock['dock'],
                                        'info' => $this->XPO_model->getDoor($dock['dock_id'])[0],
                                        'level' => 2
                                    );
                }
            }
            
            if($dock['detail'])
                foreach($dock['detail'] as $queue){
                    //check if pickup number exist
                    if($post['pickup_number']){
                        if($queue['pickup_number'] == $post['pickup_number']){
                            $suggestions[] = array(
                                            'type' => 'Pickup Number Found!',
                                            'msg' => 'Pickup Number is expected and should be properly routed',
                                            'dock' => $dock['dock'],
                                            'info' => $this->XPO_model->getDoor($dock['dock_id'])[0],
                                            'level' => 1
                                        );
                            
                        }
                    }

                    //check if carrier is expected
                    $start = strtotime($queue['expected_start']);
                    $end = strtotime($queue['expected_end']);
                    $now = strtotime(date('Y-m-d H:i:s'));
                    if($now < $end && $now > $start){
                        $expected = true;
                    }else{
                        $expected = false;
                    }


                    if($queue['carrier'] == $post['carrier'] && $expected){
                        $suggestions[] = array(
                                        'type' => 'Carrier is Expected!',
                                        'msg' => 'This carrier is expected to arrive at this time',
                                        'dock' => $dock['dock'],
                                        'info' => $this->XPO_model->getDoor($dock['dock_id'])[0],
                                        'level' => 3
                                    );
                    }

                    if($queue['carrier'] == $post['carrier']){
                        $suggestions[] = array(
                                        'type' => 'Carrier Match!',
                                        'msg' => 'Match found : please confirm with the warehouse',
                                        'dock' => $dock['dock'],
                                        'info' => $this->XPO_model->getDoor($dock['dock_id'])[0],
                                        'level' => 3
                                    );
                    }

                }
        }

        if(!count($suggestions)){
             $suggestions[] = array(
                                        'type' => 'No Suggestions for this Carrier!',
                                        'msg' => 'Please contact the warehouse',
                                        'dock' => 'N/A',
                                        'info' => array(),
                                        'level' => 4
                                    );
        }

        return $suggestions;
    }

}
