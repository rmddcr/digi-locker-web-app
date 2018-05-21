<div class="card">
	<h4 class="card-title">
		Locker Status
		<?php 
			if($locker->status=='free') echo '<span class="label label-rouded label-success"> Free </span>';
			else if($locker->status=='in_use') echo '<span class="label label-rouded label-info"> In Use </span>';
			else if($locker->status=='broken') echo '<span class="label label-rouded label-danger"> Broken </span>';
			else if($locker->status=='locked') echo '<span class="label label-rouded label-default"> Locked </span>';
		?>
	</h4>
	<div class="card-body">

		
		  <button class="btn btn-danger btn-rounded" type="button" data-toggle="collapse" href="#change_state">
		    Change State
		  </button>
		
		<div class="collapse" id="change_state">
		  <div class="card button-list">
		  	<?php
		  	if($locker->status=='free') echo '<form method="post" action="'.current_url().'">
		  										<button name="state" value="assign_go" href="#locker-owner" class="btn btn-success btn-rounded">Assign</button>
		  										<button name="state" value="broken" class="btn btn-danger btn-rounded" type="submit">Broken</button>
		  										<button name="state" value="locked" class="btn btn-dark btn-rounded" type="submit">Locked</button>
		  										</form>';
			else if($locker->status=='in_use') echo '<span class="label label-rouded label-info"> In Use </span>';
			else if($locker->status=='broken') echo '<span class="label label-rouded label-danger"> Broken </span>';
			else if($locker->status=='locked') echo '<span class="label label-rouded label-default"> Locked </span>';
		  	?>

		  	<!-- <form method="post" action="<?php current_url();?>">
		  		<button name="state" value="broken" class="btn btn-danger btn-rounded" type="submit">Broken</button>
		  		<button name="state" value="locked" class="btn btn-dark btn-rounded" type="submit">Locked</button>
		  		<button name="state" value="unassign" class="btn btn-info btn-rounded" type="submit">Unassign</button>
		  		<button href="#locker-owner" class="btn btn-success btn-rounded" type="submit">Assign</button>
		  		<button name="state" value="fix" class="btn btn-primary btn-rounded" type="submit">Fix</button>
		  		<button name="state" value="unlock" class="btn btn-primary btn-rounded" type="submit">Unlock</button>
		  	</form>
		  	assigned -> broken,locked,unassgin -> broken,locked,free
		free -> broken,locked,assign -> broken,locked,assigned
		broken -> fixed, fix and assgine to prev owner -> free
		locked -> unlocked, unlock and assign to prev owner -> free -->
		  	
		  </div>
		</div>
	</div>
</div>

<div class="card">
	<h4 class="card-title">Locker Owner</h4>
	<div class="card-body" id="locker-owner">
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