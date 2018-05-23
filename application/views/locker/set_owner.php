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
		        		echo "<td>".$employee->plant."</td>";
		        		echo "<td>".$employee->team."</td>";
		        		echo "<td>".$employee->shift."</td>";
		        		echo '<td> <form method="post" action="'.current_url().'">
		        			<button type="submit" name="employee_id" value="'.$employee->epf_no.'" href="'.base_url().'Employee/view/'.$employee->epf_no.'" class="btn btn-block btn-success"> Assigne </button>
		        				</form> </td>';
		        	echo "</tr>";
		        }
		        ?>
		    </tbody>
		</table>
	</div>
</div>