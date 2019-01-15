<?php

class Productivity_model extends XPO_Model {
	public $shift;
	public $hours;
	public $settings_exist;
	public $ob_type;
	public $total_labor;
	public $total_picks;
	public $total_units;
	public $ob_pickers;
	public $from_loc;
	public $type;
	public $graph_picks;
	public $graph_targets;
	public $time_ranges;

	public function getCRSIndividual()
	{
		$this->getHours();
		$pickers = $this->getPickers();
		$standard = $this->standard;
		$y=0;
		$final['locations'] = array(
								'mod'=>'MODs',
								'out'=>'Outside',
								'crs'=>'Cresting',
								'qp'=>'Quick Pick');

	
		foreach($pickers as $picker){
			$final['data'][$y] = array('picker'=>$picker['picker'],'wms'=>$picker['opr']);	
			
			for($x=0;$x<count($this->hours);$x++){
				$real_times = array();
				$real_picks = array();

				foreach($final['locations'] as $key => $val){
					$picks[$key] = $this->getIndividualPicks($picker['opr'],$this->hours[$x]['from'],$this->hours[$x]['to'],$key);
					$real_times[] = $picks[$key]['real_time'];
					$real_picks[] = $picks[$key]['picks'];
					$totals[$key][$y][] = $picks[$key]['picks'];	
				}
				
				$te2 = null;
				$total_efficiency = 0;
				$eff = array();
				$total_real_time = array_sum($real_times);
				$total_picks = array_sum($real_picks);
				$total_time = 3600;

				if($total_real_time){
					foreach($final['locations'] as $key => $val){
						if($picks[$key]['picks']){
							$eff[] = ($picks[$key]['real_time'] / $total_real_time) * $picks[$key]['standard_time'];
						}
					}
					$te3 = array_sum($eff);
					$te2 = round(($total_picks / $te3) * 100,2).'%';
				}

				$final['data'][$y]['rows'][]= array(
												'from' => $this->hours[$x]['from'],
												'to' => $this->hours[$x]['to'],
												'mod' => $picks['mod'],
												'out' => $picks['out'],
												'crs' => $picks['crs'],
												'qp' => $picks['qp'],
												'total_efficiency' => ($te2 ? $te2 : NULL),
												'real_time' => $total_real_time,
												'total_picks' => $total_picks
											);	
			}

			foreach($final['locations'] as $key => $val){
				$final['data'][$y][$key] = array_sum($totals[$key][$y]);
			}

			$total = NULL;
			$final['data'][$y]['total'] = $total;
			$final['data'][$y]['total_time'] = $total;
			$y++;
		}

		$final['hours'] = $this->hours;
		
		return $final;
	}

