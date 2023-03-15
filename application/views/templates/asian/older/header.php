<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta name="description" content="Dating Website">
   <meta name="keywords" content="Dating">
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <title><?php echo $title; ?></title>
   <style>
		body {
			font-family:arial;
		}
		#navigation {
			text-align:center;
			list-style:none;
			margin:0;
			padding:0;
			position:absolute;
			top:27px;
			left:300px;
		}
		#navigation li {
			display:inline;
			padding-left:16px;
		}
		#navigation li a {
			text-decoration:none;
			color:#fff;
		}
		.black {
			background-color:#000;
		}
   </style>
   <?php
   
   //auto add css based on page name
   $requestUri=explode('/', $_SERVER['REQUEST_URI']);
   $cssfile='/templates/asian/base/'.$requestUri[1].'.css';
   if(file_exists($_SERVER['DOCUMENT_ROOT'].$cssfile)){
	echo '<link rel="stylesheet" href="'.$cssfile.'">';
   } 
   
   ?>
 
   <link rel="stylesheet" href="/templates/asian/jquery-ui-1.10.3.custom/css/blitzer/jquery-ui-1.10.3.custom.css">
   <script src="/templates/asian/jquery-ui-1.10.3.custom/js/jquery-1.9.1.js"></script>
   <script src="/templates/asian/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js"></script>
   <script src="/templates/jquery/custom.js"></script>
</head>
<body style="font-family:arial;width:100%;padding:0px;margin:0px;">
	<div class="mainContainer" style="text-align:center;">
	<header>
		<div style="height:78px;width:100%;background:url('/templates/asian/default_head_bg.jpg') center;">
			<center>
			<div style="width:980px;position:relative;">
				<img style="top:12px;left:12px;position:absolute;" src="/templates/asian/default_logo.jpg">
				<img style="top:20px;left:202px;position:absolute;" src="/templates/asian/language.png">
				
				<img style="position:absolute;width:176;height:32;top:12px;right:0px;" name="login" src="/templates/asian/default_login.png" border="0" id="login" usemap="#m_login" alt="" />
				<map name="m_login" id="m_login">
				<area shape="rect" coords="100,0,200,35" href="/register" alt="" />
				<area shape="rect" coords="0,0,93,35" href="/login" alt="" />
				</map>				
			</div>
			</center>
		</div>
	</header>
