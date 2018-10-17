<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('applications/swi_model');
        $this->load->model('applications/Cycle_count_model');
        $this->load->model('applications/Random_audit_model');
        $this->load->model('applications/Argus_model');
    }

    public function get_app($app)
    {
        echo json_encode($this->db->get_where('apps',array('method_name'=>$app))->row());
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
        $this->swi_model->setFromAndTo($year,$month);
        $data = $this->swi_model->get_document_report();
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

    public function get_swi_assignment($id)
    {
        echo json_encode($this->swi_model->get_assignment($id));
    }

    public function getSWIReported($status=null)
    {
        if($status)
            $this->swi_model->db->where('swi_document_adjustments.status',$status);
        $reported = $this->swi_model->getReported();
        echo json_encode($reported);
    }

    public function getCycToday($dataset='KNK')
    {
        $this->Cycle_count_model->dataset = $dataset;
        $this->Cycle_count_model->setShift();
        $data = $this->Cycle_count_model->getCycToday();
        echo json_encode($data);
    }

    public function getCycCustom($dataset='KNK',$start=null,$end=null)
    {
        $start = date_format(date_create($start),'Y-m-d 00:00:00');
        $end = date_format(date_create($end),'Y-m-d 23:59:59');
        $this->Cycle_count_model->start = $start;
        $this->Cycle_count_model->end = $end;
        $data = $this->Cycle_count_model->getTotals($dataset);

        echo json_encode($data);
    }

    public function getLogs($table,$from=null,$to=null)
    {
        $this->Logger_model->table = $table;
        $logs = $this->Logger_model->get();
        echo json_encode($logs);
    }

    public function checkAccess($eroster_id)
    {
        $check = $this->XPO_model->getEmployees($eroster_id);
        echo json_encode($check);
    }

    public function getDatesReport()
    {
        $data = $this->Random_audit_model->getDatesReport();
        echo json_encode($data);
    }

    public function getLocationList()
    {
        $data = $this->Random_audit_model->getLocationList();
        echo json_encode($data);
    }

    public function argus_update_shipments()
    {
        $this->Argus_model->updateShipments();
        $this->Argus_model->check805();
    }

    public function argus_shipments()
    {
        $this->Argus_model->getShipments();
        echo json_encode($this->Argus_model->shipments);
    }

}