	public function getCRSIndividual2()
	{
		$this->getHours();
		$pickers = $this->getPickers();
		$standard = $this->standard;
		$y=0;
		$final['locations'] = array(
								'mod'=>'MODs',
								'out'=>'Outside',
								'crs'=>'Cresting',
								'qp'=>'Quick Pick');

	
		foreach($pickers as $picker){
			$final['data'][$y] = array('picker'=>$picker['opr']);	
			$max = count($this->hours) - 1;
			$from = $this->hours[0]['from'];
			$to = $this->hours[$max]['to'];

			foreach($final['locations'] as $key => $val){
				$picks[$key] = $this->getIndividualPicks($picker['opr'],$from,$to,$key);
			}



			/*for($x=0;$x<count($this->hours);$x++){
				$real_times = array();
				$real_picks = array();

				foreach($final['locations'] as $key => $val){
					$picks[$key] = $this->getIndividualPicks($picker['opr'],$this->hours[$x]['from'],$this->hours[$x]['to'],$key);
					$real_times[] = $picks[$key]['real_time'];
					$real_picks[] = $picks[$key]['picks'];
					$totals[$key][$y][] = $picks[$key]['picks'];	
				}
				
				$te2 = null;
				$total_efficiency = 0;
				$eff = array();
				$total_real_time = array_sum($real_times);
				$total_picks = array_sum($real_picks);
				$total_time = 3600;

				if($total_real_time){
					foreach($final['locations'] as $key => $val){
						if($picks[$key]['picks']){
							$eff[] = ($picks[$key]['real_time'] / $total_real_time) * $picks[$key]['standard_time'];
						}
					}
					$te3 = array_sum($eff);
					$te2 = round(($total_picks / $te3) * 100,2).'%';
				}

				$final['data'][$y]['rows'][]= array(
												'from' => $this->hours[$x]['from'],
												'to' => $this->hours[$x]['to'],
												'mod' => $picks['mod'],
												'out' => $picks['out'],
												'crs' => $picks['crs'],
												'qp' => $picks['qp'],
												'total_efficiency' => ($te2 ? $te2 : NULL),
												'real_time' => $total_real_time,
												'total_picks' => $total_picks
											);	
			}*/

			/*foreach($final['locations'] as $key => $val){
				$final['data'][$y][$key] = array_sum($totals[$key][$y]);
			}

			$total = NULL;
			$final['data'][$y]['total'] = $total;
			$final['data'][$y]['total_time'] = $total;
			$y++;*/
		}

		$final['hours'] = $this->hours;
		
		return $final;
	}


	public function getIndividualPicks($opr,$from,$to,$type)
	{
		$standard_key = 'prod_crs_std_'.$type;
		$standard_time = $this->$standard_key;
		$real_time = null;
		$expected_picks = null;
		$efficiency = null;
		$default_hour = 60;

		$query = "SELECT count(*) as picks,sum(act_qty) as units,min(dtimecre) as start,max(dtimecre) as end
					FROM it_f
					WHERE opr = '".$opr."'
					AND transact IN ('OPK','OPKP')
					AND dtimecre BETWEEN '".$from."' AND '".$to."'";

		if($this->ob_type){
			$query .= " AND ob_type = '$this->ob_type'";
		}

		if($this->type == 'moda' || $this->type == 'modb'){
			$query .= " AND from_loc LIKE '$this->from_loc'";
			$query .= " AND ob_type != 'CRS'";
		}

		$query .= $this->getQuery($type);
		$result = $this->wms->query($query)->row_array();

		if($result['end']){
			$start = strtotime($result['start']);
			$end = strtotime($result['end']);
			$real_time = $end - $start;
			$real_time = ($real_time != 0 ? $real_time : 1);
			$expected_picks = ($real_time * $this->$standard_key) / 3600;
			$efficiency = round(($result['picks'] * 100 / $expected_picks));
		}
		
		$final = array(
					'picks' => ($result['picks'] ? number_format($result['picks']) : null),
					'units' => ($result['units'] ? number_format($result['units']) : null),
					'start' => $result['start'],
					'end' => $result['end'],
					'real_time' => $real_time,
					'difference' => ($real_time ? $real_time.'s' : $real_time),
					'standard_time' => $standard_time,
					'expected_picks' => (round($expected_picks) ? round($expected_picks) : 1),
					'efficiency' => $efficiency,
					'efficiency_percentage' => ($efficiency ? $efficiency.'%' : $efficiency)
					);

		return $final;
	}

	public function getHistory($date,$shift)
	{

	}

