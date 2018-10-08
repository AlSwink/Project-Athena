<script>
	app_name = '<?= $method = $this->router->fetch_method(); ?>';
	page_type = 'app';
	version = $('#app_version').html();
	start = moment();
	end = moment();

	$(document).ready(function(){
		$.contextMenu({
        	selector: '.llmenu',
        	build: function($triggerElement,e){
        		return {
        			callback: function(key, options,e){
		                
        			},
        			items: {
        				reset: {name:"Reset Location",icon:"fas fa-redo-alt"},
        				"sep1": "---------",
        				delete: {name:"Delete Location",icon:"fas fa-trash-alt text-danger"}
        			}
        		}
        	}
        });

        $('.report_range').daterangepicker({
	        startDate: start,
	        endDate: end,
	        maxDate: moment(),
	        showDropdowns: true,
	        ranges: {
	           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
	           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
	           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
	           'This Month': [moment().startOf('month'), moment().endOf('month')],
	           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
	        }
	    });
	});
</script>