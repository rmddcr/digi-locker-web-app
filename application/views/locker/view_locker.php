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
		  	</form>
		  	assigned -> broken,locked,unassgin -> broken,locked,free
		free -> broken,locked,assign -> broken,locked,assigned
		broken -> fixed, fix and assgine to prev owner -> free
		locked -> unlocked, unlock and assign to prev owner -> free
		
		button -> broken,locked,unassign,assign,fix and assign to prev owner, unlock and assign to prev owner
		  	
		  </div>
		</div>
	</div>
</div>

<div class="card">
	<h4 class="card-title">Locker Owner</h4>
	<div class="card-body">
		owner details or 2 tabs
	</div>
</div>

<div class="card">
	<h4 class="card-title">Locker Owner History</h4>
	<div class="card-body">
	</div>
</div>