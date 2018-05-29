<div class="card">
    <div class="card-body">
        <div class="form-horizontal">
            <form method="post" action="<?php echo base_url(); ?>User/view/<?php echo str_replace('@','%40',$user['user_name']); ?>">

                <div class="form-group row">
                    <label class="control-label text-right col-sm-2">Username :</label>
                    <input class="form-control input-default col-sm-10" placeholder="<?php echo $user['user_name'];?>"  name="epf_no" type="number" disabled>
                </div>
                <div class="form-group row">
                    <label class="control-label text-right col-sm-2">Current Role</label>
                    <input class="form-control input-default col-sm-10" placeholder="<?php echo $user['role_name'];?>" type="text" disabled>
                </div>


                <div class="form-group row">
                <label class="control-label text-right col-sm-2">Update Role</label>
                <select class="form-control input-default col-sm-10 selectize" name="role" type="text">
                    <?php
                        foreach ($roles as $role) {
                            echo '<option value="'.$role['id'].'">'.$role['role_name'].'</option>';
                        }
                    ?>
                </select>
                </div>

                <div class="form-group row">
                    <label class="control-label text-right col-sm-2">Request to reset password :</label>
                    <input class="form-control input-default col-sm-10" placeholder="<?php if($user['request_password_reset'] == '1') echo 'YES'; else echo 'NO'; ?>" type="text" disabled>

                </div>

                <div class="form-group row">
                    <label class="control-label text-right col-sm-2">Reset password</label>
                    <input class="form-control input-default col-sm-10" placeholder="<?php if($user['password_reset'] == '1') echo 'YES'; else echo 'NO'; ?>" type="text" disabled>
                </div>

                <div class="text-center">
                	<button type="submit" name="reset_password" class="btn btn-info waves-effect waves-light col-sm-3">Reset Password</button>
                    <button type="submit" name="update_role" class="btn btn-warning waves-effect waves-light col-sm-3">Update Role</button>
                    <button type="submit" name="delete" class="btn btn-danger waves-effect waves-light col-sm-3">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>