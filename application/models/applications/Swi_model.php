<?php

class Swi_model extends XPO_Model {

	public $doc_id;
	private $today;
	private $from ;
	private $ffrom;
	private $to;
	private $fto;

	public function setFromAndTo($y=null,$m=null)
	{
		$y = ($y ? $y : date('Y'));
		$m = ($m ? $m : date('m'));
		$this->today = new DateTime;
		$this->from = new DateTime(date($y.'-'.$m.'-01'.' 00:00:00'));
		$this->to = new DateTime(date($y.'-'.$m.'-01'.' 00:00:00'));
		$this->to = $this->to->modify('last day of this month');
		$this->ffrom = $this->from->format('Y-m-d 00:00:00');
		$this->fto = $this->to->format('Y-m-d 23:59:59');
	}

	public function setDepartment($dept_id)
	{
		$this->db->where('dept_id',$dept_id);
	}


	public function get_swi($id=null,$field=null)
	{
		if($id){
			$this->db->where($field,$id);
		}

		$this->db->select('doc_id,doc_number,doc_name,department,swi_documents.added_by,swi_documents.added_on,swi_documents.modified_on');
		$this->db->select('(SELECT count(process_id) FROM swi_processes WHERE deleted = 0 AND swi_documents.doc_id = swi_processes.doc_id) as processes');
		$this->db->join('departments','departments.department_id = swi_documents.dept_id');
		$this->db->where('swi_documents.deleted',0);

		$swi = $this->db->get('swi_documents');
		$swi = $swi->result();
		$this->db->flush_cache();
		return $swi;
	}

	public function get_process($id=null)
	{
		if($id){
			$this->db->where('doc_id',$id);
		}
		$this->db->where('deleted',0);
		$process = $this->db->get('swi_processes');
		$process = $process->result();
		return $process;
	}

	public function get_process_assignments($id=null,$filters=array())
	{
		if(count($filters)){
			foreach($filters as $field => $value){
				$this->db->where($field,$value);
			}
		}

		$this->db->select('a.doc_id,a.doc_number,b.assigned_on,CONCAT(h.e_fname," ",h.e_lname) as audited,a.doc_name,d.department,e.process,c.pa_id,c.standard,c.comments,b.status,f.principle,g.e_fname,g.e_lname,b.assignment_id,b.completed_on,b.user_id');
		$this->db->from('swi_process_assignment as c');
		$this->db->join('swi_documents as a','a.doc_id = c.doc_id');
		$this->db->join('departments as d','d.department_id = a.dept_id');
		$this->db->join('swi_document_assignment as b','b.doc_id = a.doc_id');
		$this->db->join('swi_processes as e','e.process_id = c.process_id');
		$this->db->join('swi_principles as f','f.principle_id = e.principle_id');
		$this->db->join('employees as g','g.user_id = b.user_id');
		$this->db->join('employees as h','h.user_id = b.emp_audited_id','LEFT');
		$this->db->where('b.assignment_id',$id);
		$this->db->where('c.assignment_id',$id);
		$this->db->group_by('pa_id');
		$pa = $this->db->get()->result();
		
		return $pa;
	}

	public function save_swi($data)
	{
		$save = isset($data['doc_id']);

		$document = array(
						'doc_number' => $data['doc_num'],
						'doc_name' => $data['doc_name'],
						'dept_id' => $data['dept'],
						'deleted' => 0
						);
		
		if(!$save){
			$document['added_on'] = date('Y-m-d H:i:s');
			$document['added_by'] = 2;
			$this->db->insert('swi_documents',$document);
			$this->doc_id = $this->db->insert_id();
		}else{
			$document['modified_on'] = date('Y-m-d H:i:s');
			$document['modified_by'] = 2;
			$this->db->where('doc_id',$data['doc_id']);
			$this->db->update('swi_documents',$document);
			$this->doc_id = $data['doc_id'];
		}
		
		$this->save_process($data,$save);
	}

	public function delete_swi($id)
	{
		$this->db->set('deleted',1);
		$this->db->where_in('doc_id',$id);
		$this->db->update('swi_documents');

		$this->db->set('deleted',1);
		$this->db->where_in('doc_id',$id);
		$this->db->update('swi_processes');

		$this->db->set('deleted',1);
		$this->db->where_in('doc_id',$id);
		$this->db->update('swi_process_assignment');

		$this->db->set('deleted',1);
		$this->db->where_in('doc_id',$id);
		$this->db->update('swi_document_assignment');
	}

