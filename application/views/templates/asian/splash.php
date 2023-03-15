<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $this->lang->line('splash_description');?>">
    <meta name="author" content="">

    <title><?php echo $this->lang->line('splash_title');?></title> 

    <!-- Bootstrap core CSS -->
    <link href="/template/<?php echo $language['path']; ?>/resources/css/bootstrap.min.css" rel="stylesheet"> 
    <link href="/template/<?php echo $language['path']; ?>/resources/css/stylesheet.css" rel="stylesheet" type="text/css"> 
    <link href="/template/<?php echo $language['path']; ?>/splash_resources/css/landing.css" rel="stylesheet" type="text/css"> 
    <link href="/template/<?php echo $language['path']; ?>/resources/css/stylesheet-reponsive.css" rel="stylesheet" type="text/css"> 
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet"> 

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->   
    <!--[if lt IE 9]>    
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>   
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>   
    <![endif]--> 
  </head>
  
<body id="landing-page-2" class="rose-bg">
    <div class="toolbar">
        <div class="container">
                <div class="col-xs-6">
                    <div class="logo">
                        <a href="/">
                            <img src="/template/<?php echo $language['path']; ?>/resources/img/logo-white.png" alt="logo"/>
                        </a>
                    </div>    
                </div>   
                <div class="col-sm-6" >            
                    <div class="login btn-group pull-right" >              
                        <a class="btn btn-default btn-login" href="#modal-login" data-toggle="modal">         
                        <i class="fa fa-user"></i>          
                        <span><?php echo $this->lang->line('login'); ?></span>               
                        </a>
                        <a class="btn btn-warning btn-register" href="<?php echo base_url(); ?>register">            
                        <i class="fa fa-arrow-circle-o-right"></i>               
                        <span><?php echo $this->lang->line('register'); ?></span>                   
                        </a> 
                    </div> 
                </div> 
            </div>
        </div><!--  End  #header  -->                 
    </div><!--  End  #header  --> 
    <div class="header">
        <div class="container">
            <div class="row"> 
                <div class="col-sm-12">   
                    <div class="language">    
                        <a href="<?php echo $this->config->item('language_en_link'); ?>" class="active"><img src="/template/<?php echo $language['path']; ?>/resources/img/flag-eg.png" alt="img"/></a>
                        <a href="#"><img src="/template/<?php echo $language['path']; ?>/resources/img/flag-vn.png" alt="img"/></a>
                        <a href="<?php echo $this->config->item('language_ger_link'); ?>"><img src="/template/<?php echo $language['path']; ?>/resources/img/flag-gra.png" alt="img"/></a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <form class="form-horizontal frm-find" action="/search_profile/" method="post">
                    <!--<form class="form-horizontal frm-find" action="/search_result/" method="post">-->
                        <legend class="txt-red"><?php echo $this->lang->line('find_friends_now_its_free'); ?></legend>
                        <div class="form-group">
                            <label class="control-label col-sm-4"><?php echo $this->lang->line('i_am'); ?></label>
                            <div class="col-sm-8">
                                <div class="selector">    
                                    <?php echo form_dropdown('i_am', $i_am['options'], $i_am['value'], $i_am['form_options']); ?>
                                </div>    
                            </div>    
                        </div>    
                        <div class="form-group">     
                            <label class="control-label col-sm-4"><?php echo $this->lang->line('looking_for'); ?></label>
                            <div class="col-sm-8">   
                                <div class="selector">        
                                     <?php echo form_dropdown('looking_for', $looking_for['options'], $looking_for['value'], $looking_for['form_options']); ?>
                                </div>  
                            </div>   
                        </div>     
                        <div class="form-group">   
                            <label class="control-label col-sm-4" for="amount"><?php echo $this->lang->line('age'); ?></label>
                            <div class="col-sm-8">     
                                <?php echo form_input($age); ?>   
                            </div>      
                        </div>    
                        <div class="form-actions">     
                            <button class="btn btn-warning btn-block btn-lg"><?php echo $this->lang->line('start_find_now'); ?></button> 
                            <!--<p><?php echo $this->lang->line('or_use_the_social_network_account_to_start_the_search'); ?></p>
                            <div class="share">
                                <a href="#"><img src="/template/<?php echo $language['path']; ?>/resources/img/ico-fb.png" alt="img"></a>     
                                <a href="#"><img src="/template/<?php echo $language['path']; ?>/resources/img/ico-gg.png" alt="img"></a>   
                                <a href="#"><img src="/template/<?php echo $language['path']; ?>/resources/img/ico-tw.png" alt="img"></a>    
                            </div>-->
                        </div>
                    </form>   
                </div>      
                <div class="col-sm-8 hidden-xs banner-ct">   
                    <div class="banner-intro hidden-sm">   
                        <h2><?php echo $this->lang->line('splash_main_text_1'); ?><br>  
                        <?php echo $this->lang->line('splash_main_text_2'); ?><br> 
                        <span><?php echo $this->lang->line('splash_main_text_bold'); ?></span></h2> 
                    </div> 
                    <div class="banner-img pull-right">   
                        <img src="/template/<?php echo $language['path']; ?>/resources/img/banner.png" alt="ii"/>  
                    </div> 
                </div>
            </div>
        </div><!-- End #header-->
    </div><!-- End #header-->


    <div class="landing-box txt-center landing-moto">
        <div class="container">
            <h1><?php echo $this->lang->line('splash_mid_text_1'); ?>
            
            <span class="txt-red">
			<a href="<?php echo base_url(); ?>register">
			<?php echo $this->lang->line('splash_mid_text_red'); ?></a>  
            
            </span><?php echo $this->lang->line('splash_mid_text_2'); ?></h1>
            <p><?php echo $this->lang->line('splash_mid_text_3'); ?></p>   
        </div>
    </div>

    <div class="landing-box txt-center landing-feature">
        <div class="container"> 
            <div class="col-sm-4">
                <div class="feature-box bg-red">
                    <div class="feature-img">
                        <a href="#"><img src="/template/<?php echo $language['path']; ?>/resources/img/img-3.jpg" alt=""></a>  
                    </div>  
                    <p>
                    	<a href="#"><?php echo $this->lang->line('social_networks'); ?></a>
                    </p> 
                </div> 
            </div>
            <div class="col-sm-4">
                <div class="feature-box bg-red">  
                    <div class="feature-img">
                        <a href="#"><img src="/template/<?php echo $language['path']; ?>/resources/img/img-2.jpg" alt=""></a>
                    </div>  
                    <p>    
                    	<a href="#"><?php echo $this->lang->line('dating'); ?></a>
                    </p>    
                </div>
            </div>
            <div class="col-sm-4">
                <div class="feature-box bg-red">       
                    <div class="feature-img">     
                        <a href="/forums"><img src="/template/<?php echo $language['path']; ?>/resources/img/img-1.jpg" alt=""></a>
                    </div>     
                    <p>
                    	<a href="/forums"> <?php echo $this->lang->line('forum'); ?> </a>
                    </p>    
                </div>   
            </div>   
        </div>
    </div>

    <div class="landing-box">  
        <div class="container"> 
            <div class="row">   
                <div class="col-sm-6 col-md-6">    
                    <div class="content_post">   
                        <p>   
                            <?php echo $this->lang->line('splash_mid_text_4'); ?>   
                        </p>  
                    </div>   
                </div>  
                <div class="col-sm-6 col-md-6">  
                    <div class="img">   
                        <a href="#"><img src="/template/<?php echo $language['path']; ?>/resources/img/img-5.png" alt="ii"/></a>
                    </div>   
                </div> 
            </div>
            <div class="row">  
                <div class="col-sm-12">         
                    <p class="txt-center margin-top-2x">    
						<?php echo $this->lang->line('splash_mid_text_5'); ?>       
					</p>
                </div>
            </div>
        </div>
    </div>
    <div class="landing-box">
        <div class="container">
            <h3 class="txt-red txt-upper txt-bold page-title"><?php echo $this->lang->line('success_label'); ?></h3>
            
            <div id="myCarousel" class="carousel slide">
                <!-- Carousel items -->
                <div class="carousel-inner">
					<?php $i = 1; ?>
                    <?php foreach($success_story as $key=>$story): ?>
                    <?php 
					$item_class = ($i == 1 ) ? 'item active' : 'item'; ?>
                   
                        <div class="<?php echo $item_class; ?>">
                            <div class="item-content">
                                <div class="col-sm-6">
                                    <div class="story-box row">
                                        <div class="col-sm-6">
                                            <div class="story-box-img">
                                                <img src="<?php echo $story['image'];?>"  alt="ii" style="width:270px !important; height:170px; !important" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="story-box-info">
                                                <?php echo $story['description'];?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
							</div>
                    	</div>
                    
                    <?php $i++; ?>
                    <?php endforeach; ?>
  				</div>
                <!--/carousel-inner--> 
                <a class="left carousel-control" href="#myCarousel" data-slide="prev"><i class="fa fa-arrow-circle-left fa-4 txt-red"></i></a>

                <a class="right carousel-control" href="#myCarousel" data-slide="next"><i class="fa fa-arrow-circle-right fa-4 txt-red"></i></a>
            </div>
        
        </div>
    </div>


	<div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <ul class="footer-links">
                        <li><a href="#"><?php echo $this->lang->line('about_us'); ?> </a></li>
                        <li><a href="#"><?php echo $this->lang->line('privacy_terms'); ?> </a></li>
                        <li><a href="#"><?php echo $this->lang->line('faq'); ?> </a></li>
                        <li><a href="#"><?php echo $this->lang->line('invite_a_friend'); ?> </a></li>
                        <li><a href="#"><?php echo $this->lang->line('contact_us'); ?> </a></li>
                        <li><a href="#"><?php echo $this->lang->line('bookmark'); ?> </a></li>
                        <li><a href="#"><?php echo $this->lang->line('language_en'); ?> </a></li>
                    </ul>
                </div>
                <div class="col-sm-4">  
                    <div class="copyright">               
                        <p><?php echo $this->lang->line('copyright'); ?></p>           
                    </div>
                </div>
            </div>
        </div>
    </div><!-- End #footer -->

    <div class="modal fade" id="modal-login">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>  
            <h4 class="txt-red txt-upper"><i class="fa fa-user"></i> <span><?php echo $this->lang->line('member_login');?></span></h4>
          </div>
           
          <div class="modal-body">
            <form class="frm-login form-horizontal" action="/auth/login" method="post">
               <input type="hidden" name="location" value="<?php if(isset($_GET['location'])){ echo htmlspecialchars($_GET['location']); } ?>" />
                <div class="form-group">
                    <label class="col-sm-2 control-label col-sm-offset-2"><?php echo $this->lang->line('username');?></label>
                    <div class="col-sm-6">
                    <input type="text" class="form-control" name="identity" placeholder="Username " required></div>
                </div>
                <div class="form-group">    
                    <label class="col-sm-2 control-label col-sm-offset-2"><?php echo $this->lang->line('password');?></label>
                    <div class="col-sm-6">  
                    <input type="password" class="form-control" name="password" placeholder="Password " required></div>
                </div>
                <div class="form-group">   
                    <label class="col-sm-4 col-sm-offset-2 checkbox-inline">
                        <input type="checkbox">
                        <?php echo $this->lang->line('remember_me'); ?>
                    </label>   
                    <div class="col-sm-4">    
                        <input type="submit" class="btn btn-lg btn-danger pull-right" value="login">
                    </div>
                </div>
            </form>   
          </div>    
          
          <div class="modal-footer">     
                <p class="txt-center">      
                    <a href="<?php echo site_url('register'); ?>"><?php echo $this->lang->line('join_now'); ?></a>
                    &#160;&#160;&#160;&#160;&#160;&#160;
                    &#160;&#160;&#160;&#160;&#160;&#160;
                    
                    &#160;&#160;&#160;&#160;&#160;&#160;
                    &#160;&#160;&#160;&#160;&#160;&#160;
                    <a href="/auth/forgot_password"><?php echo $this->lang->line('forgot_your_password'); ?></a>
                </p>   
          </div>
        </div>    
      </div>   
    </div>     

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="/template/<?php echo $language['path'];?>/resources/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/template/<?php echo $language['path'];?>/resources/js/datepicker.js"></script>
    <script type="text/javascript" src="/template/<?php echo $language['path'];?>/resources/js/ion.rangeSlider.min.js"></script>
    <script type="text/javascript" src="/template/<?php echo $language['path'];?>/resources/js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="/template/<?php echo $language['path'];?>/resources/js/ckeditor.js"></script>
    <script type="text/javascript" src="/template/<?php echo $language['path'];?>/resources/js/adapters/jquery.js"></script>
    <script type="text/javascript" src="/template/<?php echo $language['path'];?>/resources/js/main.js"></script>
    <script type="text/javascript">
		$(document).ready(function(){
			<?php
			if(isset($age_between_array)&&is_array($age_between_array)){ 
			?>
			$("#age-slider").ionRangeSlider({ 
				from: <?php echo $age_between_array[0]; ?>,     
				to: <?php echo $age_between_array[1]; ?>, 
				type: "double",          
				step: 1,
				hideMinMax: true,            
				postfix: ""
			});
			<?php
			}    
			?>
		});
    </script>
    
    
	<script>
    $(document).ready(function() {
        $('#myCarousel').carousel({
        interval: 0,
        })
        
		$('#myCarousel').on('slid.bs.carousel', function() {
        });
    });
    
    $('.carousel .item').each(function(){
      var next = $(this).next();
      if (!next.length) {
        next = $(this).siblings(':first');
      }
      next.find('.item-content:first-child').clone().appendTo($(this));
    });
    
    </script>      
    <style>    
    .carousel-control{ padding: 5%; color:#333333;}
	.fa-arrow-circle-left:before,.fa-arrow-circle-right:before{ color:#000;}
    .carousel-control.left,.carousel-control.right {background-image:none;}
    </style>
  </body>     
</html>