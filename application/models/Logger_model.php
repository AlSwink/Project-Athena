<?php

class Logger_model extends XPO_Model {

     public $table;
     public $from;
     public $to;

     public function create($table,$columns)
     {
          $insert = $columns;
          $insert['executed_on'] = date('Y-m-d H:i:s');
          $insert['triggered_by'] = $this->user_id;

          $this->db->insert($table,$insert);
     }

     public function get()
     {
          $this->db->join('employees','employees.user_id = '.$this->table.'.triggered_by');
          $this->db->order_by('executed_on','DESC');
          return $this->db->get($this->table)->result_array();
     }
}  