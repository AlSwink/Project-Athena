<?php

class e_roster_model extends XPO_Model {

	function get($setting)
    {
        $er = $this->load->database('xpo',TRUE);
        $field = $setting;
        switch($setting){
            case 'departments':
                $field = 'dept_name';
                break;
            case 'agency':
                $field = 'temp_name';
                break;
            default:
                $field = rtrim($field,'s');
                break;
        }
        
        $er->order_by($field,'ASC');

        $results = $er->get('tbl_xpo_'.$setting);
        return $results->result();
    }

    function get_wms_usrgrp()
    {
        $er = $this->load->database('wms',TRUE);
        $er->order_by('user_grp','ASC');
        $res = $er->get('ug_f');
        return $res->result();
    }

    function insert_employee($data,$photo){
		
		$user = $this->session->userdata('user_id');
		$ip = $this->input->ip_addres();
		
		$wms_user = strtoupper(substr($data['emp_fname'],0,1).substr($data['emp_lname'],0,1));
		
		$query = "SELECT opr
				  FROM us_f
				  WHERE opr LIKE '$wms_user%'
				  ORDER BY LENGTH(opr),opr";
				  
		$check = $wms->query($query);
		$matches = $check->result();
		
		$last = 0;
        $wms_matches = array();

        if($check->num_rows()){
            foreach($matches as $row){
                $wms_matches[] = $row->opr;
            }
            
            for($x=count($wms_matches) -1;$x>=0;$x--){
                $iii = trim(substr($wms_matches[$x],2,2));
                if(is_numeric($iii)){
                    $last = $iii;
                    break;
                }
            }
            $inc = (!$last ? 1 : $last + 1);
            $wms_user = $wms_user.$inc;
        }

        $wms_pass = substr($data['wms_usrgrp'],0,4).$data['ssn'];

        $wms_pass_enc = file_get_contents('http://10.89.98.122/users/pw_encrypt.php?password='.$wms_pass);
        $wms_pass_val = str_replace('"','',$wms_pass_enc);
        $wms_pass_val = str_replace("\\\\", "\\",$wms_pass_val);
        
        $insert_wms = array(
                        'opr' => $wms_user,
                        'opr_name' => ucwords($data['emp_fname']).' '.ucwords($data['emp_lname']),
                        'password' => $wms_pass_val,
                        'rfsc1' => 'YYYYYYYYYYYYYYYYYYYY',
                        'rfsc2' => 'YYYYYYYYYYYYYYYYYYYY',
                        'rfsc3' => 'YYYYYYYYYYYYYYYYYYYY',
                        'rfsc4' => 'YYYYYYYYYYYYYYYYYYYY',
                        'rfsc5' => 'YYYYYYYYYYYYYYYYYYYY',
                        'rfsc6' => 'YYYYYYYYYYYYYYYYYYYY',
                        'rfsc7' => 'YYYYYYYYYYYYYYYYYYYY',
                        'rfsc8' => 'YYYYYYYYYYYYYYYYYYYY',
                        'rfsc9' => 'NNNNNNNNNNNNNNNNNNNN',
                        'rfsc10' => 'NNNNNNNNNNNNNNNNNNNN',
                        'rfsc11' => 'YYYYYYYYYYYYYYYYYYYY',
                        'rfsc12' => 'YYYYYYYYYYYYYYYYYYYY',
                        'language' => 'English',
                        'user_grp' => $data['wms_usrgrp'],
                        'def_eq_type' => 'ALL',
                        'def_station' => 'BASE',
                        'modcnt' => 0,
                        'usrmod' => 'WEB',
                        'dtimecre' => date('Y-m-d H:i:s'),
                        'dtimemod' => date('Y-m-d H:i:s'),
                        'allow_matl_not_req' => 'N',
                        'rfsc3a' => 'YYYYYYYYYYYYYYYYYYYY',
                        'locked_out' => 'N',
                        'num_bad_attempts' => 0,
                        'dt_pw_changed' => date('Y-m-d H:i:s')
                        );
        
        $query = $wms->set($insert_wms)->get_compiled_insert('us_f');
        $wms->query($query);

        $insert = array(
                'emp_id' => trim($data['emp_id']),
                'emp_fname' => trim(ucwords($data['emp_fname'])),
                'emp_lname' => trim(ucwords($data['emp_lname'])),
                'emp_dob' => date_format(date_create($data['emp_dob']),'Y-m-d H:i:s'),
                'wms' => ($data['wms'] ? $data['wms'] : $wms_user),
                'sb' => trim($data['sb']),
                'temp_id' => trim($data['temp_agency']),
                'temp_start' => date_format(date_create($data['temp_start']),'Y-m-d H:i:s'),
                'dept_id' => trim($data['department']),
                'zone_id' => trim($data['zone']),
                'shift_id' => trim($data['shift']),
                'primary' => trim($data['pri_rol']),
                'secondary' => trim($data['sec_rol']),
                'photo' => ($photo == '' ? 'placeholder.jpg' : $photo),
                'supervisor' => trim($data['supervisor']),
                'added' => date('Y-m-d H:i:s'),
                'emp_email' => $data['emp_email'],
                'park_tag' => trim($data['park_tag']),
                'audit' => 0,
                'ssn' => $data['ssn'],
                'wms_usrgrp' => $data['wms_usrgrp']
            );
        $er->insert('tbl_employees',$insert);
        $ikey = $er->insert_id();

        $insert_module = array(
            'emp_id' => $ikey
            );
        $er->insert('tbl_employee_modules',$insert_module);

        $insert_badge = array(
                            'employee_name' => ucwords($data['emp_fname']).' '.ucwords($data['emp_lname']),
                            'wms_user' => $wms_user,
                            'wms_pass' => $wms_pass,
                            'security_badge' => $data['sb'],
                            'user_group' => $data['wms_usrgrp'],
                            'status' => 'pending',
                            'requested' => date('Y-m-d H:i:s'),
                            'requested_by' => $user,
                            'type' => ($data['sb'] ? 'WMS and Door Badge' : 'WMS Only'),
                            'ip' => $ip
                            );
        $er->insert('tbl_badges',$insert_badge);

        //$this->send_badge_email();
	}

