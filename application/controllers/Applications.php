<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Applications extends CI_Controller {

    private $view_page;
    private $data;

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Applications_model');
        $this->view_page = 'applications/'.$this->router->fetch_method();
        $this->data = array(
                        'app_info'  =>  $this->Applications_model->get_app_info($this->router->fetch_method()),
                        'page'      =>  $this->view_page.'/index',
                        'page_dir'  =>  $this->view_page,
                    );

    }

    public function odyssey($standalone=false){
        $data = array(
                    'app_info'  =>  $this->Applications_model->get_app_info($this->router->fetch_method()),
                    'page'      =>  $this->view_page.'/index',
                    'dependencies'  => array(
                                            'css'   =>  array('mdb.min','style'),
                                            'js'    =>  array('mdb.min')
                                            ),
                );


        if($standalone){
            $this->load->view('page',$data);
        }
    }

    public function swi($standalone=false){
        $this->load->model('applications/swi_model');

        $swi = array(
                    'processes'     => $this->swi_model->get_unique_process(),
                    'swi_docs'      => $this->swi_model->get_swi(),
                    'totals'        => $this->swi_model->summary_report(),
                    'dependencies' => array(
                                        'css'   => array('jquery-ui.min'),
                                        'js'    => array('jquery-ui.min','printThis')
                                        )
                );

        $this->data = array_merge($this->data,$swi);

        if($standalone){
            $this->load->view('page',$this->data);
        }else{
            echo json_encode($this->load->view($this->data['page'],$this->data,TRUE));
        }
    }

    public function system_health_check($standalone=false){
        $this->load->model('applications/System_health_check_model');

        $shc = array(
                    'intervals' => $this->System_health_check_model->getIntervals(),
                    'notes' =>  $this->System_health_check_model->getITannouncements(),
                    'dependencies' => array(
                                'css'   => array('jquery-ui.min'),
                                'js'    => array('jquery-ui.min')
                                )
                );

        $this->data = array_merge($this->data,$shc);

        if($standalone){
            $this->load->view('page',$this->data);
        }else{
            echo json_encode($this->load->view($this->data['page'],$this->$data,TRUE));
        }
    }
}
