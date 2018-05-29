<div class="card">
    <div class="card-body">
        <div class="form-horizontal">
            <form enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>Employee/new_employee">

                <div class="form-group row">
                    <label class="control-label text-right col-sm-2">EPF Number</label>
                    <input class="form-control input-default col-sm-10" placeholder="EPF number"  name="epf_no" type="number" required>
                </div>
                <div class="form-group row">
                    <label class="control-label text-right col-sm-2">Employee Name</label>
                    <input class="form-control input-default col-sm-10" placeholder="Employee name"  name="name" type="text" required>
                </div>


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
                <label class="control-label text-right col-sm-2">Team</label>
                <select class="form-control input-default col-sm-10 selectize" name="team" placeholder="Team" type="text" required>
                    <?php
                        foreach ($teams as $team) {
                            echo '<option value="'.$team->id.'">'.$team->name.'</option>';
                        }
                    ?>
                </select>
                </div>

                <div class="form-group row">
                <label class="control-label text-right col-sm-2">Shift</label>
                <select class="form-control input-default col-sm-10 selectize" name="shift" placeholder="Shift" type="text" required>
                    <?php
                        foreach ($shifts as $shift) {
                            echo '<option value="'.$shift->id.'">'.$shift->name.'</option>';
                        }
                    ?>
                </select>
                </div>

                <div class="form-group row">
                    <input type="hidden" name="MAX_FILE_SIZE" value="5242880" />
                    <label class="control-label text-right col-sm-2">Upload image(max 5MB) :</label> 
                    <input class="col-sm-10" name="image_file" type="file" />
                </div>

                <div class="text-center">
                    <button type="submit" name="new_employee" class="btn btn-success waves-effect waves-light col-sm-4">Add Employee</button>
                </div>
            </form>
        </div>
    </div>
</div>