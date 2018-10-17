<div class="row mt-3">
	<div class="col-lg-3 col-sm-12">
		<h5 class="display-5">Table of Contents</h5>
		<hr>
		<div id="table_of_contents" class="list-group">
		  <a class="list-group-item list-group-item-action" href="#overview">Overview</a>
		  <a class="list-group-item list-group-item-action" href="#dashboard">Dashboard</a>
		  <a class="list-group-item list-group-item-action" href="#input_swi">Input SWI</a>
		  <a class="list-group-item list-group-item-action" href="#dept_ids">Department IDs</a>
		</div>
	</div>
	<div class="col-lg-9 col-sm-12" data-spy="scroll" data-target="#table_of_contents" data-offset="0" style="max-height: 80%;overflow: auto">
		<div class="row">
			<div id="overview" class="col-12">
				<h5>Overview</h5>
				<p>The objective of this application is to help ensure our SWI's are updated and is being properly followed. The application will also manage SWI documents and convert them to a more trackable data.</p>
				<p>In the past we have been doing SWI audits by hand and paper. Associates grab a worksheet and conducts the audit. After it has been filled, They put it back in an unsecured board as an indication that it was completed. After some research, flaws have been found with the current system. Such as
					<ul>
						<li>All documents placed back are not secured and can be altered or disposed.</li>
						<li>Document audit tracking takes a lot of time and cross referencing.</li>
						<li>Progress Board is not real-time.</li>
						<li>Audit assignments is not balanced nor trackable.</li>
						<li>There's no centralized database to track all SWIs on each department.</li>
					</ul>
				<p>This system will provide solution and further improve the way we do SWI audits. We grabbed the old process and forged a new one with better integration of our current systems such as the ERoster. Using this standard we will be able to balance the audit assignments, track them in real-time and study the data in a bigger picture.</p>
			</div>
			<div id="dashboard" class="col-12">
				<hr>
				<h5>Dashboard</h5>
				<p>The Dashboard provides a quick glance of the current month's progress.</p>
				<p>It also serves 4 quick control buttons as a shortcut to the application's most frequent functions.</p>
				<ul>
					<li>Print Assignment - Prints all assignment generated for the month can be specified to ALL, Department, Employees and Assignment ID</li>
					<li>Assign Document - Reassigning documents to a different employee</li>
					<li>New Document - Adds a new SWI document audit worksheet including processes that go under it.</li>
					<li>Change Dataset - This changes the dataset that the application will display. </li>
				</ul>
				<p>The doughnut charts shows the remaining days this month, completed vs pending documents and the rate for Standard met, Reported and Deprecation.</p>
				<p>Recently audited documents should show the 7 most recent documents that was completed.</p>
				<p>Progress by department displays the departmental progress for this month.</p>
			</div>

			<div id="input_swi" class="col-12">
				<hr>	
				<h5>Input SWI</h5>
				<p>This tab is used to print,input and submit worksheet assignments that has been completed.</p>
				<ol>
					<li>Type in the assignment ID found on the top left corner of the worksheet in the assignment ID field and hit search.</li>
					<li>Input the data using the worksheet.</li>
					<li>Make sure to have comments for processes that did not meet standards.</li>
					<li>Select the employee audited on the bottom of the sheet.</li>
					<li>Sign and submit.</li>
				</ol>
				<p>This will automatically complete the document in a global report and update the progress boards and dashboard charts. Documents that have at least 1 process that did not meet standard will be isolated for resolution and will be handled within the department.</p>
				<p>This page can also be used to view previous worksheet assignment and reprint them.</p>
			</div>
			<div id="dept_ids" class="col-12">
				<hr>
				<h5>Department IDs</h5>
				<p>This section only shows the department and their ID equivalent on the database. This information is vital in visiting progress boards for each department.</p>

				<table class="table table-sm">
					<thead>
						<th>Department</th>
						<th>Department ID</th>
					</thead>
					<tbody>
						<?php foreach($departments as $dept){ ?>
							<tr>
								<td><?= $dept->department; ?></td>
								<td><?= $dept->department_id; ?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>