	public function getShiftData($save=true){

		$standard = $this->standard;
		$this->getHours();

		$final = array(
					'shift_title' => $this->shift['current'],
					'sched_hrs' => $this->prod_crs_sched_hrs,
					'oprs' => $this->prod_crs_oprs
					);

		//override defaults if settings exist
		$this->db->where('date',date('Y-m-d'));
		$this->db->where('shift',$this->shift['current']);
		$this->db->where('type',$this->type);
		$shift_settings = $this->db->get('productivity_master')->row_array();

		$this->getHourlyData($shift_settings);

		if($shift_settings){
			$this->settings_exist = true;
			$final = array(
						'shift_id' => $shift_settings['shift_id'],
						'sched_hrs' => $shift_settings['sched_hrs'],
						'oprs' => $shift_settings['oprs'],
						'shift_title' => $shift_settings['shift']
					);
		}

		$final['hourly_data'] = $this->hours;
		$this->available_picks = $final['available_picks'] = $this->getAvailablePicks();
		$final['available_units'] = $this->getAvailableUnits();
		$final['target_pph'] = $this->$standard;
		$final['processing_capacity'] = ceil($this->$standard * $this->total_labor);
		$final['simulated_capacity'] = ceil($final['sched_hrs'] * $final['oprs'] * $this->$standard);
		$final['variance_to_target'] = $this->total_picks - $final['processing_capacity'];
		$final['efficiency'] = ($final['processing_capacity'] ? round(($this->total_picks / $final['processing_capacity']) * 100) : 0);
		$final['cmp_picks'] = number_format($this->total_picks);
		$final['cmp_units'] = number_format($this->total_units);
		$final['actual_pph'] = round(($this->total_labor ? $this->total_picks / $this->total_labor : 0));
		$final['variance_pph'] = $final['actual_pph'] - $final['target_pph'];
		$final['graph_picks'] = $this->graph_picks;
		$final['graph_targets'] = $this->graph_targets;
		$this->save_hourly($final);

		return $final;
	}

	public function getHourlyData($shift_data=null){		
		$standard = $this->standard;
		if($shift_data){
			$this->db->where('shift_id',$shift_data['shift_id']);
			$this->db->order_by('ph_id');
			$in_db = $this->db->get('productivity_hours')->result_array();
		}
		
		for($x=0;$x<count($this->hours);$x++){
			$ph_id = (isset($in_db[$x]['ph_id']) ? $in_db[$x]['ph_id'] : null);
			$ph_detail = $this->db->get_where('productivity_hours_detail',array('ph_id'=>$ph_id))->result_array();
			$wms_picks = $this->getWMSPicks($this->hours[$x]['from'],$this->hours[$x]['to']);
		    $pickers = (int)($wms_picks['pickers'] ? $wms_picks['pickers'] : 0);
		    $worked = ($ph_detail ? array_sum(array_column($ph_detail,'mins_worked')) : $pickers * 60);
		    $picks = (int)($wms_picks['pickers'] ? number_format($wms_picks['picks']) : 0);
		    $units = ($wms_picks['pickers'] ? $wms_picks['units'] : 0);
		    $labor = ($ph_detail ? ($worked / ($pickers * 60)) * $pickers : $pickers);
		    $target = $labor * $this->$standard;
		    $upp = ($labor ? $units / $picks / $labor : 0);
		    $variance = $picks - $target;
		    $pppph = ($labor ? $picks / $labor : 0);
		    $uppph = ($labor ? $units / $labor : 0);
		    $time = ($worked ? round(($worked / ($pickers * 60)) * 100).'%' : 0);
		    $demand = (isset($in_db[$x]['available_picks']) ? $in_db[$x]['available_picks'] : null);
		    $reason = (isset($in_db[$x]['reason']) ? $in_db[$x]['reason'] : null);
		    
		    $this->hours[$x]['ph_id'] = $ph_id;
		    $this->hours[$x]['pickers'] = $pickers;
		    $this->hours[$x]['picks'] = $picks;
		    $this->hours[$x]['units'] = number_format($units);
		    $this->hours[$x]['labor'] = round($labor,2);
		    $this->hours[$x]['target'] = floor($target);
		    $this->hours[$x]['upp'] = round($upp,2);
		    $this->hours[$x]['variance'] = number_format($variance);
		    $this->hours[$x]['pppph'] = round($pppph,2);
		    $this->hours[$x]['uppph'] = round($uppph,2);
		    $this->hours[$x]['time'] = $time;
		    $this->hours[$x]['demand'] = $demand;
		    $this->hours[$x]['reason'] = $reason;

		    $this->total_labor += round($labor);
		    $this->total_picks += $picks;
		    $this->total_units += $units;
		    $this->graph_picks[] = (string)$picks;
		    $this->graph_targets[] = $target;
		    $this->time_ranges[] = $this->hours[$x]['label'];
		}		
	}

