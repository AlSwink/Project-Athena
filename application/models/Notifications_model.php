<?php

class Notifications_Model extends XPO_Model {

    public function getNotifications($user_id = null)
    {
    	$this->db->order_by('created','DESC');
    	$notifs = $this->db->get_where('notifications',array('user_id'=>$this->user_id,'seen'=>0))->result();
    	return $notifs;
    	$this->readNotifs();
    }

    public function readNotifs($id=null)
    {
    	$this->db->set('seen',1);
    	$this->db->where('seen',0);
    	$this->db->where('user_id',$this->user_id);
    	$this->db->order_by('notif_id');
    	$this->db->limit(10);
    	$this->db->update('notifications');
    }

    public function getCount($user_id=null)
    {
    	$count = $this->db->get_where('notifications',array('user_id'=>$this->user_id,'seen'=>0))->result();
    	return count($count);
    }

    public function sendEmail($email=null)
    {
        $config['protocol'] = $this->email_protocol;
        $config['smtp_host'] = $this->email_host;
        $config['smtp_port'] = $this->email_port;
        $config['smtp_user'] = $this->email_user;
        $config['smtp_pass'] = $this->email_pass;
        $config['smtp_timeout'] = '30';
        $config['smtp_crypto'] = $this->email_crypto;
        $config['mailtype'] = 'html';
        $config['newline'] = "\r\n";
        $config['charset'] = 'utf-8';
        $config['crlf'] = "\r\n";
        
        $this->email->initialize($config);
        $email['message'] .= '<span style="color: gray;font-style: italic;">This is an automated message from the system. Please do not reply. For any other concerns please contact <a href="mailto:SCKNTHelp@xpo.com">SCKNTHelp@xpo.com</a></span>';
        $this->email->from($this->email_user);
        $this->email->to($email['to']);
        $this->email->subject($email['subject']);
        $this->email->message($email['message']);
        $this->email->send();
    }
}