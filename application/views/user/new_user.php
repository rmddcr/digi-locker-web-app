<div class="card">
    <div class="card-body">
        <div class="table-responsive">
        <table id="user_table" class="table" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Role</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($users as $user) {
                    echo '<tr>
                    <form method="post" action="'.base_url().'User/new_user" >';
                    echo '<td>'.$user['user_name'].'</td>
                        <td>
                            <select class="selectize" name="role">';
                                foreach ($roles as $role) 
                                {
                                    echo '<option value="'.$role['id'].'">'.$role['role_name'].'</option>';    
                                }
                     echo  '</select>
                        </td>
                        
                        <td>
                            <button type="submit" name="user" value="'.str_replace('@','%40',$user['user_name']).'" class="btn btn-warning btn-block">Assign Role</button>
                        </td>';
                    echo '
                    </form>
                    </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
    </div>
</div>





