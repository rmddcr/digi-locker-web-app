<?php var_dump($result_array[0]);
?>

<div class="card">
    <img src="<?php echo base_url(); ?>assets/images/users/5.jpg" class="profile-pic" alt="John"
         style="background-size: cover;width: 150px; height: 150px;background-position: top center;border-radius: 50%;">
    <h1><?php echo $result_array[0]['user_name'];?></h1>
    <p class="title"><?php echo $result_array[0]['role_name'];?></p>
    <p>Harvard University</p>
<!--    <a href="#"><i class="fa fa-dribbble"></i></a>-->

    <p>
<!--        <button>Contact</button>-->
    </p>
</div>
