<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cycle_count extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('applications/Cycle_count_model');
    }

    public function insert_locations($dataset='KNK')
    {
    	$selected = $this->input->post('post');
    	$this->Cycle_count_model->dataset = $dataset;
    	$this->Cycle_count_model->getTemplate();
    	$this->Cycle_count_model->applyTemplate($selected);

    	$this->Cycle_count_model->insert_master_pool($selected);
    	echo json_encode('Location Inserted');
    }

    public function generate_defaults($dataset='KNK',$count=5)
    {
    	if($this->input->post()){
    		parse_str($this->input->post('post'),$post);
    		$count = ($post['num_locs'] ? $post['num_locs'] : 5);
    	}

    	$this->Cycle_count_model->dataset = $dataset;
    	$this->Cycle_count_model->get_lc_f();

    	$counted = $this->Cycle_count_model->getCounted();
    	$counted = array_column($counted,'loc');
    	$generated = array_column($this->Cycle_count_model->cyc_locs,'loc');
    	$locations = array_diff($generated,$counted);
		shuffle($locations);
		$insert = array_slice($locations,0,$count);
    	
    	foreach($insert as $loc){
    		$key = array_search($loc,$generated);
    		$insert_rows[] = $this->Cycle_count_model->cyc_locs[$key];
    	}   	
    	
		sort($insert_rows);
    	echo json_encode($insert_rows);
    }

    public function generate_cyc_single($dataset='KNK',$location=null)
    {
    	$this->Cycle_count_model->dataset = $dataset;
    	$location = $this->Cycle_count_model->getLocationInfo($location);
    	$location = array($location);
    	$this->Cycle_count_model->getTemplate();
    	$this->Cycle_count_model->applyTemplate($location);
    	$this->Cycle_count_model->insert_master_pool($location);
    }

    public function checkProgress($dataset='KNK',$location=null)
    {
    	$this->Cycle_count_model->dataset = 'KNK';
    	$this->Cycle_count_model->crossCheck();
    	$this->getTotals($dataset);
    }

    public function getTotals($dataset='KNK')
    {
    	$totals = $this->Cycle_count_model->getTotals($dataset);
    	echo json_encode($totals);
    }

    public function resetLastChecktoRound1()
    {

    }
}
