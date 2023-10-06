<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="inventory">
    <meta name="author" content="dev-apps.id">
    <link rel="icon" href="" type="image/x-icon">
    <link rel="shortcut icon" href="" type="image/x-icon">
    <title>INVENTORY</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('login/css/fontawesome.css'); ?>">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('login/css/icofont.css'); ?>">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('login/css/themify.css'); ?>">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('login/css/flag-icon.css');?>">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('login/css/feather-icon.css');?>">
    <!-- Plugins css start-->
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('login/css/bootstrap.css');?>">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('login/css/style.css');?>">
    <link id="color" rel="stylesheet" media="screen" href="<?php echo base_url('login/css/color-1.css');?>">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('login/css/responsive.css');?>">

    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
        }
        
        #background-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('<?php echo base_url("login/video/background.jpg"); ?>');
            background-size: cover;
            background-position: center;
            z-index: -1; /* Place the container behind other content */
        }
    </style>

</head>



<body>
    <!-- Loader starts-->
    <div class="loader-wrapper">
        <div class="loader-index"><span></span></div>
        <svg>
        <defs></defs>
        <filter id="goo">
          <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
          <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo">    </fecolormatrix>
        </filter>
      </svg>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper">
        <div class="container-fluid p-0">
            <!-- login page with video background start-->
            <div class="auth-bg-video">
            <div id="background-container"></div>
            <!-- <img id="bgimg" src="<?php echo base_url('login/video/background.jpg'); ?>" alt="Background Image"> -->

                <!-- <video id="bgvid" playsinline="" autoplay="" muted="" loop="">
                    <source src="<?php // echo base_url('login/video/auth-bg_Trim.mp4'); ?>" type="video/mp4">
                </video> -->
          <div class="authentication-box auth-minibox1 ">
                <div class="text-center"><P><H4><B>RISE</B> | INVENTORY</H4>LOGIN</P></div>
                <div class="text-center">
                <?php
                $status_login = $this->session->userdata('status_login');
                if (empty($status_login)) {
                    $message = "";
                } else {
                    $message = $status_login;
                }
                ?>
                <p class="login-box-msg"><?php echo $message; ?></p>
                </div>
            
                <div class="card mt-4 p-4 mb-0" style="opacity: 0.9;">
                <?php echo form_open('auth/cheklogin'); ?>
                        <div class="form-group">
                            <input class="form-control" name="email" type="text" placeholder="email" value="" required>
                            <div class="invalid-feedback"> </div>
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="password" type="password" placeholder="password" value="" required>
                            <div class="invalid-feedback"> </div>
                        </div>
                        <button class="btn btn-primary btn-block" type="submit">Login</button>
                    </form>
                  </div>
             </div>
            </div>
        </div>
    </div>
    <!-- latest jquery-->
    <script src="<?php echo base_url('login/js/jquery-3.5.1.min.js'); ?>"></script>
    <!-- Bootstrap js-->
    <script src="<?php echo base_url('login/js/bootstrap/popper.min.js'); ?>"></script>
    <script src="<?php echo base_url('login/js/bootstrap/bootstrap.js'); ?>"></script>
    <!-- Sidebar jquery-->
    <script src="<?php echo base_url('login/js/config.js'); ?>"></script>
    <!-- Theme js-->
    <script src="<?php echo base_url('login/js/script.js'); ?>"></script>
</body>

</html>
