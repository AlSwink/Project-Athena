<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class E_roster extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('applications/E_roster_model');
    }

    
}
?>