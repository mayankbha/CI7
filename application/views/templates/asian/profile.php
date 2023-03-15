<?php /*?><?php 
$from = "ujjain";
$to = "indore";
$from = urlencode($from);
$to = urlencode($to);
$data = file_get_contents("http://maps.googleapis.com/maps/api/distancematrix/json?origins=$from&destinations=$to&language=en-EN&sensor=false");
$data = json_decode($data);
//echo "<pre>";print_r($data);
$time = 0;
$distance = 0;
foreach($data->rows[0]->elements as $road) {
    $time += $road->duration->value;
    $distance += $road->distance->value;
}
echo "To: ".$data->destination_addresses[0];
echo "<br/>";
echo "From: ".$data->origin_addresses[0];
echo "<br/>";
echo "Time: ".$time." seconds";
echo "<br/>";
echo "Distance: ".$distance." meters";
?>
<?php */?>

<?php //error_reporting(0);

	/*$url = "http://maps.googleapis.com/maps/api/geocode/json?address=".urlencode(456010)."&amp;sensor=false";
    $result_string = file_get_contents($url);
   
    $result = json_decode($result_string, true);
    $result1[] = $result['results'][0];
    $result2[] = $result1[0]['geometry'];
    $result3[] = $result2[0]['location'];
    print_r($result2[0]);
	die;
	*/
	
	$gender = array('m' => 'Male', 'f' => 'Female');
?>


<!--<form id="form1" runat="server">
<div>
    <script type="text/javascript" src="http://j.maxmind.com/app/geoip.js" ></script>
    <br />Country Code:
    <script type="text/javascript">document.write(geoip_country_code());</script>
    <br />Country Name:
    <script type="text/javascript">document.write(geoip_country_name());</script>
    <br />City:
    <script type="text/javascript">document.write(geoip_city());</script>
    <br />Region:
    <script type="text/javascript">document.write(geoip_region());</script>
    <br />Region Name:
    <script type="text/javascript">document.write(geoip_region_name());</script>
    <br />Latitude:
    <script type="text/javascript">document.write(geoip_latitude());</script>
    <br />Longitude:
    <script type="text/javascript">document.write(geoip_longitude());</script>
    <br />Postal Code:
    <script type="text/javascript">document.write(geoip_postal_code());</script>

</div>
</form>-->


