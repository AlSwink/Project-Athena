<div class="row mt-3">
	<div class="col">
		<h4><a href="#" id="return_to_argus">Back to Argus</a></h4>
	</div>
</div>
<hr>
<div class="row" style="max-height: 80%; overflow: auto">
	<div class="col-lg-12">
		<h3>As of 10/17/2018 (Phase 1 Continued) <small>v0.0.4</small></h3>
		Changes made:
		<ul>
			<li><span class="badge bg-success">New</span> Added changelog page access via command line "/do-argus-changelog".</li>
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