	public function getAvailablePicks()
	{
        if($this->type == 'cresting'){
        	$query = "SELECT COUNT(od.ob_oid) as picks
	                    FROM om_f as om,od_f as od
	                    WHERE om.ob_ord_stt IN ('RDY')
	                    AND om.ob_oid = od.ob_oid
	                    AND cmp_qty < ord_qty
	        			AND om.ob_type = 'CRS'
	        			GROUP BY od.ob_oid,num_line,num_unit";
        }elseif($this->type == 'moda' || $this->type == 'modb'){
        	$query = "SELECT COUNT(*) AS picks
						FROM cm_f
						WHERE loc LIKE '$this->from_loc'
						AND task = 'PICK'
						AND cmd_stt = 'CLST'
						AND ob_type != 'CRS'";
        }elseif($this->type == 'outside'){
        	$query = "SELECT COUNT(*) AS picks
						FROM cm_f
						WHERE task = 'PICK'
						AND cmd_stt = 'CLST'
						AND ob_type != 'CRS'
						AND loc NOT MATCHES 'O[18-22]*-*'
						AND loc NOT MATCHES '[A-B]*-*'";
        }

        $result = $this->wms->query($query)->row_array();
        return number_format($result['picks']);
	}

	public function getAvailableUnits()
    {
    	if($this->type == 'cresting'){
        	$query = "SELECT SUM(od.ord_qty - od.cmp_qty) as units
	                    FROM om_f as om,od_f as od
	                    WHERE om.ob_type = 'CRS'
	                    AND om.ob_ord_stt NOT IN ('PREP')
	                    AND om.ob_oid = od.ob_oid
	                    AND cmp_qty < ord_qty
	                    GROUP BY om.ob_oid,num_unit";
	    }elseif($this->type == 'moda' || $this->type == 'modb'){
        	$query = "SELECT SUM(qty) AS units
						FROM cm_f
						WHERE loc LIKE '$this->from_loc'
						AND task = 'PICK'
						AND cmd_stt = 'CLST'
						AND ob_type != 'CRS'";
        }elseif($this->type == 'outside'){
        	$query = "SELECT SUM(qty) AS units
						FROM cm_f
						WHERE task = 'PICK'
						AND cmd_stt = 'CLST'
						AND ob_type != 'CRS'
						AND loc NOT MATCHES 'O[18-22]*-*'
						AND loc NOT MATCHES '[A-B]*-*'";
        }

        $units = $this->wms->query($query)->result_array();
        $units = array_column($units,'units');
        $total_units = array_sum($units);
        return number_format($total_units);
    }

    public function saveSetting($data)
    {
    	$master = array(
    				'sched_hrs' => $data['sched_hours'],
    				'oprs' => $data['oprs']
    				);
    	$this->db->where('shift_id',$data['shift_id']);
    	$this->db->update('productivity_master',$master);
    }

    public function saveHourData($id,$field,$val)
    {
    	$this->db->set($field,$val);
    	$this->db->where('ph_id',$id);
    	$this->db->update('productivity_hours');
    }

