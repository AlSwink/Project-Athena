<?php

class Cycle_count_model extends XPO_Model {

	public $dataset;
	public $entry_id;
	public $loc_type;
	public $count_type;
	public $cyc_locs;
	public $cc_template;
	public $cc_f_insert;
	public $master_pool_insert;
	public $location;
	public $start;
	public $end;
	public $mark;
	public $query;

	public function setShift()
	{
		$this->start = getShift('start');
		$this->end = getShift('end');
	}

	public function getMaster()
	{
		$this->db->where('dataset',$this->dataset);
		$this->db->where_in('entry_id',$this->entry_id);
		$locations = $this->db->get_where('cyc_master_pool')->result_array();
		return $locations;
	}

	public function get_cm_f()
	{

	}

	public function get_lc_f()
	{
		if($this->dataset == 'KNK'){
			$final_locs = $this->getKNK();
		}else{
			$final_locs = $this->getKNT();
		}
		
		$this->cyc_locs = $final_locs;
	}

	public function getKNK()
	{
		$final_locs = array();

		for($x=49;$x<64;$x++){
			$loc_query = "SELECT TRIM(lc_f.loc) as loc,SUM(qty) as qty
							FROM lc_f 
							LEFT JOIN iv_f ON iv_f.loc = lc_f.loc
							WHERE lc_f.loc LIKE '".$x."%'
							GROUP BY loc,qty
							ORDER BY loc";

			$locs = $this->wms->query($loc_query)->result_array();
			$final_locs = array_merge($final_locs,$locs);
		}	

		$loc_query = "SELECT TRIM(lc_f.loc) as loc,SUM(qty) as qty
						FROM lc_f 
						LEFT JOIN iv_f ON iv_f.loc = lc_f.loc
						WHERE lc_f.loc LIKE 'SB%'
						AND lc_f.loc NOT LIKE 'SBRCV%'
						GROUP BY loc,qty
						ORDER BY loc";

		$locs = $this->wms->query($loc_query)->result_array();
		$final_locs = array_merge($final_locs,$locs);

		return $final_locs;
	}

	public function getKNT()
	{
		$this->query = "SELECT DISTINCT(lc_f.loc) as loc,qty,tariff_desc
						FROM lc_f 
						LEFT JOIN iv_f ON iv_f.loc = lc_f.loc
						JOIN pm_f ON  pm_f.sku = iv_f.sku AND pm_f.pkg = iv_f.pkg
						WHERE lc_f.loc IS NOT NULL ";
		if($this->count_type)
			$this->setCountType($this->count_type);
		if($this->loc_type)
			$this->setLocType($this->loc_type);
		
		$this->query .= "GROUP BY lc_f.loc,qty,tariff_desc ORDER BY lc_f.loc";
		
		return $this->wms->query($this->query)->result_array();
	}

	public function getTemplate()
	{
		$template_query = "SELECT FIRST 1 * FROM cc_f";
		$this->cc_template = $this->wms->query($template_query)->row_array();
	}

