<?php

class System_health_check_model extends XPO_Model {

	public function getITannouncements()
	{
		$announcements = $this->db->get_where('it_announcements',array('deleted'=>0))->result();
		return $announcements;
	}

	public function getITsaagcards()
	{
		$cards = array();

		$queries = $this->db->get_where('it_saag_cards',array('deleted'=>0))->result();

		foreach($queries as $query){
			$field = (string)$query->field_to_show;
			$q = $this->load->database($query->db,TRUE);
			$field_display = $q->query($query->query)->row()->$field;

			$card['title'] = ucwords(strtolower($query->card_title));
			
			if($query->field_to_show_function){
				$field_function = $query->field_to_show_function;
				$card['field_to_show'] = $field_function($field_display,$query->field_to_show_param);
			}else{
				$card['field_to_show'] = $field_display;
			}

			
			if($query->subtext_function){
				$subtext_function = $query->subtext_function;
				$sub = eval('return $'.$query->subtext.';');
				$card['subtext'] = $subtext_function($sub,$query->subtext_param);
			}else{
				$card['subtext'] = $query->subtext;
			}

			if($query->color_function){
				$color_function = $query->color_function;
				$col = eval('return $'.$query->subtext.';');
				$card['color'] = $color_function($col,$query->color_param);
			}else{
				$card['color'] = $query->color;
			}

			$cards[] = $card;
		}
		
		return $cards;
	}

	public function getMachineStatus($level=null)
	{
		$machine_cards = array();

		if($level){
			$this->db->where('level',$level);
		}

		$machines = $this->db->get_where('machine_ips',array('deleted'=>0,'monitor'=>1))->result();

		foreach($machines as $machine)
		{
			$machine_cards[] = array(
								'name' => $machine->machine_name,
								'ip' => $machine->ip_addr,
								'color' => checkSaagAlert($machine->ip_addr,'network')
								);
		}

		return $machine_cards;
	}

	public function getIntervals()
	{
		$intervals = array(
						'notes' => $this->it_notes_refresh,
						'operations' => $this->operations_refresh,
						'servers' => $this->servers_refresh,
						'systems' => $this->systems_refresh,
						'machines' => $this->machines_refresh
						);

		return $intervals;
	}
}