	public function save_process($data,$save=false)
	{
		if($save){
			$this->db->where('deleted',0);
			$existing = $this->db->get_where('swi_processes',array('doc_id'=>$data['doc_id']))->result_array();
			$existing_process = array_column($existing,'process_id');

			for($x=0;$x<count($data['process_id']);$x++){
				if(in_array($data['process_id'][$x],$existing_process)){
					$update[] = array(
									'process_id' => $data['process_id'][$x],
									'process' => $data['process'][$x],
									'principle_id' => $data['principle'][$x],
									'modified_on' => date('Y-m-d H:i:s'),
									'modified_by' => $this->session->userdata('user_id')
								);
					$key = array_search($data['process_id'][$x],$existing_process);
					unset($existing_process[$key]);
				}else{
					$insert[] = array(
									'process' => $data['process'][$x],
									'principle_id' => $data['principle'][$x],
									'doc_id' => $this->doc_id,
									'added_on' => date('Y-m-d H:i:s'),
									'added_by' => $this->session->userdata('user_id'),
									'deleted' => 0
									);
				}
			}
			if($existing_process){
				$this->db->set('deleted',1);
				$this->db->where_in('process_id',$existing_process);
				$this->db->update('swi_processes');
			}
			if($update){
				$this->db->update_batch('swi_processes',$update,'process_id');	
			}
			
			if($insert){
				$this->db->insert_batch('swi_processes',$insert);
			}
		}else{
			for($x=0;$x<count($data['process']);$x++){
				$insert[] = array(
							'process' => $data['process'][$x],
							'principle_id' => $data['principle'][$x],
							'doc_id' => $this->doc_id,
							'added_on' => date('Y-m-d H:i:s'),
							'added_by' => $this->session->userdata('user_id'),
							'deleted' => 0
							);
			}
			$this->db->insert_batch('swi_processes',$insert);
		}
	}

	public function get_unique_process()
	{
		$this->db->select('process,principle_id');
		$this->db->group_by('process');
		$process = $this->db->get_where('swi_processes',array('deleted'=>0))->result();
		return ($process ? $process : null);
	}

	public function summary_report()
	{
		$completed = 0;
		$reported = 0;
		$deprecation = 0;
		$standard_met = 0;
		$unassigned = 0;

		$this->db->join('swi_documents','swi_documents.doc_id = swi_document_assignment.doc_id');
		$this->db->where('assigned_on BETWEEN "'.$this->ffrom.'" AND "'.$this->fto.'"');
		$this->db->where('swi_documents.deleted',0);
		$this->db->where('swi_document_assignment.deleted',0);
		$this->db->where('(completed_on BETWEEN "'.$this->ffrom.'" AND "'.$this->fto.'"');
		$this->db->or_where('swi_document_assignment.modified_on BETWEEN "'.$this->ffrom.'" AND "'.$this->fto.'")');
		$documents = $this->db->get('swi_document_assignment')->result();
		//echo $this->db->last_query();
		foreach($documents as $doc)
		{
			if($doc->status != 'pending'){
				$completed++;

				switch($doc->result){
					case 1:
						$reported++;
						break;
					case 3:
						$deprecation++;
						break;
					default:
						$standard_met++;
						break;	
				}
			} //anything not pending is completed

			if($doc->result == 2)
				$unassigned++;
		}
		
		$this->db->select('COUNT(doc_id) as docs');
		$this->db->where('added_on < "'.$this->fto.'"');
		$this->db->where('deleted',0);
		$docs = $this->db->get('swi_documents')->row();
		//echo $this->db->last_query();
		//$pending = $docs->docs - ($completed + $unassigned);
		$pending = $docs->docs - $completed;
		$all_docs = (int)$docs->docs;
		
		$days_left = $this->today->diff($this->to);

		$data = array(
					'completed' => $completed,
					'reported' => $reported,
					'standard_met' => $standard_met,
					'documents' => $all_docs,
					'pending' => $pending,
					'deprecation' => $deprecation,
					'unassigned' => $unassigned,
					'year' => $this->from->format('Y'),
					'month' => $this->from->format('F'),
					'days_left' => ($days_left->invert ? 0 : $days_left->d + 1),
					'days_total' => (int)$this->to->format('d'),
					'departments' => $this->summary_department(),
					'recents' => $this->recently_audited()
				);


		return $data;
	}

