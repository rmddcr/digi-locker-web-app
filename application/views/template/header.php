<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets/images/favicon.png">
    <title>Digi Locker</title>

    <link href="<?php echo base_url(); ?>assets/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/lib/chartist/chartist.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/lib/owl.carousel.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/css/lib/owl.theme.default.min.css" rel="stylesheet" />
    
    <link href="<?php echo base_url(); ?>assets/css/selectize.bootstrap3.css" rel="stylesheet">
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>assets/css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assets/css/helper.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:** -->
    <!--[if lt IE 9]>
    <script src="https:**oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https:**oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header fix-sidebar">
    <!-- Preloader - style you can find in spinners.css -->
    <!-- <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
			<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div> -->
    <!-- Main wrapper  -->
    <div id="main-wrapper">
        <!-- header header  -->
        <div class="header">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- Logo -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo base_url(); ?>">
                        <!-- Logo icon -->
                        <b><img src="<?php echo base_url(); ?>assets/images/logo.png" alt="homepage" class="dark-logo" /></b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span><img src="<?php echo base_url(); ?>assets/images/logo-text.png" alt="homepage" class="dark-logo" /></span>
                    </a>
                </div>
                <!-- End Logo -->
                <div class="navbar-collapse">
                    <!-- toggle and nav items -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted  " href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted  " href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                    </ul>
                    <!-- User profile and search -->
                    <ul class="navbar-nav my-lg-0">

                        <!-- Search -->
                        <!-- <li class="nav-item hidden-sm-down search-box"> <a class="nav-link hidden-sm-down text-muted  " href="javascript:void(0)"><i class="ti-search"></i></a>
                            <form class="app-search">
                                <input type="text" class="form-control" placeholder="Search here"> <a class="srh-btn"><i class="ti-close"></i></a> </form>
                        </li> -->
                        
                        
                        <!-- Profile -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url(); ?>assets/images/avatar.jpg" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                                <ul class="dropdown-user">
                                    <li><a href="<?php echo base_url();?>logout"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- End header header -->
        <!-- Left Sidebar  -->
        <div class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">

                        <li class="nav-devider"></li>
                    <?php
                    if(isset($_SESSION['user']['access']['all_lockers']) || $_SESSION['user']['privilage_level'] == '1')
                    {
                        echo 
                        '<li class="nav-label">Lockers</li>
                        <li> <a href="'.base_url().'Locker/" aria-expanded="false"><i class="fas fa-boxes"></i><span class="hide-menu">All Lockers</span></a>
                        </li>';
                    }
                    if(isset($_SESSION['user']['access']['new_lockers']) || $_SESSION['user']['privilage_level'] == '1')
                    {
                        echo 
                        '<li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-plus-square"></i><span class="hide-menu">New Lockers</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="'.base_url().'Locker/new_locker">Add one</a></li>
                                <!-- <li><a href="'.base_url().'Locker/new_locker_bulck">Add bulk</a></li> -->
                            </ul>
                        </li>';
                    }
                    if(isset($_SESSION['user']['access']['remove_lockers']) || $_SESSION['user']['privilage_level'] == '1')
                    {
                        echo 
                        '<li> <a class="has-arrow  "  aria-expanded="false"><i class="fa fa-minus-square"></i><span class="hide-menu">Remove Lockers</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="'.base_url().'Locker/remove_locker">Remove locker</a></li>
                            </ul>
                        </li>';
                    }
                    if(isset($_SESSION['user']['access']['all_employee']) || $_SESSION['user']['privilage_level'] == '1')
                    {
                        echo 
                        '<li class="nav-devider"></li>
                        <li class="nav-label">Employees</li>
                        <li> <a href="'.base_url().'Employee/" aria-expanded="false"><i class="fa fa-address-book"></i><span class="hide-menu">All Employees</span></a>
                        </li>';
                    }
                    if(isset($_SESSION['user']['access']['new_employee']) || $_SESSION['user']['privilage_level'] == '1')
                    {
                        echo 
                        '<li> <a href="'.base_url().'Employee/new_employee" aria-expanded="false"><i class="fa fa-plus-square"></i><span class="hide-menu">New Employee</span></a>
                        </li>';
                    }
                    if(isset($_SESSION['user']['access']['remove_employee']) || $_SESSION['user']['privilage_level'] == '1')
                    {
                        echo 
                        '<li> <a class="has-arrow  " aria-expanded="false"><i class="fa fa-minus-square"></i><span class="hide-menu">Remove Employee</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="'.base_url().'Employee/remove_employee_csv"><i class="fas fa-file"></i>&nbsp;Remove from CVS file</a>
                                </li>
                            </ul>
                        </li>';
                    }
                    if(isset($_SESSION['user']['access']['users']) || $_SESSION['user']['privilage_level'] == '1')
                    {
                        echo 
                        '<li class="nav-devider"></li>
                        <li class="nav-label">Users</li>
                        <li> <a class="has-arrow  " href="" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu">Users</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="'.base_url().'User/"><i class="fa fa-list-ul"></i>&nbsp;List Users</a></li>
                                <li><a href="'.base_url().'User/new_user"><i class="fa fa-user-plus"></i>&nbsp;New User</a></li>
                            </ul>
                        </li>';
                    }
                    if(isset($_SESSION['user']['access']['system']) || isset($_SESSION['user']['access']['restore']) || $_SESSION['user']['privilage_level'] == '1')
                    {
                        echo '
                        <li> <a class="has-arrow  " aria-expanded="false"><i class="fa fa-cogs"></i><span class="hide-menu">System</span></a>
                            <ul aria-expanded="false" class="collapse">';

                            if(isset($_SESSION['user']['access']['system']) || $_SESSION['user']['privilage_level'] == '1')
                            {
                                echo 
                                '<li><a href="'.base_url().'System/add_plant"><i class="fas fa-building"></i>&nbsp;New Plant</a></li>
                                <li><a href="'.base_url().'System/add_team"><i class="fas fa-people-carry"></i>&nbsp;New Team</a></li>
                                <li><a href="'.base_url().'System/add_shift"><i class="far fa-clock"></i>&nbsp;New Shift</a></li>';
                            }
                            if(isset($_SESSION['user']['access']['restore']) || $_SESSION['user']['privilage_level'] == '1')
                            {
                                echo '<li><a href="'.base_url().'System/restore"><i class="fas fa-wrench"></i>&nbsp;Restore</a></li>';
                            }


                        

                        echo 
                            '</ul>
                        </li>';
                        echo
                            '<li> <a href="https://docs.google.com/forms/d/e/1FAIpQLSdxeFANMJTju5fzn6C0A0fTktWqeMWYZrlA7gTeIO0oIpRUMg/viewform?usp=sf_link" aria-expanded="false"><i class="fas fa-bug"></i><span class="hide-menu">Report bugs</span></a>
                        </li>';


                    }



                    ?>
                        

                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </div>
        <!-- End Left Sidebar  -->
        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary"><?php echo $page_title; ?></h3> 
                </div>
            </div>

            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Messages -->
                <?php
                    if(isset($error)) 
                        echo '<div class="alert alert-danger alert-dismissible fade show">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'.$error.'
                                </div>';
                    if(isset($warning))
                        echo '<div class="alert alert-warning alert-dismissible fade show">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'.$warning.'
                                </div>';
                    if(isset($success))
                        echo '<div class="alert alert-success alert-dismissible fade show">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'.$success.'
                                </div>';
                    if(isset($info))
                        echo '<div class="alert alert-success alert-dismissible fade show">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'.$info.'
                                </div>';
                    if(isset($debug))
                        echo '<div class="alert alert-dark alert-dismissible fade show">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'.var_export($debug, true).'
                                </div>';
                ?>
                <!-- End Mesages -->