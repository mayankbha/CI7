<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link href="/template/admin/css/admin.css" rel="stylesheet">
    <link href="/template/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="/template/admin/css/bootstrap-theme.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery.js"></script>
    <script src="/template/admin/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="" id="mainnav">
		<div class="container">
            <div class="col-md-3"> <img style="float:left;" src="/template/asian/resources/img/logo-white.png">
              <h2 id="maintitle">&#160;&#160;&#160;&#160;Admin</h2>
            </div>
            <div class="col-md-7 col-md-offset-2">
              <?php
                   if (isset($logged)) 
				   { 
              ?>
              <nav class="navbar navbar-default" role="navigation">
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav">
                    <li class="active"><a href="<?php echo base_url('admin');?>"><i class="fa fa-home fa-fw"></i> Home </a></li>
                    
                    <!-- <li><a href="<?php echo base_url('admins/member/'); ?>"><i class="fa fa-users fa-fw"></i>Members</a></li>-->
                    <!--<li class="dropdown"> <a href="<?php echo base_url('admins/member/'); ?>" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-users fa-fw"></i>Members <b class="caret"></b></a>
                              <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url('admins/success_story/'); ?>">Success Story</a></li>
                              </ul>
                            </li>-->
                    <!--<li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-users fa-fw"></i>Forum <b class="caret"></b></a>
                              <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url('admins/forums/'); ?>">Forum Forum</a></li>
                                <li><a href="<?php echo base_url('admins/forum_groups'); ?>">Forum Group</a></li>
                              </ul>
                    </li>-->
                    
                    <li><a href="<?php echo base_url('admins/donations/'); ?>"><i class="fa fa-users fa-fw"></i> Donation </a></li>
                    <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-users fa-fw"></i> Store <b class="caret"></b></a>
                      <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url('admins/productcategory/'); ?>"> Manage Product Categories </a></li>
                        <li><a href="<?php echo base_url('admins/product/'); ?>"> Manage Products </a></li>
                        <li><a href="<?php echo base_url('admins/tax/'); ?>"> Manage Tax </a></li>
                        <li><a href="<?php echo base_url('admins/transactions/'); ?>"> Manage Transactions </a></li>
                        <li><a href="<?php echo base_url('admins/orders/'); ?>"> Manage Orders </a></li>
                        <li><a href="<?php echo base_url('admins/templates_group/'); ?>"> Manage Template gruops </a></li>
                        <li><a href="<?php echo base_url('admins/template_data/'); ?>"> Manage Template Data </a></li>
                      </ul>
                    </li>
                    <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-users fa-fw"></i> Settings <b class="caret"></b></a>
                      <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url('admins/member/'); ?>"> Members </a></li>
                        <li><a href="<?php echo base_url('admins/success_story/'); ?>"> Success Story </a></li>
                        <li><a href="<?php echo base_url('admins/forum_groups'); ?>"> Forum Group </a></li>
                        <li><a href="<?php echo base_url('admins/forums/'); ?>"> Forum </a></li>
                      </ul>
                    </li>
                    <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gear fa-fw"></i> Tools <b class="caret"></b></a>
                      <ul class="dropdown-menu">
                        <li><a href="#">Manage Profile</a></li>
                        <li><a href="<?php echo base_url('admins/settings/popup_time'); ?>"> Popup Settings </a></li>
                        <li><a href="<?php echo site_url('admin/logout'); ?>"> Logout </a></li>
                        <!--<li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                            <li class="divider"></li>
                        <li><a href="#">One more separated link</a></li>-->
                      </ul>
                    </li>
                  </ul>
                </div>
                <!-- /.navbar-collapse -->
              </nav>
              <?php
                    }
              ?>
            </div>
          </div>
    </div>
<div class="container">
	<div class="row" style="margin-top:10px;">
        <div class="col-md-3">
          <?php 
                if (isset($logged))
                {
            ?>
                  <div class="col-md-8 col-md-offset-1">
                    <ul class="nav nav-stacked black" id="newnav">
                      <li class="active"><i class="fa fa-laptop fa-fw"></i> Site Manager</li>
                      <li><a href="/admin/manage_id"><i class="fa fa-book fa-fw"></i> Submitted IDs </a></li>
                      <li><a href="#"><i class="fa fa-pencil fa-fw"></i> Applications </a></li>
                      <li><a href="#"><i class="fa fa-cogs fa-fw"></i> Settings </a></li>
                    </ul>
                  </div>
          <?php
                }
            ?>
        </div>
		<div class="col-md-9">   