	public function summary_employee($y=null,$m=null)
	{
		$this->setEmployeeStaffing(3);
		$employees = $this->getEmployees();

		foreach($employees as $employee)
		{
			$this->db->where('assigned_on BETWEEN "'.$this->ffrom.'" AND "'.$this->fto.'"');
			$this->db->where('user_id',$employee->user_id);
			$swi_doc = $this->db->get('swi_document_assignment')->result();

			$progress[] = array(
							'user_id' => $employee->user_id,
							'name' => $employee->e_fname.' '.$employee->e_lname,
							'assigned' => (isset($swi_doc) ? count($swi_doc) : 0),
							'department' => $employee->department_name,
							'status' => $this->check_completion($swi_doc)
							);
		}
		
		return $progress;
	}

	public function summary_department($y=null,$m=null)
	{
		$final = array();

		$query = "SELECT department_id,department, count(completed_on) as completed, count(assigned_on) as total
					FROM athena.swi_document_assignment
					JOIN swi_documents ON swi_document_assignment.doc_id = swi_documents.doc_id
					JOIN departments ON swi_documents.dept_id = departments.department_id
					WHERE swi_document_assignment.deleted = 0
					AND assigned_on BETWEEN '".$this->ffrom."' AND '".$this->fto."'
					GROUP BY dept_id";

		$departments = $this->db->query($query)->result_array();
		foreach($departments as $dept){
			$progress = round(($dept['completed'] / $dept['total']) * 100).'%';

			$final[$dept['department']] = array(
											'dept' => $dept['department_id'],
											'completed' => $dept['completed'],
											'total' => $dept['total'],
											'color' => ($progress == '100%' ? 'success' : 'secondary'),
											'progress' => $progress
											);
		}
		return $final;
	}

	public function recently_audited($y=null,$m=null)
	{
		$final = array();

		$this->db->join('employees','employees.user_id = swi_document_assignment.user_id');
		$this->db->join('swi_documents','swi_documents.doc_id = swi_document_assignment.doc_id');
		$this->db->join('departments','departments.department_id = swi_documents.dept_id');
		$this->db->where('status','completed');
		$this->db->where('completed_on BETWEEN "'.$this->ffrom.'" AND "'.$this->fto.'"');
		$this->db->order_by('completed_on','DESC');
		$this->db->limit(7);
		$recents = $this->db->get('swi_document_assignment')->result();

		foreach($recents as $recent){
			$final[] = array(
						'assignment_id' => $recent->assignment_id,
						'doc_id' => $recent->doc_number,
						'doc_name' => $recent->doc_name,
						'emp_id' => $recent->user_id,
						'completed_by' => $recent->e_fname.' '.$recent->e_lname,
						'department' => $recent->department,
						'status' => ($recent->result ? 'Reported' : 'Good'),
						'color' => ($recent->result ? 'danger' : 'success'),
						'completed_on' => date_format(date_create($recent->completed_on),'m/d/Y h:i A')
						);
		}

		return $final;
	}

	private function check_completion($docs=null)
	{
		$completed = 0;
		$status['msg'] = '';
		$status['color'] = '';
		if($docs){
			foreach($docs as $doc){
				if($doc->status == 'completed')
					$completed++;
			}
		}

		if($completed == count($docs) && $completed != 0){
			$status['msg'] = 'Done';
			$status['color'] = 'table-success';
		}elseif($completed < count($docs)){
			$status['msg'] = 'In-Progress';
			$status['color'] = 'table-warning';
		}


		return $status['msg'];
	}

	public function get_assignment_pool()
	{
		$departments = $this->get_department_with_document();
		
		foreach($departments as $dept){
			$this->setEmployeeStaffing(3);
			$this->setEmployeeDepartment($dept->dept_id);
			$pool[] = array(
						'dept_id' => $dept->dept_id,
						'employees' => $this->getEmployees(),
						'department' => $this->getDepartment($dept->dept_id),
						'documents' => $this->get_swi('dept_id',['dept_id'=>$dept->dept_id])
						);
		}

		return $pool;
	}

