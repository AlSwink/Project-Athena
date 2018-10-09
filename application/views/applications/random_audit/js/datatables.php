<script>
	// by dates reporting start
	var drtable = $('#dates_report').DataTable({
			dom : 'ti',
			pagingType : 'numbers',
			info : true,
			responsive: true,
			ajax: {
				url: '<?= site_url("api/getDatesReport"); ?>',
        		dataSrc: ''
			},
			columns : [
				{ data: "date" },
				{ data: "counted" },
				{ data: "generated" },
		        { data: "error" }
			],
		    scrollY: '50vh',
		    order : [0,'desc'],
		    scroller: {
		    	loadingIndicator : true
		    },
		    select: {
		    	style : 'multi+shift'
		    }
		});
	//end

	// location list start
	var lltable = $('#location_list').DataTable({
			dom : 'ti',
			pagingType : 'numbers',
			info : true,
			responsive: true,
			ajax: {
				url: '<?= site_url("api/getLocationList"); ?>',
        		dataSrc: ''
			},
			columns : [
				{ data: "user" },
				{ data: "location" },
				{ data: "skupkg" },
		        { data: "input" },
		        { data: "status",
		        	render: function(data,type,row,meta){
		        		status = (data == 1 ? 'Completed' : 'Pending');
		        		return status;
		        	}
		        }
			],
		    scrollY: '50vh',
		    scroller: {
		    	loadingIndicator : true
		    },
		    select: {
		    	style : 'multi+shift'
		    },
		    "createdRow" : function(row,data,index){
        		$(row).addClass('llmenu');
		    }
		});

	$('a[data-toggle="tab"],a[data-toggle="pill"]').on('shown.bs.tab', function (e) {		
		$.fn.dataTable.tables({visible: true, api: true}).columns.adjust();
	})
</script>