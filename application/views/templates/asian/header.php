<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?php echo @$description; ?>">
        <meta name="author" content="">
        <title><?php echo @$title; ?></title> 
		<!-- Favicon -->
        <link rel="shortcut icon" href="<?php echo base_url(); ?>template/asian/uploads/fav.ico?v=<?php echo time() ?>">
       
        <!-- Bootstrap core CSS -->
        <link href="/template/asian/resources/css/bootstrap.min.css" rel="stylesheet"> 
        <link href="/template/asian/resources/css/stylesheet.css" rel="stylesheet" type="text/css"> 
        <link href="/template/asian/resources/css/stylesheet-reponsive.css" rel="stylesheet" type="text/css">  
        <link href="/template/asian/resources/css/jquery.toastmessage.css" rel="stylesheet" type="text/css">  
        <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">  
        <link href="<?php echo base_url(); ?>js_image/css/vasplus_programming_blog_footer_contact.css" rel="stylesheet">  
		<link href="/template/asian/resources/js/jquery-ui-1.11.0/jquery-ui.css" rel="stylesheet">

		<!--Custom css-->
        <link href="<?php echo base_url();?>resources/css/custom.css" rel="stylesheet">
        
        <!-- Upload Manager CSS -->   
        <link rel="stylesheet" href="/template/asian/resources/css/upload/blueimp-gallery.min.css">
        <link rel="stylesheet" href="/template/asian/resources/css/upload/jquery.fileupload.css">
        <link rel="stylesheet" href="/template/asian/resources/css/upload/jquery.fileupload-ui.css">
        <noscript>
        <link rel="stylesheet" href="/template/asian/resources/css/upload/jquery.fileupload-noscript.css"> 
        </noscript> 
        <noscript> 
        <link rel="stylesheet" href="/template/asian/resources/css/upload/jquery.fileupload-ui-noscript.css"> 
        </noscript>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries --> 
        <!--[if lt IE 9]> 
              <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script> 
              <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>  
            <![endif]-->
    </head>
    
    <body onLoad="changeTheme();" class="main-wrap<?php
    if (substr($_SERVER['REQUEST_URI'], 0, 6) == '/forum')
    {
        echo 'forum-wrap';   
    }
    ?>" >
        <div class="toolbar">  
            <div class="container"> 
                <div class="col-sm-3">        
                    <div class="logo pull-left">
                        <a href="<?php echo base_url();?>"> <img src="/template/asian/resources/img/logo-red.png" alt="logo"/> </a>
                    </div>
                    <div class="language pull-left">
                        <a href="#" class="active"><img src="/template/asian/resources/img/flag-eg.png" alt="img"/></a>
                        <a href="#"><img src="/template/asian/resources/img/flag-vn.png" alt="img"/></a>
                        <a href="#"><img src="/template/asian/resources/img/flag-gra.png" alt="img"/></a> </div>
                </div>
          <div class="col-sm-6">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <i class="fa fa-bars"></i> </button>
                    <div class="navbar-collapse collapse">
                        <div class="navigation clearfix">
                            <?php
                            if (@isset($this->session->userdata['user_id']))
                            {
                              ?>
                                <ul class="clearfix">
                                    <li><a <?php
                                        if (substr($_SERVER['REQUEST_URI'], 0, 5) == '/mail')
                                        {
                                            echo ' class="active"';
                                        }
                                        ?>href="/mail"><?php echo $this->lang->line('mail'); ?> </a></li>
                                   <?php /*?> li><a <?php
                                    if (substr($_SERVER['REQUEST_URI'], 0, 5) == '/list')
                                    {
                                        echo ' class="active"';
                                    }
                                    ?>href="#"><?php echo $this->lang->line('list'); ?> </a></li<?php */?>
                                    <?php /*?><li><a <?php
                                        if (substr($_SERVER['REQUEST_URI'], 0, 7) == '/search')
                                        {
                                            echo ' class="active"';
                                        }
                                        ?>href="/search_result"><?php echo $this->lang->line('search'); ?> </a>
                                    </li><?php */?>
                                    <li>
                                    	<a <?php
                                                        if (substr($_SERVER['REQUEST_URI'], 0, 7) == '/search')
                                                        {
                                                            echo ' class="active"';
                                                        }
                                                        ?>href="/search/advancesearch"><?php echo $this->lang->line('search'); ?> </a>
                                    	<?php /*?><?php if($advancesearch_donation > 0)
												{
													?>
                                                    <a <?php
                                                        if (substr($_SERVER['REQUEST_URI'], 0, 7) == '/search')
                                                        {
                                                            echo ' class="active"';
                                                        }
                                                        ?>href="/search/advancesearch"><?php echo $this->lang->line('search'); ?> </a>
                                    					<?
												}else{
                                                ?>
													 <a <?php 
                                                        if (substr($_SERVER['REQUEST_URI'], 0, 7) == '/search')
                                                        {
                                                            echo ' class="active"';
                                                        }
                                                        ?>href="#modal-advancesearchdon"  data-toggle="modal"><?php echo $this->lang->line('search'); ?> </a>
												<?php
                                                }
												?><?php */?>
                                    </li>
                                    
                                    <li><a <?php
                                        if ($_SERVER['REQUEST_URI'] == '/profile')
                                        {
                                            echo ' class="active"';
                                        }
                                        ?> href="/profile"><?php echo $this->lang->line('profile'); ?> </a>
                                    </li>
                                    <?php /*?>li><a <?php
                                    if (substr($_SERVER['REQUEST_URI'], 0, 16) == '/profile_manager')
                                    { 
                                         echo 'class="active"';
                                    }      
                                    ?> href="/profile_manager"><?php echo $this->lang->line('profile_manager'); ?> </a></li<?php */?>
                                   
                                    <li><a <?php
                                        if (substr($_SERVER['REQUEST_URI'], 0, 6) == '/forum')
                                        {
                                            echo ' class="active"';
                                        }
                                        ?>href="/forum"><?php echo $this->lang->line('forum'); ?> </a>
                                    </li>
                                    
                                    <li><a <?php
                                        if (substr($_SERVER['REQUEST_URI'], 0, 6) == '/store')
                                        {
                                            echo ' class="active"';
                                        }
                                        ?>href="/store"><?php echo $this->lang->line('store'); ?> </a>
                                    </li>
                                    
									<?php /*?>li><a <?php
                                    if (substr($_SERVER['REQUEST_URI'], 0, 5) == '/plus')
                                    {
                                        echo ' class="active"';
                                    }
                                    ?>href="#"><?php echo $this->lang->line('plus'); ?> </a></li<?php */?>
                                    
                                   <?php /*?> <li class="dropdown"><a <?php 
                                        if (substr($_SERVER['REQUEST_URI'], 0, 8) == '/setting')
                                        {
                                            echo ' class="active"';
                                        }
                                        ?>href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->lang->line('setting'); ?> <b class="caret"></b> </a>
                                       	<ul class="dropdown-menu">
                                       		 <li><a href="<?php echo base_url('settings/'); ?>"><?php echo $this->lang->line('manage_templates');?></a></li>
                                      	</ul>
                                    </li><?php */?>
                                    
                                     <li><a <?php
                                       if (substr($_SERVER['REQUEST_URI'], 0, 8) == '/setting')
                                        {
                                            echo ' class="active"';
                                        }
                                        ?>href="<?php echo base_url('settings/'); ?>"><?php echo $this->lang->line('manage_templates');?></a>
                                    </li>
                                    
                                   
                                    
                                    <?php /*?><li><a <?php
                                        if (substr($_SERVER['REQUEST_URI'], 0, 8) == '/donation')
                                        {
                                            echo ' class="active"';
                                        }
                                        ?>href="/checkout/donation"><?php echo $this->lang->line('donation'); ?> </a></li><?php */?>
                                </ul>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
        <?php 
                if (isset($this->session->userdata['identity']))
                {
                    ?>
                    <div class="col-sm-3">
                        <div class="loggedin pull-right">
                            <span class="toolbar-avatar"> 
                                 <?php 
								 if($users['avatar'] == '')
									{
										if($profile['gender'] == 'm')
										{
											?>
                                            <img class="media-object img-circle" src="/resources/img/avatar-blank.png" alt="" width="80" height="80"/>
											<?php	
										}else{
											?>
											<img class="media-object img-circle" src="/resources/img/no_profile_female.jpg" alt="" width="80" height="80">
											<?php
										}
									}else{
										?>
                                		<img  src="/uploads/profile/thumbnail/<?php echo $users['avatar'];?>" >
                           			<?php } ?>
                            </span> 
                            <a href="#" class="btn btn-link dropdown-toggle btn-sm" data-toggle="dropdown">Hello,
                                <span class="<?php
                                if (substr($_SERVER['REQUEST_URI'], 0, 6) == '/forum')
                                {
                                    echo 'txt-orange';
                                } else
                                {
                                    echo 'txt-red';
                                }
                                ?>"><?php echo ucfirst($this->session->userdata['first_name']) . ' ' .ucfirst($this->session->userdata['last_name']); ?></span> <span class="caret"></span>                            
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="/profile_manager"><i class="fa fa-cog"></i> <?php echo $this->lang->line('profile_manager'); ?></a></li>
                                <li><a href="/profile"><i class="fa fa-user"></i> <?php echo $this->lang->line('profile'); ?></a></li>
                                <li><a href="/auth/logout" class="btn btn-danger btn-block"><?php echo $this->lang->line('logout'); ?></a></li>
                            </ul>
                        </div>
                    </div>
        <?php
                } else
                {
                    ?>
                    <div class="col-sm-3">
                        <div class="login btn-group pull-right">
                            <a class="btn btn-default btn-login" href="#modal-login" data-toggle="modal"> <i class="fa fa-user"></i> <span><?php echo $this->lang->line('login'); ?></span> </a>
                            <a class="btn btn-danger btn-register" href="/register"> <i class="fa fa-arrow-circle-o-right"></i> <span><?php echo $this->lang->line('register'); ?></span> </a>                        
                    	</div>
                    </div>
              <?php
                }
                ?>
            </div>
        </div>
       <?php /*?> <?php if ($this->session->userdata('user_id')): ?> 
                    
        
       				 <!-- Modal --> 
                    <?php    
					if($donate_user == '')
					 //if(empty($donate_user))
                        {   ?>
                       		 <button class="btn btn-primary btn-lg" style="display:none;" id="donate" data-toggle="modal" data-target="#myModal"> <?php echo $this->lang->line('launch_demo_modal'); ?> </button>
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content"> 
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
                                            <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('want_to_donate_title'); ?></h4>
                                        </div>
                                        <div class="modal-body">
                                            <p><?php echo $this->lang->line('donate_money_txt'); ?></p> 
                                            <p><?php echo $this->lang->line('get_avaolable_services'); ?></p>  
                                            <div align="center">
                                                <a href="<?php echo site_url('checkout/donation'); ?>"><img src="<?php echo base_url() ?>uploads/id/donate.png"></a>                                    </div>
                                        </div>
                                    </div>
                                </div>
                             </div>
                    <?php }?>
        <?php endif; ?><?php */?>
<?php if($this->session->userdata('user_id')):
			if($donate_user == '')
			{
		 		?>
                <button class="btn btn-primary btn-lg" style="display:none;" id="donate" data-toggle="modal" data-target="#myModal"><?php echo $this->lang->line('launch_demo_modal'); ?></button>

                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('want_to_donate_title');?></h4>
                      </div>
                      <div class="modal-body">
                        <p><?php echo $this->lang->line('donate_money_txt');?></p>
                        <p><?php echo $this->lang->line('get_avaolable_services')?></p>
                        <div align="center"><a href="<?php echo site_url('checkout/donation'); ?>"><img src="<?php echo base_url() ?>uploads/id/donate.png"></a></div>
                      </div>
                    </div>
                  </div>
                </div>
				<?php 
			}?>
<?php endif; ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js">
</script> 
<script type="text/javascript"> 
<?php  
	$allowed = allow_donate();
	$lTime = $this->session->userdata('model_time');
	$last_time = (!$lTime) ? time() : $lTime;
	$diff = (time() - $last_time);
	//echo $allowed;
	$duration = donation_timer();
	$duration = ($duration == 0) ? 210 : $duration;
	
	if ($allowed == TRUE && ($lTime == FALSE or $diff >= $duration))
	{
		//echo $duration; die;
	?>
		$(document).ready(function(){
			function myfunc() {
				$('#donate').click();
				$('#myModal').modal();
			}
			myfunc();
			setInterval(function(){
				myfunc();
			}, <?php echo($duration * 1000); ?>);
			//setTimeout(myfunc(), 210000)
		});
	<?php
		$this->session->set_userdata('model_time', time());
	} //if ends
?>
</script>
<script type="text/javascript">
function changeTheme()
{
    var e = document.getElementById("group_id");
	
    var theme = e.options[e.selectedIndex].value;
	
    document.getElementById("shelf").style.backgroundImage = "url(" + theme + ")";

}
</script> 


<!------------------------------------------ Popup/Chat box footer ------------------------------------------------>

<?php if(isset($this->session->userdata['user_id'])) { ?>
	<div class="vasplus_programming_blog_bottom" style="border: 0px solid; display: none; width: 480px !important;">
		<div class="bg-red" style="padding: 8px;" onClick="vpb_leave_a_message_hide();">
			<div class="col-sm-11" style="border: 0px solid; width: 97% !important; padding-left: 0px !important;">
				<div style="float: left; border: 0px solid; width: 200px !important;">
					<i class="fa fa-user"></i>&nbsp;<span class="txt-upper">Search Users</span>
				</div>

				<div style="float: left; border: 0px solid; width: 140px !important;">
					<i class="fa fa-user"></i>&nbsp;&nbsp;<span class="txt-upper"><?php echo $this->lang->line('user_list'); ?></span>
				</div>
			</div>
			<div><a href="javascript:void(o);" onClick="vpb_leave_a_message_hide();"><font color="#000000">X</font></a></div>
		</div>

		<div id="vasplus_programming_blog_mailer_status" align="left"></div>

		<div style="float: left; border: 0px solid #000; width: 210px;">
			<form name="user_search_form" id="user_search_form" method="post">
				<table border="0" height="260" style="margin-left: 8px; margin-top: 8px; margin-bottom: 10px;">
					<tr>
						<td id="whos_online_column">
							Who is online? <?php echo $online_users_arr['male_count']; ?> male <?php echo $online_users_arr['female_count']; ?> female
						</td>
					</tr>

					<tr>
						<td>
							<?php $interest = array('' => 'Any', 'm' => 'Who is interested in me', 'f' => 'I am interested in them'); ?>
							<?php echo form_dropdown('interest', $interest, '', 'id="interest", class="form-control filters"'); ?>
						</td>
					</tr>

					<tr>
						<td>
							<?php $gender = array('' => 'Any', 'm' => 'Male', 'f' => 'Female'); ?>
							<?php echo form_dropdown('gender', $gender, '', 'id="gender", class="form-control filters"'); ?>
						</td>
					</tr>

					<tr>
						<td>
							<?php //$age = array('Any Age') + array_combine(range(18, 99), range(18, 99)); ?>
							<?php //echo form_dropdown('age', $age, '', 'id="age", class="form-control filters"'); ?>
							<select name="age" class="form-control filters">
								<option value="">Any</option>
								<?php foreach($age_arr as $age) { ?>
									<option value="<?php echo $age['age']; ?>"><?php echo $age['age']; ?> <?php if($age['users_count'] > 0) { ?> (<?php  echo $age['users_count']; ?>) <?php } ?></option>
								<?php } ?>
							</select>
						</td>
					</tr>

					<tr>
						<td>
							<?php $countries[''] = 'Any'; ?>
							<?php echo form_dropdown('country', $countries, '', 'id="country2", class="form-control filters"'); ?>
						</td>
					</tr>

					<tr>
						<td id="divState2">
							<select class="form-control" name="state_province">
								<option value=""><?php echo $this->lang->line('select_state'); ?></option>
							</select>
						</td>
					</tr>

					<tr>
						<td id="divCity2">
							<select class="form-control" name="city">
								<option value=""><?php echo $this->lang->line('select_city'); ?></option>
							</select>
						</td>
					</tr>
				</table>
			</form>
		</div>

		<div style="float: left; border: 0px solid #000; width: 240px; padding-top: 8px;" id="load_div">
		<?php
			foreach($login_user as $value)
			{
				if($users[$value['id']]['invisible_status'] == '0')
				{
					if($users[$value['id']]['block_user'] != $value['id'])
					{
						?>
						<div class="media">
							<?php if($users['donate_user'] == '') { ?>
								<a class="pull-left avatar-sm" href="JavaScript: void(0)" onClick="$('#donate').click();">
							<?php } else { ?>
								<a class="pull-left avatar-sm" href="/profile/user/<?php echo $value['id']; ?>">
							<?php } ?>
									<img class="media-object" src="/uploads/profile/thumbnail/<?php echo $users[$value['id']]['avatar']; ?>" alt="...">
							</a>

							<div class="media-body">
								<h3 class="media-heading">
									<?php if($users['donate_user'] == '') { ?>
										<a href="JavaScript: void(0)" onClick="$('#donate').click();"><?php echo $value['first_name'].' '. $value['last_name']; ?></a>
									<?php } else { ?>
										<a href="/profile/user/<?php echo $value['id']; ?>"><?php echo $value['first_name'].' '. $value['last_name']; ?></a>
									<?php } ?>
									&nbsp;&nbsp;

									<?php if($users[$value['id']]['busy_status'] != '0') { ?>
										<i class="fa fa-circle txt-red"></i>
									<?php } ?>

									<?php if($users[$value['id']]['available_status'] != '0') { ?>
										<i class="fa fa-circle txt-green"></i>
									<?php } ?>
								</h3>
							</div>
						</div>
						<?php
					}
				}
			}
		?>
		</div>

		<br clear="all" />

	</div>

	<div id="vasplus_programming_blog_bottom" class="bg-red reg-none" style="cursor:pointer;" onClick="vpb_leave_a_message_show();"> 
		<span id="vpv_tooltip_image"></span>
		<div id="vpb_leave_a_message_click">
			<div id="vpb_left_icons"></div>
			<div id="vpb_left_content"><?php echo $this->lang->line('whoisonline'); ?></div>
		</div>
	</div>

	<script>
		function accordion(id) {
			//jQuery('.common').hide();
			jQuery('.c'+id).slideToggle("slow");
		}
	</script>

<?php } ?>

<script type="text/javascript">
	/*setInterval(function() {
		$("#load_div").load(location.href+" #load_div>*", "");
	}, 10000);*/

	setInterval(function() {
		$.post('<?php echo site_url(); ?>profile/getOnlineUsers/', $('#user_search_form').serialize(), function(r) {
			$('#load_div').html(r);
		});

		$.post('<?php echo site_url(); ?>profile/getOnlineUsersCount/', function(r) {
			$('#whos_online_column').html(r);
		});
	}, 10000);

	$(document).ready(function() {

		$("#country2").on("change", function() {
			var country_id = $("#country2").val();
			$.ajax({
				type: "POST",
				url: "<?php echo site_url(); ?>register/get_state/",
				data: "county_id="+country_id,
				success: function(data) {
					$('#divState2').html(data);
				}
			});
		});

		$("#divState2").on("change", function() {
			var state_id = $("#state").val();
			var country_id = $("#country2").val();
			$.ajax({
				type: "POST",
				url: "<?php echo site_url(); ?>register/get_city/",
				data: {state_id : state_id, country_id : country_id},
				success: function(data) {
					$('#divCity2').html(data);
				}
			});
		});

		$(".filters").on("change", function() {
			$.post('<?php echo site_url(); ?>profile/getOnlineUsers/', $('#user_search_form').serialize(), function(r) {
				$('#load_div').html(r);
			});

			$.post('<?php echo site_url(); ?>profile/getOnlineUsersCount/', function(r) {
				$('#whos_online_column').html(r);
			});
		});
	});
</script>

<!-------------------------------------------------------------------------------------------------------------->