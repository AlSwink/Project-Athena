<?php
	
	function loadView($data=null)
	{
		$ci =&get_instance();

		if($ci->standalone){
            $ci->load->view('page',$data);
        }else{
            echo json_encode($ci->load->view($ci->page,$data,TRUE));
        }
	}
	
	function getCurrentPage($class)
	{
		$ci =&get_instance();
		
		if($class == 'applications'){
			$method = $ci->router->fetch_method();
		}else{
			$method = $class;
		}

		$page_name = str_replace('_',' ',$method);
		$page_name = ucwords($page_name);
		$page_name = '- '.$page_name;
		return $page_name;
	}

	function getRandomHints()
	{
		$hints = array(
					'XPO was founded in 1989 (as Express-1 Expedited Solutions)',
					'Brad Jacobs is the CEO of XPO',
					'XPO has at least 1500+ locations',
					'XPO is in 32 different countries'
				);

		$index = array_rand($hints);
		return $hints[$index];
	}

	function getSiteSetting($key=null)
	{
		$ci =&get_instance();
		$ci->load->model('XPO_model');
		return $ci->XPO_model->getSetting($key);
	}

	function generateAnnouncements($announcements)
	{
		$ci =&get_instance();
		$items = [];
		$dept = $ci->session->userdata('user_info')['dept'];
		$group = $ci->session->userdata('user_info')['group'];
		$user = $ci->session->userdata('user_id');
		$max = getSiteSetting('max_announcements');
		
		for($x=0;$x<$max;$x++){
			$restricted_departments = explode(',',$announcements[$x]->departments);
			$restricted_user_types = explode(',',$announcements[$x]->user_types);
			$restricted_users = explode(',',$announcements[$x]->users);

			if($restricted_departments && in_array($dept,$restricted_departments)){
				continue;
			}

			if($restricted_user_types && in_array($group,$restricted_user_types)){
				continue;
			}

			if($restricted_users && in_array($user,$restricted_users)){
				continue;
			}
			
			$items[] = $announcements[$x];
		}

		return $items;
	}

	function getNotificationIcon($type)
	{
		switch($type){
			case 'new' :
				return '<i class="fas fa-star"></i>';
				break;
			case 'info' :
				return '<i class="fas fa-exclamation"></i>';
				break;
			case 'critical' :
				return '<i class="fas fa-exclamation-triangle"></i>';
				break;
			case 'alert' :
				return '<i class="fas fa-dot-circle"></i>';
				break;
		}
	}

	function getSince($datetime,$param1=null)
	{
		$now = new DateTime();
		$created = new DateTime($datetime);
		$interval = $now->diff($created);

		if($interval->y){
			$since = $interval->y.($interval->y > 1 ? ' years' : ' year');
			return $since;
		}

		if($interval->m){
			$since = $interval->m.($interval->m > 1 ? ' months' : ' month');
			return $since;
		}

		if($interval->d){
			$since = $interval->d.($interval->d > 1 ? ' days' : ' day');
			return $since;
		}

		if($interval->h){
			$since = $interval->h.($interval->h > 1 ? ' hrs' : ' hr');
			return $since;
		}

		if($interval->i){
			$since = $interval->i.($interval->i > 1 ? ' mins' : ' min');
			return $since;
		}

		if($interval->s){
			$since = $interval->s.($interval->s > 1 ? ' secs' : ' sec');
			return $since;
		}
	}

	function converIcontoColor($icon)
	{
		switch($icon){
			case 'check':
				return 'success';
				break;
			case 'times':
				return 'danger';
				break;
			case 'ban':
				return 'secondary';
				break;
		}
	}

	function createDropdown($name,$table,$field,$id=null,$conditions=array(),$class=null)
	{
		$ci =&get_instance();
		$ci->load->model('XPO_model');
		$options = $ci->XPO_model->getOptions($table,$conditions);

		$dropdown = '<select name="'.$name.'" id="'.$id.'" class="'.$class.'" name="'.$field.'">';
		$field_id = $field.'_id';

		$classes = explode(' ',$class);
		if(in_array('is_filter',$classes)){
			$dropdown .= '<option value="">Show all</option>';
		}
		
		foreach($options as $option){
			$dropdown .= '<option value="'.$option->$field_id.'">'.$option->$field.'</option>';
		}
		$dropdown .= '</select>';

		return $dropdown;
	}

	function createEmpDropdown($name,$field_id,$fields=array(),$conditions=array(),$class=array())
	{
		$ci =&get_instance();
		$ci->load->model('XPO_model');
		$options = $ci->XPO_model->getOptions('employees',$conditions,'e_fname');

		$dropdown = '<select name="'.$name.'" class="'.implode(' ',$class).'">';
	
		foreach($options as $option){
			$rowval = '';
			foreach($fields as $field){
				$rowval .= $option->$field.' ';
			}
			$dropdown .= '<option value="'.$option->$field_id.'">'.$rowval.'</option>';
		}
		$dropdown .= '</select>';

		return $dropdown;
	}

	function create_autocomplete_source($arr,$value,$label)
	{
		$ac = array();

		if($arr){
			foreach($arr as $val){
				$ac[] = array(
							'value' => $val->$value,
							'label' => $val->$label
							);
			}
		}

		return json_encode($ac);
	}

	function checkSaagAlert($val,$param=null)
	{
		$ci =&get_instance();
		$ci->load->model('XPO_model');

		$vals = explode(' ',$val);

		switch($param){
			case 'operations':
				$hours = (isset($vals['h']) ? $vals['h'] : 0);
				return getCardColor($hours,$ci->XPO_model->last_order_alert,1);
				break;
			case 'network':
				return getCardColor(getNetworkResponse($val),1);
				break;
			default:
				return 'success';
		}
	}

	function getCardColor($val,$threshold=0,$diff=0)
	{
		if($val >= $threshold){
			return 'danger';
		}elseif($val < $threshold && $val >= ($threshold - $diff)){
			return 'warning';
		}else{
			return 'success';
		}
	}

	function humanDate($date,$format=null)
	{
		if(isset($date)){
			$format = (!$format ? 'm/d/y h:i A' : $format);
			$new_date = date_format(date_create($date),$format);
		
			return $new_date;
		}
	}

	function getNetworkResponse($ips)
	{
		exec("ping -n 1 $ips",$output,$status);	
		$response = explode(' ',$output[2]);
		$error = array_search('unreachable.',$response);
		if($error || $status){
			return 1;
		}else{
			return 0;
		}
	}

	function getFullLoading($message)
	{
		$ci =&get_instance();
		$data['message'] = $message;
		$loading = $ci->load->view('includes/full-screen-loading',$data,TRUE);
		return json_encode($loading);
	}

	function loadSubTemplate($pages,$data=null)
	{
		$ci =&get_instance();

		if(is_array($pages)){
			foreach($pages as $page){
				$ci->load->view($ci->page_dir.'/'.$page,$data);	
			}
		}else{
			$ci->load->view($ci->page_dir.'/'.$pages,$data);
		}
	}

	function loadInclude($page,$param=null)
	{
		$ci =&get_instance();
		$ci->load->view('includes/'.$page,$param);
	}

	function getShift($type)
  	{
    	$now = date('H:i:s');
    	if($now > '06:00:00' AND $now < '17:00:00'){
    		$shift['start'] = date('Y-m-d 05:00:00');
    		$shift['end'] = date('Y-m-d 16:59:59');
	      	$shift['display'] = '1st';
	    }else{
	    	$shift['start'] = date('Y-m-d 17:00:00');
    		$shift['end'] = date('Y-m-d 04:59:59');
	     	$shift['display'] = '2nd';
	    }

	    return $shift[$type];
  	}

  	function getConfirmation($msg,$options)
  	{
  		$ci =&get_instance();
  		$data['msg'] = $msg;
  		$data['to_url'] = (isset($options['yes_action']) ? $options['yes_action'] : '#');

		$ci->load->view('includes/confirm',$data);
  	}

?>