	function check($val){
		
		if($val['key']=='wms'){
			$field = 'opr';
			$table = 'us_f';
			$db = $this->wms;
		} else {
			$field = $val['key'];
			$table = 'tbl_employees';
			$db = $this->xpo;
		}
		
		$result = $db->get_where($table,array($field=>$val['val']));
		
		if($result->num_rows()){
			return true;
		} else {
			return false;
		}
	}
	
    function get_all()
    {
        $er = $this->load->database('xpo',TRUE);
        $er->select('emp_email,park_tag,tbl_employees.id,emp_id,emp_fname,emp_lname,shift,tbl_xpo_agency.temp_name,tbl_xpo_departments.dept_name,tbl_xpo_zones.zone,tbl_xpo_positions.position,supervisor');
        $er->from('tbl_employees');
        $er->join('tbl_xpo_departments','tbl_employees.dept_id = tbl_xpo_departments.dept_id');
        $er->join('tbl_xpo_zones','tbl_employees.zone_id = tbl_xpo_zones.id');
        $er->join('tbl_xpo_shifts','tbl_employees.shift_id = tbl_xpo_shifts.id');
        $er->join('tbl_xpo_positions','tbl_employees.primary = tbl_xpo_positions.id');
        $er->join('tbl_xpo_agency','tbl_employees.temp_id = tbl_xpo_agency.temp_id');
        $er->order_by('emp_fname','ASC');

        /*switch($this->session->userdata('user_info')->user_group){
            case 'TEMPRAND':
                $er->where('tbl_xpo_agency.temp_name','Randstad USA');
                break;
            case 'TEMPPARA':
                $er->where('tbl_xpo_agency.temp_name','Paramount Staffing');
                break;
        }*/

        $results = $er->get();
        return $results->result();
    }

    function get_employee($id)
    {
        $er = $this->load->database('xpo',TRUE);
        $er->select('emp_email,wms_usrgrp,ssn,audit,park_tag,tbl_employees.id,emp_id,emp_fname,emp_lname,emp_dob,wms,sb,tbl_employees.temp_id,tbl_employees.temp_start,tbl_employees.dept_id,tbl_employees.zone_id,tbl_employees.shift_id,primary,secondary,supervisor,photo,guser_id,audit_type');
        $er->from('tbl_employees');
        $er->join('tbl_xpo_departments','tbl_employees.dept_id = tbl_xpo_departments.dept_id');
        $er->join('tbl_xpo_shifts','tbl_employees.shift_id = tbl_xpo_shifts.id');
        $er->join('tbl_xpo_positions','tbl_employees.primary = tbl_xpo_positions.id');
        $er->join('tbl_xpo_zones','tbl_employees.zone_id = tbl_xpo_zones.id');
        $er->join('tbl_xpo_agency','tbl_employees.temp_id = tbl_xpo_agency.temp_id');
        $er->where('tbl_employees.id',$id);
        $results = $er->get();
        return $results->row();
    }