	public function applyTemplate($record,$oid=null)
	{
		$last = $this->getLast();
		$temp = $this->cc_template;
		$master_pool = array();
		$locations = array();
		$cc_rid = (int)$last;
		$prefix = $this->getPrefix();

		for($x=0;$x<count($record);$x++){
			$cc_rid++;

			$temp['cc_rid'] = $cc_rid;
			$temp['cycc_oid'] = (isset($record[$x]['cc_rid']) ? $prefix.$record[$x]['cc_rid'] : $prefix.$cc_rid);
			$temp['opr'] = 'AUTO';
			$temp['cycc_stt'] = 'HOLD';
			$temp['release_date'] = date('Y-m-d');
			$temp['start_loc'] = $record[$x]['loc'];
			$temp['end_loc'] = $record[$x]['loc'];
			//$temp['dt_start'] = date('Y-m-d H:i:s');
			//$temp['dt_end'] = date('Y-m-d H:i:s');
			$temp['gen_by'] = 'ATHENA';
			$temp['usrmod'] = 'ATHENA';
			//$temp['dtimecre'] = date('Y-m-d H:i:s');
			//$temp['dtimemod'] = date('Y-m-d H:i:s');

			if(!isset($record[$x]['annual_counter'])){
				$master_pool[] = array(
								'loc' => $record[$x]['loc'],
								'annual_counter' => 0,
								'round' => 1,
								'added_by' => $this->user_id,
								'added_on' => date('Y-m-d H:i:s'),
								'enabled' => true,
								'dataset' => $this->dataset,
								'cc_rid' => $cc_rid,
								'mark' => ($this->type ? $this->type : null),
								'loc_type' => ($this->loc_type ? $this->loc_type : null),
								'count_type' => ($this->count_type ? $this->count_type : null),
								'tariff_desc' => (isset($record[$x]['tariff_desc']) ? $record[$x]['tariff_desc'] : null)
							);
			}

			$locations[] = $temp;
		}

		$this->cc_f_insert = $locations;
		$this->master_pool_insert = $master_pool;
	}

	public function insert_master_pool($location=null)
	{
		$inserted = 0;
		if($location){
			$this->db->insert_batch('cyc_master_pool',$this->master_pool_insert);
			$insert_id = $this->db->insert_id();

			foreach($location as $detail)
			{	

				$count_details = array(
									'entry_id' => $insert_id,
									'loc' => $detail['loc'],
									'act_qty' => (int)$detail['qty'],
									'round' => 1,
									'added_on' => date('Y-m-d H:i:s')
								);
				$insert_id++;
				$this->db->insert('cyc_count_details',$count_details);
				//echo 'Location '.$detail['loc'].' Added<br>';
				$inserted++;
			}
			//echo '<hr><b>'.$inserted.'</b> Locations inserted';
			$this->insert_cc_f();
		}
	}

	public function getLocationInfo($location)
	{
		$query = "SELECT TRIM(lc_f.Loc) as loc, iv_f.sku, iv_f.pkg, iv_f.qty, pm_f.tariff_desc
					FROM (lc_f INNER JOIN iv_f ON lc_f.loc = iv_f.loc) 
					INNER JOIN pm_f ON (iv_f.pkg = pm_f.pkg) AND (iv_f.sku = pm_f.sku)
					WHERE (((lc_f.Loc)='".$location."'))";

		$info = $this->wms->query($query)->row_array();
		if(!$info){
			$info = array(
						'loc' => $location,
						'sku' => NULL,
						'pkg' => NULL,
						'tariff_desc' => NULL,
						'qty' => 0
						);
		}
		
		return $info;
	}

	public function getCounted()
	{
		$year_start = date('Y-01-01 00:00:00');
		$year_end = date('Y-12-31 23:59:59');
		$this->db->where('dataset',$this->dataset);
		$this->db->where('added_on BETWEEN "'.$year_start.'" AND "'.$year_end.'"');
		return $this->db->get('cyc_master_pool')->result_array();
	}

