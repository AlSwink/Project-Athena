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

	public function getQueue($dock_id)
	{
		$this->db->select('dock,carrier,pickup_number,expected_start,expected_end');
		$this->db->select('CONCAT(e_fname," ",e_lname) as contact');
		$this->db->select('site_docks.dock_id as dock_id');
		$this->db->where('site_docks.dock_id',$this->dock_id);
		$this->db->where('site_docks_detail.deleted',0);
		$this->db->join('site_docks_detail','site_docks.dock_id = site_docks_detail.dock_id','LEFT');
		$this->db->join('employees','employees.user_id = site_docks_detail.created_by','LEFT');
		$this->db->order_by('expected_start','ASC');
		return $this->db->get('site_docks')->result_array();
	}

	public function getDoorInfo()
	{
		$this->db->where('dock',$this->dock);
		return $this->db->get('site_docks')->result_array();
	}
}

?>