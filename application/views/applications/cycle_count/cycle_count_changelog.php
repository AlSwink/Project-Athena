<div class="row mt-3" style="max-height: 80%; overflow: auto">
	<div class="col-lg-12">
		<h3>As of 09/26/2018 <small>v0.4.4</small></h3>
		Changes made:
		<ul>
			<li><span class="badge bg-success">New</span> Added Regenerate function for recreating cycle count drops.</li>
			<li><span class="badge bg-success">New</span> Added Regenerate commands button for recreating cycle count drops.</li>
			<li><span class="badge bg-success">New</span> Added Regenerate commands menu on right click for recreating cycle count drops.</li>
			<li><span class="badge bg-success">New</span> Added Regenerate commands modal to confirm action and provide reason for recreating cycle count drops.</li>
			<li><span class="badge bg-success">New</span> Added Logging for regenerating commands.</li>
			<li><span class="badge bg-success">New</span> Added Excel export button for custom reports.</li>
			<li><span class="badge bg-success">New</span> Added Print button for custom reports.</li>
			<li><span class="badge bg-success">New</span> Added Export buttons for custom reports.</li>
			<li><span class="badge bg-success">New</span> Added Total created locations on Today's report as counted's upper limit.</li>
			<li><span class="badge bg-success">New</span> Summary numbers will now update on change.</li>
			<li><span class="badge bg-warning">Fixed</span> Fixed print blind bug where it would pick up the 2nd column instead of the locations column.</li>
			<li><span class="badge bg-secondary">Changed</span> Single right click of item is now treated as multiple.</li>
		</ul>
	</div>
	<div class="col-lg-12">
		<h3>As of 09/25/2018 <small>v0.4.3</small></h3>
		Changes made:
		<ul>
			<li><span class="badge bg-success">New</span> Enabled location deleted from report.</li>
			<li><span class="badge bg-success">New</span> Added required reason for location deletion from report.</li>
			<li><span class="badge bg-success">New</span> Added logger model for handling logs.</li>
			<li><span class="badge bg-success">New</span> Added log tracking for location generation.</li>
			<li><span class="badge bg-success">New</span> Added log tracking for location insertion.</li>
			<li><span class="badge bg-success">New</span> Added log tracking for location deletion.</li>
			<li><span class="badge bg-success">New</span> Added log tracking for checking progress.</li>
			<li><span class="badge bg-success">New</span> Added notify.js for handling single page notifications.</li>
			<li><span class="badge bg-success">New</span> Enabled log table in logs tab.</li>
			<li><span class="badge bg-success">New</span> Added excel export for logs.</li>
			<li><span class="badge bg-success">New</span> Added print function for logs.</li>
			<li><span class="badge bg-success">New</span> Added search location control in Today's report.</li>
			<li><span class="badge bg-success">New</span> Added audit field in Today's report for determining audit type.</li>
			<li><span class="badge bg-warning">Fixed</span> Fixed an alert bug when switching tabs while custom report is open.</li>
			<li><span class="badge bg-secondary">Changed</span> Check session has been enabled for accountability.</li>
			<li><span class="badge bg-secondary">Changed</span> Enabled mark field for sorting between nike and internal audit types.</li>
		</ul>
	</div>
	<div class="col-lg-12">
		<h3>As of 09/24/2018 <small>v0.4.2</small></h3>
		Changes made:
		<ul>
			<li><span class="badge bg-success">New</span> Added generate report button in reporting tab.</li>
			<li><span class="badge bg-success">New</span> Added table for cyc_status to indicate master status.</li>
			<li><span class="badge bg-success">New</span> Added date range picker with preset values to generate custom reports.</li>
			<li><span class="badge bg-success">New</span> Added right click menu in today's report tab.</li>
			<li><span class="badge bg-success">New</span> Added delete control in today's report tab.</li>
			<li><span class="badge bg-success">New</span> Added details tab in generate report.</li>
			<li><span class="badge bg-success">New</span> Added charts tab in generate report.</li>
			<li><span class="badge bg-success">New</span> Added logs tab in generate report.</li>
			<li><span class="badge bg-success">New</span> Added api for custom report generation.</li>
			<li><span class="badge bg-success">New</span> Enabled basic custom report generation.</li>
			<li><span class="badge bg-success">New</span> Enabled single location delete from custom reports.</li>
			<li><span class="badge bg-warning">Fixed</span> Added function auto update annual counter field during check progress.</li>
			<li><span class="badge bg-secondary">Changed</span> Revised returned total's array structure for better readability.</li>
		</ul>
	</div>
	<div class="col-lg-12">
		<h3>As of 09/21/2018 <small>v0.4.1</small></h3>
		Changes made:
		<ul>
			<li><span class="badge bg-success">New</span> Added summary header for today's report in reporting tab.</li>
			<li><span class="badge bg-success">New</span> Added download excel report.</li>
			<li><span class="badge bg-success">New</span> Added blind print control.</li>
			<li><span class="badge bg-success">New</span> Added print all control.</li>
			<li><span class="badge bg-secondary">Changed</span> Revised location fetching to strictly look at lc_f.</li>
			<li><span class="badge bg-secondary">Changed</span> Revised column fields on today's report, removed sku and pkg.</li>
			<li><span class="badge bg-secondary">Changed</span> Revised dashboard totals computation.</li>
		</ul>
	</div>
	<div class="col-lg-12">
		<h3>As of 09/17/2018 <small>v0.4.0</small></h3>
		Changes made:
		<ul>
			<li><span class="badge bg-success">New</span> cyc_master_pool has been added to athena database.</li>
			<li><span class="badge bg-success">New</span> cyc_count_details has been added to athena database.</li>
			<li><span class="badge bg-success">New</span> cyc_logs has been added to athena database.</li>
			<li><span class="badge bg-success">New</span> Added controller for this application.</li>
			<li><span class="badge bg-success">New</span> Added model for this application.</li>
			<li><span class="badge bg-success">New</span> Added view for this application.</li>
			<li><span class="badge bg-success">New</span> Added default location generation function.</li>
			<li><span class="badge bg-success">New</span> Added single location generation function.</li>
			<li><span class="badge bg-success">New</span> Added dataset criteria for location generation.</li>
			<li><span class="badge bg-success">New</span> Added dashboard totals.</li>
			<li><span class="badge bg-success">New</span> Added 2 columns for annual round progress.</li>
			<li><span class="badge bg-success">New</span> Added basic controls on control tab.</li>
			<li><span class="badge bg-success">New</span> Added check progress api for ajax calls.</li>
			<li><span class="badge bg-success">New</span> Added check progress controls to trigger check.</li>
			<li><span class="badge bg-success">New</span> Added round progress in check progress control.</li>
			<li><span class="badge bg-success">New</span> Added Reports tab.</li>
			<li><span class="badge bg-success">New</span> Added today's report on Reports tab.</li>
			<li><span class="badge bg-success">New</span> Added today's cycle count datatable.</li>
			<li><span class="badge bg-success">New</span> Added today's cycle count download excel button.</li>
			<li><span class="badge bg-success">New</span> Added today's cycle count print button.</li>
			<li><span class="badge bg-success">New</span> Added today's cycle count api for ajax calls.</li>
			<li><span class="badge bg-success">New</span> Controls for location generation now available.</li>
			<li><span class="badge bg-success">New</span> Location generated preview has been added.</li>
			<li><span class="badge bg-success">New</span> Selective cycle count has been added.</li>
			<li><span class="badge bg-success">New</span> Generate cycle count has been added.</li>
		</ul>
	</div>
	<div class="col-lg-12">
		<h3>As of 09/10/2018 <small>v0.0.1</small></h3>
		Changes made:
		<ul>
			<li>Initial commit of the Cycle Count mock draft.</li>
		</ul>
	</div>
</div>
