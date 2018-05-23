<div class="card">
	<div class="card-title">
        <h4><?php echo $employee->name ;?></h4>
    </div>
	<div class="card-body"> 
		
		<div class="row">
			<div class="col-md-3 col-lg-3 " align="center"> <img alt="Employee name" src="<?php echo base_url(); ?>assets/images/users/5.jpg" class="img-circle img-responsive "> </div>
			
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
			<button type="button" class="btn btn-info ">Edit</button>
		<button type="button" class="btn btn-danger ">Delete</button>
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
		<table id="lockers_histroy_table" class="display">
		    <thead>
		        <tr>
		            <th>EPF no</th>
		            <th>Name</th>
		            <th>Plant</th>
		            <th>Section</th>
		            <th>Team</th>
		            <th>Shift Group</th>
		            <th></th>
		        </tr>
		    </thead>
		    <tbody>
		        <tr>
		        	<td>EPF no</td>
		            <td>Name</td>
		            <td>Plant</td>
		            <td>Section</td>
		            <td>Team</td>
		            <td>Shift Group</td>
		            <td>Button to view</td>
		        </tr>
		    </tbody>
		</table>
	</div>
	
</div>