<script>
	$(document).ready(function(){
		loadNotes();
		loadOperations();
		loadServers();
		loadSystems();
		loadMachines();

		setInterval(function(){
			loadNotes();
		},<?= $intervals['notes']; ?>);

		setInterval(function(){
			loadOperations();
		},<?= $intervals['operations']; ?>);

		setInterval(function(){
			loadServers();
		},<?= $intervals['servers']; ?>);

		setInterval(function(){
			loadSystems();
		},<?= $intervals['systems']; ?>);

		setInterval(function(){
			loadMachines();
		},<?= $intervals['machines']; ?>);
	});

	function loadNotes()
	{
		url = '<?= site_url('health_check/getNotes') ?>';
		templater(url,'#notes',0,0,1,0);
	}

	function loadOperations()
	{
		url = '<?= site_url('health_check/getOperations') ?>';
		templater(url,'#operations',0,0,1,0);
	}

	function loadServers()
	{
		url = '<?= site_url('health_check/getServers') ?>';
		templater(url,'#servers',0,0,1,0);
	}

	function loadSystems()
	{
		url = '<?= site_url('health_check/getSystems') ?>';
		templater(url,'#systems',0,0,1,0);
	}

	function loadMachines()
	{
		url = '<?= site_url('health_check/getMachines') ?>';
		templater(url,'#machines',0,0,1,0);
	}

</script>