<div class="card">
    <div class="card-title">
        <h4>Filter Results</h4>
    </div>
    <div class="card-body">
        <div class="form-horizontal">
            <form method="get" action="<?php echo base_url(); ?>Locker/">
            	<div class="form-group row">
                    <label class="control-label text-right col-sm-2">Locker Status</label>
                    <select class="form-control input-default col-sm-10" name="status" type="text">
                    	<option selected>all</option>
                    	<option>in use</option>
                    	<option>free</option>
                    	<option>broken</option>
                    	<option>locked</option>
                    </select>
                </div>
                <div class="form-group row">
                    <label class="control-label text-right col-sm-2">Locker Number</label>
                    <input class="form-control input-default col-sm-10" placeholder="Locker number" <?php if(isset($filters) && $filters['locker_no']!="") echo 'value="'.$filters['locker_no'].'"'; ?> name="locker_no" type="number">
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
		<table id="locker_table" class="display">
		    <thead>
		        <tr>
		            <th>Locker number</th>
		            <th>Section</th>
                    <th>Status</th>
		            <th></th>
		        </tr>
		    </thead>
		    <tbody>
		        <?php
		        foreach ($lockers as $locker) {
		        	echo "<tr>";
		        		echo "<td>".$locker->locker_no."</td>";
		        		echo "<td>".$locker->section."</td>";
                        echo "<td>";
                        if($locker->status=='free') echo '<span class="label label-rouded label-success"> Free </span>';
                        else if($locker->status=='in_use') echo '<span class="label label-rouded label-info"> In Use </span>';
                        else if($locker->status=='broken') echo '<span class="label label-rouded label-danger"> Broken </span>';
                        else if($locker->status=='locked') echo '<span class="label label-rouded label-default"> Locked </span>';
                        echo "</td>";
		        		echo '<td> <a type="button" href="'.base_url().'Locker/view/'.$locker->locker_no.'" class="btn btn-block btn-info"> View </a> </td>';
		        	echo "</tr>";
		        }
		        ?>
		    </tbody>
		</table>
	</div>
</div>

