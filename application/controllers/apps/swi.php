<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Swi extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('applications/swi_model');
    }

    public function save_document()
    {
        $post = $this->input->post();
        $this->swi_model->save_swi($post);
        echo create_autocomplete_source($this->swi_model->get_unique_process(),'principle_id','process');
    }

    public function get_document($field=null,$doc_num=null)
    {
        if($doc_num)
            $docnum = $doc_num;

        if($this->input->post())
            $doc_num = $this->input->post('doc_num');

        $swi = $this->swi_model->get_swi($doc_num,$field);
        echo json_encode($swi);
    }

    public function get_document_process($doc_num=null)
    {
        if($doc_num)
            $docnum = $doc_num;

        if($this->input->post())
            $doc_num = $this->input->post('doc_num');

        $process = $this->swi_model->get_process($doc_num);
        echo json_encode($process);
    }

    public function get_dashboard_employees()
    {
        echo json_encode($this->swi_model->summary_employee());
    }

    public function delete_document($docs=null)
    {
        if(!$docs){
            $docs = $this->input->post('docs');
        }
        $this->swi_model->delete_swi($docs);
        echo json_encode('DELETED');
    }

    public function assign_documents()
    {
        $data = $this->swi_model->get_assignment_pool();
        $this->swi_model->set_assignments($data);
        echo 'All documents has been successfully assigned this month';
    }

    public function assign_document()
    {
        parse_str($this->input->post('post'),$post);
        $this->swi_model->assign($post,$post['assignment_type']);
        echo json_encode('complete');
    }

    public function reset_assignment($id=null)
    {
        $where = array();

        if($id != 'all'){
            $where[] = 'assignment_id = '.$id;
        }

        $this->swi_model->reset_assignment($where);

        echo 'swi_process_assignment and swi_document_assignment has been cleared';
    }

    public function get_assigned_document($id=null)
    {
        $page = '';
        if(!$id){
            $where = array('status'=>'pending');
        }else{
            $where = array('assignment_id'=>$id);
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

    public function get_input_document($assignment_id=null)
    {
        $id = ($assignment_id ? $assignment_id : $this->input->post('post'));
        $data['questions'] = $this->swi_model->get_process_assignments($id);
        $data['page'] = 'applications/swi/swi_input_table';
        
        if($assignment_id){
            $this->load->view('page',$data);
        }else{
            $view = $this->load->view($data['page'],$data,TRUE);
            echo json_encode($view);
        }
    }

    public function save_swi_worksheet()
    {
        $post = $this->input->post('post');
        parse_str($post,$data);
        $this->swi_model->save_input_swi($data);
        echo json_encode($post);
    }

    public function mass_update()
    {
        $this->swi_model->mass_update_process();
    }

    public function get_dashboard_chart()
    {
        $data = $this->swi_model->summary_report();
        echo json_encode($data);
    }

    public function get_document_report()
    {
        $data = $this->swi_model->get_document_report();
        echo json_encode($data);
    }

    public function unassign($id)
    {
        $this->swi_model->unassign($id);
    }

    public function getEmployeeInfo($id)
    {
        $employee = $this->swi_model->getEmployee($id);
        $data['employee'] = $employee;
        $tooltip = $this->load->view('includes/emp_tooltip',$data,TRUE);
        echo $tooltip;
    }

    public function input_worksheet()
    {
        $this->kiosk = true;
        $this->page = 'applications/swi/swi_input';
        $this->page_dir = 'applications/swi';
        $this->load->view('page');
    }
}