    public function save_hourly($data)
    {
    	$master = array(
    				'date' => humanDate($this->shift['start'],'Y-m-d'),
    				'type' => $this->type,
    				'shift' => $data['shift_title'],
    				'sched_hrs' => $data['sched_hrs'],
    				'oprs' => $data['oprs'],
    				'capacity' => $data['processing_capacity'],
    				'target_pph' => $data['target_pph'],
    				'variance' => $data['variance_to_target'],
    				'progress_to_capacity' => $data['efficiency'],
    				'actual_pph' => $data['actual_pph'],
    				'variance_pph' => $data['variance_pph'],
    				'remaining_picks' => $data['available_picks'],
    				'remaining_units' => $data['available_units'],
    				'completed_picks' => $data['cmp_picks'],
    				'completed_units' => $data['cmp_units'],
    				'last_update' => date('Y-m-d H:i:s')
    				);

    	$check = $this->db->get_where('productivity_master',array('date'=>$master['date'],'shift'=>$master['shift'],'type'=>$this->type))->row_array();
    	
    	if($check){
    		$this->db->where('shift_id',$check['shift_id']);
    		$this->db->update('productivity_master',$master);
    	}else{
    		$this->db->insert('productivity_master',$master);
    	}

    	$this->save_hourly_lines($data['hourly_data'],$check['shift_id']);
    }

    public function save_hourly_lines($data,$shift_id)
    {
    	$exist = false;
    	$this->db->order_by('ph_id');
    	$check = $this->db->get_where('productivity_hours',array('shift_id'=>$shift_id))->result_array();

    	if($check){
    		$exist = true;
    	}

    	for($x=0;$x<count($data);$x++){
    		$detail[$x] = array(
    					'ph_id' => (isset($check[$x]['ph_id']) ? $check[$x]['ph_id'] : NULL),
    					'shift_id' => $shift_id,
    					'pickers' => $data[$x]['pickers'],
    					'labor_hrs' => $data[$x]['labor'],
    					'target' => $data[$x]['target'],
    					'completed_picks' => $data[$x]['picks'],
    					'completed_units' => $data[$x]['units'],
    					'upp' => $data[$x]['upp'],
    					'variance' => $data[$x]['variance'],
    					'pppph' => $data[$x]['pppph'],
    					'uppph' => $data[$x]['uppph'],
    					'time' => $data[$x]['time'],
    					'created' => date('Y-m-d H:i:s'),
    					'start' => humanDate($data[$x]['from'],'H:00:00'),
    					'end' => humanDate($data[$x]['to'],'H:00:00')
    				);

    		if($this->now >= $data[$x]['from'] && $this->now <= $data[$x]['to']){
    			$detail[$x]['available_picks'] = $this->available_picks;
    		}
    	}


    	if($exist){
    		$this->db->update_batch('productivity_hours',$detail,'ph_id');
    	}else{
    		foreach($detail as $row){
    			$this->db->insert('productivity_hours',$row);
    		}
    	}
    }

    public function getPickers($from=null,$to=null){

		$query = "SELECT DISTINCT(it_f.opr) as opr,us_f.opr_name as picker
					FROM it_f 
					JOIN us_f ON us_f.opr = it_f.opr
					WHERE transact IN('OPK','OPKP')
					AND us_f.user_grp != 'PICKEXEMPT'";

		if($this->ob_type){
			$query .= "AND ob_type = '$this->ob_type'";
		}

		if($this->from_loc){
			if(in_array($this->type,array('moda','modb'))){
				$query .= "AND from_loc LIKE '$this->from_loc'";
			}else{
				$query .= "AND from_loc NOT MATCHES 'O[18-22]*-*'";
				$query .= "AND from_loc NOT MATCHES '[A,B]*-*'";
			}
			$query .= "AND ob_type != 'CRS'";
		}

		if($from){
			$query .= "AND it_f.dtimecre BETWEEN '".$from."' AND '".$to."'";
		}

		$pickers = $this->wms->query($query)->result_array();
		return $pickers;
    }

    public function getHoursWorked($opr,$from)
    {
    	$this->db->select('productivity_hours_detail.phd_id as phd_id,mins_worked');
		$this->db->join('productivity_hours','productivity_hours.shift_id = productivity_master.shift_id');
		$this->db->join('productivity_hours_detail','productivity_hours_detail.ph_id = productivity_hours.ph_id');
		$this->db->where('productivity_hours_detail.ph_id',$from);
		//$this->db->where('start',humanDate($from,'H:00:00'));
		$this->db->where('picker',trim($opr));
		$productivity = $this->db->get('productivity_master')->row_array();
		
		$final = array(
					'phd_id' => ($productivity ? $productivity['phd_id'] : NULL),
					'worked' => ($productivity ? $productivity['mins_worked'] : 60)
					);

		return $final;
    }