	public function set_assignments($pool)
	{
		$assignments = array();
		foreach($pool as $items){ //loop to all departments
			if(count($items['employees']) && count($items['documents'])){ //if there's anything to assign and assign into
				$employees = $items['employees'];
				$documents = $items['documents'];
				shuffle($employees); //randomize employee pool
				shuffle($documents); //randomize document pool
				$avgdpe = ceil(count($items['documents'])/count($items['employees'])); //get avg document per employee
				//echo $items['department'].count($documents);
				//echo '<br>AVGDPE : '.$avgdpe;
				//echo '<br>Employees : '.count($employees);
				for($x=0;$x<count($employees);$x++){
					if(count($documents)){
						$doc_index = array();
						//echo '<br>'.count($documents);
						if(count($documents) < $avgdpe){
							$avgdpe = count($documents);
						}
						$index = array_rand($documents,$avgdpe);
						if(is_array($index)){
							$doc_index = $index;
						}else{
							$doc_index[] = $index;
						}
						//var_dump($doc_index);
						foreach($doc_index as $di){
							$assignments[] = array(
												'user_id' => $employees[$x]->user_id,
												'doc_id' => $documents[$di]->doc_id,
												'status' => 'pending',
												'assigned_by' => 1,
												'assigned_on' => date('Y-m-d H:i:s'),
												'deleted' => 0
												);

							unset($documents[$di]);
						}
					}
				}
			}
			//echo '<hr>';
		}

		if(count($assignments)){ //if there's anything to assign
			foreach($assignments as $assignment){
				$this->db->select('process_id');
				$processes = $this->db->get_where('swi_processes',array('doc_id'=>$assignment['doc_id'],'deleted'=>0))->result();
				
				$this->db->insert('swi_document_assignment',$assignment);
				$assignment_id = $this->db->insert_id();
				$insert_process = array();

				if(count($processes)){ //if there's any process
					foreach($processes as $process){
						$insert_process[] = array(
												'assignment_id'=> $assignment_id,
												'process_id' => $process->process_id,
												'doc_id' => $assignment['doc_id'],
												'added_by' => 1,
												'deleted' => 0
											);
					}
					$this->db->insert_batch('swi_process_assignment',$insert_process);
				}
			}
		}
	}

	public function set_assignment_pool($pool)
	{
		foreach($pool as $items){
			echo '<table border="1" style="margin:0 auto;width:50%"><thead><tr><th colspan="3">'.$items['department'].'</th></tr><tr><th>Documents ('.count($items['documents']).')</th><th>Employees ('.count($items['employees']).')</th><th>Avg Doc per Employee</th></tr>';
			echo '<tbody><tr><td>';
			foreach($items['documents'] as $doc){
				echo $doc->doc_number.' ('.$doc->doc_name.')<br>';
			}
			echo '</td><td>';
			foreach($items['employees'] as $emp){
				echo $emp->e_fname.' '.$emp->e_lname.'<br>';
			}	
			echo '</td><td>'.ceil(count($items['documents'])/count($items['employees']));
			echo '</td></tr></tbody></table><hr>';
		}
	}

	public function get_document_assignment($wheres=array(),$y=null,$m=null)
	{
		$admins = array(2037,1955,2309);
		$from = ($y ? date($y.'-'.$m.'-01'.' 00:00:00') : $this->firstdayofmonth);
		$to = ($y ? date($y.'-'.$m.'-t'.' 23:59:59') : $this->lastdayofmonth);

		foreach($wheres as $column => $value){
			$this->db->where($column,$value);
		}

		if(!$y && !isset($wheres['assignment_id'])){
			$this->db->where('assigned_on BETWEEN "'.$from.'" AND "'.$to.'"');
		}

		$this->db->join('swi_documents','swi_documents.doc_id = swi_document_assignment.doc_id');
		if(!in_array($this->session->userdata('user_id'),$admins)){
			$this->db->where('swi_documents.dept_id',$this->session->userdata('user_info')['dept']);
		}
		$this->db->order_by('assignment_id','ASC');
		$assignments = $this->db->get('swi_document_assignment')->result_array();
		//echo $this->db->last_query();
		return $assignments;
	}

