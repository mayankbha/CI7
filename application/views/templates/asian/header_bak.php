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
    <link href="/template/asian/resources/css/stylesheet-reponsive.css" rel="stylesheet" type="text/css">
	<link href="/template/asian/resources/css/jquery.toastmessage.css" rel="stylesheet" type="text/css">
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

	
    <!-- Upload Manager CSS -->
    <link rel="stylesheet" href="/template/asian/resources/css/upload/blueimp-gallery.min.css">
    <link rel="stylesheet" href="/template/asian/resources/css/upload/jquery.fileupload.css">
    <link rel="stylesheet" href="/template/asian/resources/css/upload/jquery.fileupload-ui.css">
    <noscript><link rel="stylesheet" href="/template/asian/resources/css/upload/jquery.fileupload-noscript.css"></noscript>
    <noscript><link rel="stylesheet" href="/template/asian/resources/css/upload/jquery.fileupload-ui-noscript.css"></noscript>

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
                    <a href="/profile">
                        <img src="/template/asian/resources/img/logo-red.png" alt="logo"/>
                    </a>
                </div>
                <div class="language pull-left">
                    <a href="#" class="active"><img src="/template/asian/resources/img/flag-eg.png" alt="img"/></a>
                    <a href="#"><img src="/template/asian/resources/img/flag-vn.png" alt="img"/></a>
                    <a href="#"><img src="/template/asian/resources/img/flag-gra.png" alt="img"/></a>
                </div>
            </div>
            <div class="col-sm-6">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <div class="navbar-collapse collapse">
                    <div class="navigation clearfix">
						<?php
						if(@isset($logged)){
						?>
                        <ul class="clearfix">
                            <li><a <?php if(substr($_SERVER['REQUEST_URI'], 0, 5)=='/mail'){ echo ' class="active"'; } ?>href="#"><?php echo $this->lang->line('mail');?> </a></li>
                            <li><a <?php if(substr($_SERVER['REQUEST_URI'], 0, 5)=='/list'){ echo ' class="active"'; } ?>href="#"><?php echo $this->lang->line('list');?> </a></li>
                            <li><a <?php if(substr($_SERVER['REQUEST_URI'], 0, 7)=='/search'){ echo ' class="active"'; } ?>href="/search_result"><?php echo $this->lang->line('search');?> </a></li>
							<?php //print_r($_SERVER);?>
                            <li><a <?php if(substr($_SERVER['REQUEST_URI'], 0, 8)=='/profile'){ echo ' class="active"'; } ?> href="/profile"><?php echo $this->lang->line('profile');?> </a></li>
                            <li><a <?php if(substr($_SERVER['REQUEST_URI'], 0, 5)=='/plus'){ echo ' class="active"'; } ?>href="#"><?php echo $this->lang->line('plus');?> </a></li>
                            <li><a <?php if(substr($_SERVER['REQUEST_URI'], 0, 8)=='/setting'){ echo ' class="active"'; } ?>href="#"><?php echo $this->lang->line('setting');?> </a></li>
                        </ul>
						<?php
						}
						?>		
                    </div>
                </div>
            </div>
			<?php
			if(isset($session['identity'])){
			?>	

            <div class="col-sm-3">
                <div class="loggedin pull-right">
                    <span class="toolbar-avatar"><img src="resources/img/gallery_1.png" alt=""></span>
                    <a href="#" class="btn btn-link dropdown-toggle btn-sm" data-toggle="dropdown">Hello, 
                        <span class="txt-red"><?php echo ucfirst($session['first_name']).' '.ucfirst($session['last_name']);?></span>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/profile_manager"><i class="fa fa-cog"></i> Settings</a></li>
                        <li><a href="/profile"><i class="fa fa-user"></i> Profile</a></li>
                        <li><a href="#" class="btn btn-danger btn-block">Logout</a></li>
                    </ul>
                </div>
            </div>
			<?php
			} else {
			?>
            <div class="col-sm-3">
                <div class="login btn-group pull-right">
                    <a class="btn btn-default btn-login" href="#modal-login" data-toggle="modal">
                    <i class="fa fa-user"></i> 
                    <span><?php echo $this->lang->line('login');?></span>
                    </a>
                    <a class="btn btn-danger btn-register" href="register.html">
                    <i class="fa fa-arrow-circle-o-right"></i>
                    <span><?php echo $this->lang->line('register');?></span>
                    </a>
                </div>
            </div>
			<?php
			}
			?>

			
        </div>
    </div>