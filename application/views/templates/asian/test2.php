<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo @$description;?>">
    <meta name="author" content="">

    <title><?php echo @$title;?></title>

    <!-- Bootstrap core CSS -->
    <link href="/template/asian/resources/css/bootstrap.min.css" rel="stylesheet">
    <link href="/template/asian/resources/css/stylesheet.css" rel="stylesheet" type="text/css">
    <link href="/template/asian/resources/css/plugin_date.css" rel="stylesheet" type="text/css">
    <link href="/template/asian/resources/css/owl.carousel.css" rel="stylesheet" type="text/css">
    <link href="/template/asian/resources/css/stylesheet-reponsive.css" rel="stylesheet" type="text/css">
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
<body class="main-wrap">
    <div class="toolbar">
        <div class="container">
            <div class="col-sm-3">
                <div class="logo pull-left">
                    <a href="register.html">
                        <img src="/template/asian/resources/img/logo-red.png" alt="logo"/>
                    </a>
                </div>
                <div class="language pull-left">
                    <a href="#" class="active"><img src="/template/asian/resources/img/flag-eg.png" alt="img"/></a>
                    <a href="#"><img src="/template/asian/resources/img/flag-vn.png" alt="img"/></a>
                    <a href="#"><img src="/template/asian/resources/img/flag-gra.png" alt="img"/></a>
                </div>
            </div>
            <div class="col-sm-7">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <div class="navbar-collapse collapse">
                    <div class="navigation clearfix">
                        <ul class="clearfix">
                            <li><a href="#"><?php echo $this->lang->line('mail'); ?> </a></li>
                            <li><a class="active" href="#"><?php echo $this->lang->line('list'); ?> </a></li>
                            <li><a href="#"><?php echo $this->lang->line('search'); ?> </a></li>
                            <li><a href="#"><?php echo $this->lang->line('profile'); ?> </a></li>
                            <li><a href="#"><?php echo $this->lang->line('plus'); ?> </a></li>
                            <li><a href="#"><?php echo $this->lang->line('setting'); ?> </a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="login btn-group pull-right">
                    <a class="btn btn-default" href="#modal-login" data-toggle="modal"><?php echo $this->lang->line('login');?></a>
                    <a  class="btn btn-danger" href="register.html"><?php echo $this->lang->line('register');?></a>
                </div>
            </div>
        </div>
    </div>