	public function get_document_report($y=null,$m=null)
	{
		$this->db->where('swi_document_assignment.deleted',0);
		$this->db->where('assigned_on BETWEEN "'.$this->ffrom.'" AND "'.$this->fto.'"');
		$this->db->or_where('swi_document_assignment.modified_on BETWEEN "'.$this->ffrom.'" AND "'.$this->fto.'"');

		$this->db->select('doc_number,doc_name,assignment_id,swi_document_assignment.user_id,departments.department,status,result,CONCAT(e_fname," ",e_lname) as name,assigned_on,completed_on');
		$this->db->join('swi_documents','swi_document_assignment.doc_id = swi_documents.doc_id');
		$this->db->join('departments','swi_documents.dept_id = departments.department_id');
		$this->db->join('employees','swi_document_assignment.user_id = employees.user_id','LEFT');
		$this->db->order_by('status','ASC');
		$report = $this->db->get('swi_document_assignment')->result_array();
		return $report;
	}

	public function getProgressBoard()
	{
		$completed = 0;
		$pending = 0;
		$reported = 0;
		$met = 0;
		$total = 0;

		$year_start = date('Y-01-01 00:00:00');
		$year_end = date('Y-12-31 23:59:59');

		$this->db->where('swi_documents.deleted',0);
		$this->db->join('departments','departments.department_id = swi_documents.dept_id');
		$docs = $this->db->get('swi_documents')->result();
		$today_num = $this->today->format('m');

		for($x=0;$x<count($docs);$x++){
			$final[$x]['doc_num'] = $docs[$x]->doc_number;
			$final[$x]['doc_name'] = $docs[$x]->doc_name;

			for($y=01;$y<=12;$y++){
				$cm = new DateTime(date('Y-'.$y.'-01 00:00:00'));

				$this->db->join('employees','employees.user_id = swi_document_assignment.user_id','LEFT');
				$this->db->where('assigned_on BETWEEN "'.$cm->format('Y-m-d 00:00:00').'" AND "'.$cm->format('Y-m-t 23:59:59').'"');
				$this->db->where('doc_id',$docs[$x]->doc_id);

				$doc_month = $this->db->get('swi_document_assignment')->row();
				
				$val = null;

				if($doc_month)
					if($doc_month->completed_on)
						switch($doc_month->result) {
							case 0:
								$val .= '<i class="fas fa-check-circle text-success"></i>';		
								break;
							case 1:
								$val .= '<i class="fas fa-exclamation-circle text-danger"></i>';
								break;
							case 3:
								$val .= '<i class="fas fa-exclamation-circle text-secondary"></i>';
								break;
						}
						
				if((int)$today_num == (int)$y){
					$fname = (isset($doc_month->e_fname) ? $doc_month->e_fname : NULL);
					$lname = (isset($doc_month->e_lname) ? $doc_month->e_lname : NULL);
					//$val .= ' '.$fname.' '.$lname;

					switch($doc_month->status){
						case 'completed':
							$completed++;
							if($doc_month->result){
								$reported++;
							}else{
								$met++;
							}
							break;
						case 'pending':
							$pending++;
							break;
					}
					$total++;
				}

				$final[$x]['months'][$y] = array(
											'value' => $val
											);
			}
		}

		$final_completed = ceil(($completed / $total) * 100);
		$final_reported = ceil(($reported / $total) * 100);
		$final_met = $final_completed - $final_reported;
		$final_pending = $final_completed - ($final_reported + $final_met);

		$final[0]['department'] = $docs[0]->department;
		$final[0]['progress'] = array(
									'completed' => $final_completed.'%',
									'reported' => $final_reported.'%',
									'met' => $final_met.'%',
									'pending'=> $final_pending.'%'
									);

		return $final;

	}

	public function save_input_swi($data)
	{
		if(in_array('bad',$data['standard'])){
			$status = 1;
		}elseif(!in_array('bad',$data['standard']) && in_array('na',$data['standard'])){
			$status = 3;
		}else{
			$status = 0;
		}

		$update_document = array(
							'status' => 'completed',
							'result' => $status,
							'completed_on' => date('Y-m-d H:i:s'),
							'modified_by' => $this->session->userdata('user_id'),
							'emp_audited_id' => $data['emp_audited_id']
							);

		$this->db->where('assignment_id',$data['process_assignment_id']);
		$this->db->update('swi_document_assignment',$update_document);


		for($x=0;$x<count($data['question_id']);$x++){
			$update_process[] = array(
									'pa_id'=>$data['question_id'][$x],
									'standard'=>$this->get_status_icon($data['standard'][$x]),
									'comments'=> (isset($data['comments'][$x]) ? $data['comments'][$x] : NULL)
									);

			if($data['standard'][$x] == 'bad'){
				$this->insert_adjustment($data['process_assignment_id'],$data['question_id'][$x]);
			}
		}

		$this->db->update_batch('swi_process_assignment',$update_process,'pa_id');
	}

