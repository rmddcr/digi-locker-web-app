<?php var_dump($result_array) ;?>

<div class="card">
	<div class="card-title">
        <h4>Employee name</h4>
    </div>
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
		<button type="button" class="btn btn-success">Assign Locker</button>
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
		<table id="lockers_current_table" class="display">
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

<div class="card">
	<div class="card-title">
        <h4>Lockers Assigned Before to Employee</h4>
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