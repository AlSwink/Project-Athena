<?php

class it_5s_model extends XPO_Model {
	public $id;
	public $completed;
	
	function getTasks($status){
		return $this->xpo->get_where('it_5s',array('completed'=>$status))->result_array();
		
	}
	
	function getTask($id){
		return $this->xpo->get_where('it_5s',array('id'=>$id))->result_array();
	}
	
	function getTotal(){
		
		return $this->xpo->from('it_5s')->count_all_results();
	}
	
	
	
	function getPercentComplete(){
		
		$complete = count($this->getTasks(true));
		$total = $this->getTotal();
		return $complete/$total;
	}
	
	function save(){
		$date = new DateTime();
		
		$this->xpo->where('id',$this->id);
		$this->xpo->set('completed',$this->completed);
		$this->xpo->set('date_modified',$date->format('Y-m-d H:i:s'));
		$this->xpo->update('it_5s');
		
	}

}