    function delete_employee($id)
    {
        $er = $this->load->database('xpo',TRUE);
        $wms = $this->load->database('wms',TRUE);

        $emp = $this->get_employee($id);
        $emp = $emp->wms;

        $er->where('id',$id);
        $er->delete('tbl_employees');
        $er->where('emp_id',$id);
        $er->delete('tbl_employee_training');

        if($emp != '' && $emp != NULL){
            $wms->where('opr',$emp);
            $wms->delete('us_f');
        }
    }

    function update_employee($data,$photo)
    {
        $change = 0;
        $ins = array();
        $er = $this->load->database('xpo',TRUE);
        $wms = $this->load->database('wms',TRUE);
        $user = $this->session->userdata('user_fullname');

        $org = $er->get_where('tbl_employees',array('id'=>$data['id']));
        $org = $org->row();
		
		/* $er->select('user_id');
		$er->where('username',strtoupper(trim($data['wms'])));
		$guser_id = $er->get('tbl_users');
		if($guser_id->num_rows() > 0){
			$guser_id = $guser_id->row()->username;
		} else {
			$guser_id = NULL;
		}	  */
		
        $update = array(
            'emp_id' => trim($data['emp_id']),
            'emp_fname' => trim($data['emp_fname']),
            'emp_lname' => trim($data['emp_lname']),
            'emp_dob' => date_format(date_create($data['emp_dob']),'Y-m-d H:i:s'),
            'wms' => strtoupper(trim($data['wms'])),
            'sb' => trim($data['sb']),
            'temp_id' => trim($data['temp_agency']),
            'temp_start' => date_format(date_create($data['temp_start']),'Y-m-d H:i:s'),
            'dept_id' => trim($data['department']),
            'zone_id' => trim($data['zone']),
            'shift_id' => trim($data['shift']),
            'primary' => trim($data['pri_rol']),
            'secondary' => trim($data['sec_rol']),
            'photo' => ($photo == '' ? 'placeholder.jpg' : $photo),
            'supervisor' => trim($data['supervisor']),
            'emp_email' => $data['emp_email'],
            'park_tag' => $data['park_tag'],
            'audit' => (isset($data['audit']) ? 1 : 0),
			//'guser_id' => $guser_id,
            'ssn' => $data['ssn'],
            'wms_usrgrp' => $data['wms_usrgrp'],
            'audit_type' => $data['audit_type']
        );
		
        $er->where('id',$data['id']);
        $er->update('tbl_employees',$update);

        if($org->wms_usrgrp != $data['wms_usrgrp']){
            if($org->wms_usrgrp){
                $change++;
                $ins[] = 'WMS Badge';
            }
            if($org->wms){
                $pass = $data['wms_usrgrp'].$data['ssn'];
                $wms_pass_enc = file_get_contents('http://10.89.98.122/users/pw_encrypt.php?password='.$pass);
                $wms_pass_val = str_replace('"','',$wms_pass_enc);
                $wms->set('user_grp',$data['wms_usrgrp']);
                $wms->set('password',$wms_pass_val);
                $wms->where('opr',strtoupper($org->wms));
                $wms->update('us_f');
            }
        }

        if($org->sb != $data['sb'] && $data['sb']){
            $change++;
            $ins[] = 'Door Badge';
        }

        if($org->ssn != $data['ssn']){
            if($org->ssn){
                $change++;
                $ins[] = 'WMS Badge';
            }
            if($org->wms){
                $pass = $data['wms_usrgrp'].$data['ssn'];
                $wms_pass_enc = file_get_contents('http://10.89.98.122/users/pw_encrypt.php?password='.$pass);
                $wms_pass_val = str_replace('"','',$wms_pass_enc);
                $wms->set('password',$wms_pass_val);
                $wms->where('opr',strtoupper($org->wms));
                $wms->update('us_f');
            }
        }

        if($org->wms != $data['wms']){
            $change++;
            $ins[] = 'WMS Badge';
            if($data['wms']){
                $wms->set('opr',$data['wms']);
                $wms->where('opr',$org->wms);
                $wms->update('us_f');
            }
        }

        if($change){
            $ip = $this->input->ip_address();
            $final_ins = array_unique($ins);
            $final_ins = implode(',',$final_ins);
            $insert = array(
                        'wms_user' => $data['wms'],
                        'wms_pass' => ($data['wms'] ? substr(trim($data['wms_usrgrp']),0,4).$data['ssn'] : null),
                        'user_group' => ($org->wms ? trim($data['wms_usrgrp']) : null),
                        'security_badge' => $data['sb'],
                        'status' => 'pending',
                        'requested' => date('Y-m-d H:i:s'),
                        'requested_by' => $user,
                        'employee_name' => ucwords($data['emp_fname']).' '.ucwords($data['emp_lname']),
                        'type' => $final_ins,
                        'ip' => $ip
                        );

            $er->insert('tbl_badges',$insert);

            $this->send_badge_email();
        }
    }

