<div class="card">
	<div class="card-title">
        <h4><?php echo $employee->name ;?></h4>
    </div>
	<div class="card-body"> 
		
		<div class="row">
			<div class="col-md-3 col-lg-3 " align="center"> <img alt="Employee name" src="<?php echo base_url(); ?>assets/images/avatar.jpg" class="img-circle img-responsive "> </div>
			
			<div class=" col-md-9 col-lg-9 "> 
				<table class="table table-user-information">
					<tbody>
						<tr>
							<td>Name:</td>
							<td><?php echo $employee->name  ;?></td>
						</tr>
						<tr>
							<td>EPF Number:</td>
							<td><?php echo $employee->epf_no  ;?></td>
						</tr>
						<tr>
							<td>Plant:</td>
							<td><?php echo $employee->plant  ;?></td>
						</tr>
						<tr>
							<td>Team:</td>
							<td><?php echo $employee->team ;?></td>
						</tr>
						<tr>
							<td>Shift Group:</td>
							<td><?php echo $employee->shift ;?></td>
						</tr>
					</tbody>
				</table>
			</div>

		</div>
		<span class="pull-right">
			<a href="<?php echo base_url(); ?>Employee/edit/<?php echo $employee->epf_no; ?>" class="btn btn-info ">Edit</a>
			<a href="<?php echo base_url(); ?>Employee/delete/<?php echo $employee->epf_no; ?>" class="btn btn-danger ">Delete</a>
		</span>	
	</div>
	
</div>


<div class="card">
	<div class="card-title">
        <h4>Lockers Assigned to Employee</h4>
    </div>
	<div class="card-body">
		<?php 
		if(isset($locker))
		{
			echo '
			<div class="table-responsive">
		<table class="table">
		    <thead>
		        <tr>
		            <th>Locker number </th>
		            <th>Plant </th>
		            <th>Assgined by </th>
		            <th>Assigned time</th>
		            <th></th>
		        </tr>
		    </thead>
		    <tbody>
		        <tr>
		        	<td>'.$locker->locker_no.'</td>
		        	<td>'.$locker->plant.'</td>
		        	<td> <a type="button" href="'.base_url().'User/view/'.str_replace('@','%40',$locker->assigned_by).'" class="btn btn-success btn-block">'.$locker->assigned_by.'</a> </td>
		        	<td>'.$locker->assigned_time.'</td>
		        	<td> <a type="button" href="'.base_url().'Locker/view/'.$locker->id.'" class="btn btn-info btn-block"> View locker '.$locker->locker_no.'</a> </td>
		        </tr>
		    </tbody>
		</table>
		</div>';

		} else {
			echo '<a href="'.base_url().'Employee/assign_locker/'.$employee->epf_no.'" class="btn btn-success">Assign Locker</a>';
		}

		?>
	</div>
	
</div>

<div class="card">
	<div class="card-title">
        <h4>Locker Assigned Before to Employee</h4>
    </div>
	<div class="card-body"> 
		<div class="table-responsive">
		<table id="lockers_histroy_table" class="table">
		    <thead>
		        <tr>
		            <th>Locker number </th>
		            <th>Plant </th>
		            <th>Unassigned time</th>
		            <th>Assigned time</th>
		            <th>Assgined by </th>
		            <th>Unassgined by </th>
		            <th></th>
		        </tr>
		    </thead>
		    <tbody>
		    	<?php
		    	foreach ($locker_history as $locker) {
		    		echo '
		    		<tr>
		    		<td>'.$locker->locker_no.'</td>
		        	<td>'.$locker->plant.'</td>
		        	<td>'.$locker->assigned_time.'</td>
		        	<td>'.$locker->unassigned_time.'</td>
		        	<td> <a type="button" href="'.base_url().'User/view/'.str_replace('@','%40',$locker->assigned_by).'" class="btn btn-success btn-block">'.$locker->assigned_by.'</a> </td>
		        	<td> <a type="button" href="'.base_url().'User/view/'.str_replace('@','%40',$locker->assigned_by).'" class="btn btn-warning btn-block">'.$locker->unassigned_by.'</a> </td>
		        	
		        	<td> <a type="button" href="'.base_url().'Locker/view/'.$locker->id.'" class="btn btn-info btn-block"> View locker '.$locker->locker_no.'</a> </td>
		        	</tr>';
		    	}
		    	?>
		    </tbody>
		</table>
	</div>
	</div>
	
</div>