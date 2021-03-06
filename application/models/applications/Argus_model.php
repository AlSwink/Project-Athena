<?php

class Argus_model extends XPO_Model {

	public $type;
	public $stage;
	public $existing;
	public $shipment;
	public $shipments;
	public $shipment_name;
	public $shipment_id;
	public $nested;
	public $unnested;
	public $pallets;
	public $cartons;

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
						FROM om_f LEFT JOIN (shipunit_f INNER JOIN ct_f ON shipunit_f.shipunit_rid = ct_f.shipunit_rid) ON om_f.shipment = shipunit_f.shipment
						WHERE attention = '".$shipment."'
						GROUP BY attention,carrier
						ORDER BY attention ASC";
		
		$query = ($this->shipment['type'] == 'regular' ? $reg_query : $wr_query);
		
		$details['wms'] = $this->wms->query($query)->row_array();
		$details['argus'] = $this->shipment;
		
		$this->getPallets();
		$this->getCartons();

		foreach($this->pallets as $pallet){
			$pallet_info[$pallet] = $this->getContainers($pallet);
			$nested = array_merge($nested,$pallet_info[$pallet]);
		}

		$details['nested'] = $nested;
		$details['unnested'] = array_diff($this->cartons,$nested);
		$details['pallet_info'] = $pallet_info;

		$this->shipment = $details;
	}

	public function getNested()
	{
		$this->getPallets();
		$nested = array();

		foreach($this->pallets as $pallet){
			$nested = array_merge($nested,$this->getContainers($pallet));
		}

		$this->nested = $nested;
	}

	public function getUnnested()
	{
		$this->getCartons();
		$this->getNested();

		$unnested = array_diff($this->cartons,$this->nested);
		$this->unnested = $unnested;
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
						OR om.carrier IN ('FXFE','FXNL','UPGF')
						GROUP BY shipment,attention,carrier,ship_name,cartons
						ORDER BY attention ASC";

		$wr_query = "SELECT TRIM(om_f.attention) as attention, om_f.carrier, Max(om_f.ship_name) AS ship_name, Sum(shipunit_f.wgt) AS wgt, (Count(DISTINCT(ct_f.ucc128))) AS cartons
						FROM om_f INNER JOIN (shipunit_f INNER JOIN ct_f ON shipunit_f.shipunit_rid = ct_f.shipunit_rid) ON om_f.shipment = shipunit_f.shipment
						WHERE from_email != ''
						AND om_f.attention LIKE 'WR%'
						AND om_f.carrier NOT IN ('WCL','STOP','EXPT')
						AND om_f.carrier NOT LIKE 'U%'
						AND om_f.carrier NOT LIKE 'F%'
						OR om_f.carrier IN ('FXFE','FXNL','UPGF')
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

	public function getShipments($stage=null)
	{
		$this->db->select('*');
		$this->db->select('argus_stages.stage as stage');
		$this->db->where('argus_stages.stage !=','completed');
		if($stage){
			$this->db->where('argus_shipments.stage',$stage);
		}
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
			$field = (substr($shipment,2) ? 'attention' : 'shipment');
			$query = "SELECT * FROM om_f WHERE "+$field+" = '".$shipment."'";
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
		$this->pallets = $pallets;
	}

	public function getContainers($pallet)
	{
		$conts = array();
		$query = "SELECT TRIM(cont) as cont
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
		$field = ($this->shipment['type'] == 'regular' ? 'shipment' : 'attention');

		$query = "SELECT DISTINCT(TRIM(cont)) as cont
					FROM ct_f
					JOIN om_f ON om_f.shipment = ct_f.shipment
					WHERE om_f.".$field." = '".$this->shipment['shipment']."'";
		
		$cartons = $this->wms->query($query)->result_array();
		$cartons = array_column($cartons,'cont');

		$this->cartons = $cartons;
	}

	public function insertVerification($data)
	{
		$this->getShipment($data['shipment']);

		$verify_master = array(
							'shipment_id' => $this->shipment['shipment_id'],
							'total_pallets' => array_sum($data['pallets']),
							'total_cartons' => array_sum($data['cartons']),
							'verified_by' => $this->user_id,
							'verified_on' => date('Y-m-d H:i:s'),
							'created_on' => date('Y-m-d H:i:s'),
							'status' => 'verification'
						);

		$this->db->insert('argus_verifications',$verify_master);
		$verify_id = $this->db->insert_id();

		for($x=0;$x<count($data['pallets']);$x++){
			$verify_detail[] = array(
							'verification_id' => $verify_id,
							'pallet' => $data['pallets'][$x],
							'cartons' => $data['cartons'][$x],
							'status' => 'verify'
							);
		}

		$this->db->insert_batch('argus_verification_details',$verify_detail);
	}

	public function updateVerification($data)
	{
		$has_error = array_sum($data['qtys']);
		$result = ($has_error ? 'error' : 'good');
		
		for($x=0;$x<count($data['pallets']);$x++){
			$verify_details[] = array(
									'detail_id' => $data['detail_ids'][$x],
									'status' => 'verified',
									'result' => $data['reasons'][$x],
									'qty' => ($data['qtys'][$x] ? $data['qtys'][$x] : null)
							);
		}

		$this->db->update_batch('argus_verification_details', $verify_details, 'detail_id');

		$verify_master = array(
							'status' => 'verified',
							'qa_by' => $this->user_id,
							'qa_on' => date('Y-m-d H:i:s'),
							'result' => $result
						);

		$this->db->where('verification_id',$data['verification_id']);
		$this->db->update('argus_verifications',$verify_master);
	}

	public function getStage($field,$value)
	{
		$this->db->where($field,$value);
		return $this->db->get('argus_stages')->row_array();
	}

	public function getVerification()
	{
		$this->db->join('employees','employees.user_id = argus_verifications.verified_by');
		$this->db->join('argus_verification_details','argus_verification_details.verification_id = argus_verifications.verification_id');
		$this->db->where('shipment_id',$this->shipment['argus']['shipment_id']);
		$this->db->where('argus_verifications.status','verification');
		$this->db->order_by('verified_on','DESC');
		$verifications = $this->db->get('argus_verifications')->result_array();
		$this->shipment['verification'] = $verifications;
	}

	public function getArgusCarriers()
	{
		$this->db->select('DISTINCT(carrier) as carrier');
		$this->db->where('stage !=',8);
		$carriers = $this->db->get('argus_shipments')->result_array();
		return $carriers;
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