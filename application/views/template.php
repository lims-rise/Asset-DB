<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>RISE-Inventory</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/jquery-ui/themes/base/minified/jquery-ui.min.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/bower_components/select2/dist/css/select2.min.css">
        
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/bower_components/Ionicons/css/ionicons.min.css">
        <!-- DataTables -->
        <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css"> -->
        <!-- <link rel="stylesheet" href="//cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.css"> -->
        <!-- <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css"> -->
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.5/css/fixedHeader.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/dist/css/skins/_all-skins.min.css">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-datetimepicker.min.css') ?>">
       
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
              <style>
                /* .select2-selection__rendered {
                    margin-bottom: 10px;
                    }
                    .select2-selection__arrow {
                margin: 10px;
                } */
                .image-area {
                    position: relative;
                    width: 80px;
                    /* background: #333; */
                }

                .image-area img {
                    max-width: 100%;
                    height: auto;
                }

                .remove-image {
                    display: none;
                    position: absolute;
                    top: -10px;
                    right: -10px;
                    border-radius: 10em;
                    padding: 2px 6px 3px;
                    text-decoration: none;
                    font: 700 21px/20px sans-serif;
                    background: #555;
                    border: 3px solid #fff;
                    color: #FFF;
                    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.5), inset 0 2px 4px rgba(0, 0, 0, 0.3);
                    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
                    -webkit-transition: background 0.5s;
                    transition: background 0.5s;
                }

                .remove-image:hover {
                    background: #E54E4E;
                    padding: 3px 7px 5px;
                    top: -11px;
                    right: -11px;
                }

                .remove-image:active {
                    background: #E54E4E;
                    top: -10px;
                    right: -11px;
                }

                .loadscreen {
                text-align: center;
                position: fixed;
                width: 100%;
                left: 0;
                right: 0;
                margin: auto;
                top: 0;
                height: 100vh;
                background: #ffffff97;
                z-index: 99999999999;
            }

                .loadscreen .loader {
                    position: absolute;
                    top: calc(50vh - 50px);
                    left: 0;
                    right: 0;
                    margin: auto;
                }

                .loadscreen .logo {
                    display: inline-block !important;
                    width: 80px;
                    height: 80px;
                }
                .highcharts-figure,
                .highcharts-data-table table {
                min-width: 320px;
                max-width: 660px;
                margin: 1em auto;
                }

                .highcharts-data-table table {
                font-family: Verdana, sans-serif;
                border-collapse: collapse;
                border: 1px solid #ebebeb;
                margin: 10px auto;
                text-align: center;
                width: 100%;
                max-width: 500px;
                }

                .highcharts-data-table caption {
                padding: 1em 0;
                font-size: 1.2em;
                color: #555;
                }

                .highcharts-data-table th {
                font-weight: 600;
                padding: 0.5em;
                }

                .highcharts-data-table td,
                .highcharts-data-table th,
                .highcharts-data-table caption {
                padding: 0.5em;
                }

                .highcharts-data-table thead tr,
                .highcharts-data-table tr:nth-child(even) {
                background: #f8f8f8;
                }

                .highcharts-data-table tr:hover {
                background: #f1f7ff;
                }
        </style>
        <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
    </head>
    <body class="hold-transition skin-purple-light sidebar-mini">
   
        <div class="wrapper">
        <div class="loadscreen" style="z-index: 9999999">
            <div class="loader"><img class="logo mb-3" src="<?php echo base_url('image/loading.gif'); ?>" style="display: none" alt="">
                <div class="loader-bubble loader-bubble-primary d-block"></div>
            </div>
        </div>
            <header class="main-header">
                <!-- Logo -->
                <a href="<?php echo base_url('welcome') ?>" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>R</b>IN</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>INVENTORY</b></span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">                          


                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?php echo base_url() ?>assets/foto_profil/<?php echo $this->session->userdata('images'); ?>" class="user-image" style="object-fit: cover;width:30px;height:30px;" alt="User Image">
                                    <span class="hidden-xs"><?php echo $this->session->userdata('full_name'); ?> </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <!-- <img src="<?php //echo base_url() ?>assets/foto_profil/<?php// echo $this->session->userdata('images'); ?> " class="img-circle" alt="User Image"> -->
                                        <img src="<?php echo base_url() ?>assets/foto_profil/<?php echo $this->session->userdata('images'); ?> " class="img-circle" style="object-fit: cover;width:75px;height:75px;" alt="User Image">

                                        <p>
                                            <?php echo $this->session->userdata('full_name'); ?>                                         
                                            <small><?php echo $this->session->userdata('email'); ?></small>
                                        </p>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <?php echo anchor('tbl_user_profile', 'Profile', array('class' => 'btn btn-warning btn-flat')); ?>
                                            <?php //echo anchor('user/profile', 'Profile', array('class' => 'btn btn-default btn-flat')); ?>
                                            <!--<a href="#" class="btn btn-default btn-flat">Profile</a>-->
                                        </div>
                                        <div class="pull-right">
                                            <?php echo anchor('auth/logout', 'Logout', array('class' => 'btn btn-default btn-flat')); ?>
                                            <!--<a href="#" class="btn btn-default btn-flat">Sign out</a>-->
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <?php $this->load->view('template/sidebar'); ?>
            </aside>

            <?php
            echo $contents;
            ?>


            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 1.1.0
                </div>
                <strong>Copyright &copy; 2023 RISE</strong>
            </footer>

          
            <div class="control-sidebar-bg"></div>
        </div>
   
        <!-- ./wrapper -->
        <script type="text/javascript" src="<?php echo base_url() ?>assets/jquery-ui/ui/minified/jquery-ui.min.js"></script>
        <!-- jQuery 3
        <script src="<?php echo base_url() ?>assets/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
         -->
        <!-- Bootstrap 3.3.7 -->
        <script src="<?php echo base_url() ?>assets/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- DataTables -->
        <!-- SlimScroll -->
        <script src="<?php echo base_url() ?>assets/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="<?php echo base_url() ?>assets/adminlte/bower_components/fastclick/lib/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo base_url() ?>assets/adminlte/dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?php echo base_url() ?>assets/adminlte/dist/js/demo.js"></script>
     
        <!-- Select2 -->
        <script src="<?php echo base_url() ?>assets/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
        <!-- page script -->
        <script>
             $(window).on('load', function() {
                'use strict';
                $('.loadscreen').delay(300).fadeOut();
            });
            $(document).ajaxStart(function() {
                        $('.loadscreen').show();
                    }).ajaxComplete(function(event, response) {
                        $('.loadscreen').delay(300).fadeOut();
                        // if (response.status == '201') {
                        //     message('success', response.responseText)
                        // }
                    }).ajaxError(function(event, response) {
                        $('.loadscreen').delay(300).fadeOut();

                        // if (response.status == '400') {

                        // } else if (response.status == '401') {
                        //     window.location.replace('/login')
                        // } else if (response.status == '500') {
                        //     message('error', response.responseText)
                        // }
                    });
            $(function () {
                $('.select2').select2()
                $('form').on('submit',function(){
                    $('.loadscreen').show();
                })
                // $('#example1').DataTable()
                // $('#example2').DataTable({
                //     'paging'      : true,
                //     'lengthChange': false,
                //     'searching'   : false,
                //     'ordering'    : true,
                //     'info'        : true,
                //     'autoWidth'   : false
                // })
             
            })
        </script>
    </body>
</html>
