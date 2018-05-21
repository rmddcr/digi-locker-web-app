<?php var_dump($results_array);?>

<div class="card">
    <div class="card-body">
        <div class="form-horizontal">
            <form method="get" action="<?php echo base_url(); ?>Locker/new_locker">

                <div class="form-group row">
                    <label class="control-label text-right col-sm-2">Locker number</label>
                    <input class="form-control input-default col-sm-10" placeholder="Locker number"  name="locker_no" type="number">
                </div>



                <div class="form-group row">
                    <label class="control-label text-right col-sm-2">Plant</label>
                    <select class="form-control input-default col-sm-10 selectize" name="shift_group" placeholder="plant" type="text">
                        <option>Plant 1</option>
                        <option>Plant 2</option>
                        <option>Plant 3</option>
                    </select>
                </div>

                <div class="form-group row">
                    <label class="control-label text-right col-sm-2">Section</label>
                    <select class="form-control input-default col-sm-10 selectize" placeholder="Section" name="section_id" type="text">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                    </select>
                </div>

                <div class="text-center">
                    <button type="submit" name="filter_results" class="btn btn-success waves-effect waves-light col-sm-4">Add Locker</button>
                </div>
            </form>
        </div>
    </div>
</div>