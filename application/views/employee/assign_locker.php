<div class="card">
	<div class="card-title">
        <h4>Assigne Locker to <strong> <?php echo $employee->name; ?> </strong> EPF no : <strong><?php echo $employee->epf_no; ?></strong> Plant : <strong><?php echo $employee->plant; ?></strong> Shift : <strong><?php echo $employee->shift; ?></strong> Team : <strong><?php echo $employee->team; ?></strong></h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
		<table id="locker_table" class="table" style="width:100%">
		    <thead>
		        <tr>
		            <th>Plant</th>
                    <th>Locker number</th>
                    <th>Status</th>
		            <th></th>
		        </tr>
		    </thead>
		    <tbody>
		        <?php
		        foreach ($lockers as $locker) {
		        	echo "<tr>";
                        echo "<td>".$locker->plant."</td>";
		        		echo "<td>".$locker->locker_no."</td>";
                        echo "<td>";
                        if($locker->status=='free') echo '<span class="label label-rouded label-success"> Free </span>';
                        else if($locker->status=='in_use') echo '<span class="label label-rouded label-info"> In Use </span>';
                        else if($locker->status=='broken') echo '<span class="label label-rouded label-danger"> Broken </span>';
                        else if($locker->status=='locked') echo '<span class="label label-rouded label-default"> Locked </span>';
                        echo "</td>";
		        		echo '<td>
		        		<form method="post" action="'.base_url().'Employee/assign_locker/'.$employee->epf_no.'">
		        		 <button type="submit" name="locker_id" value="'.$locker->id.'" class="btn btn-block btn-success"> Assigne </button> 
		        		 </form>
		        		 </td>';
		        	echo "</tr>";
		        }
		        ?>
		    </tbody>
		</table>
    </div>
	</div>
</div>