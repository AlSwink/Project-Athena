<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class System_health_check extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('applications/System_health_check_model');
    }

    public function getNotes()
    {
        $data['page'] = 'applications/system_health_check/notes';
        $data['notes'] = $this->System_health_check_model->getITannouncements();

        $view = $this->load->view('applications/system_health_check/notes',$data,TRUE);
        
        echo json_encode($view);
    }


    public function getOperations()
    {
        $data['page'] = 'applications/system_health_check/operations';
        $data['cards'] = $this->System_health_check_model->getITsaagcards();

        $view = $this->load->view('applications/system_health_check/operations',$data,TRUE);
        
        echo json_encode($view);
    }

    public function getServers()
    {
        $data['page'] = 'applications/system_health_check/servers';
        $data['servers'] = $this->System_health_check_model->getMachineStatus(3);

        $view = $this->load->view('applications/system_health_check/servers',$data,TRUE);
        
        echo json_encode($view);
    }

    public function getSystems()
    {
        $data['page'] = 'applications/system_health_check/systems';
        $data['systems'] = $this->System_health_check_model->getMachineStatus(2);

        $view = $this->load->view('applications/system_health_check/systems',$data,TRUE);
        
        echo json_encode($view);
    }

    public function getMachines()
    {
        $data['page'] = 'applications/system_health_check/machines';
        $data['machines'] = $this->System_health_check_model->getMachineStatus(1);

        $view = $this->load->view('applications/system_health_check/machines',$data,TRUE);
        
        echo json_encode($view);
    }
}
