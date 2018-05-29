<div class="card">
    <div class="card-body">
        <div class="table-responsive">
        <table id="role_table" class="table" style="width:100%">
            <thead>
                <tr>
                    <th>Role</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($roles as $role) {
                    echo "<tr>";
                    echo '<td>'.$role['role_name'].'</td>
                        <td>
                            <a href="'.base_url().'Role/view/'.$role['id'].'" class="btn btn-info btn-block">View Info</a>
                        </td>';
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    </div>
</div>



