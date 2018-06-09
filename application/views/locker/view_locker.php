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
		  										
		  										<button name="state" value="broken" class="btn btn-danger btn-rounded" type="submit">Broken</button>
		  										</form>';
			else if($locker->status=='in_use') echo '<form method="post" action="'.current_url().'">
		  										<button name="state" value="unassign" class="btn btn-info btn-rounded" type="submit">Unassign</button>
		  										<button name="state" value="broken" class="btn btn-danger btn-rounded" type="submit">Broken</button>
		  										</form>';
			else if($locker->status=='broken') echo '<form method="post" action="'.current_url().'">
		  										<button name="state" value="fix" class="btn btn-primary btn-rounded" type="submit">Fix</button>
		  										</form>';
			else if($locker->status=='locked') echo '<form method="post" action="'.current_url().'">
		  										<button name="state" value="unlock" class="btn btn-primary btn-rounded" type="submit">Unlock</button>
		  										</form>';
		  	?>
		  </div>
		</div>
		<div class="card">
			<p>
				State changed by:
			  	<a class="btn btn-info" href="<?php echo base_url().'User/view/'.str_replace('@','%40',$locker->status_changed_by); ?>" > <?php echo $locker->status_changed_by;?></a>
			  	on <?php echo $locker->status_changed_time; ?>
		  	</p>
		</div>
	</div>
</div>

<?php if(isset($owner))
echo '
<div class="card">
	<h4 class="card-title">Locker Owner</h4>
	<div class="card-body">
		<div class="row">
				<div class="col-md-3 col-lg-3 " align="center"> <img alt="'.$owner->name.'" src="" class="img-circle img-responsive"> </div>
				
				<div class=" col-md-9 col-lg-9 "> 
					<table class="table table-user-information">
						<tbody>
							<tr>
								<td>EPF Number:</td>
								<td>'.$owner->epf_no.'</td>
							</tr>
							<tr>
								<td>Name:</td>
								<td>'.$owner->name.'</td>
							</tr>
							<tr>
								<td>Plant:</td>
								<td>'.$owner->plant.'</td>
							</tr>
							<tr>
								<td>Team:</td>
								<td>'.$owner->team.'</td>
							</tr>
							<tr>
								<td>Shift Group:</td>
								<td>'.$owner->shift.'</td>
							</tr>
							<tr>
								<td>Assigned time:</td>
								<td>'.$owner->assigned_time.'</td>
							</tr>
							<tr>
								<td>Assigned by:</td>
								<td> <a type="button" href="'.base_url().'User/view/'.str_replace('@','%40',$owner->assigned_by).'" class="btn btn-info btn-block">'.$owner->assigned_by.'</a> </td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
</div>';
else if($locker->status == 'free') echo 
'<div class="card">
	<h4 class="card-title">Locker Owner</h4>
	<div class="card-body">
	<p> Locker is not assigned to anyone </p>
	</div>
</div>' ;
else echo 
'<div class="card">
	<h4 class="card-title">Locker Owner</h4>
	<div class="card-body">
	<p> Please fix the locker and change state of the locker, to assign an employee</p>
	</div>
</div>' ;
		
?>


<div class="card">
	<h4 class="card-title">Locker Owner History</h4>
	<div class="card-body">
		<div class="table-responsive">
		<table id="owner_history_table" class="table">
		    <thead>
		        <tr>
		            <th>EPF no</th>
		            <th>Name</th>
		            <th>Plant</th>
		            <th>Team</th>
		            <th>Shift Group</th>
		            <th>Assined Time</th>
		            <th>Unassigned Time</th>
		            <th>Assigned by</th>
		            <th>Unassigned by</th>
		            <th></th>
		        </tr>
		    </thead>
		    <tbody>
		        <?php
		        foreach ($owner_history as $employee) {
		        	echo "<tr>";
		        		echo "<td>".$employee->epf_no."</td>";
		        		echo "<td>".$employee->name."</td>";
		        		echo "<td>".$employee->plant."</td>";
		        		echo "<td>".$employee->team."</td>";
		        		echo "<td>".$employee->shift."</td>";
		        		echo "<td>".$employee->assigned_time."</td>";
		        		echo "<td>".$employee->unassigned_time."</td>";
		        		echo '<td><a href="'.base_url().'User/view/'.str_replace('@','%40',$employee->assigned_by).'" class="btn btn-success btn-block">'.$employee->assigned_by.'</a></td>';
		        		echo '<td><a href="'.base_url().'User/view/'.str_replace('@','%40',$employee->unassigned_by).'" class="btn btn-warning btn-block">'.$employee->unassigned_by.'</a></td>';
		        		echo '<td> <a href="'.base_url().'Employee/view/'.$employee->epf_no.'" class="btn btn-block btn-info"> View </a> </td>';
		        	echo "</tr>";
		        }
		        ?>
		    </tbody>
		</table>
	</div>
	</div>
</div>