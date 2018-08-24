<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tools extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Tools_model');
        $this->load->helper('ssh_helper');
        $this->load->helper('imagick_helper');
        
        $this->standalone = $this->uri->segment(2,FALSE);
        
        $method = $this->router->fetch_method();
        $this->appdb = ($this->session->userdata('test') ? 'wms_test' : 'wms');
        $this->page = 'tools/'.$method;        
        $this->tool_info = $this->Tools_model->get_tool_info($method);
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

    public function add_bulk_locations($param=false)
    {
        $this->session->set_userdata('test',($param == 'test' ? true : false));
        loadView();
    }

    public function prepare_bulk_locations()
    {
        parse_str($this->input->post('post'),$post);
        
        $data['headers'] = array_keys($post);
        foreach($post as $key => $val){
            $rows[$key] = array_filter(explode(PHP_EOL,$val));
        }

        for($x=0;$x<count($rows[$data['headers'][0]]);$x++){
            foreach($data['headers'] as $header){
                $data['rows'][$x][$header] = trim($rows[$header][$x]);
            }
        }

        $this->page = 'includes/table_preview';
        $view = $this->load->view($this->page,$data,TRUE);
        echo $view;
    }

    public function verify_bulk_locations()
    {
        $insert = array();
        $data['existing'] = array();
        parse_str($this->input->post('post'),$post);
        $wms = $this->load->database($this->appdb,TRUE);
        
        $post_keys = array_keys($post);
        unset($post_keys[0]);
        $format_basis = explode('-',$post['locations'][0]);
        $format_1 = $format_basis[0];
        $format_chr_count = strlen($format_1) -1;
        $format = $format_1[0].str_repeat('%',$format_chr_count).'-%';
        
        $batch = array_chunk($post['locations'],1000);
        foreach($batch as $chunk){
            $locs = implode("','",$chunk);
            $query = "SELECT loc FROM lc_f WHERE loc IN ('".$locs."')";
            $check_duplicate = $wms->query($query);    
            if($check_duplicate->num_rows()){
                $duplicates = array_map('trim',array_column($check_duplicate->result_array(),'loc'));
                $data['existing'] = array_merge($data['existing'],$duplicates);
            }
        }

        $query = "SELECT FIRST 1 * FROM lc_f WHERE loc LIKE '".$format."' AND empty = 'E'";
        $template = $wms->query($query);
        $data['template'] = $template->row_array();
        $template_headers = array_keys($data['template']);
        for($x=0;$x<count($post['locations']);$x++){
            if(!in_array($post['locations'][$x],$data['existing'])){
                foreach($template_headers as $column){
                    $insert[$x][$column] = trim($data['template'][$column]);
                }
                foreach($post_keys as $key){
                    $insert[$x][$key] = $post[$key][$x];
                }
                $insert[$x]['loc'] = $post['locations'][$x];
                $insert[$x]['cmd_seq'] = substr(str_replace('-', '',$post['locations'][$x]),2);
                $insert[$x]['store_seq'] = substr(str_replace('-', '',$post['locations'][$x]),2);
                $insert[$x]['empty'] = 'E';
                $insert[$x]['pgmmod'] = 'web_bulk_insert';
                $insert[$x]['dtimecre'] = date('Y-m-d H:i:s');
                $insert[$x]['usrmod'] = 'OPER';
                $insert[$x]['dtimemod'] = date('Y-m-d H:i:s');
            }
        }
        $data['locations'] = count($post['locations']);
        $data['insert'] = $insert;
        $data['format'] = $format;
        //$data['page'] = $this->page;
        //$this->load->view('page',$data);

        $view = $this->load->view($this->page,$data,TRUE);
        echo $view;
    }

    public function insert_bulk_locations()
    {
        $wms = $this->load->database($this->appdb,TRUE);
        $post = $this->input->post();

        $return_url = $_SERVER['HTTP_REFERER'];
        
        if(!isset($post['locs']) ){
            redirect($return_url);
        }else{  
            $query = "SELECT FIRST 1 * FROM lc_f WHERE loc LIKE '".$post['template_loc']."' AND empty = 'E'";
            $template = $wms->query($query);
            $row_template = $template->row_array();
            $template_headers = array_keys($row_template);

            for($x=0;$x<count($post['locs']);$x++){
                    foreach($template_headers as $column){
                        $insert[$x][$column] = trim($row_template[$column]);
                    }

                    $insert[$x]['loc'] = $post['locs'][$x];
                    $insert[$x]['cmd_seq'] = substr(str_replace('-', '',$post['locs'][$x]),2);
                    $insert[$x]['store_seq'] = substr(str_replace('-', '',$post['locs'][$x]),2);
                    $insert[$x]['empty'] = 'E';
                    $insert[$x]['pgmmod'] = 'web_bulk_insert';
                    $insert[$x]['dtimecre'] = date('Y-m-d H:i:s');
                    $insert[$x]['usrmod'] = 'OPER';
                    $insert[$x]['dtimemod'] = date('Y-m-d H:i:s');
            }

            $this->session->set_userdata('location_added',count($insert));
            $batch = array_chunk($insert,300);
            foreach($batch as $insert_batch){
                foreach($insert_batch as $row){
                    $values = NULL;
                    $values = " ('".implode("','",$row)."')";
                    $query = 'INSERT INTO lc_f VALUES'.$values;
                    //$wms->query($query);
                }
            }
            redirect($return_url);
        }
    }
}
