<?php

class Argus_model extends XPO_Model {

	public $stage;
	public $shipments;
	public $existing;

	public function getWMSShipments($type=null)
	{
		$shipments = array();
		$existing = $this->getShipments();
		//REG priority 1-3 query
		$query = "SELECT TRIM(om.shipment) as shipment,TRIM(om.attention) as attention,om.carrier,om.ship_name,(SELECT SUM(ord_qty) FROM od_f WHERE ob_oid = om.ob_oid) as ord_qty
					FROM shipunit_f AS s
					INNER JOIN om_f AS om ON s.shipment = om.shipment
					WHERE packlist != ''
					AND packlist IS NOT NULL
					AND (om.attention LIKE '1%%PKG' OR om.attention LIKE '1%%LTL' OR om.attention LIKE '2%%PKG' OR om.attention LIKE '2%%LTL' OR om.attention LIKE '3%%PKG' OR om.attention LIKE '3%%LTL')
					AND om.carrier NOT LIKE 'F%' 
					AND om.carrier NOT LIKE 'U%'
					GROUP BY shipment,attention,carrier,ship_name,ord_qty
					ORDER BY attention ASC";

		if($type){
			
		}else{
			$shipments['regular'] = $this->wms->query($query)->result_array();	
		}

		$this->shipments = $shipments;
	}

	public function updateShipments()
	{
		$this->getWMSShipments();

		foreach($this->shipments as $key=>$val){
			$type = $key;
			foreach($val as $data){
				$check = $this->db->get_where('argus_shipments',array('shipment'=>$data['shipment']));
				$update = $check->num_rows();

				$info = array(
							'shipment' => $data['shipment'],
							'type' => $type,
							'carrier' => trim($data['carrier']),
							'customer' => trim($data['ship_name']),
							'qty' => round($data['ord_qty']),
						);

				if($update)
				{
					$info['modified_on'] = date('Y-m-d H:i:s');
					$this->db->where('shipment_id',$check->row()->shipment_id);
					$this->db->update('argus_shipments',$info);
				}else{
					$info['added_on'] = date('Y-m-d H:i:s');
					$info['stage'] = 1;
					$info['status'] = 'normal';
					$info['locked'] = 0;
					$this->db->insert('argus_shipments',$info);
				}				
			}
		}
	}

	public function getShipments()
	{
		$this->db->select('*');
		$this->db->select('argus_stages.stage as stage');
		$this->db->where('argus_stages.stage !=','completed');
		$this->db->join('argus_stages','argus_stages.stage_id = argus_shipments.stage');
		$this->shipments = $this->db->get('argus_shipments')->result_array();
	}

	public function check805($shipment=null)
	{
		if($shipment){
			$query = "SELECT * FROM om_f WHERE shipment = '".$shipment."'";
			$result = $this->wms->query($query)->num_rows();
			return $result;
		}else{
			$this->db->select('shipment');
			$this->db->where('stage <',8);
			$shipments = $this->db->get('argus_shipments')->result_array();

			$argus_shipments = array_column($shipments,'shipment');
			$in_shipments = implode("','",$argus_shipments);

			$query = "SELECT TRIM(shipment) FROM om_f 
						WHERE shipment IN ('".$in_shipments."')";

			$wms_shipments = $this->wms->query($query)->result_array();
			$wms_shipments = array_column($wms_shipments,'shipment');
			$ship_completed = array_diff($wms_shipments,$argus_shipments);
			
			$this->db->set('stage',8);
			$this->db->set('modified_on',date('Y-m-d H:i:s'));
			$this->db->where_in('shipment',$ship_completed);
			
			if(count($ship_completed)){
				$this->db->update('argus_shipments');
			}
		}
	}
}