	public function mass_update_process()
	{
		$this->db->join('swi_documents','swi_documents.doc_id = swi_document_assignment.doc_id');
		$this->db->join('departments','departments.department_id = swi_documents.dept_id');
		$this->db->where_in('dept_id',array(2,7));
		$this->db->where('assigned_on > "2018-09-01 00:00:00"');
		$swis = $this->db->get('swi_document_assignment')->result();
		$process = $this->get_process(197);
		//echo '<pre>';
		//var_dump($swis);
		foreach($swis as $swi){
			foreach($process as $p){
				$insert_batch[] = array(
									'assignment_id' => $swi->assignment_id,
									'process_id' => $p->process_id,
									'doc_id' => $swi->doc_id,
									'added_on' => date('Y-m-d H:i:s'),
									'added_by' => 3,
									'deleted' => 0
									);
			}
			$this->db->insert_batch('swi_process_assignment',$insert_batch);
		}

		//var_dump($insert_batch);

		
	}

	public function delete_assignment($id='all')
	{
		$this->db->set('deleted',1);
		$this->db->where_in($ids);
		$this->db->update('swi_process_assignment');

		$this->db->set('deleted',1);
		$this->db->where_in($ids);
		$this->db->update('swi_document_assignment');
	}

	public function unassign_assignment($id='all')
	{
		if($id != 'all'){
			$this->db->where('assignment_id',$id);
		}
		$this->db->set('user_id',NULL);
		$this->db->set('assigned_on',NULL);
		$this->db->set('result',2);
		$this->db->set('status','pending');
		$this->db->set('completed_on',NULL);
		$this->db->set('modified_on',date('Y-m-d H:i:s'));
		$this->db->update('swi_document_assignment');
		$this->db->flush_cache();
		$this->db->set('standard',NULL);
		$this->db->set('comments',NULL);
		$this->db->where('assignment_id',$id);
		$this->db->update('swi_process_assignment');
	}

	public function updateAssignment($data)
	{
		$completed = ($data['completed_on'] ? date_format(date_create($data['completed_on']),'Y-m-d 00:00:00') : null);

		$result = ($data['status'] !== '' ? $data['status'] : null);
		$status = ($data['status'] != null ? 'completed' : 'pending');

		$update = array(
					'assigned_on' => date_format(date_create($data['assigned_on']),'Y-m-d 00:00:00'),
					'completed_on' => $completed,
					'result' => $result,
					'status' => $status,
					'user_id' => $data['assigned'],
					'modified_on' => date('Y-m-d H:i:s'),
					'modified_by' => $this->user_id
					);

		$this->db->where('assignment_id',$data['assignment_id']);
		$this->db->update('swi_document_assignment',$update);
	}

	public function getDepartmentIds()
	{
		$dept = $this->getOptions('departments',array("has_swi = 1"));
		return $dept;
	}

	public function reset_assignment($id='all')
	{
		if($id != 'all'){
			$this->db->where('assignment_id',$id);
		}
		$this->db->set('result',NULL);
		$this->db->set('status','pending');
		$this->db->set('completed_on',NULL);
		$this->db->set('emp_audited_id',NULL);
		$this->db->set('modified_on',date('Y-m-d H:i:s'));
		$this->db->update('swi_document_assignment');
		$this->db->flush_cache();
		$this->db->set('standard',NULL);
		$this->db->set('comments',NULL);
		$this->db->where('assignment_id',$id);
		$this->db->update('swi_process_assignment');
	}

