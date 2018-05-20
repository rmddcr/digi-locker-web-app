<div class="card">
    <div class="card-body">
        <div class="form-horizontal">
            <form method="get" action="<?php echo base_url(); ?>Employee/new_employee">

                <div class="form-group row">
                    <label class="control-label text-right col-sm-2">EPF Number</label>
                    <input class="form-control input-default col-sm-10" placeholder="EPF number"  name="epf_no" type="number">
                </div>
                <div class="form-group row">
                    <label class="control-label text-right col-sm-2">Employee Name</label>
                    <input class="form-control input-default col-sm-10" placeholder="Employee name"  name="name" type="text">
                </div>


                <div class="form-group row">
                <label class="control-label text-right col-sm-2">Team</label>
                <select class="form-control input-default col-sm-10 selectize" placeholder="Team" name="team" type="text">
                    <option>Team A</option>
                    <option>Team B</option>
                    <option>Team C</option>
                    <option>Team D</option>
                </select>
                </div>

                <div class="form-group row">
                <label class="control-label text-right col-sm-2">Shift</label>
                <select class="form-control input-default col-sm-10 selectize" name="shift_group" placeholder="Shift" type="text">
                    <option>Shift A</option>
                    <option>Shift B</option>
                    <option>Shift C</option>
                    <option>Shift D</option>
                </select>
                </div>

                <div class="form-group row">
                <label class="control-label text-right col-sm-2">Section</label>
                <select class="form-control input-default col-sm-10 selectize" name="section_id" placeholder="Section" type="text">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                </select>
                </div>

                <div class="text-center">
                    <button type="submit" name="filter_results" class="btn btn-success waves-effect waves-light col-sm-4">Add User</button>
                </div>
            </form>
        </div>
    </div>
</div>