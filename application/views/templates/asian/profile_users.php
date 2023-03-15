<?php
$gender = $this->lang->line('gender_short');
?>
    <!-- MAIN CONTENT -->
    <div class="content-box">
        <section class="container">

            <div class="row">
                <ol class="breadcrumb">
                    <li><i class="fa fa-user fa-2x icon-round-border"></i></li>
                    <li class="active"><span>Profile Member</span></li>
                </ol>
            </div>
            <!-- /BREADCRUMB/ -->
            <div class="box highlight-bg">
                <div class="row">
                    <div class="col-sm-4 member-gallery">
                   
                   <?php if($main_avatar == '')
						{
							if($gender[$profile['gender']] == 'Male')
							{
								?>
								<a href="#" class="item-feature" title="You've interested in <?php echo $profile['first_name'];?>"><img src="/resources/img/avatar-blank.png" alt="" width="160" height="" ></a>
								<?php	
							}else{
								?>
								<a href="#" class="item-feature" title="You've interested in <strong><?php echo $profile['first_name'];?></strong>"><img src="/resources/img/no_profile_female.jpg" alt="" ></a>
								<?php
							}
						   
						}else{
								?>
                                <a href="#" class="item-feature" title="You've interested in <strong><?php echo $profile['first_name'];?></strong>"><img src="/uploads/profile/<?php echo $main_avatar;?>" alt=""></a>
							  	<?php 
						} ?>
                       
					   <?php /*?> <a href="#" class="item-feature" title="You've interested in <strong><?php echo $profile['first_name'];?></strong>"><img src="/uploads/profile/			<?php 
							if(isset($main_avatar)&&$main_avatar!='')
							{
								echo $main_avatar;
							} else {
								
								echo 'no_image.jpg';
							}
							?>" alt=""></a><?php */?>
							
							<?php
							if(is_array($avatars))
							{
								?>
								<div class="prod-img-slider">
									<?php
									
									//print_r($avatars);die;
									foreach($avatars as $akey => $avalue)
									{
										?>
										<div class="item">
											<a href="#"><img src="/uploads/profile/<?php echo $avalue['name']; ?>" alt=""/></a>
										</div>
										<?php							
									}
									?>
								</div>
								<?php
							}
							?>
                    </div>
                    <div class="col-sm-8">
                        <h4 class="txt-red txt-upper page-title">
                            <?php echo $profile['first_name'] .' '.$profile['last_name']; ?>
                            <i class="fa fa-circle txt-green"></i> 
                            <span class="badge"><?php echo $this->format_model->dob_to_age($profile['dob']); ?> yrs</span> 
                            <img src="resources/img/badge-verify.png" alt="" class="member-badge">
                        </h4>

                        <div class="member-quote-detail">
                            <i class="fa fa-quote-left"></i> <?php echo $profile['about_yourself']; ?> <i class="fa fa-quote-right"></i>
                        </div>
                        <div class="member-rate-ct"> 
                            <!--h5 class=" txt-upper">Overal Rating <span class="label label-success">689</span></h5--> 
                            <!--p class="member-star-rate"> 
                                <a href="#" class="rated"><i class="fa fa-star"></i></a> 
                                <a href="#" class="rated"><i class="fa fa-star"></i></a>
                                <a href="#" class="rated"><i class="fa fa-star"></i></a>   
                                <a href="#" class="rated"><i class="fa fa-star"></i></a> 
                                <a href="#" class="rated"><i class="fa fa-star"></i></a> 
                                <span class="label label-danger">5/5</span> 
                                <a href="#">Detail</a> 
                            </p-->
                        </div>
                        
                        <div class="member-action-list">
                        	<!--chat-->
                            <a href="/chat" class="btn btn-warning" title="Chat"><i class="fa fa-comments"></i></a>
                            <!--send heart-->
                            <a href="#modal-heart<?php echo $id?>" class="btn btn-danger" title="Send Heart" data-toggle="modal"><i class="fa fa-heart"></i></a> 
                            <!--Like-->
                            <?php if($profile['like'] == '1')
									{?>
                            			<a href="<?php echo base_url(); ?>search/unlike/<?php echo $id; ?>/<?php echo $this->session->userdata['user_id']; ?>" title="Unlike" class="btn btn-success"><i class="fa fa-thumbs-up"></i></a>   
										<? 
									}else{ ?>
                                    	<a href="<?php echo base_url(); ?>search/like/<?php echo $id; ?>/<?php echo $this->session->userdata['user_id']; ?>" title="Like" class="btn btn-danger"><i class="fa fa-thumbs-up"></i></a>
                                    	<?
									}
                                    ?>
                           <!-- <a href="#modal-like" class="btn btn-danger" title="Like" data-toggle="modal"><i class="fa fa-thumbs-up"></i></a>-->
                            
                             <!--warning-->
							<?php if($profile['warning_message'] > '1')
                            {
                                ?>
                                <a href="#modal-warningsend" class="btn btn-danger" data-toggle="modal" title="Report Abuse"><span class="fa fa-exclamation ">  </span></a> 
                                <?php
                            }else{
                                ?>
                                <a href="#modal-warning<?php echo $id;?>" class="btn btn-danger" data-toggle="modal" title="Report Abuse"><span class="fa fa-exclamation">  </span></a>
                                <?php 
                            } ?>
                            <!--<a href="#modal-warning" class="btn btn-danger" title="Warning" data-toggle="modal"><i class="fa fa-exclamation"></i></a>-->
                            
                            <!--favorite-->
						   <?php 
                            if($profile['favourite'] >= '1')
							{ 	
								?>
                                <a href="#" title="" class="btn btn-danger" ><i class="fa fa-minus"></i></a>   
                            	<?php  
							}else{ ?>
                            	<a class="btn btn-danger" href="search/favorite/<?php echo $id?>/<?php echo $this->session->userdata['user_id']; ?>" title="Favourite" ><i class="fa fa-plus"></i></a>     
                            	<?php 
							} ?>
                           
                            <!--<div class="dropdown">
                                <button class="btn btn-danger" type="button" id="dropdownMenu1" data-toggle="dropdown"><i class="fa fa-plus"></i></button>
                                <ul class="dropdown-menu">
                                    <li><a href="#modal-bookmark" data-toggle="modal"> Bookmark </a></li>
                                    <li><a href="#modal-fav" data-toggle="modal"> Favourite </a></li>
                                </ul>
                            </div>-->
                           
                            <!-- block user-->
                           
                            <?php 
							if($profile['block_user_id'] != $id)
							{
								?>
								<a id="<?php echo $id;?>" class="user_block btn btn-danger" title="Block User"><i class="fa fa-ban"></i></a></li>
								<?
							}else{
								?>
								<a id="<?php echo $id; ?>" class="user_unblock btn btn-danger" title="Unblock User"><i class="fa fa-check-circle-o"></i></a>
								<?
							}
							?>
										
                            <!--<a href="#modal-block" class="btn btn-danger" title="Block" data-toggle="modal"><i class="fa fa-ban"></i></a>-->
                            <a href="/mail/compose/" class="btn btn-success" title="Write Message" data-toggle="modal"><i class="fa fa-envelope"></i></a>
                        </div>
                        <ul class="member-profile-detail">
                            <li><?php echo $gender[$profile['gender']]; ?> </li>
                            <!--li>ID: 1086868</li-->
                            <li><?php echo $profile['state_province'] .', ' . $profile['city'] .', ' .$profile['country']; ?></li>
                            <li>Seeking: <?php echo $gender[$profile['looking_for']]; ?></li>
                            <li>For: <?php echo str_replace('_', ' ', $profile['relationship_your_looking_for']); ?> </li>
                           <!-- <li>Last active: unknown</li>-->
                            
                        </ul>
                    </div>
                </div>    
            </div>
                
            <div class="row">
                <div class="col-sm-10">
                    <div class="row-offcanvas row-offcanvas-right">
                        <button type="button" class="btn-offcanvas" data-toggle="offcanvas">
                            <i class="fa fa-chevron-left"></i>
                            <i class="fa fa-chevron-right"></i>
                        </button>
                        <div class="box box-tab-content">
							<ul class="nav nav-tabs sidebar-offcanvas">
								<li class="active"><a href="#profile" data-toggle="tab"> Profile </a></li>
								<!--<li><a href="#comments" data-toggle="tab"> Comments </a></li>-->
								<li><a href="#interest" data-toggle="tab"> Interest </a></li>
								<!--<li><a href="#personality" data-toggle="tab"> Personality </a></li>-->
								<li><a href="#favorites" data-toggle="tab"> Favorites </a></li>
								<li><a href="#personality_types" data-toggle="tab"> Personality Type</a></li>
							</ul>

							<?php //echo "<pre>"; print_r($allTabsData); ?>

							<div class="tab-content">

                                <div class="tab-pane active" id="profile">
									<div class="row">

										<div class="col-sm-6">
											<div class="content-box-border">
												<table class="table table-hover tbl-no-margin">
													<thead><tr><th colspan="2">Your Appearance</th></tr></thead>

													<tbody>
														<tr>
															<td>Hair Color</td>
															<td><?php echo $allTabsData['about_data']->hair_color; ?></td>
														</tr>
														<tr>
															<td>Eye Color</td>
															<td><?php echo $allTabsData['about_data']->eye_color; ?></td>
														</tr>
														<tr>
															<td>Height</td>
															<td><?php echo $allTabsData['about_data']->height; ?></td>
														</tr>
														<tr>
															<td>Weight</td>
															<td><?php echo $allTabsData['about_data']->weight; ?></td>
														</tr>
														<tr>
															<td>Body Type</td>
															<td><?php echo $allTabsData['about_data']->body_type; ?></td>
														</tr>
														<tr>
															<td>Ethnicity</td>
															<td><?php echo $allTabsData['about_data']->ethnicity; ?></td>
														</tr>
														<tr>
															<td>Appearance</td>
															<td><?php echo $allTabsData['about_data']->appearance; ?></td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>

										<div class="col-sm-6">
											<div class="content-box-border">
												<table class="table table-hover tbl-no-margin">
													<thead><tr><th colspan="2">Your Lifestyle</th></tr></thead>

													<tbody>
														<tr>
															<td>Drink</td>
															<td><?php echo ($allTabsData['about_data']->drink == 1) ? 'Yes' : 'No'; ?></td>
														</tr>
														<tr>
															<td>Smoke</td>
															<td><?php echo ($allTabsData['about_data']->smoke) ? 'Yes' : 'No'; ?></td>
														</tr>
														<tr>
															<td>Marital Status</td>
															<td><?php echo ($allTabsData['about_data']->marital_status) ? 'Yes' : 'No'; ?></td>
														</tr>
														<tr>
															<td>Children</td>
															<td><?php echo ($allTabsData['about_data']->have_children) ? 'Yes' : 'No'; ?></td>
														</tr>
														<tr>
															<td>Occupation</td>
															<td><?php echo ($allTabsData['about_data']->occupation) ? 'Yes' : 'No'; ?></td>
														</tr>
														<tr>
															<td>Willing to Relocate</td>
															<td><?php echo ($allTabsData['about_data']->willing_to_relocate) ? 'Yes' : 'No'; ?></td>
														</tr>
														<tr>
															<td>Relationship you are looking for</td>
															<td><?php echo $allTabsData['about_data']->relationship_your_looking_for; ?></td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>

										<div class="col-sm-6">
											<div class="content-box-border">
												<table class="table table-hover tbl-no-margin">
													<thead><tr><th colspan="2">Your Background / Cultural Values</th></tr></thead>

													<tbody>
														<tr>
															<td>Nationality</td>
															<td><?php echo $allTabsData['about_data']->nationality; ?></td>
														</tr>
														<tr>
															<td>Education</td>
															<td><?php echo $allTabsData['about_data']->education; ?></td>
														</tr>
														<tr>
															<td>English Ability</td>
															<td>
																<?php
																	if($allTabsData['about_data']->english_ability == '0') {
																		echo 'does not understand or speak';
																	} else if($allTabsData['about_data']->english_ability == '1') {
																		echo 'Beginner - You can speak and understand English in a very limited way.';
																	} else if($allTabsData['about_data']->english_ability == '2') {
																		echo 'Elementary - You can understand language used in everyday situations if the speaker speaks slowly and clearly.';
																	} else if($allTabsData['about_data']->english_ability == '3') {
																		echo 'Pre Intermediate - You can communicate in a range of everyday social and travel contexts.';
																	} else if($allTabsData['about_data']->english_ability == '4') {
																		echo 'Intermediate - You can speak English with some confidence.';
																	} else if($allTabsData['about_data']->english_ability == '5') {
																		echo 'Upper intermediate - You can use English effectively.';
																	} else if($allTabsData['about_data']->english_ability == '6') {
																		echo 'Advanced - You can use English in a range of culturally appropriate ways.';
																	} else if($allTabsData['about_data']->english_ability == '7') {
																		echo 'Proficient - You can use English with ease and fluency.';
																	}
																?>
															</td>
														</tr>
														<tr>
															<td>Religion</td>
															<td><?php echo $allTabsData['about_data']->religion; ?></td>
														</tr>
														<tr>
															<td>Living Situation</td>
															<td><?php echo $allTabsData['about_data']->living_situation; ?></td>
														</tr>
														<tr>
															<td>Income Per Year</td>
															<td><?php echo $allTabsData['about_data']->incomeperyear; ?></td>
														</tr>
														<tr>
															<td>Working Status</td>
															<td><?php echo $allTabsData['about_data']->workingstatus; ?></td>
														</tr>
														<tr>
															<td>Chinese Sign</td>
															<td><?php echo $allTabsData['about_data']->chinese_sign; ?></td>
														</tr>
														<tr>
															<td>Star Sign</td>
															<td><?php echo $allTabsData['about_data']->star_sign; ?></td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>

									</div>
								</div>

                                <div class="tab-pane" id="comments">
									
                                </div>
                                
                                <!--interest-->
                                <div class="tab-pane active" id="interest">
                                    <h4 class="txt-upper txt-red page-title visible-xs"> Interest </h4>
                                   
                                </div>

								<!-- personality-->
                                <div class="tab-pane" id="personality">
									
                                </div>
                                
                                <!--favorites-->
                                <div class="tab-pane active" id="favorites">
                                    <h4 class="txt-upper txt-red page-title visible-xs"> Favorites </h4>
                                    <table class="table table-hover tbl-no-margin">
                                           <thead>
                                            <tr>
                                                <th> Food </th>
                                                <th> Book </th>
                                                <th> Food </th>
                                                <th> Music </th>
                                                <th> Hobbies </th>
												<th> Dress </th>
												<th> Sense </th>
												<th> Personality </th>
												<th> Travelled </th>
												<th> Adaptive </th>
                                            </tr>
                                        </thead>

                                        <tbody>
											<?php if(isset($allTabsData['user_data']['favorites'])) { ?>
												<tr>
													<td><?php echo $allTabsData['user_data']['favorites']->fav_movie; ?></td>
													<td><?php echo $allTabsData['user_data']['favorites']->fav_book; ?></td>
													<td><?php echo $allTabsData['user_data']['favorites']->food_you_like; ?></td>
													<td><?php echo $allTabsData['user_data']['favorites']->music_you_like; ?></td>
													<td><?php echo $allTabsData['user_data']['favorites']->your_hobies; ?></td>
													<td><?php echo $allTabsData['user_data']['favorites']->describe_your_dress; ?></td>
													<td><?php echo $allTabsData['user_data']['favorites']->describe_your_sense; ?></td>
													<td><?php echo $allTabsData['user_data']['favorites']->describe_your_personality; ?></td>
													<td><?php echo $allTabsData['user_data']['favorites']->you_travelled; ?></td>
													<td><?php echo $allTabsData['user_data']['favorites']->adaptive_are_you; ?></td>
												</tr>
											<?php } ?>
                                        </tbody>
                                    </table>
                                </div>

                                <!--personality types-->
                                <div class="tab-pane active" id="personality_types">
                                    <h4 class="txt-upper txt-red page-title visible-xs"> Personality Types </h4>
                                    <table class="table table-hover tbl-no-margin">
                                        <thead>
                                            <tr>
                                                <th> About </th>
                                                <th> Info </th>
                                                <th> Matching </th>
                                                <th> Looking for </th>
                                                <th> Matching </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td> Gender </td>
                                                <td><?php echo $gender[$profile['gender']];?></td>
                                                <td>
												<?php
												if($viewer_match['looking_for']==$profile['gender']){
													?>
													<i class="txt-green fa fa-circle"></i>
													<?php
												} else {
													?>
													<i class="txt-red fa fa-circle"></i>
													<?php
												}
												?>
												</td>
                                                <td><?php echo $gender[$profile['looking_for']];?></td>
                                                <td>
												<?php
												if($viewer_match['gender']==$profile['looking_for']){
													?>
													<i class="txt-green fa fa-circle"></i>
													<?php
												} else {
													?>
													<i class="txt-red fa fa-circle"></i>
													<?php
												}
												?>												
												</td>
                                            </tr>
                                            <tr>
                                                <td>Info</td>
                                                <td>Personal info</td>
                                                <td><i class="txt-green fa fa-circle"></i></td>
                                                <td>Other Info</td>
                                                <td><i class="txt-green fa fa-circle"></i></td>
                                            </tr>
                                            <tr>
                                                <td>Info</td>
                                                <td>Personal info</td>
                                                <td><i class="txt-green fa fa-circle"></i></td>
                                                <td>Other Info</td>
                                                <td><i class="txt-green fa fa-circle"></i></td>
                                            </tr>
                                            <tr>
                                                <td>Info</td>
                                                <td>Personal info</td>
                                                <td><i class="txt-red fa fa-circle"></i></td>
                                                <td>Other Info</td>
                                                <td><i class="txt-green fa fa-circle"></i></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"><h5 class="txt-red">Title Info</h5></td>
                                            </tr>
                                            <tr>
                                                <td>Info</td>
                                                <td>Personal info</td>
                                                <td><i class="txt-green fa fa-circle"></i></td>
                                                <td>Other Info</td>
                                                <td><i class="txt-red fa fa-circle"></i></td>
                                            </tr>
                                            <tr>
                                                <td>Info</td>
                                                <td>Personal info</td>
                                                <td><i class="txt-green fa fa-circle"></i></td>
                                                <td>Other Info</td>
                                                <td><i class="txt-green fa fa-circle"></i></td>
                                            </tr>
                                            <tr>
                                                <td>Info</td>
                                                <td>Personal info</td>
                                                <td><i class="txt-green fa fa-circle"></i></td>
                                                <td>Other Info</td>
                                                <td><i class="txt-red fa fa-circle"></i></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"><h5 class="txt-red">Title Info</h5></td>
                                            </tr>
                                            <tr>
                                                <td>Info</td>
                                                <td>Personal info</td>
                                                <td><i class="txt-green fa fa-circle"></i></td>
                                                <td>Other Info</td>
                                                <td><i class="txt-red fa fa-circle"></i></td>
                                            </tr>
                                            <tr>
                                                <td>Info</td>
                                                <td>Personal info</td>
                                                <td><i class="txt-green fa fa-circle"></i></td>
                                                <td>Other Info</td>
                                                <td><i class="txt-green fa fa-circle"></i></td>
                                            </tr>
                                            <tr>
                                                <td>Info</td>
                                                <td>Personal info</td>
                                                <td><i class="txt-green fa fa-circle"></i></td>
                                                <td>Other Info</td>
                                                <td><i class="txt-red fa fa-circle"></i></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"><h5 class="txt-red">Title Info</h5></td>
                                            </tr>
                                            <tr>
                                                <td>Info</td>
                                                <td>Personal info</td>
                                                <td><i class="txt-green fa fa-circle"></i></td>
                                                <td>Other Info</td>
                                                <td><i class="txt-red fa fa-circle"></i></td>
                                            </tr>
                                            <tr>
                                                <td>Info</td>
                                                <td>Personal info</td>
                                                <td><i class="txt-red fa fa-circle"></i></td>
                                                <td>Other Info</td>
                                                <td><i class="txt-green fa fa-circle"></i></td>
                                            </tr>
                                            <tr>
                                                <td>Info</td>

                                                <td>Personal info</td>
                                                <td><i class="txt-red fa fa-circle"></i></td>
                                                <td>Other Info</td>
                                                <td><i class="txt-red fa fa-circle"></i></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="content-box-border">
                        <div class="box-title bg-red">Similar Member</div>
                        <div class="box-ct mod-similar-member">
                            <a href="#" class="avatar-lg member-item" title="Jennie<br>18 yrs<br>Hanoi,Vietnam">
                                <img src="resources/img/gallery_1.png" alt=""/>
                            </a>
                            <a href="#" class="avatar-lg member-item" title="Jennie<br>18 yrs<br>Hanoi,Vietnam">
                                <img src="resources/img/gallery_1.png" alt=""/>
                            </a>
                            <a href="#" class="avatar-lg member-item" title="Jennie<br>18 yrs<br>Hanoi,Vietnam">
                                <img src="resources/img/gallery_1.png" alt=""/>
                            </a>
                            <a href="#" class="avatar-lg member-item" title="Jennie<br>18 yrs<br>Hanoi,Vietnam">
                                <img src="resources/img/gallery_1.png" alt=""/>
                            </a>
                        </div>
                    </div>
                </div>
            </div>    
        </section><!-- End .container -->
    </div><!-- End #content -->
    
  <script>
  //Block user to block list
	$(document).on('click', '.user_block', function(){
			var mail_id = $(this).attr("id");
			$(this).attr('class', 'user_block');
			$.post('/ajax', {
				'mail_id': $(this).attr('id'),
				'user_block':'inbox'
				},
				function(data){
					location.reload(true);
				});
				
				$().toastmessage('showNoticeToast', 'Added to Block List.');
				/*setInterval(function(){0
					$(".reload_cont").load(location.href+" .reload_cont>*","");
				}, 6000);  // 1000 = 1 second, 3000 = 3 seconds*/
				
		});	
	
	//unblock user from block list
	$(document).on('click', '.user_unblock', function(){
	
			var mail_id = $(this).attr("id");
			//alert(mail_id);
			$(this).attr('class', 'user_unblock');
			$.post('/ajax', {
				'mail_id': $(this).attr('id'),
				'user_unblock':'user_unblock'
				
				},
				function(data){
					//alert(data);
					location.reload(true);
				});
				
				$().toastmessage('showNoticeToast', 'Remove from Block List.');
				//location.reload(true);
				//window.location.href = <?php $_SERVER['PHP_SELF'];?>;
		});	
  </script> 