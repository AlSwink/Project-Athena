<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Swi extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        check_session();
        $this->load->model('applications/swi_model');
        $this->page_dir = 'applications/swi';
    }

    public function save_document()
    {
        $post = $this->input->post();
        $this->swi_model->save_swi($post);
        echo create_autocomplete_source($this->swi_model->get_unique_process(),'principle_id','process');

        $action = (isset($post['doc_id']) ? 'Added' : 'Edited');
        $log = array(
                'for' => $post['doc_num'].' - '.$post['doc_name'],
                'action' => "Document ".$action,
                'reason' => 'System Log'
                );
        
        $this->Logger_model->create('swi_logs',$log);
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

    public function delete_document($docs=null)
    {
        if(!$docs){
            $docs = $this->input->post('docs');
        }
        $this->swi_model->delete_swi($docs);

        $log = array(
                'for' => 'DOCID : '.implode(',',$docs),
                'action' => "Deleted documents",
                'reason' => 'System Log'
                );
        
        $this->Logger_model->create('swi_logs',$log);

        echo json_encode('DELETED');
    }

    public function assign_documents($test=null)
    {
        $data = $this->swi_model->get_assignment_pool();
        if($test){
            $this->swi_model->set_assignment_pool($data);
        }else{
            $this->swi_model->set_assignments($data);    
        }

        $log = array(
                'for' => date('Y-m'),
                'action' => "Document Assignment generation",
                'reason' => 'System Log'
                );
        
        $this->Logger_model->create('swi_logs',$log);

        echo 'All documents has been successfully assigned this month';
    }

    public function assign_document()
    {
        parse_str($this->input->post('post'),$post);
        $this->swi_model->assign($post,$post['assignment_type']);

        $log = array(
                'for' => 'DOC ID : '.$post['assign_doc_id'].' to USER ID :'.$post['reassign_to_emp_id'],
                'action' => "Assign document",
                'reason' => 'System Log'
                );
        
        $this->Logger_model->create('swi_logs',$log);

        echo json_encode($post);
    }

    public function reset_assignment($id=null)
    {
        if(!$id){
            $id = $this->input->post('confirm_assignment_id');
        }
        $this->swi_model->reset_assignment($id);
        echo json_encode('SWI assignment number '.$id.' has been reset');
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

    public function unassign($id)
    {
        $this->swi_model->unassign_assignment($id);
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
        $this->page = $this->page_dir.'/swi_input';
        $this->load->view('page');
    }

    public function resolution()
    {
        $this->kiosk = true;
        $this->page = $this->page_dir.'/swi_resolution';
        $this->load->view('page');
    }

    public function worksheet()
    {
        $this->kiosk = true;
        $this->page = $this->page_dir.'/swi_worksheet';
        $this->load->view('page');
    }

    public function override_assignment()
    {
        $post = $this->input->post();
        $update = $this->swi_model->updateAssignment($post);

        $log = array(
                'for' => 'Assignment '.$post['assignment_id'],
                'action' => "Override Assignment",
                'reason' => $post['reason']
                );
        
        $this->Logger_model->create('swi_logs',$log);
        echo json_encode($log['action'].$log['for'].' - '.$log['reason']);
    }

    public function save_resolution()
    {
        parse_str($this->input->post('post'),$post);
        $this->swi_model->saveResolution($post);

        $log = array(
                'for' => 'ADJID : '.$post['adj_id'],
                'action' => "Submit resolution",
                'reason' => 'System Log'
                );
        
        $this->Logger_model->create('swi_logs',$log);
        echo json_encode($log['action'].' '.$log['for']);
    }
}
