<div class="row" style="max-height: 80%; overflow: auto">
	<div class="col-lg-12">
		<div class="jumbotron">
			<h2><i class="fas fa-code-branch"></i> Development has been put on-hold until further notice</h2>
		</div>
	</div>
	<div class="col-lg-12">
		<h3>As of 08/28/2018 <small>v0.4.2</small></h3>
		Changes made:
		<ul>
			<li>Added change dataset control for dashboard and reporting tab.</li>
			<li>Added api for fetching data by filter.</li>
			<li>Reconstructed chart and datatable updates to do less calls.</li>
			<li>Added chart update hooks on new dataset.</li>
			<li>Added datatable update hooks on new dataset.</li>
			<li>Added progress by department section.</li>
			<li>Added progress update hooks on new dataset.</li>
			<li>Added progress by deparment on api call.</li>
			<li>Dashboard chart and header sizes have been revised to provide more space for sub data</li>
		</ul>
	</div>
	<div class="col-lg-12">
		<h3>As of 08/24/2018 <small>v0.4.1</small></h3>
		Changes made:
		<ul>
			<li>Migrated SWI controller functions to API function for datatables.</li>
			<li>Fixed a bug where there would be multiple errors whenever session has expired.</li>
			<li>Re-labeled print all assignment to print assignment button.</li>
			<li>Added print assignment modal to house the extended printing function.</li>
			<li>Added 4 criterias for targeted printing.</li>
			<li>Printing via department is now available.</li>
			<li>Printing via employee is now available.</li>
			<li>Targeted printing has been enabled on both dashboard and input worksheet page.</li>
		</ul>
	</div>
	<div class="col-lg-12">
		<h3>As of 08/17/2018 <small>v0.4.0</small></h3>
		Changes made:
		<ul>
			<li>
				Reporting Tab:
				<ul>
					<li>Removed single line assignment id link on all documents tab</li>
					<li>Added Unassigned header value on all documents tab</li>
					<li>Formatted dates on all documents tab to M/D/Y H:Ma format</li>
					<li>Improved table performance and layout on all documents tab</li>
					<li>Added quick view tooltip to employee names on all documens tab</li>
					<li>Added context menu on all documents tab. accessible via right click on row for controls</li>
					<li>Added Reprint control on context menu</li>
					<li>Added Reassign control on context menu</li>
					<li>Added See assignment control on context menu</li>
				</ul>
			</li>
			<li>
				Reassign Modal:
				<ul>
					<li>Increased modal width to 1300px for more space</li>
					<li>Reassignment feature has been added accessible via dashboard quick links or reporting->all documents context menu</li>
					<li>Improved table performance and layout on both document and associate table</li>
					<li>Added column sorting on both tables</li>
					<li>Added instructions</li>
					<li>Added department field on both tables</li>
					<li>Create assignment has been added but not visible as of the moment (needs team review)</li>
				</ul>
			</li>
			<li>
				Dashboard:
				<ul>
					<li>Corrected Standard Met rate chart percentage calculation</li>
				</ul>
			</li>
		</ul>
		In-Progress
		<ul>
			<li>Adding Reset assignment function</li>
			<li>Adding Unassign document function</li>
			<li>Adding Delete assignment function</li>
		</ul>
		Known Issues:
		<ul>
			<li>Assignment generation will include all employees in the department regardless of position/role</li>
		</ul>
	</div>
</div>
