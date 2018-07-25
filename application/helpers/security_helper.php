<?php
	
	function check_session()
	{
		$ci =&get_instance();
		if(!$ci->session->userdata('user_id')){
			$ci->session->set_userdata('referral_url',current_url());
			redirect(site_url('login'));	
		}
	}

	function wms_pass_convert($password)
	{
		$inPass = str_split(strtoupper($password));
		$main_key = 0;
		$rotating_key = 0;
		$password_length = strlen($password);
		$encrypted_password = '';
		foreach ($inPass as &$chr) {
			$main_key += ord($chr);
		}
		for ($i = 0; $i < 12; $i++) {
			$rotating_key += $main_key;
			if ($i < $password_length) {
				$rotating_key += ord($inPass[$i]);
			}
			$rotating_key = ($rotating_key % 77) + 48;
			$encrypted_string[$i] = $rotating_key;
			
		}
		foreach ($encrypted_string as &$chr) {
			$encrypted_password .= chr($chr);
		}

		$encrypted_password = str_replace('"', '',$encrypted_password);
		//$encrypted_password = str_replace("\\\\", "\\",$encrypted_password);
		$encrypted_password = trim($encrypted_password);

		return $encrypted_password;

	}

	function get_client_machine_info()
	{
		$ci =&get_instance();
		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		$os = "Unknown OS Platform";
		$browser = "Unknown Browser";

		$os_array     = array(
                          '/windows nt 10/i'      =>  'Windows 10',
                          '/windows nt 6.3/i'     =>  'Windows 8.1',
                          '/windows nt 6.2/i'     =>  'Windows 8',
                          '/windows nt 6.1/i'     =>  'Windows 7',
                          '/windows nt 6.0/i'     =>  'Windows Vista',
                          '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                          '/windows nt 5.1/i'     =>  'Windows XP',
                          '/windows xp/i'         =>  'Windows XP',
                          '/windows nt 5.0/i'     =>  'Windows 2000',
                          '/windows me/i'         =>  'Windows ME',
                          '/win98/i'              =>  'Windows 98',
                          '/win95/i'              =>  'Windows 95',
                          '/win16/i'              =>  'Windows 3.11',
                          '/macintosh|mac os x/i' =>  'Mac OS X',
                          '/mac_powerpc/i'        =>  'Mac OS 9',
                          '/linux/i'              =>  'Linux',
                          '/ubuntu/i'             =>  'Ubuntu',
                          '/iphone/i'             =>  'iPhone',
                          '/ipod/i'               =>  'iPod',
                          '/ipad/i'               =>  'iPad',
                          '/android/i'            =>  'Android',
                          '/blackberry/i'         =>  'BlackBerry',
                          '/webos/i'              =>  'Mobile'
                    );

		$browser_array = array(
                            '/msie/i'      => 'Internet Explorer',
                            '/firefox/i'   => 'Firefox',
                            '/safari/i'    => 'Safari',
                            '/chrome/i'    => 'Chrome',
                            '/edge/i'      => 'Edge',
                            '/opera/i'     => 'Opera',
                            '/netscape/i'  => 'Netscape',
                            '/maxthon/i'   => 'Maxthon',
                            '/konqueror/i' => 'Konqueror',
                            '/mobile/i'    => 'Handheld Browser'
                     );

		foreach($os_array as $regex => $value){
	        if (preg_match($regex, $user_agent)){
	            $os = $value;
	        }
		}

		foreach($browser_array as $regex => $value){
        	if (preg_match($regex, $user_agent)){
            	$browser = $value;
            }
    	}

    	if(!empty($_SERVER['HTTP_CLIENT_IP'])){
		    $ip_address = $_SERVER['HTTP_CLIENT_IP'];
		}elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
		    $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}else{
		    $ip_address = $_SERVER['REMOTE_ADDR'];
		}

    	$client['ip'] = $ip_address;
		$client['os'] = $os;
		$client['browser'] = $browser;
		$client['controller'] = $ci->router->fetch_class();
		$client['method'] = $ci->router->fetch_method();
		return $client;
	}

?>