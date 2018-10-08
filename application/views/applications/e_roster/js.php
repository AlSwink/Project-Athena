<script>
$('#position_filter').change(function(){
	
	var position = $(this).val();
	if(position == 'all'){
		$("tr.employee").each(function(){
			$(this).show();
		});
	} else {
		$("tr.employee").each(function(){
			$curRow = $(this);
			var pstn = $curRow.find("td.position").html();
			if(pstn !== position){
				$curRow.hide();
			} else {
				$curRow.show();
			}
		});
	}
});
</script>