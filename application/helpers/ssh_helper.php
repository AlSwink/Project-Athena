<?php

	function ssh_initialize()
	{
		$ci =&get_instance();

		$conn = ssh2_connect($ci->config->item('ssh_host'));
		ssh2_auth_password($conn,$ci->config->item('ssh_user'),$ci->config->item('ssh_pass'));

		$conn = array(
					'ci' => $ci,
					'conn' => $conn
					);

		return $conn;
	}
	
	function searchContainerLabel($cont)
	{
		$conn = ssh_initialize();
		$sftp = ssh2_sftp($conn['conn']);
		$files = scandir('ssh2.sftp://' . $sftp . $conn['ci']->config->item('return_label_dir'));
		$new_cont = preg_grep('/'.$cont.'/', $files);
		$new_cont = array_values($new_cont);
		return ($new_cont ? $new_cont[0] : NULL);
	}

	function getNFLabel($cont)
	{
		$conn = ssh_initialize();
		$cont_final = explode('_',$cont);
		$cont_final = $cont_final[0];
		$stream = ssh2_sftp($conn['conn']);
		ssh2_scp_recv($conn['conn'], $conn['ci']->config->item('return_label_dir').$cont,FCPATH.'temp\nf_labels\\'.$cont_final.'.pdf');
		return $cont_final;
	}

	
?>