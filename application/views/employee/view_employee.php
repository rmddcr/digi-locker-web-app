<?php var_dump($result_array) ;?>

<div class="card">
    <img src="<?php echo base_url(); ?>assets/images/users/5.jpg" class="profile-pic" alt="John"
         style="background-size: cover;width: 150px; height: 150px;background-position: top center;border-radius: 50%;">
    <h1><?php echo $result_array[0]['name']?></h1>
    <p class="title"><?php echo "EPF NUMBER: ".$result_array[0]['epf_no']?></p>
    <p><?php echo "TEAM: ".$result_array[0]['team']?></p>
    <p><?php echo "SHIFT GROUP: ".$result_array[0]['shift_group']?></p>
    <p><?php echo "SECTION: ".$result_array[0]['section_id']?></p>
    <?php foreach ($result_array as $rows) :?>
    <div class="card">
        <?php echo "LOCKER ID NO  ".$rows['locker_locker_no'];?>
    </div>


    <?php endforeach;?>

</div>