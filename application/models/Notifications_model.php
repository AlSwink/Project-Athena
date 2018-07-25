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
}