    function add_module($data)
    {
        $er = $this->load->database('xpo',TRUE);
        $forge = $this->load->dbforge($er,TRUE);
        $pres = array();
        $vids = array();

        foreach($data['pdata'] as $row){
            $pres[] = $row['file_name'];
        }

        foreach($data['vdata'] as $row){
            $vids[] = $row['file_name'];
        }

        $p = ($pres ? implode(',',$pres) : null);
        $v = ($vids ? implode(',',$vids) : null);

        $insert = array(
            'module_name' => trim($data['module_name']),
            'module_description' => trim($data['module_description']),
            'module_length' => trim($data['module_length']),
            'type' => $data['m_type'],
            'est_duration' => $data['est_duration'],
            'cover' => (isset($data['cdata'][0]['file_name']) ? $data['cdata'][0]['file_name'] : null),
            'presentations' => $p,
            'videos' => $v
            );

        $er->insert('tbl_training_modules',$insert);
        $ikey = $er->insert_id();
        $field = array(
            'mod_'.$ikey => array('type'=>'DATE')
            );
        $forge->add_column('tbl_employee_modules',$field);
    }

    function get_modules()
    {
        $er = $this->load->database('xpo',TRUE);
        $er->join('tbl_training_types','tbl_training_types.type_id = tbl_training_modules.ttype');
        $er->order_by('mod_id','ASC');
        $results = $er->get('tbl_training_modules');
        $final = $results->result();
        for($x=0;$x<count($final);$x++){

            $where = array(
                'mod_'.$final[$x]->mod_id.' !=' => NULL
                );
            $er->join('tbl_employees','tbl_employees.id = tbl_employee_modules.emp_id');
            $count = $er->get_where('tbl_employee_modules',$where);
            if($count){
                $final[$x]->completed = $count->num_rows();
            }
        }
        return $final;
    }

    function get_module($id)
    {
        $er = $this->load->database('xpo',TRUE);
        $results = $er->get_where('tbl_training_modules',array('mod_id'=>$id));
        return $results->row();
    }

    function delete_module($id)
    {
        $er = $this->load->database('xpo',TRUE);
        $forge = $this->load->dbforge($er,TRUE);
        $er->where('mod_id',$id);
        $er->delete('tbl_training_modules');
        $forge->drop_column('tbl_employee_modules','mod_'.$id);
    }

    function get_my_employees()
    {
        $er = $this->load->database('xpo',TRUE);
        $er->select('tbl_employees.id,emp_id,kronos_id,emp_fname,emp_lname,shift,tbl_xpo_agency.temp_name,tbl_xpo_departments.dept_name,tbl_xpo_zones.zone,tbl_xpo_positions.position,supervisor');
        $er->from('tbl_employees');
        $er->join('tbl_xpo_departments','tbl_employees.dept_id = tbl_xpo_departments.dept_id');
        $er->join('tbl_xpo_zones','tbl_employees.zone_id = tbl_xpo_zones.id');
        $er->join('tbl_xpo_shifts','tbl_employees.shift_id = tbl_xpo_shifts.id');
        $er->join('tbl_xpo_positions','tbl_employees.primary = tbl_xpo_positions.id');
        $er->join('tbl_xpo_agency','tbl_employees.temp_id = tbl_xpo_agency.temp_id');
        $er->order_by('emp_fname','ASC');

        /*switch($this->session->userdata('user_info')->user_group){
            case 'TEMPRAND':
                $er->where('tbl_xpo_agency.temp_name','Randstad USA');
                break;
            case 'TEMPPARA':
                $er->where('tbl_xpo_agency.temp_name','Paramount Staffing');
                break;
        }*/
        $results = $er->get();
        return $results->result();
    }

	function get_positions(){
		$employees = $this->get_all();
		$tabs = array();
		$tabs_count = array();
		foreach($employees as $row){
			if(array_search($row->position,$tabs) === false){
				$tabs[] = $row->position;
				$tabs_count[$row->position] = 1;
			}else{
				$tabs_count[$row->position] = $tabs_count[$row->position] + 1;
			}
		}
		return $tabs_count;
	}
	
    function module_employee_list($id)
    {
        $er = $this->load->database('xpo',TRUE);        
        $supervisor = trim($this->session->userdata('user_fullname'));
        $er->select('tbl_employees.id,temp_start,emp_lname,emp_fname,mod_'.$id);
        $er->from('tbl_employees');
        $er->join('tbl_employee_modules','tbl_employees.id = tbl_employee_modules.emp_id');
        /*switch($this->session->userdata('user_info')->user_group){
            case 'TEMPRAND':
                $er->where('tbl_xpo_agency.temp_name','Randstad USA');
                break;
            case 'TEMPPARA':
                $er->where('tbl_xpo_agency.temp_name','Paramount Staffing');
                break;
        }*/
        $er->order_by('emp_fname','ASC');
        $results = $er->get();
        return $results->result();
    }

