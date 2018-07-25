<?php

class Applications_model extends XPO_Model {

   public function get_app_info($method)
   {
        $info = $this->db->get_where('apps',array('method_name'=>$method))->row();
        return $info;
   }    
}