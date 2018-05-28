<div class="card">
    <div class="card-body">
        <div class="form-horizontal">
            <form method="post" action="<?php echo base_url(); ?>System/add_team">

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
                    <label class="control-label text-right col-sm-2">Team Name</label>
                    <input class="form-control input-default col-sm-10" placeholder="Team nname : Plant name"  name="team" type="text" required>
                </div>

                <div class="text-center">
                    <button type="submit" name="new_team" class="btn btn-success waves-effect waves-light col-sm-4">Add Team</button>
                </div>
            </form>
        </div>
    </div>
</div>