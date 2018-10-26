<?php

class Argus_model extends XPO_Model {

	public $type;
	public $stage;
	public $existing;
	public $shipment;
	public $shipments;
	public $shipment_name;
	public $shipment_id;

	public function getShipmentDetails($shipment)
	{
		$pallet_info = array();
		$nested = array();
		$this->getShipment($shipment);

		$reg_query = "SELECT TRIM(om.shipment) as shipment,TRIM(om.attention) as attention,om.carrier,om.ship_name,SUM(num_crtn) as cartons,SUM(s.wgt) as wgt,ship_addr1,ship_addr2,ship_city,ship_state,ship_zip,pay_acct,num_unit,om.wave,total_wgt,sched_date,om.probill,fr_terms,route_cmt1,route_cmt2,route_cmt3,num_line
						FROM shipunit_f AS s
						INNER JOIN om_f AS om ON s.shipment = om.shipment
						AND om.shipment = '".$shipment."'
						GROUP BY shipment,attention,carrier,ship_name,ship_addr1,ship_addr2,ship_city,ship_state,ship_zip,pay_acct,num_unit,om.wave,total_wgt,sched_date,om.probill,fr_terms,route_cmt1,route_cmt2,route_cmt3,num_line
						ORDER BY attention ASC";

		$wr_query = "SELECT TRIM(om_f.attention) as shipment,TRIM(om_f.attention) as attention, om_f.carrier,Max(om_f.wave) as wave, Max(om_f.ship_name) AS ship_name, Sum(shipunit_f.wgt) AS wgt, (Count(DISTINCT(ct_f.ucc128))) AS cartons,MAX(from_email) as sched_date,MAX(om_f.probill) as probill,MAX(ship_addr1) as ship_addr1,MAX(ship_addr2) as ship_addr2,MAX(fr_terms) as fr_terms,MAX(pay_acct) as pay_acct,MAX(ship_city) as ship_city,MAX(ship_state) as ship_state,MAX(ship_zip) as ship_zip,MAX(route_cmt1) as route_cmt1,MAX(route_cmt2) as route_cmt2,MAX(route_cmt3) as route_cmt3
						FROM om_f INNER JOIN (shipunit_f INNER JOIN ct_f ON shipunit_f.shipunit_rid = ct_f.shipunit_rid) ON om_f.shipment = shipunit_f.shipment
						WHERE attention = '".$shipment."'
						GROUP BY attention,carrier
						ORDER BY attention ASC";
		
		$query = ($this->shipment['type'] == 'regular' ? $reg_query : $wr_query);
		
		$details['wms'] = $this->wms->query($query)->row_array();
		$details['argus'] = $this->shipment;
		$pallets = $this->getPallets();

		foreach($pallets as $pallet){
			$pallet_info[$pallet] = $this->getContainers($pallet);
			$nested = array_merge($nested,$pallet_info[$pallet]);
		}

		$cartons = $this->getCartons();

		$details['nested'] = $nested;
		$details['unnested'] = array_diff($cartons,$nested);
		$details['pallet_info'] = $pallet_info;

		$this->shipment = $details;

	}

	public function getWMSShipments($type=null)
	{
		$shipments = array();
		$existing = $this->getShipments();
		//REG priority 1-3 query
		$reg_query = "SELECT TRIM(om.shipment) as shipment,TRIM(om.attention) as attention,om.carrier,om.ship_name,(SELECT COUNT(DISTINCT(ucc128)) FROM ct_f WHERE ct_f.shipment = om.shipment) as cartons,SUM(wgt) as wgt
						FROM shipunit_f AS s
						INNER JOIN om_f AS om ON s.shipment = om.shipment
						WHERE packlist != ''
						AND packlist IS NOT NULL
						AND (om.attention LIKE '1%%PKG' OR om.attention LIKE '1%%LTL' OR om.attention LIKE '2%%PKG' OR om.attention LIKE '2%%LTL' OR om.attention LIKE '3%%PKG' OR om.attention LIKE '3%%LTL')
						AND om.carrier NOT LIKE 'F%' 
						AND om.carrier NOT LIKE 'U%'
						GROUP BY shipment,attention,carrier,ship_name,cartons
						ORDER BY attention ASC";

		$wr_query = "SELECT TRIM(om_f.attention) as attention, om_f.carrier, Max(om_f.ship_name) AS ship_name, Sum(shipunit_f.wgt) AS wgt, (Count(DISTINCT(ct_f.ucc128))) AS cartons
						FROM om_f INNER JOIN (shipunit_f INNER JOIN ct_f ON shipunit_f.shipunit_rid = ct_f.shipunit_rid) ON om_f.shipment = shipunit_f.shipment
						WHERE from_email != ''
						AND om_f.carrier NOT IN ('WCL','STOP','EXPT')
						GROUP BY attention,carrier
						ORDER BY attention ASC";

		
		$shipments['work_request'] = $this->wms->query($wr_query)->result_array();	
		$shipments['regular'] = $this->wms->query($reg_query)->result_array();	
		
		$this->shipments = $shipments;
	}

