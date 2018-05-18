<div class="card">
    <div class="card-title">
        <h4>Filter Results</h4>
    </div>
    <div class="card-body">
        <div class="form-horizontal">
            <form method="get" action="<?php echo base_url(); ?>Employee/">
            	<div class="form-group row">
                    <label class="control-label text-right col-sm-2">EPF Number</label>
                    <input class="form-control input-default col-sm-10" placeholder="EPF number" <?php if(isset($filters) && $filters['epf_no']!="") echo 'value="'.$filters['epf_no'].'"'; ?> name="epf_no" type="number">
                </div>
                <div class="form-group row">
                    <label class="control-label text-right col-sm-2">Name</label>
                    <input class="form-control input-default col-sm-10" placeholder="Name" <?php if(isset($filters) && $filters['name']!="") echo 'value="'.$filters['name'].'"'; ?> name="name" type="text">
                </div>
                <div class="form-group row">
                    <label class="control-label text-right col-sm-2">Tean</label>
                    <input class="form-control input-default col-sm-10" placeholder="Team" <?php if(isset($filters) && $filters['team']!="") echo 'value="'.$filters['team'].'"'; ?> name="team" type="text">
                </div>
                <div class="form-group row">
                    <label class="control-label text-right col-sm-2">Shift Group</label>
                    <input class="form-control input-default col-sm-10" placeholder="Shift Group" <?php if(isset($filters) && $filters['shift_group']!="") echo 'value="'.$filters['shift_group'].'"'; ?> name="shift_group" type="text">
                </div>
                <div class="form-group row">
                    <label class="control-label text-right col-sm-2">Plant</label>
                    <input class="form-control input-default col-sm-10" placeholder="Plant name" <?php if(isset($filters) && $filters['plant']!="") echo 'value="'.$filters['plant'].'"'; ?> name="plant" type="text">
                </div>
                <div class="form-group row">
                    <label class="control-label text-right col-sm-2">Section</label>
                    <input class="form-control input-default col-sm-10" placeholder="Section name" <?php if(isset($filters) && $filters['section']!="") echo 'value="'.$filters['section'].'"'; ?> name="section" type="text">
                </div>
                <div class="text-center">
                    <button type="submit" name="filter_results" class="btn btn-success waves-effect waves-light col-sm-12">Filter</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="card">
    <div class="card-body">
		<table id="employee_table" class="display">
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
		        <?php
		        foreach ($employees as $employee) {
		        	echo "<tr>";
		        		echo "<td>".$employee->epf_no."</td>";
		        		echo "<td>".$employee->name."</td>";
		        		echo "<td>".$employee->plant."</td>";
		        		echo "<td>".$employee->section."</td>";
		        		echo "<td>".$employee->team."</td>";
		        		echo "<td>".$employee->shift_group."</td>";
		        		echo '<td> <a type="button" href="'.base_url().'Employee/view/'.$employee->epf_no.'" class="btn btn-block btn-info"> View </a> </td>';
		        	echo "</tr>";
		        }
		        ?>
		    </tbody>
		</table>
	</div>
</div>

