<div class="row mt-3">
	<div class="col-lg-3 col-sm-12">
		<h5 class="display-5">Table of Contents</h5>
		<hr>
		<div id="table_of_contents" class="list-group">
		  <a class="list-group-item list-group-item-action" href="#overview">Overview</a>
		  <a class="list-group-item list-group-item-action" href="#dept_ids">Department IDs</a>
		</div>
	</div>
	<div class="col-lg-9 col-sm-12" data-spy="scroll" data-target="#table_of_contents" data-offset="0">
		<div id="overview">
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
		<div id="dept_ids">
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