    function module_summary($emp_id = null)
    {
        $er = $this->load->database('xpo',TRUE);
        $supervisor = trim($this->session->userdata('user_fullname'));
        $fields = $er->list_fields('tbl_employee_modules');
        $er->select('tbl_employees.id,emp_fname,emp_lname');
        for($x=2;$x<count($fields);$x++){
            $er->select($fields[$x]);
        }
        $er->from('tbl_employees');
        $er->join('tbl_employee_modules','tbl_employees.id = tbl_employee_modules.emp_id');
        /*if(!in_array($this->session->userdata('user_info')->user_type,$this->config->item('access'))){
            $er->where('tbl_employees.supervisor',$supervisor);
        }*/
        if($emp_id){
            $er->where('tbl_employees.id',$emp_id);
        }
        $results = $er->get();
        return $results->result();
    }

    function module_finish($col,$emp_id)
    {
        $er = $this->load->database('xpo',TRUE);
        $update = array(
            $col => date('Y-m-d')
            );
        $er->where('emp_id',$emp_id);
        $er->update('tbl_employee_modules',$update);
    }

    function module_finish_from_date($data)
    {
        $er = $this->load->database('xpo',TRUE);
        $col = 'mod_'.$data['module_id'];
        $update = array(
            $col => date_format(date_create($data['complete_date']),'Y-m-d')
            );
        $er->where('emp_id',$data['emp_id']);
        $er->update('tbl_employee_modules',$update);
    }

    function module_date_multi($data)
    {
        $er = $this->load->database('xpo',TRUE);
        $col = 'mod_'.$data['module_id'];
        $update = array(
            $col => date_format(date_create($data['complete_date']),'Y-m-d')
            );
        $er->where_in('emp_id',$data['ids']);
        $er->update('tbl_employee_modules',$update);
    }

    function module_finish_multi($data)
    {
        $er = $this->load->database('xpo',TRUE);
        $col = 'mod_'.$data['mod'];
        $update = array(
            $col => date('Y-m-d')
            );
        $er->where_in('emp_id',$data['ids']);
        $er->update('tbl_employee_modules',$update);
    }

    function module_reset_multi($data)
    {
        $er = $this->load->database('xpo',TRUE);
        $col = 'mod_'.$data['mod'];
        $update = array(
            $col => null
            );
        $er->where_in('emp_id',$data['ids']);
        $er->update('tbl_employee_modules',$update);
    }

    function module_reset($col,$emp_id)
    {
        $er = $this->load->database('xpo',TRUE);
        $update = array(
            $col => null
            );
        $er->where('emp_id',$emp_id);
        $er->update('tbl_employee_modules',$update);
    }

    function get_report_all()
    {
        $er = $this->load->database('xpo',TRUE);
        $fields = $er->list_fields('tbl_employee_modules');
        $er->select('tbl_employees.id');
        $er->select('tbl_employees.emp_id');
        $er->select('emp_fname,emp_lname,emp_dob,supervisor,added,wms,sb,dept_name,zone,shift,position,temp_name,temp_start');
        $er->from('tbl_employees');
        $er->join('tbl_xpo_departments','tbl_employees.dept_id = tbl_xpo_departments.dept_id');
        $er->join('tbl_xpo_zones','tbl_employees.zone_id = tbl_xpo_zones.id');
        $er->join('tbl_xpo_shifts','tbl_employees.shift_id = tbl_xpo_shifts.id');
        $er->join('tbl_xpo_positions','tbl_employees.primary = tbl_xpo_positions.id');
        $er->join('tbl_xpo_agency','tbl_employees.temp_id = tbl_xpo_agency.temp_id');
        $er->order_by('added','DESC');
        $results = $er->get();
        $final = $results->result();

        /*for($x=0;$x<count($final);$x++){
            for($y=2;$y<count($fields);$y++){
                $er->select($fields[$y]);
                $er->from('tbl_employee_modules');
                $er->where('emp_id',$final[$x]->id);
                $value = $er->get();
                $mod_id = explode('_',$fields[$y]);
                $er->select('module_name');
                $mod_index = $er->get_where('tbl_training_modules',array('mod_id'=>$mod_id[1]));
                $mod_index = $mod_index->row()->module_name;
                $final[$x]->$mod_index = ($value->row()->$fields[$y] ? $value->row()->$fields[$y] : null);
            }            
        }*/
        return $final;
    }

