<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Applications extends CI_Controller {

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
        $this->app_info = $this->Applications_model->get_app_info($method);
        $this->view_page = 'applications/'.$method;
        $this->page = $this->view_page.'/index';
        $this->page_dir = $this->view_page;
    }

    public function swi(){
        check_session();
        $this->model->setFromAndTo(date('Y'),date('m'));
        $swi = array(
                    'processes'     => $this->model->get_unique_process(),
                    'swi_docs'      => $this->model->get_swi(),
                    'totals'        => $this->model->summary_report(),
                    'departments'   => $this->model->getDepartmentIds(),
                    'dependencies' => array(
                                        'css'   => array('jquery-ui.min','jquery.contextMenu.min'),
                                        'js'    => array('jquery-ui.min','chart.min','jquery.contextMenu.min','jquery.ui.position.min','moment')
                                        )
                );

        loadView($swi);
    }

    public function system_health_check(){
        $shc = array(
                    'intervals' => $this->model->getIntervals(),
                    'notes' =>  $this->model->getITannouncements(),
                    'dependencies' => array(
                                'css'   => array('jquery-ui.min'),
                                'js'    => array('jquery-ui.min')
                                )
                );

        loadView($shc);
    }
}
