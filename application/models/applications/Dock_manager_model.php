<?php

class Dock_manager_model extends XPO_Model {

	public $dock_id;
	public $dock;
	public $building_id;
	public $status;
	public $note;
	public $category;
	public $dept_id;

	public function insertQueue($data){
		$insert = array(
					'dock_id' => $this->dock_id,
					'carrier' => $data['carrier_code'],
					'pickup_number' => $data['pickup_number'],
					'expected_start' =>  date_format(date_create($data['from']),'Y-m-d H:i:s'),
					'expected_end' => date_format(date_create($data['to']),'Y-m-d H:i:s'),
					'created_on' => date('Y-m-d H:i:s'),
					'created_by' => $this->user_id,
					'deleted' => 0,
				);

		$this->db->insert('site_docks_detail',$insert);
	}

	public function updateDock()
	{
		
	}
}

?>