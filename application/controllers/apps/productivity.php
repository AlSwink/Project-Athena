<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productivity extends CI_Controller {

	public function __construct()
    {
        parent::__construct();

        $this->app_info = $this->Applications_model->get_app_info('argus');
        $this->load->model('applications/productivity_model');
        $this->page_dir = 'applications/productivity';
    }

    public function save_shift()
    {
        $type = $this->input->post('type');
        
        parse_str($this->input->post('post'),$post_data);
        $this->productivity_model->saveSetting($post_data);
        $this->getAdminHTML($type);
    }

    public function save_reason()
    {
        $post_data = $this->input->post();
        $this->productivity_model->saveHourData($post_data['ph_id'],'reason',$post_data['reason']);
        echo json_encode($post_data);
    }

    public function individual_tracker()
    {
        $this->page = $this->page_dir.'/productivity_individual';
        $this->productivity_model->setProdType('cresting');
        $prod = $this->productivity_model->getCRSIndividual();
        $data['data'] = ($prod ? $prod : NULL);
        echo $this->load->view($this->page,$data,TRUE);
    }

    public function test()
    {
        $this->page = $this->page_dir.'/test';
        $this->productivity_model->setProdType('cresting');
        $data['data'] = $this->productivity_model->getCRSIndividual();
        //echo '<pre>';
        //var_dump($data['data']);
        $this->load->view('page',$data);
    }

    public function test2()
    {
        $this->page = $this->page_dir.'/test';
        $this->productivity_model->setProdType('cresting');
        $data['data'] = $this->productivity_model->getCRSIndividual2();
        //echo '<pre>';
        //var_dump($data['data']);
        //$this->load->view('page',$data);
    }

    public function test3()
    {
        $this->productivity_model->getHours();
        $hours = $this->productivity_model->hours;
    	$goal = 5000;
    	$done = 0;
    	$dropped = 0;
    	$labor = 0;

        for($x=0;$x<count($hours);$x++){
            $hours[$x] = $this->productivity_model->saag($this->productivity_model->hours[$x]['from'],$this->productivity_model->hours[$x]['to']);
            $hours[$x]['label'] = $this->productivity_model->hours[$x]['label'];
            
            $done = $done + ($hours[$x]['processed'] ? $hours[$x]['processed'] : 0);
            $dropped = $dropped + ($hours[$x]['dropped'] ? $hours[$x]['dropped'] : 0);
            if($hours[$x]['processed']){
                $labor++;
            }
        }

	    $totals = array(
        			'hours'=>$hours,
        			'done' => $done,
        			'dropped' => $dropped,
        			'remaining' => $goal - $done
			     ); 
        $totals['uph'] = ($labor ? $done / $labor : 0);
        $this->page = $this->page_dir.'/test2.php';
        $this->load->view('page',$totals);
    }

    public function getAdminHTML($type=null)
    {
        $this->productivity_model->setProdType($type);
        $page = '';
        $data['data'] = $this->productivity_model->getShiftData();
        $page .= $this->load->view($this->page_dir.'/productivity_admin_cards',$data,TRUE);
        $page .= $this->load->view($this->page_dir.'/productivity_hour_lines',$data,TRUE);
        echo $page;
    }

    public function getPickersOnHour()
    {
        $this->page = $this->page_dir.'/productivity_hour_detail';
        $this->productivity_model->checkShift();
        $post_data = $this->input->post();
        $this->productivity_model->setProdType($post_data['type']);
        $pickers = $this->productivity_model->getPickers($post_data['from'],$post_data['to']);

        foreach($pickers as $picker){
            
            $data['pickers'][] = array(
                                    'opr' => ucwords($picker['picker']),
                                    'db' => $this->productivity_model->getHoursWorked($picker['picker'],$post_data['ph_id']),
                                    'mod' => $this->productivity_model->getIndividualPicks($picker['opr'],$post_data['from'],$post_data['to'],'mod'),
                                    'out' => $this->productivity_model->getIndividualPicks($picker['opr'],$post_data['from'],$post_data['to'],'out'),
                                    'crs' => $this->productivity_model->getIndividualPicks($picker['opr'],$post_data['from'],$post_data['to'],'crs'),
                                    'qp' => $this->productivity_model->getIndividualPicks($picker['opr'],$post_data['from'],$post_data['to'],'qp')
                                );
        }

        //var_dump($data['pickers']);
        $data['ph_id'] = $post_data['ph_id'];
        $page = $this->load->view($this->page,$data,TRUE);
        echo $page;
    }

    public function saveHoursWorked()
    {
        parse_str($this->input->post('post'),$post_data);
        $this->productivity_model->saveHourWorked($post_data);
        echo json_encode($post_data);
    }

    public function display($type=null)
    {
        $page = '';
        $this->productivity_model->setProdType($type);
        $data['data'] = $this->productivity_model->getShiftData();
        $this->page = $this->page_dir.'/display';
        
        $graph[] = array(
                        'label' => 'Actuals',
                        'type' => 'line',
                        'backgroundColor' => "black",
                        'borderColor' => "black",
                        'fill' => false,
                        'lineTension' => 0,
                        'data' => $this->productivity_model->graph_picks
                        );

        $graph[] = array(
                        'label' => 'Targets',
                        'type' => 'line',
                        'backgroundColor' => "#e68100",
                        'borderColor' => "#e68100",
                        'fill' => false,
                        'lineTension' => 0,
                        'data' => $this->productivity_model->graph_targets
                        );
        
        $data['graph'] = $graph;
        $data['time_range'] = $this->productivity_model->time_ranges;
        $data['dependencies']['js'] = ['chart.min'];
        $page .= $this->load->view('page',$data,TRUE);

        echo $page;
    }
}
