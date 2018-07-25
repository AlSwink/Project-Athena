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

    public function delete_document()
    {
        $docs = $this->input->post('docs');
        $this->swi_model->delete_swi($docs);
        echo json_encode('DELETED');
    }

    public function assign_documents()
    {
        $data = $this->swi_model->set_assignment_pool();
        //$data = $this->swi_model->assign_documents_from_pool();

    }

    public function get_assigned_document($assignment_ids=array())
    {
        $print = '';
        
        $ids = array(6,7);

        foreach($ids as $id){
            $data['data'] = $this->swi_model->get_process_assignments($id);
            $data['page'] = 'applications/swi/swi_print_worksheet';
            $print .= $this->load->view('page',$data,TRUE);
        }
        
        echo json_encode($print);
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
        echo json_encode($post);
    }
}