	public function crossCheck()
	{
		//initialize 
		$this->setShift();
		$this->getTemplate();
		$prefix = $this->getPrefix();
		$status = $this->getAnnualStatus();
		
		//fetch current cyc locations
		$this->db->join('cyc_count_details','cyc_count_details.entry_id = cyc_master_pool.entry_id');
		$this->db->where('cyc_master_pool.added_on BETWEEN "'.$this->start.'" AND "'.$this->end.'"');
		$locs = $this->db->get('cyc_master_pool')->result_array();
		$checklocs = array_column($locs,'cc_rid');
		
		//1:1 check for each location
		foreach($locs as $cc){
			$cadj = NULL;
			$cycc = NULL;
			$cycf = NULL;

			if($cc['round'] == 1){
				$check_query = "SELECT transact,opr,dtimecre,qty FROM it_f
								WHERE ob_oid = '".$prefix.$cc['cc_rid']."'
								AND transact IN ('CYCC','CADJ','CYCF')";	
			}else{
				$check_query = "SELECT FIRST 5 transact,opr,dtimecre,qty FROM it_f
								WHERE ob_oid = '".$prefix.$cc['cc_rid']."'
								AND transact IN ('CYCC','CADJ','CYCF')
								AND dtimecre > '".$cc['added_on']."'
								ORDER BY dtimecre DESC";	
			}
			//check in it_f for transact activity
			$check = $this->wms->query($check_query);					
			$itf = $check->result_array();

			//grabbing each transact keys
			$cadj_key = search_key_val('transact','CADJ',$itf);
			$cycc_key = search_key_val('transact','CYCC',$itf);
			$cycf_key = search_key_val('transact','CYCF',$itf);

			if($cadj_key !== NULL)
				$cadj = $itf[$cadj_key];

			if($cycc_key !== NULL)
				$cycc = $itf[$cycc_key];

			if($cycf_key !== NULL)
				$cycf = $itf[$cycf_key];
			
			//if there's activity
			if($itf){
				//update snapshot
				$detail = array(
						'counted_on' => (isset($cycf_key) ? $cycf['dtimecre'] : date('Y-m-d H:i:s')),
						'type' => ($cadj_key !== NULL ? 'Adjusted' : 'Counted'),
						'qty' =>  ($cadj_key !== NULL ? (int)$cadj['qty'] : (int)$cycc['qty']),
						'opr' => trim($cycc['opr'])
					);
				$this->db->where('entry_id',$cc['entry_id']);
				$this->db->where('round',$cc['round']);
				$this->db->update('cyc_count_details',$detail);
				
				//if adjusted
				if($cadj_key !== NULL){
					//check if already on round 2
					$check = $this->getCycDetail($cc['entry_id'],2);
					//not in round 2
					if(!$check){
						//insert command to cc_f with same ob_oid
						$detail = array(
										'entry_id' => $cc['entry_id'],
										'loc' => $cc['loc'],
										'act_qty' =>  $this->getCycDetail($cc['entry_id'],1)->act_qty,
										'added_on' => date('Y-m-d H:i:s'),
										'round' => 2
									);

						$this->applyTemplate(array($detail));
						$this->insert_cc_f();
						$this->db->insert('cyc_count_details',$detail);
					}elseif(!$check->qty){
						//in round 2
						$detail = array(
										'counted_on' => (isset($cycc) ? $cycc['dtimecre'] : date('Y-m-d H:i:s')),
										'type' => ($cadj_key !== NULL ? 'Adjusted' : 'Counted'),
										'qty' =>  ($cadj_key !== NULL ? (int)$cadj['qty'] : (int)$cycc['qty']),
										'opr' => trim($cycc['opr'])
									);
						$this->db->where('entry_id',$cc['entry_id']);
						$this->db->where('round',$cc['round']);
						$this->db->update('cyc_count_details',$detail);
					}
					//force to make it the last round
					$this->db->set('round',2);
				}
			}

			//check if counted this year
			$this_year = date_format(date_create($cc['added_on']),'Y');
			if($cc['annual_counter'] < $status['status'] && $status['year'] == $this_year && $cycf_key !== NULL){
				$this->db->set('annual_counter','annual_counter + 1',FALSE); //increment annual counter if less than max round and on the same year
			}

			$this->db->set('last_check',date('Y-m-d H:i:s'));
			$this->db->where('entry_id',$cc['entry_id']);
			$this->db->update('cyc_master_pool');
		}			
	}

