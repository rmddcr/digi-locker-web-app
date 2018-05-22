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
                <td> <form action="<?php echo base_url()."User/view/".str_replace('@','%40',$row['user_name']);?>">
                        <input type="submit"  class="btn btn-info m-b-10 m-l-5" value="View Info" />
                    </form>

                </td>



            </tr>
            </tbody>
        </table>
    </div>






<?php endforeach;?>