<!-- MAIN CONTENT -->
<div class="content-box">
    <section class="container">
        <div class="row">
            <ol class="breadcrumb">
                <li><i class="fa fa-user fa-2x icon-round-border"></i></li>
                <li class="active"><span> <?php echo $this->lang->line('profile_member'); ?> </span></li>
            </ol>
        </div>
        
        <!-- /BREADCRUMB/ -->
        
        <div class="box gray-bg">
            <div class="row">
                <div class="col-sm-4">
                    <div class="content-box-border">
                        <div class="box-title bg-red">
                            <span class="txt-upper txt-bold"><?php echo $profile['first_name'] . ' ' . $profile['last_name']; ?></span> 
                            <small class="badge pull-right"> <?php echo $this->lang->line('standard_member'); ?></small>
                        </div>

                        <div class="box-ct clearfix" id="">
                            <div class="member-avatar pull-left">
                            <?php if($users['avatar'] == '')
								{
									if($profile['gender'] == 'm')
											{
												?>
												<img class="media-object img-circle" src="/resources/img/avatar-blank.png" alt="" width="110" height="110">
												<?php	
											}else{
												?>
												<img class="media-object img-circle" src="/resources/img/no_profile_female.jpg" alt="" width="110" height="110">
												<?php
											}
									}else{
								?>
                                <a href=""><img  src="/uploads/profile/<?php echo $users['avatar'];?>" ></a>
                            <?php } ?>
                            </div>
                            <p>
                                <strong>Profile Status<?php //echo $this->lang->line('profile_status'); ?></strong><br>
                                <span class="label label-warning txt-upper"><i class="fa fa-circle"></i> Visible </span>
                            </p>
                            <p>
                                <strong> Online Status </strong><br>
                                <span id="autoloaddiv"> &nbsp; </span>
                                <?php 
								//echo $login_status->available;die;
									foreach($login_status as $status)
									{
										if($status['available'] != '0')
											{
												?>
                                               <span id="autohidediv"><i class="fa fa-circle txt-green"></i>  </span>
                                                <select name="login_status" id="login_status">
                                                    <option value="Available" selected="selected">Available</option>
                                                    <option value="Busy">Busy</option>
                                                    <option value="Invisible">Invisible</option>
                                                 </select>
                                                <?php  
											}
											if($status['busy'] != '0')
											{
												?>
                                              <span id="autohidediv"><i class="fa fa-circle txt-red"></i>  </span>
                                                <select name="login_status" id="login_status">
                                                	<option value="Available">Available</option>
                                                    <option value="Busy" selected="selected">Busy</option>
                                                    <option value="Invisible">Invisible</option>
                                                 </select>
                                                <?php 
											}
											if($status['invisible'] != '0')
											{
												?>
                                                <span id="autohidediv"><i class="fa fa-circle"></i>  </span>
                                                <select name="login_status" id="login_status">
                                                	<option value="Available">Available</option>
                                                	<option value="Busy">Busy</option>
                                                    <option value="Invisible" selected="selected">Invisible</option>
                                                </select>
                                                <?php 
											}
									} ?>
                            </p>
                        </div>
                        <div class="box-ct">
                            <div class="box-ct-meta">
                                <h5 class="clearfix"> Your profile is <?php echo $profile_complete.'%';?> completion <small class="pull-right"><a href="/profile_manager"> <?php echo $this->lang->line('editprofile'); ?></a></small></h5>

                                <div class="progress progress-striped active">
                                    <div class="progress-bar progress-bar-success"  role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $profile_complete.'%';?>">
                                        <span class="sr-only"> <?php echo $profile_complete.'%';?> Complete </span>
                                    </div>
                                </div>
                            </div>
                            Complete your profile and be found more often in Searches

                            <ul class="list-links">
                                <li><?php if($match == ''){ ?><a href="/profile_manager">+ Add Matching Detail to your Resume (+14%) </a><? } ?></li>
                                <li><?php if($profile_comp == ''){ ?><a href="/profile_manager">+ Add Matching Detail to your Resume (+14%) </a><? } ?></li>
                                <li><?php if($interest == ''){ ?><a href="/profile_manager">+ Add Interest to your Resume (+14%) </a><? } ?></li>
                                <li><?php if($profile_verify == ''){ ?><a href="/profile_manager">+ Add Verification documents to your Resume (+14%) </a><? }?></li>
                                <li><?php if($questions == ''){ ?><a href="/profile_manager">+ Add questions to your Resume (+14%) </a><? } ?></li>
                                <li><?php if($get_personality_comp == ''){ ?><a href="/profile_manager">+ Add Personality details to your Resume (+16%) </a><? } ?></li>
                                <li><?php if($photo == ''){?><a href="/profile_manager">+ Add Profile Picture to your Resume (+14%) </a><? } ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="content-box-border">
                        <h4 class="box-title clearfix bg-red"> 
                            <i class="fa fa-search"></i>
                            <span class="txt-upper" > <?php echo $this->lang->line('search_profile'); ?> </span>
                            <small class="pull-right"><a href="<?php echo base_url('search/advancesearch'); ?>"> <?php echo $this->lang->line('advanced_search'); ?> </a></small>
                        </h4>
                        <div class="box-ct">
                            <form class="form-horizontal" method="POST" action="<?php echo site_url('search'); ?>">
                                <?php /*?><div class="form-group">
                                    <label class="col-sm-3 control-label"> <?php echo $this->lang->line('iam_profile');?> </label>
                                    <div class="col-sm-4">
                                     <?php echo $gender[$profile['gender']]; ?>
                                    </div>
                                </div><?php */?>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo lang('loogin_for'); ?></label>
                                    <div class="col-sm-4">
                                    	 <select class="form-control" id="looking_for" name="looking_for">
                                         
										   <?php if($getlooking_for == 'f'){ ?>
                                                    <option value="female" selected="selected">Female</option>
                                                    <option value="male">Male</option>
                                            <?php }else{ ?>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                    
                                            <?php }?>
                                        </select>
                                        <?php //echo form_dropdown('looking_for', $looking_for['options'], $looking_for['value'], $looking_for['form_options']); ?>	
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo lang('age'); ?></label>
                                    <div class="col-sm-3">
                                        <?php 
                                           // $age_arr =  array(lang('select')) + array_combine(range(18, 99), range(18, 99));
											$age_arr_min =  array_combine(range(18, 99), range(18, 99));
											$age_arr_max =  array_combine(range(99, 18), range(99, 18));
                                        ?>
                                        <?php echo form_dropdown('min_age', $age_arr_min, '', 'class="form-control"'); ?>
                                    </div>
                                    <label class="col-sm-1 control-label"> to </label>
                                    <div class="col-sm-3">
                                        <?php echo form_dropdown('max_age', $age_arr_max, '', 'class="form-control"'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo lang('country') ?></label>   
                                    <div class="col-sm-8">
                                        <?php array_unshift($countries, lang('selecect_country')); // = lang('selecect_country'); ?>   
                                        <?php echo form_dropdown('country', $countries, '#', 'id="country", class="form-control"'); ?>  
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo lang('state') ?></label>
                                    <div class="col-sm-8" id="divState">
                                        <select class="form-control" name="state_province">  
                                            <option value=""><?php echo $this->lang->line('select_state'); ?></option>   
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                  	<label for="city" class="col-sm-3 control-label"><?php echo $this->lang->line('reg_city'); ?></label>
                                  	<div id="divCity" class="col-sm-8">
                                    	<select class="form-control" name="city">
                                      		<option value=""><?php echo $this->lang->line('select_city'); ?></option>
                                    	</select>
                                  	</div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo lang('within') ?></label>
                                    <div class="col-sm-3">
                                        <select class="form-control" name="within">
                                        	<option value="">Any</option>
                                        	<option value="5">5</option>
                                        	<option value="20">20</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                            <option value="250">250</option>
                                            <option value="500">500</option>
                                        </select>
                                    </div>
                                    <label class="col-sm-3 control-label"><?php echo lang('within_area') ?></label>
                                   
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo lang('photo') ?></label>
                                    <div class="col-sm-6">
                                        <div class="checkbox-inline">
                                            <input type="checkbox" name="profile_pic" value="1"> <?php echo lang('photo_text') ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <button class="btn btn-danger btn-block" type="submit"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!--<label class="col-sm-3 control-label"><?php echo lang('last_active') ?></label>-->
                                    <div class="col-sm-5">
                                        <!--<select class="form-control"><option>1 hour</option></select>-->
                                    </div>
                                    <div class="col-sm-3">
                                        <!--<button type="submit" class="btn btn-danger btn-block"><i class="fa fa-search"></i></button>-->
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="content-box-border">
                        <h4 class="box-title bg-red">
                            <i class="fa fa-bullhorn"></i>
                            <span class="txt-upper"> <?php echo $this->lang->line('recent_activity'); ?> </span>
                        </h4>
                        <div class="box-ct">
                            <div class="activity-list">
                                <!--<a href="#warning_profile" data-toggle="modal">
                                    <i class="fa fa-comments"></i>
                                    <span> <?php echo $count_warning_message; ?> News Messenger </span>
                                </a>-->
                                <a href="/profile/message" data-toggle="modal">
                                    <i class="fa fa-comments"></i>
                                    <span> <?php echo $count_warning_message; ?> New Messages </span>
                                </a>
                                <a href="#like_profile"  data-toggle="modal">
                                    <i class="fa fa-star"></i>
                                    <span> <?php echo $send_like; ?>  New Interests (or Likes) </span>
                                </a>
                                <a href="#heart_profile" data-toggle="modal">
                                    <i class="fa fa-heart"></i>
                                    <span> <?php echo $send_heart; ?> New Hearts</span>
                                </a>
                                <a href="#fav_profile" data-toggle="modal">
                                    <i class="fa fa-user"></i>
                                    <span> <?php echo $count_fav_members; ?> New Favourites</span>
                                </a>
                            </div>
                        </div>
                        <div class="box-ct-meta">
                            <!--<h4 class="txt-red"><?php echo $this->lang->line('get_more_attention'); ?></h4>-->
                            <p>That's the basics of the interface for now. I'm thinking we can improve the default landing page that users see when the login. We want to show them different things to do from the site: shopping, hot forum topics, featured (premium) members, articles, promos, etc... In this way the get to explore the site more and we get a better chance at retaining users.<br />
</p>
                            <?php /*?><p> Upgrading you membership will give you more exposure by ranking you above free members. <br></p> <?php */?>
                            <p><a href="#" class="btn btn-block btn-success btn-lg">UPGRADE NOW</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<div class="content-box-border">
   	<div class="box-title bg-red txt-upper"><?php echo $this->lang->line('newest_Members'); ?> </div>
    <div class="member-slider">
    <?php foreach($newest_member as $new_member)
		{
			if($new_member['id'] != $this->session->userdata['user_id'])
			{
			?>    
			<div class="content-box-border clearfix member-box"> 
				<div class="member-avatar pull-left">
				   <?php if($users[$new_member['id']]['avatar'] == '')
					{
						if($new_member['gender'] == 'm')
						{
							?>
							<img class="media-object img-circle" src="/resources/img/avatar-blank.png" alt="" width="110" height="110">
							<?php	
						}else{
							?>
							<img class="media-object img-circle" src="/resources/img/no_profile_female.jpg" alt="" width="110" height="110">
							<?php
						}
					   
					}else{
							?><img class="media-object img-circle" src="/uploads/profile/thumbnail/<?php echo $users[$new_member['id']]['avatar'];?>" width="110" height="110">
						  <?php 
					} ?>
				</div> 
				
				<div class="clearfix"></div>
				
				<p class="member-id"><a href="/profile/user/<?php echo $new_member['id']; ?>" data-toggle="modal"><strong><?php echo $new_member['first_name'].' '.$new_member['last_name']. ' (' . $new_member['age'] . ')'; ?> </strong></a></p>
				
				<p class="member-quote"><em><i class="fa fa-quote-left"></i> <?php echo $new_member['profile_head']; ?> </em></p> 
			   
				<p class="member-loc"><?php echo ucfirst($new_member['state_province']); ?> <?php echo ucfirst($new_member['city']); ?>, <?php echo $new_member['country']; ?></p>
				
				<p class="member-status"><strong> <?php echo $this->lang->line('seeking'); ?> </strong> <?php if($new_member['looking_for'] == 'm'){ echo 'Male' ; }else{ echo 'Female';}?> <?php echo str_replace(';', '-', $users[$new_member['id']]['age_between']); ?></p>
				
				<!--<p class="member-status"><strong> <?php echo $this->lang->line('seeking'); ?> </strong> <?php echo $new_member['im_seeking_a']; ?> <?php echo str_replace(';', '-', $users[$new_member['id']]['age_between']); ?></p>-->
				
				<?php if($new_member['block_user_id'] == $new_member['id'])
				{
					?>
					<p class="member-action">
						<a href="<?php echo base_url('/mail/unblock_user').'/'.$new_member['id']; ?>" class="btn btn-danger fa fa-ban"> Unblock </a>
						<!--<a href="javascript:alert('Please Unblock User')" onclick="alert('Please Unblock User')"><i class="fa fa-comments"></i></a>  
						<a href="javascript:alert('Please Unblock User')" ><i class="fa fa-minus fav"></i></a>   -->
				   </p>
					<?
				}else{
						?>
						<p class="member-action">
							<!--chat-->
							<a href="/chat" title="Live Chat" data-toggle="modal"><i class="fa fa-comments"></i></a>  
							<!--Like-->
							<?php if($new_member['like'] == '1')
							{
								?>
								<a href="search/unlike/<?php echo $new_member['id']; ?>/<?php echo $this->session->userdata['user_id']; ?>" title="Unlike" ><i class="fa fa-thumbs-up fav"></i></a>   
								<?php
							}else{ 
								?>
								<a href="search/like/<?php echo $new_member['id']; ?>/<?php echo $this->session->userdata['user_id']; ?>" title="Like" ><i class="fa fa-thumbs-up"></i></a>
								<?php 
							} ?>
							
							<!--send heart-->
							<a href="#modal-heart<?php echo $new_member['id']; ?>" title="Send Heart" data-toggle="modal"><i class="fa fa-heart"></i></a> 
						   
							<!--warning-->
							<?php if($new_member['warning_message'] == '1')
							{
								?>
								<a href="#modal-warningsend"  data-toggle="modal"><span class="fa fa-warning label-warning">  </span></a> 
								<?php
							}else{
								?>
								<a href="#modal-warning<?php echo $new_member['id'];?>" data-toggle="modal"><span class="fa fa-warning label-warning">  </span></a>
								<?php 
							} ?>
						   
						   <!--favorite-->
						   <?php 
							if($new_member['favourite'] >= '1'){ ?>
								<a href="#" title="" ><i class="fa fa-minus fav"></i></a>   
							<?php  }else{ ?>
							<a href="search/favorite/<?php echo $new_member['id']?>/<?php echo $this->session->userdata['user_id']; ?>" title="Favourite" ><i class="fa fa-plus"></i></a>     
							<?php } ?>
							
							<?php /*?><a href="search/favorite/<?php echo $new_member['id']?>/<?php echo $this->session->userdata['user_id']; ?>" title="Favourite" ><i class="fa fa-plus"></i></a>   <?php */?>
						</p>
						<?php 
					} ?>
			</div>
		<?php } 
	} ?>
    </div>
</div>


        <!--<div class="box content-box-border">
            <div class="box-title bg-red txt-upper txt-bold">Newest Member</div>
            <div class="member-slider">
                <div class="content-box-border clearfix member-box">
                    <div class="member-avatar pull-left">
                        <a href="#modal-login" data-toggle="modal"><img src="/template/asian/resources/img/gallery_1.png" alt=""></a>
                    </div>
                    <p class="member-id"><a href="#modal-login" data-toggle="modal"><strong>quynhhuong (29)</strong></a></p>
                    <p class="member-quote"><em><i class="fa fa-quote-left"></i> di tim 1 nua cua doi minh, hihi, hehe</em></p>
                    <p class="member-loc">Hai Chau, Danang, Vietnam</p>
                    <p class="member-status"><strong>Seeking: </strong> Male 32-40</p>
                    <p class="member-action">
                        <a href="#"><i class="fa fa-comments"></i></a>
                        <a href="#"><i class="fa fa-heart"></i></a>
                        <span class="label label-warning">100%</span>
                    </p>
                </div>
                <div class="content-box-border clearfix member-box">
                    <div class="member-avatar pull-left">
                        <a href="#modal-login" data-toggle="modal"><img src="/template/asian/resources/img/gallery_1.png" alt=""></a>
                    </div>
                    <p class="member-id"><a href="#modal-login" data-toggle="modal"><strong>quynhhuong (29)</strong></a></p>
                    <p class="member-quote"><em><i class="fa fa-quote-left"></i> di tim 1 nua cua doi minh, hihi, hehe</em></p>
                    <p class="member-loc">Hai Chau, Danang, Vietnam</p>
                    <p class="member-status"><strong>Seeking: </strong> Male 32-40</p>
                    <p class="member-action">
                        <a href="#"><i class="fa fa-comments"></i></a>
                        <a href="#"><i class="fa fa-heart"></i></a>
                        <span class="label label-warning">100%</span>
                    </p>
                </div>
                <div class="content-box-border clearfix member-box">
                    <div class="member-avatar pull-left">
                        <a href="#modal-login" data-toggle="modal"><img src="/template/asian/resources/img/gallery_1.png" alt=""></a>
                    </div>
                    <p class="member-id"><a href="#modal-login" data-toggle="modal"><strong>quynhhuong (29)</strong></a></p>
                    <p class="member-quote"><em><i class="fa fa-quote-left"></i> di tim 1 nua cua doi minh, hihi, hehe</em></p>
                    <p class="member-loc">Hai Chau, Danang, Vietnam</p>
                    <p class="member-status"><strong>Seeking: </strong> Male 32-40</p>
                    <p class="member-action">
                        <a href="#"><i class="fa fa-comments"></i></a>
                        <a href="#"><i class="fa fa-heart"></i></a>
                        <span class="label label-warning">100%</span>
                    </p>
                </div>
                <div class="content-box-border clearfix member-box">
                    <div class="member-avatar pull-left">
                        <a href="#modal-login" data-toggle="modal"><img src="/template/asian/resources/img/gallery_1.png" alt=""></a>
                    </div>
                    <p class="member-id"><a href="#modal-login" data-toggle="modal"><strong>quynhhuong (29)</strong></a></p>
                    <p class="member-quote"><em><i class="fa fa-quote-left"></i> di tim 1 nua cua doi minh, hihi, hehe</em></p>
                    <p class="member-loc">Hai Chau, Danang, Vietnam</p>
                    <p class="member-status"><strong>Seeking: </strong> Male 32-40</p>
                    <p class="member-action">
                        <a href="#"><i class="fa fa-comments"></i></a>
                        <a href="#"><i class="fa fa-heart"></i></a>
                        <span class="label label-warning">100%</span>
                    </p>
                </div>
                <div class="content-box-border clearfix member-box">
                    <div class="member-avatar pull-left">
                        <a href="#modal-login" data-toggle="modal"><img src="/template/asian/resources/img/gallery_1.png" alt=""></a>
                    </div>
                    <p class="member-id"><a href="#modal-login" data-toggle="modal"><strong>quynhhuong (29)</strong></a></p>
                    <p class="member-quote"><em><i class="fa fa-quote-left"></i> di tim 1 nua cua doi minh, hihi, hehe</em></p>
                    <p class="member-loc">Hai Chau, Danang, Vietnam</p>
                    <p class="member-status"><strong>Seeking: </strong> Male 32-40</p>
                    <p class="member-action">
                        <a href="#"><i class="fa fa-comments"></i></a>
                        <a href="#"><i class="fa fa-heart"></i></a>
                        <span class="label label-warning">100%</span>
                    </p>
                </div>
               
                <div class="content-box-border clearfix member-box">
                    <div class="member-avatar pull-left">
                        <a href="#modal-login" data-toggle="modal"><img src="/template/asian/resources/img/gallery_1.png" alt=""></a>
                    </div>
                    <p class="member-id"><a href="#modal-login" data-toggle="modal"><strong>quynhhuong (29)</strong></a></p>
                    <p class="member-quote"><em><i class="fa fa-quote-left"></i> di tim 1 nua cua doi minh, hihi, hehe</em></p>
                    <p class="member-loc">Hai Chau, Danang, Vietnam</p>
                    <p class="member-status"><strong>Seeking: </strong> Male 32-40</p>
                    <p class="member-action">
                        <a href="#"><i class="fa fa-comments"></i></a>
                        <a href="#"><i class="fa fa-heart"></i></a>
                        <span class="label label-warning">100%</span>
                    </p>
                </div>
            </div>
        </div>-->    
    </section><!-- End .container -->
</div><!-- End #content -->

 <!--like modal-->
        <div class="modal fade" id="like_profile">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
              
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>  
                <h4 class="txt-red"><i class="fa fa-thumbs-up"></i>  <span> <?php echo $this->lang->line('people_who_sent_like'); ?> </span></h4>
              </div>
              
              <div class="modal-body popupbody">
              <?php 
			foreach($like_member_list as $member)
			  {
				  ?> 
                  <div class="media">
                  		<?php if($users[$member['id']]['avatar'] == '')
							{
								if($profile['gender'] == 'm')
								{
									?>
									<a class="pull-left avatar-sm" href="/profile/user/<?php echo $member['id']; ?>"><img class="media-object img-circle" src="/resources/img/avatar-blank.png" alt="" width="80" height="80"></a>
									<?php	
								}else{
									?>
									<a class="pull-left avatar-sm" href="/profile/user/<?php echo $member['id']; ?>"><img class="media-object img-circle" src="/resources/img/no_profile_female.jpg" alt="" width="80" height="80"></a>
									<?php
								}
							}else{?>
								<a class="pull-left avatar-sm" href="/profile/user/<?php echo $member['id']; ?>"><img class="media-object" src="/uploads/profile/thumbnail/<?php echo $users[$member['id']]['avatar'];?>"></a>
								<?php 
							} ?>
                  
					<div class="media-body">
						<h3 class="media-heading"><a href="/profile/user/<?php echo $member['id']; ?>"><?php  echo $member['first_name'].' '.$member['last_name'];?></a></h3>
					</div>
                    <hr />
				  </div>
			  <?php }
			 	?>
              </div>
              <div class="modal-footer">
                    <p class="txt-center"></p>
              </div>
            </div>
          </div>
    </div>
        <!--End like modal-->
 <!--heart modal-->
        <div class="modal fade" id="heart_profile">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
              
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>  
                <h4 class="txt-red"><i class="fa fa-heart"></i>  <span> <?php echo $this->lang->line('people_who_sent_heart'); ?> </span></h4>
              </div>
              <div class="modal-body popupbody">
              <?php 
			foreach($heart_member_list as $member)
			  {
				  ?>
                  <div class="media">
						<?php if($users[$member['id']]['avatar'] == '')
								{
									if($profile['gender'] == 'm')
									{
										?>
										<a class="pull-left avatar-sm" href="/profile/user/<?php echo $member['id']; ?>"><img class="media-object img-circle" src="/resources/img/avatar-blank.png" alt="" width="80" height="80"></a>
										<?php	
									}else{
										?>
										<a class="pull-left avatar-sm" href="/profile/user/<?php echo $member['id']; ?>"><img class="media-object img-circle" src="/resources/img/no_profile_female.jpg" alt="" width="80" height="80"></a>
										<?php
									}
								}else{ ?>
									<a class="pull-left avatar-sm" href="/profile/user/<?php echo $member['id']; ?>"><img class="media-object" src="/uploads/profile/thumbnail/<?php echo $users[$member['id']]['avatar']; ?>"></a>
									<?php 
								} ?>
					<div class="media-body">
						<h3 class="media-heading"><a href="/profile/user/<?php echo $member['id']; ?>"><?php echo $member['first_name'].' '.$member['last_name'];?></a></h3>
					</div>
                    <hr />
				  </div>
			  <?php } ?>
              </div>
              <div class="modal-footer">
                    <p class="txt-center"></p>
              </div>
            </div>
          </div>
    </div>
        <!--End heart modal-->

<!--favorite people modal-->
        <div class="modal fade" id="fav_profile">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>  
                <h4 class="txt-red"><i class="fa fa-heart"></i>  <span> <?php echo $this->lang->line('people_add_to_fav'); ?> </span></h4>
              </div>
              <div class="modal-body popupbody">
              <?php 
			foreach($fav_member_list as $member)
			  {
				  ?> 
                  <div class="media">
						<?php if($users[$member['id']]['avatar'] == '')
								{
									if($profile['gender'] == 'm')
									{
										?>
										<a class="pull-left avatar-sm" href="/profile/user/<?php echo $member['id']; ?>"><img class="media-object img-circle" src="/resources/img/avatar-blank.png" alt="" width="80" height="80"></a>
										<?php	
									}else{
										?>
										<a class="pull-left avatar-sm" href="/profile/user/<?php echo $member['id']; ?>"><img class="media-object img-circle" src="/resources/img/no_profile_female.jpg" alt="" width="80" height="80"></a>
										<?php
									}
								}else{?>
                                    <a class="pull-left avatar-sm" href="/profile/user/<?php echo $member['id']; ?>"><img class="media-object" src="/uploads/profile/thumbnail/<?php echo $users[$member['id']]['avatar'];?>"></a>
                                    <?php 
								} ?>
					<div class="media-body">
						<h3 class="media-heading"><a href="/profile/user/<?php echo $member['id']; ?>"><?php echo $member['first_name'].' '.$member['last_name'];?></a></h3>
					</div>
                    <hr />
				  </div>
			  <?php }
			 ?>
              </div>
              <div class="modal-footer">
                    <p class="txt-center"></p>
              </div>
            </div>
          </div>
    </div>
        <!--End favorite people modal-->

<!--Warning modal-->
        <div class="modal fade" id="warning_profile">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
              
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>  
                <h4 class="txt-red"><i class="fa fa-thumbs-up"></i>  <span> People Who Send Warning Message </span></h4>
              </div>
              
              <div class="modal-body popupbody">
             
                  <div class="media">
                  	<table class="table table-striped">
						<tr>
                        	<th>Profile</th>
                            <th>User Name</th>
                            <th>Message</th>
                        </tr>
                         <?php 
							foreach($warning_message_list as $member)
							  	{
								  ?> 
                                  <tr>
                                    <td><?php if($users[$member['id']]['avatar'] == '')
                                        {
                                            ?>
                                            <a class="pull-left avatar-sm" href="/profile/user/<?php echo $member['id']; ?>"><img class="media-object img-circle" src="/resources/img/No_image_available.svg" alt="" width="80" height="80"></a>
                                            <?php }else{?>
                                            <a class="pull-left avatar-sm" href="/profile/user/<?php echo $member['id']; ?>"><img class="media-object" src="/uploads/profile/thumbnail/<?php echo $users[$member['id']]['avatar']; ?>"></a>
                                            <?php
                                        } 	?>
                                    </td>
                                    <td><a href="/profile/user/<?php echo $member['id']; ?>"><?php echo $member['first_name'].' '.$member['last_name']; ?></a></td>
                                    <td><a href="/profile/user/<?php echo $member['id']; ?>"><?php echo $member['message']; ?></a></td>
								  </tr>
									<?php 
								} ?>
                    </table>
				  </div>
              </div>
              <div class="modal-footer">
                    <p class="txt-center"></p>
              </div>
            </div>
          </div>
    </div>
        <!--End warning modal-->


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function()
    {
        $("#country").on("change", function(){
		
            var country_id = $("#country").val();
            $.ajax({
                type: "POST",
                url: "<?php echo site_url()?>register/get_state/", //controller url
                data: "county_id=" + country_id,
                success: function(data)
                {
                    $('#divState').html(data);
                }
            });
        });

        $("#divState").on("change", function(){
            var state_id = $("#state").val();
            var country_id = $("#country").val();
			
			
			$.ajax({
                type: "POST",
                url: "<?php echo site_url();?>register/get_city/", //controller
                data: {state_id: state_id, country_id: country_id},
                success: function(data)
                {
                    $('#divCity').html(data);
                }
            });
        });
		
		$("#login_status").on('change',function(){
			var login_status = $('#login_status').val();
			$.ajax({
				type 	: 'POST',
				url		: '<?php echo site_url();?>profile/login_status/', //contriller
				data	: 'login_status=' +login_status,
				success	: function(r){
					//alert('suss');
				}
			});
			
		});
		
		//chamge login status color 
		 $('#login_status').change(function() {
                    var sel = $(this).val();
					if (sel == 'Available')
						{
								$("#autoloaddiv").html('<span id="autoloaddiv"><i class="fa fa-circle txt-green"></i> </span>');
								$('#autohidediv').hide();		
						}
					 if (sel == 'Busy')
						{
								$("#autoloaddiv").html('<span id="autoloaddiv"><i class="fa fa-circle txt-red"></i> </span>');
								$('#autohidediv').hide();
                    	}
					if (sel == 'Invisible')
						{
								$("#autoloaddiv").html('<span id="autoloaddiv"><i class="fa fa-circle"></i></span>');
								$('#autohidediv').hide();
                    	}
                });

    });
	
</script>
<!--for change background color
https://drjohnstechtalk.com/setback.php?color=lightgreen
-->