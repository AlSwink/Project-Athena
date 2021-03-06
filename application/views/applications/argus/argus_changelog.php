<div class="row mt-3">
	<div class="col">
		<h4><a href="#" id="return_to_argus">Back to Argus</a></h4>
	</div>
</div>
<hr>
<div class="row" style="max-height: 80%; overflow: auto">
	<div class="col-lg-12">
		<h3>As of 11/9/2018 (Phase 3 Continued) <small>v0.1.6</small></h3>
		Changes made:
		<ul>
			<li><span class="badge bg-success">New</span> Added Core function to fetch Dock information.</li>
			<li><span class="badge bg-success">New</span> Added Core function to fetch Carrier information.</li>

		</ul>
	</div>
	<div class="col-lg-12">
		<h3>As of 11/7/2018 (Phase 3 Continued) <small>v0.1.5</small></h3>
		Changes made:
		<ul>
			<li><span class="badge bg-success">New</span> Added a button for setting trailer door and seal numbers.</li>
			<li><span class="badge bg-success">New</span> Added a database argus_trailers for accepting and recording trailers through argus.</li>
			<li><span class="badge bg-success">New</span> Added a database argus_trailer_details for trailer inspection details.</li>
			<li><span class="badge bg-warning">Fixed</span> A bug where opening a QA sheet that's been 805'd will get stuck.</li>
		</ul>
	</div>
	<div class="col-lg-12">
		<h3>As of 11/5/2018 (Phase 3 Start) <small>v0.1.4</small></h3>
		Changes made:
		<ul>
			<li><span class="badge bg-success">New</span> Added Standalone page for accepting outbound trailers.</li>
			<li><span class="badge bg-success">New</span> Added Carrier database for translating carrier codes.</li>
			<li><span class="badge bg-success">New</span> Added Dock database for trailer yard management.</li>
			<li><span class="badge bg-success">New</span> Added Trailer number input on accept outbound trailer.</li>
			<li><span class="badge bg-warning">Fixed</span> An issue where entering QA mode changes all shipment carrier cards to the same carrier as the QA sheet.</li>
			<li><span class="badge bg-secondary">Changed</span> Changed released icon from steady truck to moving truck on Count summary and Card stages.</li>
		</ul>
	</div>
	<div class="col-lg-12">
		<h3>As of 11/5/2018 (Phase 2 Continued) <small>v0.1.3</small></h3>
		Changes made:
		<ul>
			<li><span class="badge bg-success">New</span> Added Verification ID field on QA verification sheet.</li>
			<li><span class="badge bg-success">New</span> Added system pallet check to show expected pallets.</li>
			<li><span class="badge bg-success">New</span> Added system carton check to show expected cartons.</li>
			<li><span class="badge bg-success">New</span> Added verification dataset query to provide data in QA verification sheet.</li>
			<li><span class="badge bg-success">New</span> Added Error catcher in event of WMS db lock.</li>
			<li><span class="badge bg-success">New</span> Added QTY field required before submission.</li>
			<li><span class="badge bg-success">New</span> Added QA sheet saving function.</li>
			<li><span class="badge bg-warning">Fixed</span> a bug where starting a shipment will not release from unlock state.</li>
			<li><span class="badge bg-warning">Fixed</span> a bug where resetting a shipment will not remove it from a filtered list.</li>
			<li><span class="badge bg-warning">Fixed</span> a bug sending a shipment to QA will not remove it from a filtered list.</li>
			<li><span class="badge bg-warning">Fixed</span> a bug where save a verification sheet will add a ghost pallet.</li>
		</ul>
	</div>
	<div class="col-lg-12">
		<h3>As of 11/01/2018 (Phase 2 Continued) <small>v0.1.2</small></h3>
		Changes made:
		<ul>
			<li><span class="badge bg-success">New</span> Added logout button at the bottom of shipment list.</li>
			<li><span class="badge bg-warning">Fixed</span> revised fetch query to include FXFE FXNL UPGF.</li>
			<li><span class="badge bg-warning">Fixed</span> sync button will not work properly on verification mode.</li>
		</ul>
	</div>
	<div class="col-lg-12">
		<h3>As of 10/30/2018 (Phase 2 Continued) <small>v0.1.1</small></h3>
		Changes made:
		<ul>
			<li><span class="badge bg-success">New</span> Added +10 carton count control.</li>
			<li><span class="badge bg-success">New</span> Added reset carton count control.</li>
			<li><span class="badge bg-success">New</span> Added sheet reset.</li>
			<li><span class="badge bg-success">New</span> Added error notification sound.</li>
			<li><span class="badge bg-success">New</span> Added error checking before verification submit.</li>
			<li><span class="badge bg-success">New</span> Added argus_verifications table for master sheet.</li>
			<li><span class="badge bg-success">New</span> Added argus_verification_details table for detail sheet.</li>
			<li><span class="badge bg-success">New</span> Added verification transact update.</li>
			<li><span class="badge bg-success">New</span> Added verification global notification.</li>
			<li><span class="badge bg-success">New</span> Added URL isolation for each stage use this format /athena/argus/mode/{data-stage}.</li>
		</ul>
	</div>
	<div class="col-lg-12">
		<h3>As of 10/29/2018 (Phase 2 Continued) <small>v0.1.0</small></h3>
		Changes made:
		<ul>
			<li><span class="badge bg-success">New</span> Added independent get pallet information function.</li>
			<li><span class="badge bg-success">New</span> Added Nesting check function.</li>
			<li><span class="badge bg-success">New</span> Added Nest check on start shipment modal to show unnested containers if any before starting a shipment.</li>
			<li><span class="badge bg-success">New</span> Added Unnested container count on start nest check alert.</li>
			<li><span class="badge bg-success">New</span> Added See details link on nest check alert.</li>
			<li><span class="badge bg-success">New</span> Added Number spinner for carton input.</li>
			<li><span class="badge bg-success">New</span> Added Dynamic total updates for pallets.</li>
			<li><span class="badge bg-success">New</span> Added Dynamic total updates for cartons.</li>
			<li><span class="badge bg-success">New</span> Added New row button to add new line.</li>
			<li><span class="badge bg-success">New</span> Added Delete row button to remove line.</li>
			<li><span class="badge bg-success">New</span> Added Subtraction limit for 0 value.</li>
			<li><span class="badge bg-secondary">Changed</span> Removed trailer number on verification sheet.</li>
			<li><span class="badge bg-secondary">Changed</span> Removed door number on verification sheet.</li>
			<li><span class="badge bg-secondary">Changed</span> Removed WR number on verification sheet.</li>
			<li><span class="badge bg-secondary">Changed</span> Removed Ship ID on verification sheet.</li>
		</ul>
	</div>
	<div class="col-lg-12">
		<h3>As of 10/24/2018 (Phase 2 Start) <small>v0.0.9</small></h3>
		Changes made:
		<ul>
			<li><span class="badge bg-success">New</span> Added General details tab.</li>
			<li><span class="badge bg-success">New</span> Added Pallet details tab.</li>
			<li><span class="badge bg-success">New</span> Added Transaction details tab.</li>
			<li><span class="badge bg-success">New</span> Added Auto-805 when checking details on an 805'd shipment.</li>
			<li><span class="badge bg-success">New</span> Added Nested tab under pallet information.</li>
			<li><span class="badge bg-success">New</span> Added Un-nested tab under pallet information.</li>
			<li><span class="badge bg-secondary">Changed</span> Added pallet information and nested containers.</li>
			<li><span class="badge bg-secondary">Changed</span> Added tabs for shipment details for information separation.</li>
			<li><span class="badge bg-secondary">Changed</span> Moved general details in general details tab.</li>
			<li><span class="badge bg-secondary">Changed</span> Moved transaction table to transaction tab.</li>
		</ul>
	</div>
	<div class="col-lg-12">
		<h3>As of 10/23/2018 (Phase 1 Continued) <small>v0.0.8</small></h3>
		Changes made:
		<ul>
			<li><span class="badge bg-success">New</span> Locking and Unlocking now updates on Argus' database to stay locked/unlocked after refresh.</li>
			<li><span class="badge bg-success">New</span> Added voice text to speech announcement.</li>
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
