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
                    <label class="control-label text-right col-sm-2">Plant</label>
                    <select class="selectize form-control input-default col-sm-10" placeholder="Plant" name="plant" type="text">
                        <option>all</option>
                        <?php 
                            foreach ($plants as $plant) {
                                echo '<option value="'.$plant->id.'">'.$plant->name.'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group row">
                    <label class="control-label text-right col-sm-2">Team</label>
                    <select class="selectize form-control input-default col-sm-10" placeholder="Team" name="team" type="text">
                        <option>all</option>
                        <?php 
                            foreach ($teams as $team) {
                                echo '<option value="'.$team->id.'">'.$team->name.'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group row">
                    <label class="control-label text-right col-sm-2">Shift Group</label>
                    <select class="selectize form-control input-default col-sm-10" placeholder="Shift" name="shift" type="text">
                        <option>all</option>
                        <?php 
                            foreach ($shifts as $shift) {
                                echo '<option value="'.$shift->id.'">'.$shift->name.'</option>';
                            }
                        ?>
                    </select>
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
        <div class="table-responsive">
		<table id="employee_table" class="table">
		    <thead>
		        <tr>
		            <th>EPF no</th>
		            <th>Name</th>
		            <th>Plant</th>
		            <th>Team</th>
		            <th>Shift Group</th>
                    <th>Has Locker</th>
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
		        		echo "<td>".$employee->team."</td>";
		        		echo "<td>".$employee->shift."</td>";
                        if($employee->has_locker == 1)
                            echo '<td> <span class="label label-rouded label-success"> Yes </span> </td>';
                        else
                            echo '<td> <span class="label label-rouded label-danger"> No </span> </td>';
		        		echo '<td> <a href="'.base_url().'Employee/view/'.$employee->epf_no.'" class="btn btn-block btn-info"> View </a> </td>';
		        	echo "</tr>";
		        }
		        ?>
		    </tbody>
		</table>
    </div>
	</div>
</div>