	public function getTotals($dataset='KNK')
	{
		if(!$this->start){
			$this->setShift();
		}

		$this->dataset = $dataset;
		$this->get_lc_f();
		$total_locs = count($this->cyc_locs);

		$created = $this->getCreated();
		$counted = $this->getCountedToday();
		$adjusted_today = $this->getTypeToday('Adjusted');		
		$qty_today = $this->getTypeQTY();
		$qty_net = $this->getTypeQTY('net');
		$qty_abs = $this->getTypeQTY('abs');

		$this->db->where('annual_counter !=',0);
		$this->db->where('dataset',$this->dataset);
		$master = $this->db->get('cyc_master_pool')->result_array();

		$rounds = $this->getRoundTotal();	

		$finals = array(
					'master' => array(
								'all' => number_format($total_locs),
								'counted' => count($master),
								'pending' => number_format($total_locs - count($master)),
								'progress' => ceil((count($master) / $total_locs) * 100).'%'
								),
					'today' => array(
								'created' => $created,
								'counted' => $counted,
								'adjusted' => $adjusted_today,
								'remainder' => $created - $counted,
								'r1' => ($rounds ? $rounds[1] : NULL),
								'r2' => ($rounds ? $rounds[2] : NULL),
								'units' => array(
											'all' => ($qty_today ? $qty_today : 0),
											'net_adj' => ($qty_net ? $qty_net : 0),
											'abs_adj' => ($qty_abs ? $qty_abs : 0)
											)
								),
					'dataset' => $dataset,
					'dataset_header' => $this->getDatasetHeader(),
					'cyc_all' => $this->getCycToday(),
					'start' => $this->start
					);

		return $finals;
	}

	public function getCycToday()
	{
		$query = "SELECT cm.entry_id,cm.mark,cm.loc, cm.sku,cm.pkg,cd.act_qty,cd.type,cd.qty,
					(SELECT qty FROM cyc_count_details r1cd WHERE cm.entry_id = r1cd.entry_id AND r1cd.round = 1) as r1_qty,
					(SELECT qty FROM cyc_count_details r2cd WHERE cm.entry_id = r2cd.entry_id AND r2cd.round = 2) as r2_qty
					FROM cyc_master_pool as cm
					JOIN cyc_count_details as cd ON cd.entry_id = cm.entry_id
					WHERE cm.added_on BETWEEN '".$this->start."' AND '".$this->end."'
					AND cm.dataset = '".$this->dataset."'
					GROUP BY cm.entry_id;";
		$cyc_all = $this->db->query($query)->result_array();

		return $cyc_all;
	}

	public function deleteLocations($ids)
	{
		$tables = array('cyc_count_details','cyc_master_pool');
		$this->db->where_in('entry_id',$ids);
		$this->db->delete($tables);
	}

	public function insert_cc_f()
	{
		$fields = array_keys($this->cc_f_insert[0]);
		$fields = implode(',',$fields);
		
		foreach($this->cc_f_insert as $row){
                $values = " ('".implode("','",$row)."')";
                $query = 'INSERT INTO cc_f ('.$fields.') VALUES'.$values;
            	$this->wms->query($query);
        }
	}

	//Private functions

	private function getAnnualStatus()
	{
		return $this->db->get_where('cyc_status',array('dataset'=>$this->dataset))->row_array();
	}

	private function getRoundTotal($round=1)
	{
		$round_master = array();

		for($x=1;$x<=$this->cyc_max_rounds;$x++){
			$counted = 0;
			$adjusted = 0;

			$this->db->join('cyc_master_pool','cyc_count_details.entry_id = cyc_master_pool.entry_id');
			$this->db->where('cyc_count_details.added_on BETWEEN "'.$this->start.'" AND "'.$this->end.'"');
			$this->db->where('dataset',$this->dataset);
			$this->db->where('cyc_count_details.round',$x);
			$rounds = $this->db->get('cyc_count_details')->result_array();

			foreach($rounds as $round_detail){
				if($round_detail['type'] == 'Adjusted'){
					$adjusted++;
				}
				
				if($round_detail['type'])
					$counted++;
			}

			$assigned = count($rounds);
			$progress = (count($rounds) ? ceil($counted / $assigned * 100).'%' : '0%');
			
			$round_master[$x] = array(
									'assigned' => $assigned,
									'counted' => $counted,
									'progress' => $progress
								);
		}

		return $round_master;
	}

