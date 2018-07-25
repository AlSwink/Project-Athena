<?php

class Auth_Model extends XPO_Model {

	public $username;
    public $haserror;
	public $errors;
    public $user_id;
    public $user_type;
    public $creator_id;
    
    private $password;
    private $login_attempt;

    function validate($creds)
    {
        $this->username = $creds['wms_user'];
        $this->password = $creds['wms_pass'];
        $this->check();

        return $this;
    }

    private function check()
    {
        $check = $this->db->get_where('users_login',array('username'=>$this->username))->row();

        if(!$check){
            $this->set_errors('wms_user','User does not exist');
            return false;
        }

        $this->set_user($check);

        if($check->password != $this->password){
            $this->update_attempt();
            return false;
        }

        if($check->deleted){
            $this->set_errors('wms_user','User does not exist');
            return false;
        }

        if(!$check->active){
            $this->set_errors('wms_user','User is currently suspended');
            return false;
        }

        if($check->locked_out){
            $this->set_errors('wms_user','You have been locked out. Please see your manager');
            return false;
        }

        $this->update_attempt(1);
    }

    private function set_user($user)
    {
        $this->user_type = $user->user_type;
        $this->user_id = $user->user_id;
        $this->login_attempt = $user->login_attempt;
        $this->creator_id = $user->creator_id;
    }

    private function update_attempt($reset=NULL)
    {
        $current_attempt = $this->login_attempt + 1;
        $this->db->where('user_id',$this->user_id);

        if($reset){
            $current_attempt = 0;
        }elseif($current_attempt < $this->login_max_attempt){
            $this->set_errors('wms_pass','Incorrect Password Attempt ('.$current_attempt.'/'.$this->login_max_attempt.')');
        }else{
            $this->set_errors('wms_pass','You have been locked out. Please see your manager');
            $this->db->update('users_login',array('locked_out'=>1));
        }

        $this->db->set('login_attempt',$current_attempt);
        $this->db->update('users_login');
    }

    private function set_errors($field=NULL,$error = NULL)
    {
        $errors = array(
            'field' => $field,
            'error' => $error
        );

        $this->haserror = TRUE;
        $this->errors = $errors;
    }

    public function unlock_user($user_id)
    {
        $this->db->set('locked_out',0);
        $this->db->set('login_attempt',0);
        $this->db->where('user_id',$user_id);
        $this->db->update('users_login');
    }
}