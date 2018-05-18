<!DOCTYPE html>
<html>
<head>
    <title>Interactive Table</title>




    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />




    <!-- Bootstrap core CSS     -->
    <link href="<?php echo base_url().'assets/css/css_for_table/bootstrap.min.css'?>" rel="stylesheet" />


    <!--  Light Bootstrap Table core CSS    -->
    <link href="<?php echo base_url().'assets/css/css_for_table/light-bootstrap-dashboard.css'?>" rel="stylesheet"/>


    <!-- table -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/css_for_table/dataTable.bootstrap.min.css'?>">


    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.min.css" rel="stylesheet">
    <link rel="apple-touch-icon" href="/bootstrap/img/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/bootstrap/img/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/bootstrap/img/apple-touch-icon-114x114.png">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/css_for_table/mystyle.css'?>">

</head>
<body>

<div class="container">
    <h3>Insert Data To student</h3>

    <?php
    if($this->uri->segment(3)=="updated"){
        echo '<p class="text-success">Data Updated</p>';
    }

    ?>
    <?php
    if($this->uri->segment(3)=="inserted"){
        echo '<p class="text-success">Data Inserted</p>';
    }

    ?>

    <!-- update start from here ##################################################-->
    <?php
    if(isset($user_data)){
        foreach($user_data->result_array()as $row){
            ?>

            <?php echo form_open_multipart('main/form_Update_common/'.$row['id']);?>
            <div class="form-group form-group-sm">
                <label>Index</label>
                <input type="text" name="index_num" class="form-control" value="<?php echo $row['index_num'] ?>">
                <!-- print error message -->
                <span class="text-danger"><?php echo form_error("index_num");?></span>
            </div>
            <div class="form-group form-group-sm">
                <label>FirstName</label>
                <input type="text" name="firstname" class="form-control" value="<?php echo $row['firstname'] ?>">
                <!-- print error message -->
                <span class="text-danger"><?php echo form_error("firstname");?></span>
            </div>
            <div class="form-group form-group-sm">
                <label>LastName</label>
                <input type="text" name="lastname" class="form-control" value="<?php echo $row['lastname'] ?>">
                <!-- print error message -->
                <span class="text-danger"><?php echo form_error("lastname");?></span>
            </div>
            <div class="form-group form-group-sm">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control" value="<?php echo $row['phone'] ?>">
                <!-- print error message -->
                <span class="text-danger"><?php echo form_error("phone");?></span>
            </div>
            <div align="center" class="form-group form-group-sm">
                <input type="submit" name="update" value="Update" class="btn btn-warning">
            </div>
            <?php
        }
    }else{

        ?>

        <!-- end from here ####################################################-->


        <?php echo form_open_multipart('main/form_validation_student/student');?>
        <div class="form-group form-group-sm">
            <label>Index</label>
            <input type="text" name="index_num" class="form-control">
            <!-- print error message -->
            <span class="text-danger"><?php echo form_error("index_num");?></span>
        </div>
        <div class="form-group form-group-sm">
            <label>FirstName</label>
            <input type="text" name="firstname" class="form-control">
            <!-- print error message -->
            <span class="text-danger"><?php echo form_error("firstname");?></span>
        </div>
        <div class="form-group form-group-sm">
            <label>LastName</label>
            <input type="text" name="lastname" class="form-control">
            <!-- print error message -->
            <span class="text-danger"><?php echo form_error("lastname");?></span>
        </div>
        <div class="form-group form-group-sm">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control">
            <!-- print error message -->
            <span class="text-danger"><?php echo form_error("phone");?></span>
        </div>

        <div align="center" class="form-group form-group-sm">
            <input type="submit" name="insert" value="Update/Insert" class="btn btn-warning">
        </div>

        <?php
    }
    ?>
    <?php echo form_close();?>

</div>

<!-- table -->
<br><br>
<div align="center" >

    <h3>student Table</h3>

</div>


<div class ="align-center">
    <?php echo form_open_multipart('main/search');?>
    <div class="form-group form-group-sm">

        <div class="col-xs-5">
            <p> <input type="text" name="search_data" class="form-control">  </p>
        </div>
        <p><input type="submit" name="search" value="Search" class="btn btn-info"></p>

    </div>
    <?php echo form_close();?>

</div>









<table class="table table-striped">

    <thead>
    <tr>

        <th><b>ID</b></th>
        <th><b>Index number</b></th>
        <th><b>First Name</b></th>
        <th><b>Last Name</b></th>
        <th><b>Telephone Number</b> </th>
        <th><b>Update</b></th>
        <th><b>Delete</b></th>
    </tr>
    </thead>


    <?php
    if($fetch_data->num_rows()>0){
    foreach($fetch_data->result() as $row){
    ?>


    <tbody>

    <tr>
    <tr>
        <td><?php echo $row->id; ?></td>
        <td><?php echo $row->index_num; ?></td>
        <td><?php echo $row->firstname; ?></td>
        <td><?php echo $row->lastname; ?></td>
        <td><?php echo $row->phone; ?></td>
        <td><a class="btn btn-danger" href="<?php echo base_url()."main/delete_data/".$row->id ;?>">Delete</a></td>
        <td><a  class="btn btn-warning"href="<?php echo base_url()."main/update_data/".$row->id ;?>">Update</a></td>


    </tr>


    <?php
    }
    }else{
        ?>
        <tr>
            <td colspan="3">No Data Found</td>
        </tr>
        <?php
    }
    ?>


    </tr>


    </tbody>

</table>










</body>
</html>
