<?php
	function cropNFlabel($cont)
	{
		//$cont_final = explode('_',$cont);
		//$cont_final = $cont_final[0];
		$cont_dir = FCPATH."temp\\nf_labels\\".$cont.'.pdf';
		$label_dir = FCPATH."temp\labels\\".$cont.'.jpg';

		exec('convert -verbose -density 300 -interlace none -quality 100 '.$cont_dir.' -trim '.$label_dir.'');
	}

?>