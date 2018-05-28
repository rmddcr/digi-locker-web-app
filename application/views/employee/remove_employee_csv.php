<div class="card">
    <div class="card-body">
        <div class="form-horizontal">
            <form enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>Employee/remove_employee_csv">
                
                <div class="form-group row">
                	<input type="hidden" name="MAX_FILE_SIZE" value="5242880" />
                    <label class="control-label text-right col-sm-2">Upload CVS file(max 5MB) :</label> 
                    <input class="col-sm-10" name="cvs_file_remove_emp" type="file" required />
                </div>

                <div class="text-center">
                    <button type="submit" name="remove_employees" class="btn btn-success waves-effect waves-light col-sm-4">Remove Employees</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
if(isset($warrning_count))
{
echo
'<div class="card">
	<div class="card-title">
        <h4>Warnings</h4>
       </div>
    <div class="card-body">';
if($warrning_count>0)
{
	echo '<div class="card">
		<p> No of Warnings <strong>'.$warrning_count.'</strong> <br>
		Rows read from CVS file : <strong>'.$read_rows.'</strong> <br>
		Rows used to delete employees : <strong>'.$inserted_rows.'</strong>
		</p>
		</div>';
	echo '<div class="table-responsive">
		<table id="warnings" class="table">
		    <thead>
		        <tr>
		            <th>Row number</th>
		            <th>Warning</th>
		        </tr>
		    </thead>
		    <tbody>';

		 foreach ($warrnings as $warning) {
		 	echo '<tr>';
		 	echo  '<td>'.$warning['row'].'</td>';
		 	echo  '<td>'.$warning['error'].'</td>';
		 	echo '</tr>';
		 }
		    
	echo   '</tbody>
		</table>
		</div>';

} else
{
	echo '
	<p> No Warnings <br>
		Rows read from CVS file : <strong>'.$read_rows.'</strong> <br>
		Rows used to delete employees : <strong>'.$inserted_rows.'</strong>
	</p>';
} 

echo 
	'</div>
</div>';

}

if(isset($deleted)){

if(sizeof($deleted)>0)
{
	echo
'<div class="card">
	<div class="card-title">
        <h4>Deleted Employee EPF numbers</h4>
       </div>
    <div class="card-body">
    <div class="table-responsive">
		<table id="deleted" class="table">
		    <thead>
		        <tr>
		            <th>EPF number</th>
		        </tr>
		    </thead>
		    <tbody>';
		    foreach ($deleted as $d) {
		    	echo '<tr><td>'.$d.'</td></tr>';
		    }

echo 
	'</tbody>
		</table>
		</div>
	</div>
</div>';
} else 
echo '<div class="card">
<div class="card-title">
        <h4>Deleted Employee EPF numbers</h4>
       </div>
    <div class="card-body">
    <p>No Employees deleted</p>
    </div>
    </div>';
}
?>
