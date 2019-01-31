<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scheduler extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('applications/productivity_model');
    }

    public function save_hourly_demand($type=null)
    {
    	$this->productivity_model->type = $type;
    	if($type == 'cresting'){
            $this->productivity_model->ob_type = 'CRS';
            $this->productivity_model->standard = 'prod_crs_pph';
            $label = 'Cresting';
        }elseif($type == 'moda'){
            $this->productivity_model->from_loc = 'A%-%';
            $this->productivity_model->standard = 'prod_moda_pph';
            $label = 'MOD-A';
        }elseif($type == 'modb'){
            $this->productivity_model->from_loc = 'B%-%';
            $this->productivity_model->standard = 'prod_modb_pph';
            $label = 'MOD-B';
        }

        $this->productivity_model->getShiftData();
        echo json_encode('Success');
    }
}