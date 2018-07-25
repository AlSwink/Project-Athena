<div class="container-fluid p-3 shadow bg-white rounded">
	<?php $this->load->view('tools/container_control'); ?>
	<div class="row">
		<div class="col-lg-2 col-sm-12">
			<div class="form-group">
				<label>Tag Number</label>
				<input type="text" class="form-control" name="tag" required/>
			</div>
			<div class="form-group">
				<label>From Loc</label>
				<input type="text" class="form-control" name="from" required/>
			</div>
			<div class="form-group">
				<label>To Loc</label>
				<input type="text" class="form-control" name="to" required/>
			</div>
			<button id="search" type="button" class="btn btn-secondary w-100">Find <i class="fas fa-search"></i></button>
		</div>
		<div class="col-lg-10 col-sm-12">
			<div class="row">
				<div class="col-5 col-sm-5">
					<div class="card">
				      <div class="card-body">
				        <h5 class="card-title">T12345678</h5>
				        <table class="table table-sm table-striped">
			        		<tr>
			        			<td>From Loc</td>
			        			<td>O123-32-12</td>
			        		</tr>	
			        		<tr>
			        			<td>To Loc</td>
			        			<td>A2-3245-21</td>
			        		</tr>
			        		<tr>
			        			<td>SKU</td>
			        			<td>833282-012</td>
			        		</tr>
			        		<tr>
			        			<td>PKG</td>
			        			<td>2XL</td>
			        		</tr>
			        		<tr>
			        			<td>Alloc QTY</td>
			        			<td>23</td>
			        		</tr>
			        		<tr>
			        			<td>Intran QTY</td>
			        			<td>15</td>
			        		</tr>
				        </table>
				        <p class="card-text font-weight-bold text-danger">Ensure that all fields match before proceeding.</p>
				      </div>
				    </div>
				</div>
				<div class="col-2 col-sm-2 text-center mt-5">
					<i class="fas fa-arrow-right fa-5x" style="vertical-align: middle"></i>
					<br>
					<button type="button" class="btn btn-info mt-5" disabled>Execute <i class="fas fa-play"></i></button>
				</div>
				<div class="col-5 col-sm-5">
					<div class="card">
				      <div class="card-body">
				        <h5 class="card-title">T12345678</h5>
				        <table class="table table-sm table-striped">
			        		<tr>
			        			<td>From Loc</td>
			        			<td>O123-32-12</td>
			        		</tr>	
			        		<tr>
			        			<td>To Loc</td>
			        			<td>A2-3245-21</td>
			        		</tr>
			        		<tr>
			        			<td>SKU</td>
			        			<td>833282-012</td>
			        		</tr>
			        		<tr>
			        			<td>PKG</td>
			        			<td>2XL</td>
			        		</tr>
			        		<tr class="table-danger">
			        			<td>Alloc QTY</td>
			        			<td>0</td>
			        		</tr>
			        		<tr class="table-danger">
			        			<td>Intran QTY</td>
			        			<td>0</td>
			        		</tr>
				        </table>
				        <p class="card-text font-weight-bold text-danger">This will also delete the Tag.</p>
				      </div>
				    </div>
				</div>
			</div>
			<div class="row pt-3">
				<div class="col">
					<table class="table table-sm table-hover table-striped">
						<thead>
							<tr class="table-secondary">
								<th colspan="9" class="text-center">Kill Intransit History</th>
							</tr>
							<tr>
								<th>Tag</th>
								<th>From Loc</th>
								<th>To Loc</th>
								<th>SKU</th>
								<th>PKG</th>
								<th>Alloc</th>
								<th>Intran</th>
								<th>User</th>
								<th>Date-Time</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>T12345679</td>
								<td>B3-1514-12</td>
								<td>B3-1514-11</td>
								<td>854498-012</td>
								<td>2XL</td>
								<td>15</td>
								<td>20</td>
								<td>Brandon Quinn</td>
								<td>06/12/18 7:31pm</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$('#search').click(function(){

	});
</script>