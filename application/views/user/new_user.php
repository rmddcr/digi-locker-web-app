new_user

<?php var_dump($result_array);?>

<?php foreach ($result_array as $row) : ?>

    <div class="card">

        <div class="card-body"><?php "Confirm user     ";echo $row['user_name'] ; echo  "        As      " ; echo $row['role_name'] ;?>
            <button type="button" class="btn btn-warning btn-outline m-b-10 m-l-5">Confirm User</button>
        </div>

    </div>


<?php endforeach;?>

