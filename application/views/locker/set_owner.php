<div class="card">
	<div class="card-title">
        <h4>Assgine Employee</h4>
    </div>
    <div class="card-body">
		<table id="employee_table" class="display">
		    <thead>
		        <tr>
		            <th>EPF no</th>
		            <th>Name</th>
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
		        		echo "<td>".$locker->section."</td>";
		        		echo "<td>".$employee->team."</td>";
		        		echo "<td>".$employee->shift_group."</td>";
		        		echo '<td> <form method="post" action="'.current_url().'">
		        			<button type="submit" name="employee_id" value="'.$employee->epf_no.'" type="button" href="'.base_url().'Employee/view/'.$employee->epf_no.'" class="btn btn-block btn-success"> Assigne </button>
		        				</form> </td>';
		        	echo "</tr>";
		        }
		        ?>
		    </tbody>
		</table>
	</div>
</div>

<div class="card">
	<div class="card-title">
        <h4>Add Employee and Assigne</h4>
    </div>
    <div class="card-body">
        <div class="form-horizontal">
            <form method="post" action="<?php echo current_url(); ?>">

                <div class="form-group row">
                    <label class="control-label text-right col-sm-2">EPF Number</label>
                    <input class="form-control input-default col-sm-10" placeholder="EPF number"  name="epf_no" type="number">
                </div>
                <div class="form-group row">
                    <label class="control-label text-right col-sm-2">Employee Name</label>
                    <input class="form-control input-default col-sm-10" placeholder="Employee name"  name="name" type="text">
                </div>


                <div class="form-group row">
                <label class="control-label text-right col-sm-2">Team</label>
                <select class="form-control input-default col-sm-10 selectize" placeholder="Team" name="team" type="text">
                    <option>Team A</option>
                    <option>Team B</option>
                    <option>Team C</option>
                    <option>Team D</option>
                </select>
                </div>

                <div class="form-group row">
                <label class="control-label text-right col-sm-2">Shift</label>
                <select class="form-control input-default col-sm-10 selectize" name="shift_group" placeholder="Shift" type="text">
                    <option>Shift A</option>
                    <option>Shift B</option>
                    <option>Shift C</option>
                    <option>Shift D</option>
                </select>
                </div>

                <div class="form-group row">
                <label class="control-label text-right col-sm-2">Section</label>
                <select class="form-control input-default col-sm-10 selectize" name="section_id" placeholder="Section" type="text">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                </select>
                </div>

                <div class="text-center">
                    <button type="submit" name="filter_results" class="btn btn-success waves-effect waves-light col-sm-4">Add User and Assign Locker : <?php echo $locker->locker_no; ?></button>
                </div>
            </form>
        </div>
    </div>
</div>