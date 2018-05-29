<div class="card">
    <div class="card-body">
        <div class="form-horizontal">
            <form enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>System/restore">

                <div class="form-group row">
                <label class="control-label text-right col-sm-2">Plant</label>
                <select class="form-control input-default col-sm-10 selectize" placeholder="Plant" name="plant" type="text" required>
                    <?php
                        foreach ($plants as $plant) {
                            echo '<option value="'.$plant->id.'">'.$plant->name.'</option>';
                        }
                    ?>
                </select>
                </div>

                <div class="form-group row">
                	<input type="hidden" name="MAX_FILE_SIZE" value="5242880" />
                    <label class="control-label text-right col-sm-2">Upload CVS file(max 5MB) :</label> 
                    <input class="col-sm-10" name="cvs_file" type="file" required />
                </div>

                <div class="text-center">
                    <button type="submit" name="restore" class="btn btn-success waves-effect waves-light col-sm-4">Restore Data</button>
                </div>
                <a href="<?php echo base_url(); ?>assets/sample_templates/restore.csv" class="pull-right btn btn-info" download>Download CVS file Template</a>
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
		Rows inserted from CVS file to the system : <strong>'.$inserted_rows.'</strong>
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
		Rows inserted from CVS file to the system : <strong>'.$inserted_rows.'</strong>
	</p>';
} 

echo 
	'</div>
</div>';

}
?>