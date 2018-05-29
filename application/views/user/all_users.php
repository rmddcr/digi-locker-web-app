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
                    echo "<tr>";
                    echo '<td>'.$user['user_name'].'</td>
                        <td>'.$user['role_name'].'</td>
                        <td>
                            <a href="'.base_url().'User/view/'.str_replace('@','%40',$user['user_name']).'" class="btn btn-info btn-block">View Info</a>
                        </td>';
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    </div>
</div>



