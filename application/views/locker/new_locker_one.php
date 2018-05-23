<div class="card">
    <div class="card-body">
        <div class="form-horizontal">
            <form method="post" action="<?php echo base_url(); ?>Locker/new_locker">

                <div class="form-group row" required>
                    <label class="control-label text-right col-sm-2">Locker number</label>
                    <input class="form-control input-default col-sm-10" placeholder="Locker number"  name="locker_no" type="number">
                </div>

                <div class="form-group row">
                    <label class="control-label text-right col-sm-2">Plant</label>
                    <select class="form-control input-default col-sm-10 selectize" placeholder="Plant" name="plant" type="text">
                        <?php
                            foreach ($plants as $plant) {
                                echo '<option value="'.$plant->id.'">'.$plant->name.'</option>';
                            }
                        ?>
                    </select>
                </div>

                <div class="text-center">
                    <button type="submit" name="new_locker" class="btn btn-success waves-effect waves-light col-sm-4">Add Locker</button>
                </div>
            </form>
        </div>
    </div>
</div>