	private function getWMSPicks($from,$to){

		$pick_query = "SELECT COUNT(DISTINCT it_f.opr) AS pickers, count(it_rid) as picks,SUM(act_qty) as units
		                    FROM it_f 
		                    JOIN us_f ON it_f.opr = us_f.opr
		                    WHERE it_f.dtimecre BETWEEN '$from' AND '$to'
		                    AND us_f.user_grp != 'PICKEXEMPT'
		                    AND transact IN('OPK','OPKP')";

		if($this->ob_type){
			$pick_query .= "AND ob_type = '$this->ob_type'";
		}

		if($this->from_loc){
			if(in_array($this->type,array('moda','modb'))){
				$pick_query .= "AND from_loc LIKE '$this->from_loc'";
			}else{
				$pick_query .= "AND from_loc NOT MATCHES 'O[18-22]*-*'";
				$pick_query .= "AND from_loc NOT MATCHES '[A,B]*-*'";
			}
			$pick_query .= "AND ob_type != 'CRS'";
		}

		return $this->wms->query($pick_query)->row_array();
	}

	//shift hour functions
	public function checkShift(){
		$now = new DateTime();
		$now_formatted = $now->format('Y-m-d H:i:s');
		$shift1_start = $now->format('Y-m-d 06:00:00');
		$shift1_end = $now->format('Y-m-d 17:59:59');
		//$now_formatted = '2018-12-20 01:00:00';
		if($now_formatted > $shift1_start && $now_formatted < $shift1_end){
			$this->shift['current'] = '1st';
			$this->shift['start'] = $now->format('Y-m-d 06:00:00');
			$this->shift['end'] = $now->format('Y-m-d 17:59:59');
		}else{
			$this->shift['current'] = '2nd';
			$this->shift['start'] = $now->format('Y-m-d 18:00:00');
			$this->shift['end'] = $now->add(new DateInterval('P1D'))->format('Y-m-d 05:59:59');
		}
	}

	public function getHours(){
		$this->checkShift();
		$start = DateTime::createFromFormat('Y-m-d H:i:s',$this->shift['start']);
		$end = DateTime::createFromFormat('Y-m-d H:i:s',$this->shift['end']);

		$total_hours = $end->diff($start)->format('%h');
		
		for($x=0;$x<=$total_hours;$x++){
			$db_from = $start->format('Y-m-d H:00:00');
			$to = $start->add(new DateInterval('PT1H'));
			$db_to = $to->format('Y-m-d H:00:00');

			$hours[] = array(
						'from' => $db_from,
						'to' => $db_to,
						'label' => humanDate($db_from,'h:i A').' - '.humanDate($db_to,'h:i A')
					);
		}

		$this->hours = $hours;
	}

	public function saveHourWorked($data)
	{
		for($x=0;$x<count($data['picker']);$x++){
			$info[] = array(
						'phd_id' => $data['phd_id'][$x],
						'ph_id' => $data['ph_id'],
						'picker' => trim($data['picker'][$x]),
						'mins_worked' => $data['labor'][$x]
						);


		}

		$this->db->where('phd_id',$data['phd_id'][0]);
		$check = $this->db->get('productivity_hours_detail')->num_rows();

		if($check){
			$this->db->update_batch('productivity_hours_detail',$info,'phd_id');
		}else{
			$this->db->insert_batch('productivity_hours_detail',$info);
		}
	}