    function add_setting($data)
    {
        $er = $this->load->database('xpo',TRUE);
        switch($data['type']){
            case 'positions':
                $field = 'position';
                break;
            case 'departments':
                $field = 'dept_name';
                break;
            case 'zones':
                $field = 'zone';
                break;
        }
        
        $insert = array(
            $field => trim($data['name'])
            );

        $er->insert('tbl_xpo_'.$data['type'],$insert);
    }

    function check_duplicate_name($data)
    {
        $er = $this->load->database('xpo',TRUE);
        $result = $er->get_where($data['table'],array($data['field']=>$data['name']));
        return $result->num_rows();
    }

    function get_needs_training($mod,$exp)
    {
        $er = $this->load->database('xpo',TRUE);
        $er->select('tbl_employees.id,emp_fname,emp_lname');
        $er->select($mod);
        $er->where($mod.' < DATE_SUB(NOW(),INTERVAL '.$exp.' MONTH)');
        $er->from('tbl_employees');
        $er->join('tbl_employee_modules','tbl_employees.id = tbl_employee_modules.emp_id');
        $results = $er->get();
        return $results->result();
    }

    function refresh_training_date($mod,$exp)
    {
        $er = $this->load->database('xpo',TRUE);
        $er->set($mod,null);
        $er->where($mod.'< DATE_SUB(NOW(),INTERVAL '.$exp.' YEAR)');
        $results = $er->update('tbl_employee_modules');
    }

    function edit_multi($data)
    {
        $er = $this->load->database('xpo',TRUE);
        $res = array();
        foreach($data as $row){
            if(key($row) != 'emp_ids'){
                $res = array_merge($res,$row);
            }else{
                $where = $row;
            }
        }
        
        $ids = explode(',',$where['emp_ids']);
        $er->where_in('id',$ids);
        $er->update('tbl_employees',$res);
    }

	function get_auditors($id = null)
    {
        $er = $this->load->database('xpo',TRUE);
        $pos = array(21,59,34);
        $not = array(15,62);
        //AND ((`primary` IN(21, 59, 34, 71, 54, 37, 57) AND `secondary` NOT IN(15, 62, 74))
        //OR (`primary` NOT IN(15, 62, 74) AND `secondary` IN(21, 59, 34, 71, 54, 37, 57)))

        if(!$id){
            $query = 'SELECT `tbl_employees`.`emp_fname`, `tbl_employees`.`emp_lname`, `tbl_employees`.`emp_email`, `tbl_employees`.`guser_id`, `primary`, `secondary`,`audit_type`
                    FROM `tbl_employees` 
                    WHERE `guser_id` IS NOT NULL 
                    AND audit = 1
                    GROUP BY `emp_fname`, `emp_lname`, `emp_email`, `guser_id`';
        }else{
            $query = 'SELECT `tbl_employees`.`emp_fname`, `tbl_employees`.`emp_lname`, `tbl_employees`.`emp_email`, `tbl_employees`.`guser_id`, `primary`, `secondary`,`audit_type`
                    FROM `tbl_employees` 
                    WHERE `guser_id` = '.$id.' AND audit = 1 GROUP BY `emp_fname`, `emp_lname`, `emp_email`, `guser_id`';
        }

        $result = $er->query($query);        
        return ($id ? $result->row() : $result->result());
    }

    function get_auditor($id)
    {
        $er = $this->load->database('xpo',TRUE);

        $result = $er->get_where('tbl_employees',array('guser_id'=>$id));
        $result = $result->row();

        return $result;
    }

    function get_auditors_notif($notif = null)
    {
        $er = $this->load->database('xpo',TRUE);
        $now = date('Y-m-d H:i:s');
        $date = date('Y-m-d');
        $shift = 0;
        $pos = array(21,59,34,71);
        if($now >= date('Y-m-d 05:00:00') && $now <= date('Y-m-d 16:59:59')){
            $shift = 2;
        }else{
            $shift = 1;
        }

        //AND (`primary` IN(21, 59, 34, 71, 54, 37, 57) AND `secondary` NOT IN(15, 62, 74))
        //OR (`primary` NOT IN(15, 62, 74) AND `secondary` IN(21, 59, 34, 71, 54, 37, 57))

        $query = 'SELECT `tbl_employees`.`emp_fname`, `tbl_employees`.`emp_lname`, `tbl_employees`.`emp_email`, `tbl_employees`.`guser_id`, `primary`, `secondary` 
                    FROM `tbl_employees` 
                    WHERE `guser_id` IS NOT NULL 
                    AND audit = 1
                    GROUP BY `emp_fname`, `emp_lname`, `emp_email`, `guser_id`';
        if($notif){
            $query .= '(SELECT COUNT(audit_id) FROM tbl_audit_locations WHERE tbl_audit_locations.status = "completed" AND tbl_audit_locations.user = tbl_employees.guser_id AND audit_date = "'.$date.'") != 6';
        }
        $result = $er->query($query);
        return $result->result();

    }

