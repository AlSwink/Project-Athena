<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->helper('directory');
        $this->load->model('auth_model');
        $this->load->model('accounts_model');
    }

    public function login()
    {
    	$post = $this->input->post();
    	$post['wms_pass'] = wms_pass_convert($post['wms_pass']);
    	$user = $this->auth_model->validate($post);
        
        if($user->haserror){
            $this->session->set_flashdata('errors',$user->errors);
            redirect(site_url());
        }
        
        $this->session->set_userdata('user_id',$user->user_id);
        $this->accounts_model->build($user->user_id);
        if($this->session->userdata('referral_url') != ''){
            $redirect = $this->session->userdata('referral_url');
            redirect($redirect);
        }else{
            redirect('dashboard');
        }
    }

    public function logout()
    {
        session_destroy();
        redirect($this->session->userdata('referral_url'));
    }

    public function unlock_user($key=NULL,$user_id)
    {
        $this->auth_model->unlock_user($user_id);
    }

    public function rebuild_usermenu($user_id)
    {
        $this->accounts_model->build($user_id);
    }
}