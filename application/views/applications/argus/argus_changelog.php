<div class="row mt-3">
	<div class="col">
		<h4><a href="#" id="return_to_argus">Back to Argus</a></h4>
	</div>
</div>
<hr>
<div class="row" style="max-height: 80%; overflow: auto">
	<div class="col-lg-12">
		<h3>As of 10/23/2018 (Phase 1 Continued) <small>v0.0.8</small></h3>
		Changes made:
		<ul>
			<li><span class="badge bg-success">New</span> Locking and Unlocking now updates on Argus' database to stay locked/unlocked after refresh.</li>
			<li><span class="badge bg-warning">Fixed</span> a bug that is not removing shipments that are already 805'd.</li>
			<li><span class="badge bg-warning">Fixed</span> a miscalculation on carton count and shipment weight.</li>
			<li><span class="badge bg-warning">Fixed</span> duplicating notification when resetting.</li>
			<li><span class="badge bg-warning">Fixed</span> notifications to reflect the user who triggered the action instead of the current user.</li>
			<li><span class="badge bg-warning">Fixed</span> stages count not updating properly.</li>
			<li><span class="badge bg-warning">Fixed</span> shipment details weight and carton numbers.</li>
			<li><span class="badge bg-secondary">Changed</span> WR shipments query for better performance and accuracy.</li>
			<li><span class="badge bg-secondary">Changed</span> Announcement has been moved to the top.</li>
			<li><span class="badge bg-secondary">Changed</span> Announcement font size has been slightly increased.</li>
		</ul>
	</div>
	<div class="col-lg-12">
		<h3>As of 10/22/2018 (Phase 1 Continued) <small>v0.0.7</small></h3>
		Changes made:
		<ul>
			<li><span class="badge bg-success">New</span> Added Notification audio for sent notifications.</li>
			<li><span class="badge bg-success">New</span> Added Reset database update.</li>
			<li><span class="badge bg-success">New</span> Added Notification user trigger.</li>
			<li><span class="badge bg-success">New</span> Added Announcement bar at the bottom the screen for important announcement.</li>
			<li><span class="badge bg-success">New</span> Added Announce button to create an announcment.</li>
			<li><span class="badge bg-success">New</span> Added Announcement audio for announcments.</li>
			<li><span class="badge bg-success">New</span> v0.0.7 has been pushed to production server new link is : http://10.89.96.128/athena/argus/standalone</li>
			<li><span class="badge bg-secondary">Changed</span> Notification cards statement have been revised to identify source of notification.</li>
		</ul>
	</div>
	<div class="col-lg-12">
		<h3>As of 10/19/2018 (Phase 1 Continued) <small>v0.0.6</small></h3>
		Changes made:
		<ul>
			<li><span class="badge bg-success">New</span> WR shipments have been added to the list.</li>
			<li><span class="badge bg-success">New</span> PROBILL field has been added to shipment details.</li>
			<li><span class="badge bg-success">New</span> Added Transaction trigger on started status.</li>
			<li><span class="badge bg-success">New</span> Added automated 805 checking on sync.</li>
			<li><span class="badge bg-success">New</span> Added Refresh all Argus Session button to refresh/resync all devices.</li>
			<li><span class="badge bg-success">New</span> Added 805 override within Argus for shipments that has already been 805'd.</li>
			<li><span class="badge bg-success">New</span> Unlocking a shipment will now kick out anyone in that process.</li>
			<li><span class="badge bg-success">New</span> Added Global notification for each shipment that has passed a stage.</li>
			<li><span class="badge bg-success">New</span> Added changelog button.</li>
			<li><span class="badge bg-success">New</span> Added automated 805 checking on sync.</li>
			<li><span class="badge bg-secondary">Changed</span> Removed Lines and Units from shipment details. Information was not necessary for shipping.</li>
			<li><span class="badge bg-secondary">Changed</span> Removed outside click and keyboard ESC key on active modals to encourage the use of the cancel button.</li>
			<li><span class="badge bg-secondary">Changed</span> Filter buttons have been separated from Argus controls.</li>
		</ul>
	</div>
	<div class="col-lg-12">
		<h3>As of 10/18/2018 (Phase 1 Continued) <small>v0.0.5</small></h3>
		Changes made:
		<ul>
			<li><span class="badge bg-success">New</span> Added changelog page access via command line "/do-argus-changelog".</li>
			<li><span class="badge bg-success">New</span> Added Quicksearch function.</li>
			<li><span class="badge bg-success">New</span> Added Priority level badge on shipment cards.</li>
			<li><span class="badge bg-success">New</span> Added Comments field on shipment cards.</li>
			<li><span class="badge bg-success">New</span> Added Sync button function.</li>
			<li><span class="badge bg-success">New</span> Added Unlock user command line to refresh targeted users.</li>
			<li><span class="badge bg-success">New</span> Added Carton number field on shipment cards.</li>
			<li><span class="badge bg-success">New</span> Added Weight field on shipment cards.</li>
			<li><span class="badge bg-success">New</span> Added Shipment details modal.</li>
			<li><span class="badge bg-success">New</span> Added Sched date field on shipment detail modal.</li>
			<li><span class="badge bg-success">New</span> Added Lines field on shipment detail modal.</li>
			<li><span class="badge bg-success">New</span> Added Units field on shipment detail modal.</li>
			<li><span class="badge bg-success">New</span> Added FR Terms field on shipment detail modal.</li>
			<li><span class="badge bg-success">New</span> Added Account Number field on shipment detail modal.</li>
			<li><span class="badge bg-success">New</span> Added Ship address on shipment detail modal.</li>
			<li><span class="badge bg-success">New</span> Added Comments field on shipment detail modal.</li>
			<li><span class="badge bg-success">New</span> Added Transactions table on shipment detail modal.</li>
			<li><span class="badge bg-success">New</span> Added Current stage field on shipment detail modal.</li>
		</ul>
	</div>
	<div class="col-lg-12">
		<h3>As of 10/16/2018 (Phase 1 Continued) <small>v0.0.4</small></h3>
		Changes made:
		<ul>
			<li><span class="badge bg-success">New</span> Shipment cards now pull from argus_shipments for shipment details.</li>
			<li><span class="badge bg-success">New</span> Added carrier field for shipment details.</li>
			<li><span class="badge bg-success">New</span> Added customer name field for shipment details.</li>
			<li><span class="badge bg-success">New</span> Added qty/units field for shipment details.</li>
			<li><span class="badge bg-secondary">Fixed</span> Fixed a bug where newly prioritized or locked shipment will not show up on clients that have filtered enabled.</li>
			<li><span class="badge bg-secondary">Fixed</span> Fixed a bug where shipments are pulling Fedex and UPS shipments too.</li>
		</ul>
	</div>
	<div class="col-lg-12">
		<h3>As of 10/15/2018 (Phase 1 Start) <small>v0.0.3</small></h3>
		Changes made:
		<ul>
			<li><span class="badge bg-success">New</span> Added argus_shipment table on Athena DB as master shipment list.</li>
			<li><span class="badge bg-success">New</span> Added argus_stages table on Athena DB as shipment stage references.</li>
			<li><span class="badge bg-success">New</span> Added Pull regular shipment from WMS function.</li>
			<li><span class="badge bg-success">New</span> Added Update current shipment from WMS function.</li>
			<li><span class="badge bg-success">New</span> Added Added 1 more stage to represent IDLE shipments.</li>
			<li><span class="badge bg-success">New</span> Added Removal of shipment already 805'd in the system.</li>
			<li><span class="badge bg-success">New</span> Added Quick filters to only show shipments based on enabled filters.</li>
			<li><span class="badge bg-warning">Changed</span> Revised shipment list to accommodate 2 shipments per row.</li>
		</ul>
	</div>
	<div class="col-lg-12">
		<h3>As of 10/05/2018 <small>v0.0.2</small></h3>
		Changes made:
		<ul>
			<li><span class="badge bg-success">New</span> Added Context menu on shipment cards for control.</li>
			<li><span class="badge bg-success">New</span> Added 1 more stage to separate verification pass 1 from pass 2 (QA).</li>
			<li><span class="badge bg-success">New</span> Added Stage counters to represent shipments on each stages.</li>
			<li><span class="badge bg-success">New</span> Added Stage counter change event listeners.</li>
		</ul>
	</div>
	<div class="col-lg-12">
		<h3>As of 10/03/2018 <small>v0.0.2</small></h3>
		Changes made:
		<ul>
			<li><span class="badge bg-success">New</span> Added Carrier change event listener.</li>
			<li><span class="badge bg-success">New</span> Added Prioritize change event listener.</li>
			<li><span class="badge bg-success">New</span> Added Normalize change event listener.</li>
			<li><span class="badge bg-success">New</span> Added Lock/Unlock change event listener.</li>
			<li><span class="badge bg-success">New</span> Added Shipment details modal.</li>
		</ul>
	</div>
	<div class="col-lg-12">
		<h3>As of 09/05/2018 <small>v0.0.1</small></h3>
		Changes made:
		<ul>
			<li><span class="badge bg-success">New</span> Added Node+Socket for real-time functionality.</li>
			<li><span class="badge bg-success">New</span> Added Event listener for all stages.</li>
			<li><span class="badge bg-success">New</span> Added shipment list screen to host both regular and WR shipments.</li>
			<li><span class="badge bg-success">New</span> Added 5 process stage indicators on shipment cards.</li>
			<li><span class="badge bg-success">New</span> Added Added short process description on shipment cards.</li>
			<li><span class="badge bg-success">New</span> Added Added shipment details.</li>
			<li><span class="badge bg-success">New</span> Added trailer log Verify form.</li>
			<li><span class="badge bg-success">New</span> Added trailer log QA form.</li>
			<li><span class="badge bg-success">New</span> Added Pickup/door number modal form.</li>
			<li><span class="badge bg-success">New</span> Added BOL Signature capture form.</li>
			<li><span class="badge bg-success">New</span> Added Security capture form.</li>
			<li><span class="badge bg-success">New</span> Initial mock draft completed.</li>
		</ul>
	</div>
</div>
