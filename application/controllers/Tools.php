<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tools extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Tools_model');
        $this->load->helper('ssh_helper');
        $this->load->helper('imagick_helper');
    }

    public function kill_intransit($standalone=false){
    	$data = array();
    	$data['tool_info'] = $this->Tools_model->get_tool_info('kill_intransit');
    	$data['page'] = 'tools/kill_intransit';

    	if($standalone){
    		$this->load->view('page',$data);
    	}else{
    		echo json_encode($this->load->view($data['page'],$data,TRUE));	
    	}    	
    }

    public function reprint_nf($standalone=false){
        $data['tool_info'] = $this->Tools_model->get_tool_info('reprint_nf');
        $data['page'] = 'tools/reprint_nf';

        if($standalone){
            $this->load->view('page',$data);
        }else{
            echo json_encode($this->load->view($data['page'],$data,TRUE)); 
        } 
    }

    public function check_804()
    {
        $conts = $this->input->post('conts');
        $data['conts'] = $this->Tools_model->check_804($conts);
        $view = $this->load->view('tools/reprint_nf_process_list',$data,TRUE);
        echo json_encode($view);
    }

    public function download_label($cont=null)
    {
        $cont = $this->input->post('cont');
        $new_cont = getNFlabel($cont);
        echo json_encode($new_cont);
    }

    public function crop_nf_label($cont=null,$from_dir=null,$to_dir=null)
    {
        $cont = $this->input->post('cont');
        cropNFlabel($cont);
        echo json_encode($cont);
    }

    public function generate_nf_labels($conts=null)
    {
        //$cont = $this->input->post('cont');
        $data['info'] = $this->Tools_model->get_label_info($conts);
        $data['page'] = 'tools/reprint_nf_print';
        $this->load->view('page',$data);
    }
}
