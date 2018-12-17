<?php

class Replenisher_model extends XPO_Model {

	public $wave;
	public $lines;

	public function getWaves($type)
	{
		$final_waves = array();

		$query = "SELECT DISTINCT(trim(wave)) as wave 
					FROM om_f
					WHERE ob_ord_stt = 'PLN'";
		$query .= "AND ".$this->getReplenishmentSettings('query',$type)['val'];

		$waves = $this->wms->query($query)->result_array();

		foreach($waves as $wave){
			$replenisher_info = $this->getReplenisherInfo($wave['wave']);

			$final_waves[] = array(
								'wave' => $wave['wave'],
								'built' => ($replenisher_info && $replenisher_info['replenished_on'] ? 1 : 0),
								'user' => ($replenisher_info['replenished_on'] ? $replenisher_info['e_fname'].' '.$replenisher_info['e_lname'] : null),
								'timestamp' => $replenisher_info['replenished_on']
							);
		}

		return $final_waves;
	}

	public function getWaveLines()
	{
		$query = "SELECT trim(od_f.sku) as sku,trim(od_f.pkg) as pkg,SUM(plan_qty - sched_qty) as qty,trim(tariff_desc) as tariff_desc FROM om_f
					JOIN od_f ON om_f.ob_oid = od_f.ob_oid
					JOIN pm_f ON pm_f.sku = od_f.sku AND pm_f.pkg = od_f.pkg
					WHERE wave = '".$this->wave."'
					GROUP BY sku,pkg,tariff_desc
					HAVING (SUM(plan_qty - sched_qty)) >0
					ORDER BY qty DESC";

		$this->lines = $this->wms->query($query)->result_array();
	}

	public function buildReplenishment($data)
	{
		$update = array(
					'loc' => $data['loc'],
					'loc_type' => $this->getReplenishmentSettings('field','loc_type')['val'],
					'sku' => $data['sku'],
					'pkg' => $data['pkg'],
					'max_fp_cap' => $this->getReplenishmentSettings('field','max_fp_cap')['val'],
					'uc1' => $this->getReplenishmentSettings('field','uc1')['val'],
					'uc2' => $this->getReplenishmentSettings('field','uc2')['val'],
					'uc3' => $this->getReplenishmentSettings('field','uc3')['val'],
					'repl_batch_qty' => $this->getReplenishmentSettings('field','repl_batch_qty')['val'],
					'repl_dynam_qty' => $this->getReplenishmentSettings('field','repl_dynam_qty')['val'],
					'repl_uom' => $this->getReplenishmentSettings('field','repl_uom')['val'],
					'trig_batch_qty' => $this->getReplenishmentSettings('field','trig_batch_qty')['val'],
					'trig_dynam_qty' => $this->getReplenishmentSettings('field','trig_dynam_qty')['val'],
					'trig_uom' => $this->getReplenishmentSettings('field','trig_uom')['val'],
					'lot' => $this->getReplenishmentSettings('field','lot')['val'],
					'search' => $this->getReplenishmentSettings('search',$data['commodity'])['val']
				);

		return $update;
	}

	public function getCrestingLocations($type)
	{
		$query = "SELECT trim(loc) as loc FROM lc_f
					WHERE empty = 'E'
					AND cycc_stat = ''
					AND loc_type = 'FIFO'
					AND zone LIKE 'C%'
					AND loc_stt = ''";

		$filter = $this->getReplenishmentSettings('query',$type);
		if($filter){
			$query .= "AND ".$filter['val'];
		}
		
		return $this->wms->query($query)->result_array();
	}

	public function updateLocations($data)
	{
		$insert_master = array(
							'wave' => $data['wave'],
							'status' => 1,
							'replenished_by' => $this->user_id,
							'replenished_on' => date('Y-m-d H:i:s')
						);

		$this->db->insert('replenishment_master',$insert_master);
		$replen_id = $this->db->insert_id();
		for($x=0;$x<count($data['loc']);$x++){
			$insert_detail[] = array(
								'replen_id' => $replen_id,
								'loc' => $data['loc'][$x],
								'sku' => $data['sku'][$x],
								'pkg' => $data['pkg'][$x],
								'commodity' => $data['commodity'][$x],
								'qty' => $data['qty'][$x]
								);
		}

		$this->db->insert_batch('replenishment_detail',$insert_detail);
		$this->update_lc_f($insert_detail);
	}

	public function getReplenisherInfo($wave)
	{
		$this->db->join('employees','employees.user_id = replenishment_master.replenished_by','LEFT');
		$this->db->where('wave',$wave);
		$replenisher_info = $this->db->get('replenishment_master')->row_array();

		return $replenisher_info;
	}

	private function getReplenishmentSettings($type,$key,$multi=false)
	{
		$this->db->where('type',$type);
		$this->db->where('key',$key);
		if(!$multi){
			$setting = $this->db->get('replenishment_settings')->row_array();
		}else{
			$setting = $this->db->get('replenishment_settings')->result_array();
		}

		return $setting;
	}

	private function update_lc_f($data)
	{
		$marker = $this->getReplenishmentSettings('type','marker')['val'];
		$new_marker = $this->getReplenishmentSettings('type','new_marker')['val'];
		$pm_query = "UPDATE pm_f SET prod_class = '".$new_marker."' 
					WHERE prod_class = ".$marker."";
		
		$this->wms->query($pm_query); //clear 78s

		foreach($data as $row){
			$lc_fields = $this->buildReplenishment($row);
			$query = "UPDATE lc_f SET ".$this->updateSQL($lc_fields,'loc');
			$this->wms->query($query);
			$query_2 = "UPDATE pm_f SET prod_class = '".$marker."' WHERE sku = '".$lc_fields['sku']."' AND pkg = '".$lc_fields['pkg']."'"; //apply 78s
			$this->wms->query($query_2);
		}
	}

	private function updateSQL($data,$update_key)
	{
		$update = '';
		
		foreach($data as $key => $val){
			if($key != $update_key){
				$update .= $key." = '".$val."',";
			}
		}		
		$update = rtrim($update,",");
		$update .= ' WHERE '.$update_key.' = "'.$data[$update_key].'"';
		return $update;
	}
}