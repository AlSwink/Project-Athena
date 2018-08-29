<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
         $this->load->model('applications/swi_model');
    }

    public function get_dashboard_chart()
    {
        $year = date('Y');
        $month = date('m');
        if($this->input->post()){
            $year = $this->input->post('year');
            $month = $this->input->post('month');
        }
        $this->swi_model->setFromAndTo($year,$month);
        $data = $this->swi_model->summary_report();
        echo json_encode($data);
    }

    public function get_swi_employees()
    {
        $this->swi_model->setFromAndTo();
        echo json_encode($this->swi_model->summary_employee());
    }

     public function swi_get_document($field=null,$doc_num=null)
    {
        if($doc_num)
            $docnum = $doc_num;

        if($this->input->post())
            $doc_num = $this->input->post('doc_num');

        $swi = $this->swi_model->get_swi($doc_num,$field);
        echo json_encode($swi);
    }

    public function get_document_report($year=null,$month=null)
    {
        if(!$year){
            $year = date('Y');
            $month = date('m');
        }
        $data = $this->swi_model->get_document_report($year,$month);
        echo json_encode($data);
    }

    public function get_assigned_document($id=null)
    {
        $page = '';
        if(!$id){
            $where['status'] = 'pending';
            if($this->input->post() !== ''){
            	parse_str($this->input->post('post'),$post_data);
                foreach($post_data as $key=>$val){
                    $where[$key] = $val;
                }
            }
        }else{
            $where['assignment_id'] = $id;
        }

        $assignments = $this->swi_model->get_document_assignment($where);
        $ids = array_column($assignments,'assignment_id');

        foreach($ids as $id){
            $data['data'] = $this->swi_model->get_process_assignments($id);
            $data['page'] = 'applications/swi/swi_print_worksheet';
            $page .= $this->load->view($data['page'],$data,TRUE);
        }
        $print['page'] = $page;
        $printable = $this->load->view('page_printer',$print,TRUE);

        echo json_encode($page);
    }
}