	public function setProdType($type)
	{
		$this->type = $type;

		switch($type){
			case 'cresting':
	            $this->ob_type = 'CRS';
	            $this->standard = 'prod_crs_pph';
	            $this->label = 'Cresting';
	            break;
        	case 'moda':
	            $this->from_loc = 'A%-%';
	            $this->standard = 'prod_moda_pph';
	            $this->label = 'MOD-A';
	            break;
        	case 'modb':
	            $this->from_loc = 'B%-%';
	            $this->standard = 'prod_modb_pph';
	            $this->label = 'MOD-B';
	           	break;
	        case 'outside':
	        	$this->from_loc = 'OUT';
	            $this->standard = 'prod_out_pph';
	            $this->label = 'Outside';
        }
	}

	private function getQuery($type)
	{
		$query['mod'] = " AND (from_loc LIKE 'A%-%' OR from_loc LIKE 'B%-%')";
		$query['out'] = " AND from_loc NOT MATCHES '[A-B]*-*' 
							AND from_loc NOT MATCHES 'O[18-22]*-*'
							AND from_loc NOT LIKE 'QP%'";

		$query['crs'] = " OR from_loc MATCHES 'O[18-22]*-*'";
		$query['qp'] = " AND from_loc LIKE 'QP%'";
		$query['pick_out'] = " AND ith_f.from_loc NOT LIKE 'A%-%-%'
								AND ith_f.from_loc NOT LIKE 'B%-%-%'
								AND ith_f.from_loc NOT LIKE 'DSG%'
								AND ith_f.from_loc NOT LIKE 'O18%'
								AND ith_f.from_loc NOT LIKE 'O19%'
								AND ith_f.from_loc NOT LIKE 'O20%'
								AND ith_f.from_loc NOT LIKE 'O21%'
								AND ith_f.from_loc NOT LIKE 'O22%'
								AND ith_f.from_loc NOT LIKE 'O23%'
								AND ith_f.from_loc NOT LIKE 'QP%'
								AND ith_f.from_loc NOT LIKE '50%'
								AND ith_f.from_loc NOT LIKE '51%'
								AND ith_f.from_loc NOT LIKE '52%'
								AND ith_f.from_loc NOT LIKE '53%'
								AND ith_f.from_loc NOT LIKE '54%'
								AND ith_f.from_loc NOT LIKE '55%'
								AND ith_f.from_loc NOT LIKE '56%'
								AND ith_f.from_loc NOT LIKE '57%'
								AND ith_f.from_loc NOT LIKE '58%'
								AND ith_f.from_loc NOT LIKE '59%'
								AND ith_f.from_loc NOT LIKE '60%'
								AND ith_f.from_loc NOT LIKE '61%'
								AND ith_f.from_loc NOT LIKE '62%'
								AND ith_f.from_loc NOT LIKE '63%'
								AND ith_f.from_loc NOT LIKE '64%'
								AND ith_f.from_loc NOT LIKE 'INF%'
								AND ith_f.from_loc NOT LIKE 'SB%'";


		return $query[$type];
	}

	public function saag($from,$to)
	{
		$dtimecre = "AND dtimecre BETWEEN '".$from."' AND '".$to."'";
		$dropped = "SELECT count(*) as dropped
					FROM it_f
					WHERE transact = 'ODC'
					AND sku = '378037-100'";

		$processed = "SELECT count(*) as processed
					FROM it_f
					WHERE transact IN ('OPK','OPKP')
					AND sku = '378037-100'";
		$dropped .= $dtimecre;	
		$processed .= $dtimecre;
		
		$final['dropped'] = $this->wms->query($dropped)->row_array()['dropped'];
		$final['processed'] = $this->wms->query($processed)->row_array()['processed'];
		return $final;
	}

	public function processed($from)
	{
		$to_var = $from+2;
		$from = date('Y-m-d '.$from.':00:00');
		$to = date('Y-m-d '.$to_var.':00:00');
		$dtimecre = "AND dtimecre BETWEEN '".$from."' AND '".$to."'";
			
		return $this->wms->query($query)->row_array();
	}
}