new_user

<?php var_dump($result_array);?>

<?php foreach ($result_array as $row) : ?>

    <div class="card">
        <table id="lockers_current_table" class="display">
            <thead>
            <tr>

                <th>Name</th>
                <th>Role</th>
                <th></th>

            </tr>
            </thead>
            <tbody>
            <tr>
                <td><?php echo $row['user_name'] ; ?></td>
                <td><?php echo $row['role_name'] ; ?></td>
                <td> <form action="<?php echo base_url()."User/view/";?>">
                        <input type="submit"  class="btn btn-warning m-b-10 m-l-5" value="Assign a role" />
                    </form>

                </td>



            </tr>
            </tbody>
        </table>


    </div>


<?php endforeach;?>



