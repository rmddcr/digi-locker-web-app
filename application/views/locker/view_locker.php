<div class="card">
	<h4 class="card-title">Locker Status</h4>
	<div class="card-body">

		
		  <button class="btn btn-danger btn-rounded" type="button" data-toggle="collapse" href="#change_state">
		    Change State
		  </button>
		
		<div class="collapse" id="change_state">
		  <div class="card button-list">
		  	<form method="post" action="<?php current_url();?>">
		  		<button class="btn btn-danger btn-rounded" type="submit">Broken</button>
		  		<button class="btn btn-dark btn-rounded" type="submit">Locked</button>
		  		<button class="btn btn-info btn-rounded" type="submit">Unassign</button>
		  		<button class="btn btn-success btn-rounded" type="submit">Assign</button>
		  		<button class="btn btn-primary btn-rounded" type="submit">Fix</button>
		  		<button class="btn btn-primary btn-rounded" type="submit">Unlock</button>
		  		<button class="btn btn-warning btn-rounded" type="submit">Fix & Assign to Previous Owner</button>
		  		<button class="btn btn-warning btn-rounded" type="submit">Unlock & Assig to Previous Owner</button>
		  	</form>
		  	assigned -> broken,locked,unassgin -> broken,locked,free
		free -> broken,locked,assign -> broken,locked,assigned
		broken -> fixed, fix and assgine to prev owner -> free
		locked -> unlocked, unlock and assign to prev owner -> free
		  	
		  </div>
		</div>
	</div>
</div>

<div class="card">
	<h4 class="card-title">Locker Owner</h4>
	<div class="card-body">
		<div class="row">
			<div class="col-md-3 col-lg-3 " align="center"> <img alt="Employee name" src="http://babyinfoforyou.com/wp-content/uploads/2014/10/avatar-300x300.png" class="img-circle img-responsive"> </div>
			
			<div class=" col-md-9 col-lg-9 "> 
				<table class="table table-user-information">
					<tbody>
						<tr>
							<td>EPF Number:</td>
							<td>Programming</td>
						</tr>
						<tr>
							<td>Name:</td>
							<td>06/23/2013</td>
						</tr>
						<tr>
							<td>Team:</td>
							<td>06/23/2013</td>
						</tr>
						<tr>
							<td>Shift Group:</td>
							<td>06/23/2013</td>
						</tr>
						<tr>
							<td>Plant:</td>
							<td>06/23/2013</td>
						</tr>
						<tr>
							<td>Section:</td>
							<td>06/23/2013</td>
						</tr>
					</tbody>
				</table>
			</div>

		</div>
		owner details or 2 tabs
	</div>
</div>

<div class="card">
	<h4 class="card-title">Locker Owner History</h4>
	<div class="card-body">
	</div>
</div>