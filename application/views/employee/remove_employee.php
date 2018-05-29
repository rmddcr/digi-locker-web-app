<div class="card">
	<div class="card-title">
        <h4><?php echo $employee->name ;?></h4>
    </div>
	<div class="card-body"> 
		
		<div class="row">
			<div class="col-md-3 col-lg-3 " align="center"> 
				
				<img alt="Employee name" src="<?php echo base_url(); ?>Employee/picture/<?php echo $employee->epf_no; ?>" class="img-circle img-responsive "> 

			</div>
			
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
		<div class="text-center">
		<form method="post" action="<?php echo base_url(); ?>/Employee/delete/<?php echo $employee->epf_no; ?>">
			<button type="submit" name="yes" class="btn btn-danger col-sm-4">Yes</button>
			<button type="submit" name="no" class="btn btn-success col-sm-4">No</button>
		</form>
		</div>
	</div>
	
</div>