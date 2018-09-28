<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cycle_count extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('applications/Cycle_count_model');
        $this->load->model('Logger_model');   
    }

    public function insert_locations($dataset='KNK')
    {
    	$selected = $this->input->post('post');
        $this->Cycle_count_model->type = $this->input->post('type');
    	$this->Cycle_count_model->dataset = $dataset;
    	$this->Cycle_count_model->getTemplate();
    	$this->Cycle_count_model->applyTemplate($selected);

    	$this->Cycle_count_model->insert_master_pool($selected);
    	
        $log = array(
                'for' => $dataset,
                'action' => "Insert Locations",
                'reason' => "Cycle count ".count($selected)." locations"
                );
        $this->Logger_model->create('cyc_logs',$log);

        $this->getTotals($dataset);
    }

    public function generate_defaults($dataset='KNK',$count=5)
    {
    	if($this->input->post()){
    		parse_str($this->input->post('post'),$post);
    		$count = ($post['num_locs'] ? $post['num_locs'] : 5);
            $dataset = $post['dataset'];
            $this->Cycle_count_model->loc_type = ($post['loc_type'] ? $post['loc_type'] : null);
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
        $log = array(
                'for' => $dataset,
                'action' => "Fetch Locations",
                'reason' => "Creating ".$count." locations"
                );
        $this->Logger_model->create('cyc_logs',$log);
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
        $log = array(
                'for' => $dataset,
                'action' => "Check Progress",
                'reason' => "Updating counts"
                );
        $this->Logger_model->create('cyc_logs',$log);
    }

    public function getTotals($dataset='KNK')
    {
    	$totals = $this->Cycle_count_model->getTotals($dataset);
    	echo json_encode($totals);
    }

    public function delete_locations()
    {
        parse_str($this->input->post('post'),$post);
        $ids = explode('-',$post['ids']);
        $locations = explode(';',$post['locations']);
        $dataset = $post['dataset'];
        $this->Cycle_count_model->deleteLocations($ids);
        $log = array(
                'for' => implode(',',$locations),
                'action' => "Remove Locations",
                'reason' => $post['reason']
                );
        $this->Logger_model->create('cyc_logs',$log);
        $this->getTotals($dataset);
    }

    public function regenerate_cyc()
    {
        parse_str($this->input->post('post'),$post);
        $ids = explode('-',$post['ids']);
        $locs = explode(';',$post['locations']);
        $dataset = $post['dataset'];
        $this->Cycle_count_model->dataset = $dataset;

        $this->Cycle_count_model->entry_id = $ids;
        $locations = $this->Cycle_count_model->getMaster();
        $this->Cycle_count_model->getTemplate();
        $this->Cycle_count_model->applyTemplate($locations);
        $this->Cycle_count_model->insert_cc_f();
        $log = array(
                'for' => implode(',',$locs),
                'action' => "Regenerate Commands",
                'reason' => $post['reason']
                );
        $this->Logger_model->create('cyc_logs',$log);
        $this->getTotals($dataset);
    }

    
}
