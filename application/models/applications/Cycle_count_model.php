<?php

class Cycle_count_model extends XPO_Model {

	public $dataset;
	public $cyc_locs;
	public $cc_template;
	public $cc_f_insert;
	public $master_pool_insert;
	public $location;
	private $start;
	private $end;

	public function setShift()
	{
		$this->start = getShift('start');
		$this->end = getShift('end');
	}

	public function get_lc_f()
	{
		$final_locs = array();

		if($this->dataset == 'KNK'){
			for($x=49;$x<64;$x++){
				$loc_query = "SELECT TRIM(lc_f.loc) as loc,SUM(qty) as qty
								FROM lc_f 
								LEFT JOIN iv_f ON iv_f.loc = lc_f.loc
								WHERE lc_f.loc LIKE '".$x."%'
								GROUP BY loc,qty
								ORDER BY loc";

				/*$rack_query = "SELECT TRIM(lc_f.loc) as loc, iv_f.sku, iv_f.pkg, pm_f.tariff_desc,iv_f.qty
								FROM (lc_f LEFT JOIN iv_f ON lc_f.loc = iv_f.loc) LEFT JOIN pm_f ON (iv_f.pkg = pm_f.pkg) AND (iv_f.sku = pm_f.sku)
								WHERE lc_f.loc LIKE '".$x."%'
								ORDER BY lc_f.loc";*/

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

			/*$sb_query = "SELECT TRIM(lc_f.loc) as loc, iv_f.sku, iv_f.pkg, pm_f.tariff_desc,iv_f.qty
							FROM (lc_f LEFT JOIN iv_f ON lc_f.loc = iv_f.loc) LEFT JOIN pm_f ON (iv_f.pkg = pm_f.pkg) AND (iv_f.sku = pm_f.sku)
							WHERE lc_f.loc LIKE 'SB%'
							ORDER BY lc_f.loc";*/

			$locs = $this->wms->query($loc_query)->result_array();
			$final_locs = array_merge($final_locs,$locs);
		}
		
		$this->cyc_locs = $final_locs;
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
		$prefix = ($this->dataset == 'KNK' ? 'SB' : 'NM');

		for($x=0;$x<count($record);$x++){
			$cc_rid++;

			$temp['cc_rid'] = $cc_rid;
			$temp['cycc_oid'] = ($oid ? $prefix.$oid : $prefix.$cc_rid);
			$temp['opr'] = 'AUTO';
			$temp['cycc_stt'] = 'HOLD';
			$temp['release_date'] = date('Y-m-d');
			$temp['start_loc'] = $record[$x]['loc'];
			$temp['end_loc'] = $record[$x]['loc'];
			$temp['dt_start'] = date('Y-m-d H:i:s');
			$temp['dt_end'] = date('Y-m-d H:i:s');
			$temp['gen_by'] = 'ATHENA';
			$temp['usrmod'] = 'ATHENA';
			$temp['dtimecre'] = date('Y-m-d H:i:s');
			$temp['dtimemod'] = date('Y-m-d H:i:s');

			if(!$oid){
				$master_pool[] = array(
								'loc' => $record[$x]['loc'],
								'annual_counter' => 0,
								'round' => 1,
								'added_by' => 1,
								'added_on' => date('Y-m-d H:i:s'),
								'enabled' => true,
								'dataset' => $this->dataset,
								'cc_rid' => $cc_rid
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
		$start = getShift('start');
		$end = getShift('end');

		$prefix = ($this->dataset == 'KNK' ? 'SB' : 'NM');
		$this->getTemplate();

		$this->db->join('cyc_count_details','cyc_count_details.entry_id = cyc_master_pool.entry_id');
		$this->db->where('cyc_master_pool.added_on BETWEEN "'.$start.'" AND "'.$end.'"');
		$locs = $this->db->get('cyc_master_pool')->result_array();
		$checklocs = array_column($locs,'cc_rid');
		
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
			
			$check = $this->wms->query($check_query);					
			$itf = $check->result_array();

			$cadj_key = search_key_val('transact','CADJ',$itf);
			$cycc_key = search_key_val('transact','CYCC',$itf);
			$cycf_key = search_key_val('transact','CYCF',$itf);

			if($cadj_key !== NULL)
				$cadj = $itf[$cadj_key];

			if($cycc_key !== NULL)
				$cycc = $itf[$cycc_key];

			if($cycf_key !== NULL)
				$cycf = $itf[$cycf_key];
			
			
			if($itf){
				$detail = array(
						'counted_on' => (isset($cycf_key) ? $cycf['dtimecre'] : date('Y-m-d H:i:s')),
						'type' => ($cadj_key !== NULL ? 'Adjusted' : 'Counted'),
						'qty' =>  ($cadj_key !== NULL ? (int)$cadj['qty'] : (int)$cycc['qty']),
						'opr' => trim($cycc['opr'])
					);
				$this->db->where('entry_id',$cc['entry_id']);
				$this->db->where('round',$cc['round']);
				$this->db->update('cyc_count_details',$detail);
				

				if($cadj_key !== NULL){
					$check = $this->getCycDetail($cc['entry_id'],2);
					
					if(!$check){
						$detail = array(
										'entry_id' => $cc['entry_id'],
										'loc' => $cc['loc'],
										'act_qty' =>  $this->getCycDetail($cc['entry_id'],1)->act_qty,
										'added_on' => date('Y-m-d H:i:s'),
										'round' => 2
									);

						$this->applyTemplate(array($detail),$cc['cc_rid']);
						$this->insert_cc_f();
						$this->db->insert('cyc_count_details',$detail);
					}elseif(!$check->qty){
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
					$this->db->set('round',2);
				}
			}

			$this->db->set('last_check',date('Y-m-d H:i:s'));
			$this->db->where('entry_id',$cc['entry_id']);
			$this->db->update('cyc_master_pool');
		}			
	}

	public function getTotals($dataset='KNK')
	{
		$this->setShift();

		$this->dataset = $dataset;
		$this->get_lc_f();
		$total_locs = count($this->cyc_locs);

		$this->db->where('annual_counter !=',0);
		$this->db->where('dataset',$this->dataset);
		$master = $this->db->get('cyc_master_pool')->result_array();
		//echo $this->db->last_query();
		$query = "SELECT 
					count(cm.entry_id) as created,
					(SELECT count(entry_id) FROM cyc_count_details WHERE type ='Adjusted') as adjusted_locs,
					(SELECT count(entry_id) FROM cyc_count_details WHERE type ='Counted') as counted_locs,
					(SELECT sum(qty) FROM cyc_count_details WHERE type ='Counted') as qty,
					(SELECT sum(qty) FROM cyc_count_details WHERE type ='Adjusted') as net_adj,
					(SELECT sum(ABS(qty)) FROM cyc_count_details WHERE type ='Adjusted') as abs_adj
					FROM cyc_master_pool as cm
					JOIN cyc_count_details as cd
					WHERE dataset = '".$this->dataset."'
					AND cm.added_on BETWEEN '".$this->start."' AND '".$this->end."'
					GROUP BY cm.entry_id
					LIMIT 1";

		$totals = $this->db->query($query)->row_array();
		$rounds = $this->getRoundTotal();	

		$final = array(
					'percentage' => ceil((count($master) / $total_locs) * 100).'%',
					'total_locs' => number_format($total_locs),
					'counted' => count($master),
					'counted_today'=> number_format($totals['counted_locs']),
					'pending' => number_format($total_locs - count($master)),
					'assigned_today' => $totals['created'],
					'r1_today' => ($rounds ? $rounds[1] : NULL),
					'r2_today' => ($rounds ? $rounds[2] : NULL),
					'dataset' => $dataset,
					'dataset_header' => $this->getDatasetHeader(),
					'remainder_today' => ($totals['created'] ? $totals['created'] - $totals['counted_locs'] : 0),
					'net_adj' => ($totals['net_adj'] ? $totals['net_adj'] : 0),
					'abs_adj' => ($totals['abs_adj'] ? $totals['abs_adj'] : 0),
					'qty' => $totals['qty'],
					'cyc_all' => $this->getCycToday()
					);

		return $final;
	}

	public function getCycToday()
	{
		$query = "SELECT cm.loc, cm.sku,cm.pkg,cd.act_qty,cd.type,cd.qty,
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

	//Private functions

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
				if($round_detail['type'] == 'Counted'){
					$counted++;
				}elseif($round_detail['type'] == 'Adjusted'){
					$adjusted++;
				}
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

	private function insert_cc_f()
	{
		$fields = array_keys($this->cc_f_insert[0]);
		$fields = implode(',',$fields);
		
		foreach($this->cc_f_insert as $row){
                $values = " ('".implode("','",$row)."')";
                $query = 'INSERT INTO cc_f ('.$fields.') VALUES'.$values;
            	$this->wms->query($query);
        }
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
}