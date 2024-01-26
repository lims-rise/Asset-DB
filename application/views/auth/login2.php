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
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">  -->
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
                        <div class="form-group has-feedback">
                            <input class="form-control" name="email" type="text" placeholder="Email" value="" required>
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            <!-- <div class="invalid-feedback"> </div> -->
                        </div>
                        <div class="form-group has-feedback">
                            <div class="input-group">
                                <input class="form-control" name="password" type="password" placeholder="Password" value="" required>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-eye-close bt1" style="cursor:pointer"></span>
                            </div>
                        <!-- <div class="invalid-feedback"> </div> -->
                        </div>
                        <button class="btn btn-primary btn-block" type="submit">Login</button>
                    </form>
                    <a href="#" id='addtombol'>Forget password?</a>
                   </div>
             </div>
            </div>
        </div>
    </div>

    <!-- MODAL FORM -->
    <div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header box">
                    <h4 class="modal-title" id="modal-title">Forget password?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <!-- <form id="formSample"  action= <?php //echo site_url('Auth/forgetpassword') ?> method="post" class="form-horizontal"> -->
                <form id="formSample" method="post" class="form-horizontal">
                    <div class="modal-body">
                        <div class="form-group">
                        <input id="mode" name="mode" type="hidden" class="form-control input-sm">
                            <label for="email" class="col-sm-8 control-label">Enter your LIMS login email</label>
                            <div class="col-sm-8">
                                <input id="email" name="email" type="text" class="form-control" placeholder="Email" required>
                                <!-- <div class="val1tip"></div> -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer clearfix">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Request code</button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->        


    <!-- MODAL FORM 2-->
    <div class="modal fade" id="reset-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header box">
                    <h4 class="modal-title" id="modal-title">Reset Password</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <form id="formSample"  action= <?php echo site_url('Auth/savepassword') ?> method="post" class="form-horizontal">
                    <div class="modal-body">
                        <p>6 digit Code has been sent to your email, please check your email</p>
                        <input id="emailsend" name="emailsend" type="hidden" class="form-control input-sm">
                        <div class="form-group">
                            <label for="code" class="col-sm-8 control-label">Your Code?</label>
                            <div class="col-sm-8">
                                <input id="code" name="code" type="text" class="form-control" placeholder="Insert your code here" required>
                                <!-- <div class="val1tip"></div> -->
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="new_pass" class="col-sm-8 control-label">New password</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input id="new_pass" name="new_pass" type="password" class="form-control" placeholder="New password" required>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-eye-close bt1" style="cursor:pointer"></span>
                                    <!-- <div class="val1tip"></div> -->
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="re_pass" class="col-sm-8 control-label">Retype password</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input id="re_pass" name="re_pass" type="password" class="form-control" placeholder="Retype password" required>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-eye-close bt1" style="cursor:pointer"></span>
                                    <!-- <div class="val1tip"></div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer clearfix">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Reset password</button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->            
    <!-- latest jquery-->
    <script src="<?php echo base_url('login/js/jquery-3.5.1.min.js'); ?>"></script>
    <!-- Bootstrap js-->
    <script src="<?php echo base_url('login/js/bootstrap/popper.min.js'); ?>"></script>
    <script src="<?php echo base_url('login/js/bootstrap/bootstrap.js'); ?>"></script>
    <!-- Sidebar jquery-->
    <script src="<?php echo base_url('login/js/config.js'); ?>"></script>
    <!-- Theme js-->
    <script src="<?php echo base_url('login/js/script.js'); ?>"></script>


    <script>
    $(document).ready(function() {

        $('#code').on("change", function() {
            data1 = $('#code').val();
            data2 = $('#emailsend').val();
            $.ajax({
                type: "GET",
                url: "Auth/valid_code?id1="+data1+"&id2="+data2,
                dataType: "json",
                success: function(data) {
                    if (data.length == 0) {
                        $('#code').focus();
                        $('#code').val('');     
                        $('#code').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#code').css({'background-color' : '#FFFFFF'});
                            setTimeout(function(){
                                $('#code').css({'background-color' : '#FFE6E7'});
                                setTimeout(function(){
                                    $('#code').css({'background-color' : '#FFFFFF'});
                                }, 300);                            
                            }, 300);
                        }, 300);
                    }
                }
            });
        });

        // $('#email').on("change", function() {
        //     $('#emailsend').val($('#email').val());     
        // });

        $('#re_pass').on("change", function() {
            data1 = $('#new_pass').val();
            data2 = $('#re_pass').val();
            if (data1 != data2) {
                $('#re_pass').focus();
                $('#re_pass').val('');     
                $('#re_pass').css({'background-color' : '#FFE6E7'});
                setTimeout(function(){
                    $('#re_pass').css({'background-color' : '#FFFFFF'});
                    setTimeout(function(){
                        $('#re_pass').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#re_pass').css({'background-color' : '#FFFFFF'});
                        }, 300);                            
                    }, 300);
                }, 300);
            }
            });
        });

        $('#addtombol').click(function() {
            // $('.val1tip').tooltipster('hide');   
            // $('#modal-title').html('<i class="fa fa-wpforms"></i> Forget Password ?<span id="my-another-cool-loader"></span>');
            $('#email').val('');
            $('#compose-modal').modal('show');
        });

        // $('#formSample').submit(function(e) {
        //     e.preventDefault();
        //     // Perform your form submission logic here
        //     // For demonstration purposes, let's assume the form is successfully submitted
        //     // You may want to use AJAX to submit the form data to your server
        //     // Show the second modal after the form is submitted
        //     $('#modal-title').html('<i class="fa fa-wpforms"></i> Reset Password ?<span id="my-another-cool-loader"></span>');
        //     $('#code').val('');
        //     $('#new_pass').val('');
        //     $('#reset-modal').modal('show');
        // });            

        $('#formSample').submit(function(e) {
            e.preventDefault();
            // Get form data
            var formData = $(this).serialize();

            // Perform AJAX request to submit the form data
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url('Auth/forgetpassword'); ?>',
                data: formData,
                dataType: 'json', // Change this based on your server response
                success: function(response) {
                    // Handle the server response here
                    // Show the second modal after the form is successfully submitted
                    if (response.status === 'success') {
                        // $('#modal-title').html('<i class="fa fa-wpforms"></i> Reset Password<span id="my-another-cool-loader"></span>');
                        $('#emailsend').val($('#email').val());
                        $('#code').val('');
                        $('#new_pass').val('');
                        $('#compose-modal').modal('hide');
                        $('#reset-modal').modal('show');
                    }
                    else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    // Handle the error response here
                    console.error(xhr.responseText);
                }
            });
        });

        $(".bt1").bind("click", function() {
            // if ($('#password').attr('type') =='password'){
            //     $('#password').attr('type','text');
            //     $('.bt1').removeClass('glyphicon-eye-close');
            //     $('.bt1').addClass('glyphicon-eye-open');
            // }else if($('#password').attr('type') =='text'){
            //     $('#password').attr('type','password');
            //     $('.bt1').removeClass('glyphicon-eye-open');
            //     $('.bt1').addClass('glyphicon-eye-close');
            // }

            if ($('#new_pass').attr('type') =='password'){
                $('#new_pass').attr('type','text');
                $('.bt1').removeClass('glyphicon-eye-close');
                $('.bt1').addClass('glyphicon-eye-open');
            }else if($('#new_pass').attr('type') =='text'){
                $('#new_pass').attr('type','password');
                $('.bt1').removeClass('glyphicon-eye-open');
                $('.bt1').addClass('glyphicon-eye-close');
            }                

            if ($('#re_pass').attr('type') =='password'){
                $('#re_pass').attr('type','text');
                $('.bt1').removeClass('glyphicon-eye-close');
                $('.bt1').addClass('glyphicon-eye-open');
            }else if($('#re_pass').attr('type') =='text'){
                $('#re_pass').attr('type','password');
                $('.bt1').removeClass('glyphicon-eye-open');
                $('.bt1').addClass('glyphicon-eye-close');
            }                

            });    
    
    </script>    
</body>

</html>