	private function getCycDetail($entry_id,$round=1)
	{
		$this->db->flush_cache();
		return $this->db->get_where('cyc_count_details',array('entry_id'=>$entry_id,'round'=>$round))->row();
	}

	private function getDatasetHeader()
	{
		$datasetheader = ($this->dataset == 'KNK' ? 'Sports Balls - KNK' : 'DC - KNT');
		return $datasetheader;
	}

	private function check_location($location)
	{
		return $this->db->get_where('cyc_master_pool',array('loc'=>$location))->num_rows();
	}

	private function getLast()
	{
		$query = "SELECT FIRST 1 cc_rid FROM cc_f ORDER BY cc_rid DESC";
		$cc_rid = $this->wms->query($query)->row()->cc_rid;
		return $cc_rid;
	}

	private function setLocType($type)
	{
		$types = array(
					'FP' => array('FP'),
					'BULK' => array('FIFO','LIFO','BULK')
					);
		$in = implode('","',$types[$type]);
		$this->query .= 'AND loc_type IN ("'.$in.'")';
	}

	private function setCountType($type)
	{		
		$outside = array('A','B','SB','CW','BG','DR','TRUCK','RP','VT','VAN','US','OX','TRK','T1','TS','PA','UN','RCV','RTR','RES','RTN','RD','PROJ','STOP','TG','REC','UR','WET','Q','test','OS','RTS','MCO','MSL','AD','CR','MST','GSW','HNG');

		$this->query .= 'AND (';
		if($type == 'OUTSIDE'){
			foreach($outside as $where){
				$wheres[] = "lc_f.loc NOT LIKE '".$where."%'";
			}
			
			for($x=49;$x<64;$x++){
				$wheres[] = "lc_f.loc NOT LIKE '".$x."%'";
			}	
			$this->query .= implode(' AND ',$wheres);
		}else{
			$this->query .= "lc_f.loc LIKE 'A%' ";
			$this->query .= "OR lc_f.loc LIKE 'B%' ";
		}
		$this->query .= ')';
	}

	private function setWhere()
	{
		$this->db->join('cyc_count_details','cyc_count_details.entry_id = cyc_master_pool.entry_id');
		$this->db->where('dataset',$this->dataset);
		$this->db->where('cyc_master_pool.added_on BETWEEN "'.$this->start.'" AND "'.$this->end.'"');
	}

	private function getCreated()
	{
		$this->db->select('count(cyc_master_pool.entry_id) as created');
		$this->setWhere();
		return $this->db->get('cyc_master_pool')->row_array()['created'];
	}

	private function getCountedToday()
	{
		$this->db->select('count(cyc_count_details.entry_id) as counted');
		$this->setWhere();
		$this->db->where('type !=',NULL);
		return $this->db->get('cyc_master_pool')->row_array()['counted'];
	}

	private function getTypeToday($type)
	{
		$this->db->select('count(cyc_count_details.entry_id) as counted');
		$this->setWhere();
		$this->db->where('type',$type);
		return $this->db->get('cyc_master_pool')->row_array()['counted'];
	}

	private function getTypeQTY($type=null)
	{
		if($type == 'net'){
			$this->db->select('SUM(cyc_count_details.qty) as qty');
			$this->db->where('type','Adjusted');
		}elseif($type == 'abs'){
			$this->db->select('SUM(ABS(cyc_count_details.qty)) as qty');
			$this->db->where('type','Adjusted');
		}else{
			$this->db->select('SUM(cyc_count_details.qty) as qty');
		}

		$this->setWhere();
		return $this->db->get('cyc_master_pool')->row_array()['qty'];
	}

	private function getPrefix()
	{
		switch($this->dataset){
			case 'KNK':
				$prefix = 'SB';
				break;
			case 'KNT':
				$prefix = 'DC';
				break;
		}

		return $prefix;
	}
}