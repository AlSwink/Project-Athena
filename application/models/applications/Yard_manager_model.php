<?php

class Yard_manager_model extends XPO_Model {
	
	public function saveTransaction($data)
	{
		$insert = array(
					'transaction_type' => $data['trailer_type'],
					'carrier' => $data['carrier'],
					'trailer_number' => $data['trailer_number'],
					'dock_id' => $data['update_dock_id'],
					'io' => $data['trans_type'],
					'user_id' => $this->user_id,
					'transaction_datetime' => date('Y-m-d H:i:s')
					);

		$this->db->insert('yard_transactions',$insert);

		$trans_id = $this->db->insert_id();

		$update = array(
					'trans_id' => $trans_id,
					'status' => $data['trans_type'],
					'modified_on' => date('Y-m-d H:i:s'),
					);

		$this->db->where('dock_id',$data['update_dock_id']);
		$this->db->update('site_docks',$update);
	}
}