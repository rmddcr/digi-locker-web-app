<!DOCTYPE html>
<html lang="en">
<head>
    <title>Digi Locker | Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/images/favicon.png"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login_assets/'); ?>vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login_assets/'); ?>fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login_assets/'); ?>fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login_assets/'); ?>vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login_assets/'); ?>vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login_assets/'); ?>vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login_assets/'); ?>vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login_assets/'); ?>vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login_assets/'); ?>css/util.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login_assets/'); ?>css/main.css">
    <!--===============================================================================================-->
</head>
<body>

<?php echo form_open('login'); ?>
Test users : <br>
<strong>Username : Password</strong> <br>
root : root <br>
admin : admin <br>
enterer : enterer <br>
manager : manager <br>
<div class="limiter">

    <div class="container-login100">

        <div class="wrap-login100">
            <form class="login100-form validate-form">
					<span class="login100-form-title p-b-26">
						Welcome
					</span>


                <span class="login100-form-title p-b-48"> <img src="<?php echo base_url('assets/'); ?>images/logo.png">
                    <img src="<?php echo base_url('assets/'); ?>images/logo-text.png">
						<i class="zmdi "> </i>
					</span>

                <div class="wrap-input100 validate-input" data-validate = "Enter username">
                    <input class="input100" type="text" name="email" required>
                    <span class="focus-input100" data-placeholder="Username"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
                    <input class="input100" type="password" name="pass" required>
                    <span class="focus-input100" data-placeholder="Password"></span>
                </div>
                <?php 
                $error = $this->session->flashdata('error');
                if(isset($error))
                    { 
                        echo '<div class="text-center p-t-70">
                                        <span class="txt1">
                                            Invalid Username Password combinantion
                                        </span>

                                    <a class="txt2" href="'.base_url('password_rest').'">
                                        Reset Password
                                    </a>
                                </div>'; 

                    }
                ?>
                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button type="submit" class="login100-form-btn">
                            Login
                        </button>
                    </div>
                </div>

                <div class="text-center p-t-70">
						<span class="txt1">
							Don’t have an account?
						</span>

                    <a class="txt2" href="<?php echo base_url('signup'); ?>">
                        Sign Up
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php echo form_close(); ?>

<div id="dropDownSelect1"></div>



<!--===============================================================================================-->
<script src="<?php echo base_url('assets/login_assets/'); ?>vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="<?php echo base_url('assets/login_assets/'); ?>vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="<?php echo base_url('assets/login_assets/'); ?>vendor/bootstrap/js/popper.js"></script>
<script src="<?php echo base_url('assets/login_assets/'); ?>vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="<?php echo base_url('assets/login_assets/'); ?>vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="<?php echo base_url('assets/login_assets/'); ?>vendor/daterangepicker/moment.min.js"></script>
<script src="<?php echo base_url('assets/login_assets/'); ?>vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="<?php echo base_url('assets/login_assets/'); ?>vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="<?php echo base_url('assets/login_assets/'); ?>js/main.js"></script>

</body>
</html>