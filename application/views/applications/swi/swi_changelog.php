<div class="row" style="max-height: 80%; overflow: auto">
	<div class="col-lg-12">
		<div class="jumbotron">
			<h2><i class="fas fa-code-branch"></i> Development has been put on-hold until further notice</h2>
		</div>
	</div>
	<div class="col-lg-12">
		<h3>As of 09/07/2018 <small>v0.4.9a</small></h3>
		Changes made:
		<ul>
			<li><span class="badge bg-secondary">Changed</span> Page layout has been updated to display better on mobile devices.</li>
			<li><span class="badge bg-secondary">Fixed</span> Corrected standard met calculation after the addition of deprecation status.</li>
			<li><span class="badge bg-success">New</span> Added NodeJs in preparation for real-time requests.</li>
		</ul>
	</div>
	<div class="col-lg-12">
		<h3>As of 09/04/2018 <small>v0.4.9</small></h3>
		Changes made:
		<ul>
			<li><span class="badge bg-secondary">Changed</span>Revised document saving procedures to preserve document after deletion.</li>
			<li><span class="badge bg-secondary">Changed</span>Revised document assignment saving procedures to preserve document assignment after deletion.</li>
			<li><span class="badge bg-secondary">Changed</span>Revised process saving procedures to preserve process after deletion.</li>
			<li><span class="badge bg-secondary">Changed</span>Refined chart and reporting data to only reflect documents and assignments added on the current dataset.</li>
			<li><span class="badge bg-secondary">Changed</span>Updated August Dataset to reflect Deprecation status.</li>
			<li><span class="badge bg-success">New</span> Added new document status "Deprecation" to seperate BAD from NA's.</li>
			<li><span class="badge bg-primary">Added</span> Added documents for September assignments.</li>
			<li><span class="badge bg-primary">Added</span> Added table field for "Deprecation" status on reporting tab.</li>
			<li><span class="badge bg-primary">Added</span> Added color code for "Deprecation" status as grey.</li>
			<li><span class="badge bg-primary">Added</span> Added chart section for "Deprecation" status.</li>
			<li><span class="badge bg-primary">Added</span> Added status filter on document reporting tab for "Deprecation" status.</li>
			<li><span class="badge bg-primary">Added</span> Added session checking to redirect to login when session has expired.</li>
		</ul>
	</div>
	<div class="col-lg-12">
		<h3>As of 08/30/2018 <small>v0.4.8</small></h3>
		Changes made:
		<ul>
			<li><span class="badge bg-success">New</span> Deparment progress board accessible via <a href="http://10.89.96.128/athena/swi/progress_board/1" target="_blank">http://10.89.96.128/athena/swi/progress_board/1</a>. the number should be the department's id.</li>
			<li><span class="badge bg-success">New</span> Completion progress bar on progress board.</li>
			<li><span class="badge bg-success">New</span> Standard met,reported and pending progress bar on progress board.</li>
			<li><span class="badge bg-success">New</span> Monthly document tracking table on progress board.</li>
			<li><span class="badge bg-success">New</span> Department ID list is added on the documentation tab.</li>
			<li><span class="badge bg-secondary">Changed</span>Documentation tab has been renabled and is open for any resources available.</li>
			<li><span class="badge bg-primary">Added</span> Employee tooltip on recently audited table.</li>
			<li><span class="badge bg-primary">Added</span> Right click controls on recently audited table.</li>
			<li><span class="badge bg-primary">Added</span> Right click controls on progress by department to show progress boards.</li>
		</ul>
	</div>
	<div class="col-lg-12">
		<h3>As of 08/30/2018 <small>v0.4.8</small></h3>
		Changes made:
		<ul>
			<li><span class="badge bg-success">New</span> Deparment progress board accessible via <a href="http://10.89.96.128/athena/swi/progress_board/1" target="_blank">http://10.89.96.128/athena/swi/progress_board/1</a>. the number should be the department's id.</li>
			<li><span class="badge bg-success">New</span> Completion progress bar on progress board.</li>
			<li><span class="badge bg-success">New</span> Standard met,reported and pending progress bar on progress board.</li>
			<li><span class="badge bg-success">New</span> Monthly document tracking table on progress board.</li>
			<li><span class="badge bg-success">New</span> Department ID list is added on the documentation tab.</li>
			<li><span class="badge bg-secondary">Changed</span>Documentation tab has been renabled and is open for any resources available.</li>
			<li><span class="badge bg-primary">Added</span> Employee tooltip on recently audited table.</li>
			<li><span class="badge bg-primary">Added</span> Right click controls on recently audited table.</li>
			<li><span class="badge bg-primary">Added</span> Right click controls on progress by department to show progress boards.</li>
		</ul>
	</div>
	<div class="col-lg-12">
		<h3>As of 08/29/2018 <small>v0.4.3</small></h3>
		Changes made:
		<ul>
			<li>Added employee being audited on input worksheet.</li>
			<li>Added new field on database to store employee being audited.</li>
			<li>Revised print worksheet layout to specify signatures.</li>
			<li>Added Recently audited worksheets on dashboard.</li>
			<li>Added Current dataset indicator to change dataset modal.</li>
			<li>Added Department and status filter on reporting tab.</li>
		</ul>
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