	public function assign($data,$type)
	{
		if($type == 'create'){
			$assignment = array(
						'user_id' => $data['reassign_to_emp_id'],
						'doc_id' => $data['assign_doc_id'],
						'status' => 'pending',
						'assigned_by' => 1,
						'assigned_on' => date('Y-m-d H:is')
						);

			$this->db->select('process_id');
			$processes = $this->db->get_where('swi_processes',array('doc_id'=>$data['assign_doc_id'],'deleted'=>0))->result();
				
			$this->db->insert('swi_document_assignment',$assignment);
			$assignment_id = $this->db->insert_id();
			$insert_process = array();

			if(count($processes)){ //if there's any process
				foreach($processes as $process){
					$insert_process[] = array(
											'assignment_id'=> $assignment_id,
											'process_id' => $process->process_id,
											'doc_id' => $assignment['doc_id'],
											'added_by' => 1,
											'deleted' => 0
										);
				}
				$this->db->insert_batch('swi_process_assignment',$insert_process);
			}
		}else{
			$this->db->set('status','pending');
			$this->db->set('result',NULL);
			$this->db->set('assigned_on',date('Y-m-d H:i:s'));
			$this->db->set('modified_on',date('Y-m-d H:i:s'));
			$this->db->set('user_id',$data['reassign_to_emp_id']);
			$this->db->where('assignment_id',$data['reassignment_id']);
			$this->db->update('swi_document_assignment');
		}
	}

	public function getEmployee($id)
	{
		$query = 'SELECT user_id,CONCAT(e_fname," ",e_lname) as name,dept.department,staff.staffing_name,pp.position as pos1,sp.position as pos2,
					(SELECT CONCAT(smp.e_fname," ",smp.e_lname) FROM employees as smp WHERE smp.user_id = emp.supervisor_id) as supervisor
					FROM athena.employees as emp
					JOIN departments as dept ON dept.department_id = emp.department
					JOIN site_staffing as staff ON staff.staffing_id = emp.staffing
					INNER JOIN positions pp ON emp.p_position = pp.position_id
					INNER JOIN positions sp ON emp.s_position = sp.position_id
					WHERE user_id = "'.$id.'"';
		$employee = $this->db->query($query);
		return $employee->row();
	}

	public function get_assignment($assignment_id)
	{
		$this->db->join('swi_documents','swi_documents.doc_id = swi_document_assignment.doc_id');
		$this->db->join('employees','employees.user_id = swi_document_assignment.user_id','LEFT');
		$this->db->where('assignment_id',$assignment_id);
		$assignment = $this->db->get('swi_document_assignment')->row();
		return $assignment;
	}

	public function getReported($id=null)
	{
		$this->setFromAndTo();

		$this->db->select('*');
		$this->db->select('swi_document_adjustments.status as status');
		$this->db->select('CONCAT(auditor.e_fname," ",auditor.e_lname) as auditor');
		$this->db->select('CONCAT(audited.e_fname," ",audited.e_lname) as audited');
		$this->db->select('CONCAT(resolver.e_fname," ",resolver.e_lname) as resolver');
		$this->db->join('swi_document_assignment','swi_document_assignment.assignment_id = swi_document_adjustments.assignment_id');
		$this->db->join('swi_documents','swi_documents.doc_id = swi_document_assignment.doc_id');
		$this->db->join('swi_process_assignment','swi_process_assignment.pa_id = swi_document_adjustments.pa_id');
		$this->db->join('swi_processes','swi_processes.process_id = swi_process_assignment.process_id');
		$this->db->join('employees as auditor','auditor.user_id = swi_document_assignment.user_id');
		$this->db->join('employees as audited','audited.user_id = swi_document_assignment.user_id');
		$this->db->join('employees as resolver','resolver.user_id = swi_document_adjustments.corrected_by','LEFT');
		
		$this->db->where('swi_document_adjustments.deleted',0);
		$this->db->where('swi_document_assignment.assigned_on BETWEEN "'.$this->ffrom.'" AND "'.$this->fto.'"');
		$reported = $this->db->get('swi_document_adjustments')->result();

		return $reported;
	}

	public function saveResolution($data)
	{
		$update = array(
					'correction_made' => $data['resolution'],
					'status' => 'resolved',
					'corrected_on' => date('Y-m-d H:i:s'),
					'corrected_by' => $this->user_id
					);

		$this->db->where('adj_id',$data['adj_id']);
		$this->db->update('swi_document_adjustments',$update);
	}

	private function get_status_icon($status)
	{
		switch($status){
			case 'ok':
				return 'check';
				break;
			case 'bad':
				return 'times';
				break;
			case 'na':
				return 'ban';
				break;
		}
	}

	private function insert_adjustment($assignment_id,$pa_id)
	{
		$insert = array(
					'assignment_id' => $assignment_id,
					'pa_id' => $pa_id,
					'status' => 'pending',
					'added_on' => date('Y-m-d H:i:s'),
					'deleted' => 0
					);

		$this->db->insert('swi_document_adjustments',$insert);
	}
}