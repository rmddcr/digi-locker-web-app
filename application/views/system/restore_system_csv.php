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
            </form>
        </div>
    </div>
</div>