	public function updateShipments()
	{
		$this->getWMSShipments();
		
		foreach($this->shipments as $key=>$val){
			$type = $key;
			foreach($val as $data){
				if($type == 'regular'){
					$shipment = $data['shipment'];
				}else{
					$shipment = $data['attention'];
				}

				$check = $this->db->get_where('argus_shipments',array('shipment'=>$shipment));
				$update = $check->num_rows();

				$info = array(
							'shipment' => $shipment,
							'type' => $type,
							'carrier' => trim($data['carrier']),
							'customer' => trim($data['ship_name']),
							'weight' => trim($data['wgt']),
							'cartons' => trim($data['cartons']),
							'attention' => $data['attention']
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
					$this->shipment['shipment_id'] = $this->db->insert_id();
					$this->stage = 1;
					$this->type = 'start';
					$this->insertTransaction();
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

	public function getShipment($shipment=null)
	{
		$this->db->select('*');
		$this->db->select('argus_stages.stage as stage');
		$this->db->where('argus_stages.stage !=','completed');
		$this->db->join('argus_stages','argus_stages.stage_id = argus_shipments.stage');
		$this->db->where('shipment',$shipment);
		$this->shipment = $this->db->get('argus_shipments')->row_array();
		$this->getTransactions($shipment);
	}

	public function check805($shipment=null)
	{
		$ship_completed = array();

		if($shipment){
			$query = "SELECT * FROM om_f WHERE shipment = '".$shipment."'";
			$result = $this->wms->query($query)->num_rows();
			if(!$result){
				$this->getShipment($shipment);
			}

			$ship_completed[] = $this->shipment['shipment_id'];
		}else{
			$this->db->where('stage <',8);
			$shipments = $this->db->get('argus_shipments')->result_array();

			foreach($shipments as $shipment){
				$type = ($shipment['type'] == 'work_request' ? 'attention' : 'shipment');
				$query = "SELECT ob_oid FROM om_f WHERE ".$type." = '".$shipment['shipment']."'";
				$in_om = $this->wms->query($query)->num_rows();
				if(!$in_om){
					$ship_completed[] = $shipment['shipment_id'];
				}
			}			
		}

		if(count($ship_completed)){
			$this->db->set('stage',8);
			$this->db->set('modified_on',date('Y-m-d H:i:s'));
			$this->db->where_in('shipment_id',$ship_completed);
			$this->db->update('argus_shipments');
			$this->override805($ship_completed);
		}

		$this->db->reset_query();
	}

	public function getTransactions($shipment=null)
	{

		$this->db->where('shipment',$shipment);
		$this->db->join('argus_shipments','argus_shipments.shipment_id = argus_transactions.shipment_id');
		$this->db->join('argus_stages','argus_stages.stage_id = argus_transactions.stage_id');
		$this->db->join('employees','employees.user_id = argus_transactions.user_id');
		$this->db->order_by('transaction_id','DESC');
		$transactions = $this->db->get('argus_transactions')->result_array();
		$this->shipment['transactions'] = $transactions;
	}

	public function updateShipment()
	{
		$update = array(
					'stage' => $this->stage,
					'modified_by' => $this->user_id,
					'modified_on' => date('Y-m-d H:i:s'),
					);

		$this->db->where('shipment',$this->shipment_name);
		$this->db->update('argus_shipments',$update);
		$this->insertTransaction();
	}

	public function insertTransaction($sys_override=null)
	{
		$from_stage = (int)$this->stage - 1;
		$to_stage = (int)$this->stage;

		//check if a previous stage exists except for 0 (0 doesn't exist)
		if($from_stage){
			$check_from = $this->db->get_where('argus_transactions',array('shipment_id'=>$this->shipment['shipment_id'],'stage_id'=>$from_stage));

			if($check_from->num_rows()){
				//update end time for previous stage
				$transaction_id = $check_from->row_array()['transaction_id'];
				$data = array(
							'end' => date('Y-m-d H:i:s'),
							'user_id' => $this->user_id
						);
				$this->db->where('transaction_id',$transaction_id);
				$this->db->update('argus_transactions',$data);
			}
		}
		
		//insert next stage
		$data = array(
					'shipment_id' => $this->shipment['shipment_id'],
					'start' => date('Y-m-d H:i:s'),
					'stage_id' => $to_stage,
					'user_id' => $this->user_id,
					'created' => date('Y-m-d H:i:s')
				);

		$this->db->insert('argus_transactions',$data);
	}

	public function save()
	{
		$this->db->where('shipment_id',$this->shipment['shipment_id']);
		$this->db->update('argus_shipments');
	}

	public function getPallets()
	{
		$field = ($this->shipment['type'] == 'regular' ? 'shipment' : 'attention');

		$query = "SELECT DISTINCT(TRIM(cn_f.in_cont)) as cont
					FROM cn_f
					JOIN shipunit_f ON shipunit_f.cont = cn_f.cont
					JOIN om_f ON om_f.shipment = shipunit_f.shipment
					WHERE om_f.'".$field."' = '".$this->shipment['shipment']."'
					AND in_cont != ''";
		
		$pallets = $this->wms->query($query)->result_array();
		$pallets = array_column($pallets,'cont');
		return $pallets;
	}

	public function getContainers($pallet)
	{
		$conts = array();
		$query = "SELECT cont
					FROM cn_f
					WHERE in_cont = '".$pallet."'";
		
		if($pallet){
			$conts = $this->wms->query($query)->result_array();
			$conts = array_column($conts,'cont');
		}
		return $conts;
	}

	public function getCartons()
	{
		$cartons = array();
		$field = ($this->shipment['type'] == 'regular' ? 'shipment' : 'attention');

		$query = "SELECT DISTINCT(cont)
					FROM ct_f
					JOIN om_f ON om_f.shipment = ct_f.shipment
					WHERE om_f.".$field." = '".$this->shipment['shipment']."'";
		
		$cartons = $this->wms->query($query)->result_array();
		$cartons = array_column($cartons,'cont');

		return $cartons;
	}

	private function override805($shipments)
	{
		foreach($shipments as $id){
			$insert[] = array(
					'shipment_id' => $id,
					'stage_id' => 8,
					'end' => date('Y-m-d H:i:s'),
					'user_id' => $this->user_id,
					'created' => date('Y-m-d H:i:s'),
				);
		}
		if(isset($insert)){
			$this->db->insert_batch('argus_transactions',$insert);
		}
		$this->db->reset_query();
	}
}