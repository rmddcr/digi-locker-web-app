<!DOCTYPE html>
<html lang="en">
<head>
    <title>Digi Locker | Reset password</title>
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

<?php echo form_open('password_rest'); ?>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <form class="login100-form validate-form">
					<span class="login100-form-title p-b-26">
						Welcome reset your password
					</span>


                <span class="login100-form-title p-b-48"> <img src="<?php echo base_url('assets/'); ?>images/logo.png">
                    <img src="<?php echo base_url('assets/'); ?>images/logo-text.png">
						<i class="zmdi "> </i>
					</span>

                <div class="wrap-input100 validate-input">
                    <input class="input100" type="text" name="" value="<?php echo $_SESSION['user_rest']['username'] ?>" disabled required>
                    
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i id='message1' class="zmdi zmdi-eye"></i>
						</span>
                    <input class="input100" type="password" id="password" name="password" onkeyup='check()' required>
                    <span class="focus-input100" data-placeholder="Password"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
<!--                            <span id='message' ></span>-->
							<i id='message2'class="zmdi zmdi-eye"></i>

						</span>
                    <input class="input100" type="password" name="confirm_password" id="confirm_password" onkeyup='check()'; required>
                    <span class="focus-input100" data-placeholder="Confirm Password "></span>

                </div>
                <?php echo validation_errors(); ?>
                <?php 
                $error = $this->session->flashdata('error');
                if(isset($error))
                    { 
                        echo '<div class="text-center p-t-70">
                                        <span class="txt1">
                                            Unable to change password
                                        </span>
                                </div>'; 

                    }
                ?>

                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button type="submit" class="login100-form-btn">
                            Reset Password
                        </button>
                    </div>
                </div>
                <script>
                    var check = function() {
                        if (document.getElementById('password').value ==
                            document.getElementById('confirm_password').value) {
                            document.getElementById('message1').style.color = 'green';
                            document.getElementById('message2').style.color = 'green';
                          //  document.getElementById('message').innerHTML = '&#11044;';
                        } else {
                            document.getElementById('message').style.color = 'red';
                          //  document.getElementById('message').innerHTML = '&#11044;';
                        }
                    }
                </script>

                <div class="text-center p-t-70">
						<span class="txt1">
							Already have a  account?
						</span>

                    <a class="txt2" href="<?php echo base_url('login'); ?>">
                        Login
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