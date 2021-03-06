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
                                        'css'   => array(
                                                    'jquery-ui.min',
                                                    'jquery.contextMenu.min',
                                                    'daterangepicker'
                                                ),
                                        'js'    => array(
                                                    'jquery-ui.min',
                                                    'chart.min',
                                                    'jquery.contextMenu.min',
                                                    'jquery.ui.position.min',
                                                    'hermes',
                                                    'daterangepicker',
                                                    'notify.min'
                                                )
                                        )
                );

        loadView($swi);
    }

    public function argus($stage='master'){
        check_session();
        $this->model->stage = $stage;
        $this->model->getShipments();
        $this->stage = $stage;

        $argus = array(
                    'shipments' =>  $this->model->shipments,
                    'dependencies' => array(
                                        'css'   => array(
                                                    'jquery.signature',
                                                    'jquery-ui.min',
                                                    'jquery.contextMenu.min'
                                                ),
                                        'js'    => array(
                                                    'moment',
                                                    'hermes',
                                                    'jquery-ui.min',
                                                    'jquery.signature.min',
                                                    'jquery.ui.touch-punch.min',
                                                    'jquery.contextMenu.min',
                                                    'jquery.quicksearch.min',
                                                    'notify.min',
                                                    'responsivevoice',
                                                )
                                        )
                );

        loadView($argus);
    }

    public function cycle_count($dataset='KNK'){
        check_session();
        
        $cyc = array(
                    'totals' => $this->model->getTotals($dataset),
                    'dependencies' => array(
                                        'css'   => array(
                                                    'daterangepicker',
                                                    'jquery.contextMenu.min'
                                                ),
                                        'js'    => array(
                                                    'hermes',
                                                    'chart.min',
                                                    'jquery-barcode.min',
                                                    'daterangepicker',
                                                    'jquery.contextMenu.min',
                                                    'jquery.ui.position.min',
                                                    'notify.min'
                                                )
                                        )
                );

        loadView($cyc);
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
	
	public function it_5s(){
		$it5s = array(
					'incomplete' => $this->model->getTasks(false),
					'complete' => $this->model->getTasks(true),
					'total' => $this->model->getTotal(),
					'percent' => $this->model->getPercentComplete(),
					'js' => array(
							'hermes'
						)
					);
		loadView($it5s);
		
	}
	
	public function e_roster(){
		$eroster = array(
						'employees' => $this->model->get_all(),
						'wms_missing' => $this->model->get_not_in_wms(),
						'test' => $this->model->get_missing_report(),
						'positions' => $this->model->get('positions'),
						'position_data' => $this->model->get_position_numbers(),
						'agencies' => $this->model->get_temp_agencies(),
						'user_groups' => $this->model->get_wms_usrgrp(),
						'departments' => $this->model->get('departments'),
						'zones' => $this->model->get('zones'),
						'shifts' => $this->model->get('shifts'),
						'supervisors' => $this->model->get_supervisors(),
						'access_levels' => $this->model->get_access_levels(),
						'birthdays' => $this->model->get_birthdays_by_month(),
						'dependencies' => array(
											'js'    => array('hermes','chart.min','notify.min','jquery.contextMenu.min')
											)
		);	
		loadView($eroster);
			
		
	}

    public function access_verifier(){
        $ac = array(
                );

        loadView();
    }

    public function random_audit()
    {
        $ra = array(
                    'employees' => $this->model->getEmployeesReport(),
                    'dependencies' => array(
                                        'css'   => array(
                                                    'daterangepicker',
                                                    'jquery.contextMenu.min'
                                                ),
                                        'js'    => array(
                                                    'hermes',
                                                    'chart.min',
                                                    'notify.min',
                                                    'jquery.contextMenu.min',
                                                    'daterangepicker'
                                                )
                                        )
                );

        loadView($ra);
    }

    public function replenisher()
    {
        check_session();
        $replen = array(
                    'cresting_waves' => $this->model->getWaves('Cresting'),
                    'dependencies' => array(
                                        'css' => array(
                                                    'jquery.contextMenu.min'
                                        ),
                                        'js' => array(
                                                    'hermes',
                                                    'notify.min',
                                                    'jquery.contextMenu.min'
                                                )
                                        )
                );

        loadView($replen);
    }

    public function dock_manager()
    {
        check_session();
        $docker = array(
                    'carriers' => $this->XPO_model->getCarriers(),
                    'buildings' => $this->XPO_model->getBuildings(),
                    'dependencies' => array(
                                        'css' => array(
                                                    'jquery.contextMenu.min',
                                                    'daterangepicker'
                                        ),
                                        'js' => array(
                                                    'hermes',
                                                    'moment',
                                                    'jquery.contextMenu.min',
                                                    'notify.min',
                                                    'daterangepicker'
                                        ),
                                    )
                );

        loadView($docker);
    }

    public function yard_manager()
    {
        check_session();
        $yard = array(
                    'carriers' => $this->XPO_model->getCarriers(),
                    'buildings' => $this->XPO_model->getBuildings(),
                    'dependencies' => array(
                                        'css' => array(
                                                    'jquery.contextMenu.min',
                                                    'daterangepicker'
                                        ),
                                        'js' => array(
                                                    'hermes',
                                                    'moment',
                                                    'jquery.contextMenu.min',
                                                    'notify.min',
                                                    'daterangepicker'
                                        ),
                                    )
                );

        loadView($yard);
    }

    public function productivity($type)
    {
        $this->model->setProdType($type);
        $prod = array(
                    'type' => $type,
                    'data' => $this->model->getShiftData(),
                    'title' => $this->model->label,
                    'dependencies' => array(
                                        'js' => array(
                                                'hermes'
                                        )
                                    )
                );

        loadView($prod);
    }
}
