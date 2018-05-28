<div class="card">
    <div class="card-body">
        <div class="form-horizontal">
            <form method="post" action="<?php echo base_url(); ?>System/add_plant">
                <div class="form-group row">
                    <label class="control-label text-right col-sm-2">Plant Name</label>
                    <input class="form-control input-default col-sm-10" placeholder="Plant name"  name="plant" type="text" required>
                </div>

                <div class="text-center">
                    <button type="submit" name="new_plant" class="btn btn-success waves-effect waves-light col-sm-4">Add Plant</button>
                </div>
            </form>
        </div>
    </div>
</div>