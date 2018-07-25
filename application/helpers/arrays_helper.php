<?php
	
	function search_key_val($key,$val,$haystack)
	{
		if($haystack){
			foreach($haystack as $i => $v)
			{
				if($v[$key] == ucwords($val)){
					return $i;
				}
			}
		}
	}

?>