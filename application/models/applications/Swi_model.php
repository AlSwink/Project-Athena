<?php

class Swi_model extends XPO_Model {

	public $doc_id;

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

		return $swi;
	}

	public function get_process($id=null)
	{
		if($id){
			$this->db->where('doc_id',$id);
		}

		$process = $this->db->get('swi_processes');
		$process = $process->result();
		return $process;
	}

	public function get_process_assignments($id=null)
	{
		$query = "SELECT a.doc_id,a.doc_number,b.assigned_on,a.doc_name,d.department,e.process,c.pa_id,c.standard,c.comments,b.status,f.principle,g.e_fname,g.e_lname,b.assignment_id,b.completed_on
					FROM swi_process_assignment as c, swi_documents as a, departments as d, swi_processes as e,swi_principles as f, swi_document_assignment as b, employees as g
					WHERE b.assignment_id = $id
					AND c.assignment_id = $id
					AND b.doc_id = a.doc_id
					AND b.doc_id = c.doc_id
					AND a.dept_id = d.department_id
					AND e.principle_id = f.principle_id
					AND e.process_id = c.process_id
					AND b.user_id = g.user_id
					GROUP BY pa_id";

		$pa = $this->db->query($query)->result();

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
	}

	public function save_process($data,$save=false)
	{
		if($save){
			$this->db->where('doc_id',$data['doc_id']);
			$this->db->delete('swi_processes');
		}

		for($x=0;$x<count($data['process']);$x++){
			$insert_process[] = array(
									'process' => $data['process'][$x],
									'principle_id' => $data['principle'][$x],
									'doc_id' => $this->doc_id,
									'added_on' => date('Y-m-d H:i:s'),
									'added_by' => 2,
									'deleted' => 0
									);
		}

		$this->db->insert_batch('swi_processes',$insert_process);
	}

	public function get_unique_process()
	{
		$this->db->select('process,principle_id');
		$this->db->group_by('process');
		$process = $this->db->get_where('swi_processes',array('deleted'=>0))->result();
		return ($process ? $process : null);
	}

	public function summary_report($y=null,$m=null)
	{
		$completed = 0;
		$reported = 0;
		$assigned = array();

		$from = ($y ? date($year.'-'.$month.'-01'.' 00:00:00') : $this->firstdayofmonth);
		$to = ($y ? date($year.'-'.$month.'-t'.' 23:59:59') : $this->lastdayofmonth);

		$this->db->where('assigned_on BETWEEN "'.$from.'" AND "'.$to.'"');
		$this->db->or_where('completed_on BETWEEN "'.$from.'" AND "'.$to.'"');
		$documents = $this->db->get('swi_document_assignment')->result();

		foreach($documents as $doc)
		{
			if($doc->status == 'completed'){
				$completed++;
			}

			if(!in_array($doc->doc_id,$assigned)){
				array_push($assigned,$doc->doc_id);
			}

			if($doc->result != NULL){
				$reported++;
			}
		}

		$this->db->select('COUNT(doc_id) as docs');
		$docs = $this->db->get_where('swi_documents',array('deleted'=>0))->row();
		
		$data['completed'] = $completed;
		$data['assigned'] = count($assigned);
		$data['reported'] = $reported;
		$data['documents'] = $docs->docs;

		return $data;
	}

	public function summary_employee($y=null,$m=null)
	{
		$from = ($y ? date($year.'-'.$month.'-01'.' 00:00:00') : $this->firstdayofmonth);
		$to = ($y ? date($year.'-'.$month.'-t'.' 23:59:59') : $this->lastdayofmonth);

		$employees = $this->getEmployeesByStaffing(3);

		foreach($employees as $employee)
		{
			$this->db->where('assigned_on BETWEEN "'.$from.'" AND "'.$to.'"');
			$this->db->where('user_id',$employee->user_id);
			$swi_doc = $this->db->get('swi_document_assignment')->result();

			$progress[] = array(
							'user_id' => $employee->user_id,
							'name' => $employee->e_fname.' '.$employee->e_lname,
							'assigned' => (isset($swi_doc) ? count($swi_doc) : 0),
							'department' => $this->getDepartment($employee->department),
							'status' => $this->check_completion($swi_doc)
							);
		}
		
		return $progress;
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

	public function set_assignment_pool()
	{
		$building_department = $this->getBuldingDepartment();

		foreach($building_department as $bd){
			$this->db->where_in('dept_id',$bd['department_ids']);
			$docs = $this->db->get('swi_documents')->result_array();
			foreach($docs as $dcs){
				$employees = $this->getEmployeesByDepartment($dcs['dept_id']);
			}

			$pool_array = array_merge($bd,array('docs'=>$docs,'employees'=>$employees));
			$doc_pool[] = $pool_array;
		}

		foreach($doc_pool as $doc){
			echo '<hr>';
			echo $doc['bldg_id'].'<br>';
			echo 'Departments : <br>';

			foreach($doc['department_ids'] as $dept){
				echo '['.$dept.']';
			}

			echo '<br>Available docs ('.count($doc['docs']).'): <br>';
			foreach($doc['docs'] as $d){
				echo '<b>'.$d['doc_id'].'</b>, ';
			}

			echo '<br>Available Employees ('.count($doc['employees']).'): <br>';
			foreach($doc['employees'] as $e){
				echo '<b>'.$e->user_id.'</b>, ';
			}

			echo '<br><i>DOCS PER EMPLOYEE</i> <b>'.round(count($doc['docs']) / count($doc['employees'])).'</b>';
		}

		return $doc_pool;
	}

	public function assign_documents_from_pool()
	{
		$pool = $this->set_assignment_pool();
		
		echo '<pre>';

		foreach($pool as $items){
			$dpe = round(count($items['docs']) / count($items['employees']));
			$dpts = $items['department_ids'];
			
		}

	}
}