    function get_employee_emails()
    {
        $er = $this->load->database('xpo',TRUE);
        $er->where('emp_email !=','');
        $er->order_by('emp_fname');
        $res = $er->get('tbl_employees');
        $final = $res->result();

        return $final;
    }

    function get_rf_permissions()
    {
        $er = $this->load->database('xpo',TRUE);
        $er->order_by('command');
        $result = $er->get('tbl_rf_permissions');

        return $result->result();

    }

    function get_user_rfp($wms)
    {
        $er = $this->load->database('wms',TRUE);
        $emp_rfs = array();
        $rfps = $this->get_rf_permissions();

        $result = $er->get_where('us_f',array('opr'=>$wms));
        $result = $result->row();

        if(count($result)){
            foreach($rfps as $row){
                if($row->command != '1001'){
                    $field = substr($row->command,0,1);
                    $field = 'rfsc'.$field;
                    $place = (int)substr($row->command,1,2);
                    if($place > 20){
                        $field = 'rfsc3a';
                        $place = (int)substr($row->command,2,1);
                        $place = $place - 1;
                        $current = $result->$field;
                        $emp_rfs[$row->command] = $current[$place];
                    }else{
                        $place = $place - 1;
                        $current = $result->$field;
                        $emp_rfs[$row->command] = $current[$place];
                    }
                }else{
                    $field = substr($row->command,0,1);
                    $field = 'rfsc10';
                    $place = (int)substr($row->command,3,1);
                    $place = $place - 1;
                    $current = $result->$field;
                    $emp_rfs[$row->command] = $current[$place];
                }
            }
        }
        return $emp_rfs;
    }

    function send_badge_email()
    {
        require_once 'C:/Users/wdyount/vendor/swiftmailer/swiftmailer/lib/swift_required.php';
        $xpo = $this->load->database('xpo',TRUE);
        $result = $xpo->get_where('tbl_badges',array('status'=>'pending'));
        $data['data'] = $result->result();

        $body = $this->load->view('e-roster/email_badge_requests',$data,TRUE);

        try{
            $transport = \Swift_SmtpTransport::newInstance('outlook.office365.com', 587,'tls')->setUsername('William.Yount@xpo.com')->setPassword('Conway23');

            $mailer = \Swift_Mailer::newInstance($transport);
            $message = \Swift_Message::newInstance('New Badge Requests is available');

            $message->setReplyTo('SCKNTHelp@xpo.com');

            $message->setFrom(array('William.Yount@xpo.com'=>'SCKNT-IT'));
            $message->setTo('SCKNTHelp@xpo.com');
            $message->setBody($body, 'text/html');
            $result = $mailer->send($message);
        }catch(Swift_TransportException $e){

        }catch(Exception $e){

        }
    }

