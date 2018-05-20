<?php var_dump($result_array);?>

<?php foreach ($result_array as $row) : ?>

    <div class="card">

        <div class="card-body"><?php echo $row['user_name'] ; echo  "        As      " ; echo $row['role_name'] ;?>  </div>

    </div>


<?php endforeach;?>

