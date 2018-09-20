<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Displays extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        //set view type html(true)/json(false)
        $this->standalone = $this->uri->segment(2,FALSE);
        $method = $this->router->fetch_method();

        //dynamic model initialization
        $this->load->model('Applications_model');
        $this->load->model('applications/'.$method.'_model',$method);
        $this->model = $this->$method;

        //dynamic view initialization
        $this->view_page = 'applications/'.$method;
        $this->page = $this->view_page.'/'.$method;
        $this->page_dir = $this->view_page;
    }

    public function swi($dept_id)
    {
        $this->model->setDepartment($dept_id);
        $this->model->setFromAndTo();

        $data = array(
                    'summary' => $this->model->getProgressBoard(),
                    'bars' => $this->model->get_document_report(),
                    'totals' => $this->model->summary_report(),
                    'processes'     => $this->model->get_unique_process(),
                    'dependencies' => array(
                                        'js'    => array('chart.min','moment','hermes')
                                        )
                    );

        $this->page = $this->page_dir.'/swi_progress_board';
        $this->load->view('page',$data);
    }
}