    function update_module($data)
    {
        $er = $this->load->database('xpo',TRUE);

        $res = $er->get_where('tbl_training_modules',array('mod_id'=>$data['module_id']));
        $res = $res->row();

        $update = array(
                    'module_name' => $data['module_name'],
                    'module_description' => $data['module_description'],
                    'module_length' => $data['module_length'],
                    'type' => $data['m_type'],
                    'est_duration' => $data['est_duration']
                    );

        if($data['cdata']){
            $update['cover'] = $data['cdata']['file_name'];
        }

        if($data['pdata']){
            foreach($data['pdata'] as $row){
                $new[] = $row['orig_name'];
            }

            //$cur = explode(',',$res->presentations);
            $cur = explode(',',$data['cur_pres']);
            $pcheck = array_intersect($cur,$new);

            foreach($pcheck as $row){
                $ind = array_search($row,$new);
                unset($new[$ind]);
            }

            foreach($new as $row){
                $cur[] = $row;
            }

            $cur = array_filter($cur, function($value) { return $value !== ''; });
            $cur = implode(',',$cur);

            $update['presentations'] = $cur;

        }else{
            $update['presentations'] = ($data['cur_pres'] ? $data['cur_pres'] : NULL);
        }        

        if($data['vdata']){
            foreach($data['vdata'] as $row){
                $new2[] = $row['orig_name'];
            }

            //$cur = explode(',',$res->videos);
            $cur = explode(',',$data['cur_vids']);
            $pcheck = array_intersect($cur,$new2);

            foreach($pcheck as $row){
                $ind = array_search($row,$new2);
                unset($new2[$ind]);
            }

            foreach($new2 as $row){
                $cur[] = $row;
            }

            $cur = array_filter($cur, function($value) { return $value !== ''; });
            $cur = implode(',',$cur);

            $update['videos'] = $cur;
        }else{
            $update['videos'] = ($data['cur_vids'] ? $data['cur_vids'] : NULL);
        }

        if(isset($data['question'])){
            $er->where('mod_id',$data['module_id']);
            $er->delete('tbl_quiz_master');
            
            for($x=0;$x<count($data['question']['question']);$x++){
                $cor_ind = 'opt'.($data['correct'][$x]);
                $insert_batch[] = array(
                                    'mod_id' => $data['module_id'],
                                    'question' => $data['question']['question'][$x],
                                    'img' => (isset($data['qdata'][$x]['orig_name']) ? $data['qdata'][$x]['orig_name'] : null),
                                    'opt1' => $data['question']['opt0'][$x],
                                    'opt2' => $data['question']['opt1'][$x],
                                    'opt3' => $data['question']['opt2'][$x],
                                    'opt4' => $data['question']['opt3'][$x],
                                    'correct' => $data['question'][$cor_ind][$x]
                                    );

            }

            $update['quiz_id'] = $data['module_id'];

            $er->insert_batch('tbl_quiz_master',$insert_batch);   
        }else{
            $er->where('mod_id',$data['module_id']);
            $er->delete('tbl_quiz_master');

            $er->set('quiz_id',NULL);
            $er->where('mod_id',$data['module_id']);
            $er->update('xpo.tbl_training_modules');
        }
        
        $er->where('mod_id',$data['module_id']);
        $er->update('xpo.tbl_training_modules',$update);
    }

    function get_wms_user_group($opr)
    {
        $wms = $this->load->database('wms',TRUE);
        
        $result = $wms->get_where('us_f',array('opr'=>trim($opr)));
        $result = $result->row();

        return $result->user_grp;
    }

    function recreate_wms($emp_id)
    {
        $wms = $this->load->database('wms',TRUE);

        $employee = (array)$this->get_employee($emp_id);

        $wms_pass = substr($employee['wms_usrgrp'],0,4).$employee['ssn'];
        $wms_pass_enc = file_get_contents('http://10.89.98.122/users/pw_encrypt.php?password='.$wms_pass);
        $wms_pass_val = str_replace('"','',$wms_pass_enc);
        $wms_pass_val = str_replace("\\\\", "\\",$wms_pass_val);
        
        $insert_wms = array(
                        'opr' => $employee['wms'],
                        'opr_name' => ucwords($employee['emp_fname']).' '.ucwords($employee['emp_lname']),
                        'password' => $wms_pass_val,
                        'rfsc1' => 'YYYYYYYYYYYYYYYYYYYY',
                        'rfsc2' => 'YYYYYYYYYYYYYYYYYYYY',
                        'rfsc3' => 'YYYYYYYYYYYYYYYYYYYY',
                        'rfsc4' => 'YYYYYYYYYYYYYYYYYYYY',
                        'rfsc5' => 'YYYYYYYYYYYYYYYYYYYY',
                        'rfsc6' => 'YYYYYYYYYYYYYYYYYYYY',
                        'rfsc7' => 'YYYYYYYYYYYYYYYYYYYY',
                        'rfsc8' => 'YYYYYYYYYYYYYYYYYYYY',
                        'rfsc9' => 'NNNNNNNNNNNNNNNNNNNN',
                        'rfsc10' => 'NNNNNNNNNNNNNNNNNNNN',
                        'rfsc11' => 'YYYYYYYYYYYYYYYYYYYY',
                        'rfsc12' => 'YYYYYYYYYYYYYYYYYYYY',
                        'language' => 'English',
                        'user_grp' => $employee['wms_usrgrp'],
                        'def_eq_type' => 'ALL',
                        'def_station' => 'BASE',
                        'modcnt' => 0,
                        'usrmod' => 'WEB',
                        'dtimecre' => date('Y-m-d H:i:s'),
                        'dtimemod' => date('Y-m-d H:i:s'),
                        'allow_matl_not_req' => 'N',
                        'rfsc3a' => 'YYYYYYYYYYYYYYYYYYYY',
                        'locked_out' => 'N',
                        'num_bad_attempts' => 0,
                        'dt_pw_changed' => date('Y-m-d H:i:s')
                        );

        $query = $wms->set($insert_wms)->get_compiled_insert('us_f');
        $wms->query($query);
    }

}
?>