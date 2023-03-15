    <? //print_r($this->session->userdata); ?>
    <!-- MAIN CONTENT -->
    <div class="content-box">
        <section class="container">

            <div class="row">
                <ol class="breadcrumb">
                    <li><i class="fa fa-user fa-2x icon-round-border"></i></li>
                    <li class="active"><span><?php echo $this->lang->line('manage_your_acc');?></span></li>
                </ol>
            </div>
            <!-- /BREADCRUMB/ -->
            <div class="row-offcanvas row-offcanvas-right">
                <button type="button" class="btn-offcanvas" data-toggle="offcanvas">
                    <span class="offcanvas-show"><i class="fa fa-angle-left"></i> <?php echo $this->lang->line('show_menu');?></span>
                    <span class="offcanvas-hide"><i class="fa fa-angle-right"></i> <?php echo $this->lang->line('hide_menu');?></span>
                </button>
                <div class="box box-tab-content">
                    <ul class="nav nav-tabs sidebar-offcanvas">
                      <li class="active"><a href="#match" data-toggle="tab"><?php echo $this->lang->line('match')?></a></li>
                      <li><a href="#photo" data-toggle="tab"><?php echo $this->lang->line('Photo')?></a></li>
                      <li><a href="#profile" data-toggle="tab"><?php echo $this->lang->line('Profile')?></a></li>
                      <li><a href="#interest1" data-toggle="tab"><?php echo $this->lang->line('Interest')?></a></li>
                      <li><a href="#verify" data-toggle="tab"><?php echo $this->lang->line('profile_verify')?></a></li>
                      <li><a href="#personality" data-toggle="tab"><?php echo $this->lang->line('Personality')?></a></li>
                      <li><a href="#question" data-toggle="tab"><?php echo $this->lang->line('Questions')?></a></li>
                    </ul>
                    
                    <!-- profile progress bar-->
                    <div class="box-ct row">
                            <div class="box-ct-meta col-sm-12" align="right">
                                <span class="col-sm-7"> Your profile is <?php echo $profile_complete.'%';?> complete <small class="pull-right"><a href="/profile_manager"> <?php echo $this->lang->line('editprofile'); ?></a></small></span>
								<div class="col-sm-3">
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success"  role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $profile_complete.'%';?>">
                                            <span class="sr-only"> <?php echo $profile_complete.'%';?> Complete </span>
                                        </div>
                                    </div>
                                </div>    
                                <div class="col-sm-2" align="left">
                                	<a id="next_toggle" style="cursor:pointer" >What's next?</a>
                                </div>
                            </div>
                        </div>
                        <script>
                        	$(document).ready(function(){
								$('#next_toggle').click(function(){
									$('#pr_comp').slideToggle('slow');
								});
							})
                        </script>
                        <div class="col-sm-12 content-box-border" id="pr_comp" style="display:none;">
                                Complete your profile and be found more often in Searches
    
                                <ul class="list-links">
                                    <li><?php if($pm_match == ''){ ?><a href="/profile_manager">+ Add Matching Detail to your Resume (+14%) </a><? } ?></li>
                                    <li><?php if($pm_profile_comp == ''){ ?><a href="/profile_manager">+ Add Matching Detail to your Resume (+14%) </a><? } ?></li>
                                    <li><?php if($pm_interest == ''){ ?><a href="/profile_manager">+ Add Interest to your Resume (+14%) </a><? } ?></li>
                                    <li><?php if($pm_profile_verify == ''){ ?><a href="/profile_manager">+ Add Verification documents to your Resume (+14%) </a><? }?></li>
                                    <li><?php if($pm_questions == ''){ ?><a href="/profile_manager">+ Add questions to your Resume (+14%) </a><? } ?></li>
                                    <li><?php if($pm_get_personality_comp == ''){ ?><a href="/profile_manager">+ Add Personality details to your Resume (+16%)</a><? } ?></li>
                                    <li><?php if($pm_photo == ''){?><a href="/profile_manager">+ Add Profile Picture to your Resume (+14%) </a><? } ?></li>
                                </ul>
                            </div>
					<!-- end profile progress bar-->
                    
                    
                    <!-- Tab panes -->
                    <div class="tab-content">
                      <div class="tab-pane" id="photo">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="profile-photo"id="main_profile_photo">
                                    <img src="/uploads/profile/<?php echo $main_id['name'];?>" alt="" class="img-responsive img-rounded">
                                    <!--a href="#" title="Change Avatar"><i class="fa fa-picture-o fa-2x"></i></a-->
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="row profile-photo-info">
                                    <div class="col-sm-4">
                                        <h4 class="txt-red txt-upper page-title"><?php echo $this->lang->line('upload_photo'); ?><br>
                                            <small><?php echo $this->lang->line('add_more_photos')?></small>
                                        </h4>
                                        <p>1. <?php echo $this->lang->line('browse_your_photo')?><br>
                                           2. <?php echo $this->lang->line('confirm_photo')?><br>
                                           3. <?php echo $this->lang->line('click_photo')?><br>
                                        </p>
                                    </div>
                                    <div class="col-sm-8">
												<span class="btn btn-success fileinput-button">
													<i class="glyphicon glyphicon-plus"></i>
													<span><?php echo $this->lang->line('select_img')?></span>
													<!-- The file input field used as target for the file upload widget -->
													<input id="fileupload2" type="file" name="files[]" multiple>
													<input id="user_id2" type="hidden" name="user_id2" value='<?php echo $this->session->userdata['user_id'];?>'>
												</span>
												<br>
												<br>
												<!-- The global progress bar -->
												<div id="progress2" class="progress">
													<div class="progress-bar progress-bar-success"></div>
												</div>
												<!-- The container for the uploaded files -->
												<div id="files2" class="files">
												</div>
												<br>  
                                    </div>
                                </div>
                                <hr>
                                <?php echo $this->lang->line('change_photo')?>
								<br><br>
                                <div class="row">
									<?php
									//print_r($profile_photos);die;
                                    foreach ($profile_photos as $ppkey => $ppvalue)
									{
                                    //echo "<pre>";print_r($ppvalue);
                                        ?>
                                        <div class="col-sm-2" id="#profile_pic_list">
                                                <a style="cursor:pointer" class="select_avatar" rel="<?php echo $ppvalue['id'];?>" title="Select as avatar">
                                                <input type="hidden" name="pic" value="<?php echo $ppvalue['id'];?>">
                                                <!--<img id="main_profile_photo" style="margin-bottom:50px;" src="/uploads/profile/thumbnail/<?php echo $ppvalue['name'];?>" alt="" class="img-responsive img-rounded">-->
                                                <img id="main_profile_photo" src="/uploads/profile/thumbnail/<?php echo $ppvalue['name'];?>" class="img-responsive img-rounded">
                                                </a>
                                        </div>
                                        <?php	
                                    }
                                    ?>									

                                </div>
                            </div>
                        </div>
                        <hr>
                        <h4 class="txt-red txt-upper"><?php echo $this->lang->line('photo_guide')?></h4>
                        <h5 class="page-title"<?php echo $this->lang->line('how_chose_galary_photo')?>></h5>
                        <div class="row">
                            <div class="col-sm-9 col-sm-offset-1">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <img src="/template/asian/resources/img/profile-photo-bg.png" alt="" class="img-responsive margin-top">
                                    </div>
                                    <ul class="col-sm-5 list-square">
                                        <li><?php echo $this->lang->line('shows_you')?></li>
                                        <li><?php echo $this->lang->line('reflect_personality')?></li>
                                        <li><?php echo $this->lang->line('atleast_1_photo')?></li>
                                        <li><?php echo $this->lang->line('unique_setting')?></li>
                                    </ul>
                                    <ul class="col-sm-5 list-square">
                                        <li><?php echo $this->lang->line('clearly_show_face')?></li>
                                        <li><?php echo $this->lang->line('good_quality')?></li>
                                        <li><?php echo $this->lang->line('must_contain')?></li>
                                        <li><?php echo $this->lang->line('does_not_cont')?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                      </div>

                      <!-- Edit Profile -->
                      <div class="tab-pane" id="profile">
                        <h4 class="txt-red txt-upper page-title"<?php echo $this->lang->line('edit_profile')?>></h4>
                        <form class="form-horizontal">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="content-box-border">
                                        <legend><?php echo $this->lang->line('your_appearance')?></legend>
                                        <div class="form-group">
											<label class="col-sm-3 control-label col-sm-offset-1"><?php echo $this->lang->line('reg_hair_color');?></label>
											<div class="col-sm-6">
												<?php 
												echo form_dropdown('hair_color', $profile_data['hair_color']['options'], $profile_data['hair_color']['value'], $profile_data['hair_color']['form_options']);?>
											</div>
                                        </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label col-sm-offset-1"><?php echo $this->lang->line('reg_eye_color');?></label>
                                    <div class="col-sm-6">
                                        <?php echo form_dropdown('eye_color', $profile_data['eye_color']['options'], $profile_data['eye_color']['value'], $profile_data['eye_color']['form_options']);?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label col-sm-offset-1"><?php echo $this->lang->line('reg_height');?></label>
                                    <div class="col-sm-6">
                                        <?php echo form_error('height') . form_input($profile_data['height']);?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label col-sm-offset-1"><?php echo $this->lang->line('reg_weight');?></label>
                                    <div class="col-sm-6">
                                        <?php echo form_error('weight') . form_input($profile_data['weight']);?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label col-sm-offset-1"><?php echo $this->lang->line('reg_body_type');?></label>
                                    <div class="col-sm-6">
                                        <?php echo form_dropdown('body_type', $profile_data['body_type']['options'], $profile_data['body_type']['value'], $profile_data['body_type']['form_options']);?>
                                    </div>
                                </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 col-sm-offset-1 label-control"><?php echo $this->lang->line('your_enthnicity_is_mostly')?>:</label>
                                            <div class="col-sm-6">
                                               <?php echo form_dropdown('ethnicity', $profile_data['ethnicity']['options'], $profile_data['ethnicity']['value'], $profile_data['ethnicity']['form_options']);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 col-sm-offset-1 label-control"><?php echo $this->lang->line('i_consider_my_appearance')?>:</label>
                                            <div class="col-sm-6">
                                                <?php echo form_dropdown('appearance', $profile_data['appearance']['options'], $profile_data['appearance']['value'], $profile_data['appearance']['form_options']);?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                        <div class="content-box-border">
                                        <legend><?php echo $this->lang->line('your_lifestyle')?></legend>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label col-sm-offset-1"><?php echo $this->lang->line('do_you_drink');?></label>
                                            <div class="col-sm-6">
                                                <?php echo form_dropdown('drink', $profile_data['drink']['options'], $profile_data['drink']['value'], $profile_data['drink']['form_options']);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label col-sm-offset-1"><?php echo $this->lang->line('do_you_smoke')?></label>
                                            <div class="col-sm-6">
                                                <?php echo form_dropdown('smoke', $profile_data['smoke']['options'], $profile_data['smoke']['value'], $profile_data['smoke']['form_options']);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label col-sm-offset-1"><?php echo $this->lang->line('marital_status');?></label>
                                            <div class="col-sm-6">
                                                <?php echo form_dropdown('marital_status', $profile_data['marital_status']['options'], $profile_data['marital_status']['value'], $profile_data['marital_status']['form_options']);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label col-sm-offset-1"><?php echo $this->lang->line('do_you_have_child');?></label>
                                            <div class="col-sm-6">
                                                <?php echo form_dropdown('have_children', $profile_data['have_children']['options'], $profile_data['have_children']['value'], $profile_data['have_children']['form_options']);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label col-sm-offset-1"><?php echo $this->lang->line('Occupation');?></label>
                                            <div class="col-sm-6">
                                                <?php echo form_dropdown('occupation', $profile_data['occupation']['options'], $profile_data['occupation']['value'], $profile_data['occupation']['form_options']);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label col-sm-offset-1"><?php echo $this->lang->line('willing_to_relocate');?></label>
                                            <div class="col-sm-6">
                                                 <?php echo form_dropdown('willing_to_relocate', $profile_data['willing_to_relocate']['options'], $profile_data['willing_to_relocate']['value'], $profile_data['willing_to_relocate']['form_options']);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-12"><?php echo $this->lang->line('relationship_look');?></label>
                                            <div class="col-sm-12 ">
									<?php
										form_error('relationship_your_looking_for');
										
										/*foreach($profile_data['relationship_your_looking_for'] as $rylf){
											//print_r($rylf);
											//echo '<label class="checkbox-inline">'.form_radio($rylf).' '.str_replace('-', ' ', $this->lang->line('reg_'.$rylf['value'])).'</label>';
											echo '
											<label class="checkbox-inline">'.form_radio($rylf).' '.str_replace('-', ' ', $this->lang->line('reg_'.$rylf['value'])).'
											</label>';
										}*/
									?>
                                     <?php foreach($relationship_your_looking_for['relationship_is_looking_for_options'] as $rylf)
										{
											?>
											<input id="Rel_<?php echo str_replace(' ', '_', $rylf['options']); ?>" name="relationship_your_looking_for[]" <?php if(isset($rylf['selected'])){ echo "checked=\"checked\"";}?> value="<?php echo $rylf['options']; ?>" type="checkbox"> <?php echo $rylf['options']; ?>
											<? 
										}?>	
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="content-box-border">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <legend><?php echo $this->lang->line('your_background');?></legend>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label col-sm-offset-1"><?php echo $this->lang->line('Nationality');?> : </label>
                                            <div class="col-sm-6">
                                                <?php echo form_dropdown('nationality', $profile_data['nationality']['options'], $profile_data['nationality']['value'], $profile_data['nationality']['form_options']);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label col-sm-offset-1"><?php echo $this->lang->line('Education');?>:</label>
                                            <div class="col-sm-6">
                                                <?php echo form_dropdown('education', $profile_data['education']['options'], $profile_data['education']['value'], $profile_data['education']['form_options']);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label col-sm-offset-1"><?php echo $this->lang->line('english_lang_ability');?>:</label>
                                            <div class="col-sm-6">
                                                <?php echo form_dropdown('english_ability', $profile_data['english_ability']['options'], $profile_data['english_ability']['value'], $profile_data['english_ability']['form_options']);?>
                                            </div>
                                        </div>
                                        <?php /*?><div class="form-group">
                                            <label class="col-sm-4 control-label col-sm-offset-1"><?php echo $this->lang->line('vietnamese_lang_ability');?>:</label>
                                            <div class="col-sm-6">
                                                <?php echo form_dropdown('vietnamese_ability', $profile_data['vietnamese_ability']['options'], $profile_data['vietnamese_ability']['value'], $profile_data['vietnamese_ability']['form_options']);?>
                                            </div>
                                        </div><?php */?>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label col-sm-offset-1"><?php echo $this->lang->line('Religion');?>:</label>
                                            <div class="col-sm-6">
                                                <?php echo form_dropdown('religion', $profile_data['religion']['options'], $profile_data['religion']['value'], $profile_data['religion']['form_options']);?>
                                            </div>
                                        </div>
                                        
                                        <!--new box add 27oct-->
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label col-sm-offset-1"><?php echo $this->lang->line('living_situation');?>:</label>
                                            <div class="col-sm-6">
                                            	<?php echo form_dropdown('living_situation', $profile_data['living_situation']['options'], $profile_data['living_situation']['value'], $profile_data['living_situation']['form_options']);?>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label col-sm-offset-1"><?php echo $this->lang->line('incomeperyear');?>:</label>
                                            <div class="col-sm-6">
                                            	<?php echo form_dropdown('incomeperyear', $profile_data['incomeperyear']['options'], $profile_data['incomeperyear']['value'], $profile_data['incomeperyear']['form_options']);?>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label col-sm-offset-1"><?php echo $this->lang->line('workingstatus');?>:</label>
                                            <div class="col-sm-6">
                                            	<?php echo form_dropdown('workingstatus', $profile_data['workingstatus']['options'], $profile_data['living_situation']['value'], $profile_data['workingstatus']['form_options']);?>
                                            </div>
                                        </div>
                                        <?php if($profile['gender'] == 'f'){  //this option is only for female members?>
                                        
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label col-sm-offset-1"><?php echo $this->lang->line('cupsize');?>:</label>
                                            <div class="col-sm-6">
                                            	<?php echo form_dropdown('cupsize', $profile_data['cupsize']['options'], $profile_data['cupsize']['value'], $profile_data['cupsize']['form_options']);?>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <!-- end new box-->
                                        
                                        
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label col-sm-offset-1"><?php echo $this->lang->line('chinese_sign');?>:</label>
                                            <div class="col-sm-6">
                                                 <?php echo form_dropdown('chinese_sign', $profile_data['chinese_sign']['options'], $profile_data['chinese_sign']['value'], $profile_data['chinese_sign']['form_options']);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label col-sm-offset-1"><?php echo $this->lang->line('star_sign');?>:</label>
                                            <div class="col-sm-6">
                                                <?php echo form_dropdown('star_sign', $profile_data['star_sign']['options'], $profile_data['star_sign']['value'], $profile_data['star_sign']['form_options']);?>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-sm-6">
                                        <legend><?php echo $this->lang->line('in_your_words');?></legend>
                                        <div class="form-group">
                                            <label class="col-sm-10 col-sm-offset-1"> <?php echo $this->lang->line('your_profile_heading');?>:</label>
                                            <div class="col-sm-10 col-sm-offset-1">
                                                <?php echo form_error('profile_head') . form_input($profile_data['profile_head']); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-10 col-sm-offset-1"><?php echo $this->lang->line('about_your_self');?> :</label>
                                            <div class="col-sm-10 col-sm-offset-1">
                                                <?php echo form_error('about_yourself') . form_input($profile_data['about_yourself']); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-10 col-sm-offset-1"> <?php echo $this->lang->line('reg_what_your_looking_for_in_a_partner');?></label>
                                            <div class="col-sm-10 col-sm-offset-1">
                                                <?php echo form_error('looking_for_in_partner') . form_textarea($profile_data['looking_for_in_partner']); ?>
                                            </div>
                                        </div>
                                        
                                       <script> 
									    	$('#reg_about_yourself').keyup(function() {
        										this.value = this.value.replace(/[^A-Za-z '()\.]/g,' ');
    										});
									  	 	$('#reg_looking_for_in_partner').keyup(function() {
        										//$(this).val($(this).val().replace(/[^A-Za-z0-9~`!@#$%^&*()_+-=\[\]{};'\\:"|,.\/<>?]/g,''))
												this.value = this.value.replace(/[^A-Za-z '()\.]/g,' ');
    										});
                                        </script>
                                    </div>
                                </div>
                            </div>

                            <p class="txt-center">
								<input type="hidden" id="form_edit_profile_save" name="form_edit_profile_save" value="edit_profile">
                                <button id="edit_profile_save" type="submit" class="btn btn-lg btn-danger"><?php echo $this->lang->line('Submit');?></button>
                            </p>
                        </form>
                      </div>

                      <!-- Edit Match -->
                      <div class="tab-pane active" id="match">
                       <?php /*?> <h4 class="txt-red txt-upper clearfix"><?php echo $this->lang->line('edit_match_criteria');?>
                            <a href="#" class="btn btn-danger pull-right"><?php echo $this->lang->line('view_match');?></a>
                        </h4><?php */?>
                        <h5 class="page-title"><?php echo $this->lang->line('help_us_find_you');?></h5>
                        <form class="form-horizontal" method="POST">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="content-box-border">
                                        <legend><?php echo $this->lang->line('their_basic_detail');?></legend>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"><?php echo $this->lang->line('iam_seeking_a');?></label>
                                            <div class="col-sm-6">
                                                <?php //echo form_dropdown('im_seeking_a', $match['im_seeking_a']['options'], $match['im_seeking_a']['value'], $match['im_seeking_a']['form_options']);?>
                                                 <select class="form-control" id="looking_for" name="looking_for">
													<?php if($getlooking_for == 'f'){ ?>
                                                            <option value="female">Female</option>
                                                            <option value="male">Male</option>
                                                    <?php }else{ ?>
                                                            <option value="male">Male</option>
                                                            <option value="female">Female</option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"><?php echo $this->lang->line('age_between');?></label>
                                            <div class="col-sm-7">
                                                <input type="text" id="match_age-slider" name="age" value="18;99" />
                                            </div>
                                        </div>
                                        <div class="form-group live-box">
                                            <label class="col-sm-3 control-label"><?php echo $this->lang->line('prfmngr_living_in');?></label>
                                            <div class="col-sm-4">
                                                <?php echo form_dropdown('living_in', $match['living_in']['options'], $match['living_in']['value'], $match['living_in']['form_options']);?>
                                            </div>
                                            <div class="col-sm-5">
                                                <?php echo form_dropdown('living_in2', $match['living_in2']['options'], $match['living_in2']['value'], $match['living_in2']['form_options']);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"><?php echo $this->lang->line('with_in_km');?></label>
                                            <div class="col-sm-6">
                                                <?php echo form_dropdown('with_in', $match['with_in']['options'], $match['with_in']['value'], $match['with_in']['form_options']);?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    
							<!-- their background and cultural details-->
                            	<div class="">
                                    <div class="content-box-border">
                                      <legend>Their Background / Cultural Values</legend>
                                      <div class="form-group">
                                        <label class="col-sm-3 control-label"><?php echo $this->lang->line('Nationality');?></label>
                                        <div class="col-sm-7"> <?php echo form_dropdown('nationality', $match['nationality']['options'], $match['nationality']['value'], $match['nationality']['form_options']);?> </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-sm-3 control-label"><?php echo $this->lang->line('Education')?></label>
                                        <div class="col-sm-7"> <?php echo form_dropdown('education', $match['education']['options'], $match['education']['value'], $match['education']['form_options']);?> </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-sm-3 control-label"><?php echo $this->lang->line('Religion')?></label>
                                        <div class="col-sm-7"> <?php echo form_dropdown('religion', $match['religion']['options'], $match['religion']['value'], $match['religion']['form_options']);?> </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-sm-3 control-label"><?php echo $this->lang->line('chinese_sign');?></label>
                                        <div class="col-sm-7"> <?php echo form_dropdown('chinese_sign', $match['chinese_sign']['options'], $match['chinese_sign']['value'], $match['chinese_sign']['form_options']);?> </div>
                                        </div>
                                         <div class="form-group">
                                        <label class="col-sm-3 control-label"><?php echo $this->lang->line('star_sign');?></label>
                                        <div class="col-sm-7"> <?php echo form_dropdown('star_sign',  $match['star_sign']['options'],  $match['star_sign']['value'],  $match['star_sign']['form_options']);?> </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-sm-3 control-label"><?php echo $this->lang->line('living_situation');?></label>
                                        <div class="col-sm-7"> <?php echo form_dropdown('living_situation', $match['living_situation']['options'], $match['living_situation']['value'], $match['living_situation']['form_options']);?> </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-sm-3 control-label"><?php echo $this->lang->line('incomeperyear');?></label>
                                        <div class="col-sm-7"> <?php echo form_dropdown('incomeperyear', $match['incomeperyear']['options'], $match['incomeperyear']['value'], $match['incomeperyear']['form_options']);?> </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-sm-3 control-label"><?php echo $this->lang->line('workingstatus');?></label>
                                        <div class="col-sm-7"> <?php echo form_dropdown('workingstatus', $match['workingstatus']['options'], $match['workingstatus']['value'], $match['workingstatus']['form_options']);?> </div>
                                      </div>
                                    </div>
                              </div>
							<!--end their nackground and cultrul details-->
                                    
                                    
                                </div>
                                <div class="col-sm-6">
                                    <div class="content-box-border">
                                        <legend><?php echo $this->lang->line('their_appearance');?></legend>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="amount"><?php echo $this->lang->line('Height');?></label>
                                            <div class="col-sm-9">
                                                <input type="text" id="match_height-slider" name="height" value="100;220" />
                                                <?php //echo form_input($profile_data['height']);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="amount"><?php echo $this->lang->line('Weight');?></label>
                                            <div class="col-sm-9">
                                                <input id="match_weight-slider" type="text" name="weight" value="40;100" />
                                            </div>
                                        </div>
                                        <legend><?php echo $this->lang->line('body_type');?>:</legend>
                                        <?php
										//print_r($match['body_type']);
										$hcount = 1;
										foreach($match['body_type'] as $hvalue)
										{
											$odd = array(1,3,5,7,9,11,13,15,17,19,21);
										
											if(in_array($hcount, $odd))
											{
												?>
												<div class="form-group">
												<label class="checkbox-inline col-sm-4 col-sm-offset-1">
													<input id="match_<?php echo str_replace(' ', '_', $hvalue['options']); ?>" name="body_type[]" <?php if(isset($hvalue['selected'])){ echo "checked=\"checked\"";}?> value="<?php echo $hvalue['options']; ?>" type="checkbox"> <?php echo $hvalue['options']; ?>
												</label>											
												<?php
											} else {
												?>
												<label class="checkbox-inline col-sm-4 col-sm-offset-1">
													<input id="match_<?php echo str_replace(' ', '_', $hvalue['options']); ?>" name="body_type[]" <?php if(isset($hvalue['selected'])){ echo "checked=\"checked\"";}?> value="<?php echo $hvalue['options']; ?>" type="checkbox"> <?php echo $hvalue['options']; ?>
												</label>
												</div>	
												<?php
											}
											?>
                                        									
										<?php
										$hcount++;
										}
										if(!in_array($hcount, $odd))
										{
										?>
										</div>	
										<?php
										}
										?>	
                                        
										<?php /*?><?php
										
										$btcount = 1;
										$odd = array(1,3,5,7,9,11,13,15,17,19,21);
										foreach($match['body_type'] as $btvalue){
											if(in_array($btcount, $odd)){
												?>
												<div class="form-group">
												<label class="checkbox-inline col-sm-4 col-sm-offset-1">
													<?php /*?><input name="match_body_type" <?php if(isset($btvalue['selected'])){ echo "checked=\"checked\"";}?> value="<?php echo $btvalue['options']; ?>" type="radio"> <?php echo $btvalue['options']; ?>
                                                    	<?php foreach($body_type['reg_body_type_options'] as $rylf)
															{
																?>
																<input id="Rel_<?php echo str_replace(' ', '_', $rylf['options']); ?>" name="body_type[]" <?php if(isset($rylf['selected'])){ echo "checked=\"checked\"";}?> value="<?php echo $rylf['options']; ?>" type="checkbox"> <?php echo $rylf['options']; ?>
																<? 
															}?>	
												</label>											
												<?php
											} else 
											{
												?>
												<label class="checkbox-inline col-sm-4 col-sm-offset-1">
													<?php /*?><input name="match_body_type" <?php if(isset($btvalue['selected'])){ echo "checked=\"checked\"";}?> value="<?php echo $btvalue['options']; ?>" type="radio"> <?php echo $btvalue['options']; ?>
												
                                                	<?php foreach($body_type['reg_body_type_options'] as $rylf)
														{
															?>
															<input id="Rel_<?php echo str_replace(' ', '_', $rylf['options']); ?>" name="body_type[]" <?php if(isset($rylf['selected'])){ echo "checked=\"checked\"";}?> value="<?php echo $rylf['options']; ?>" type="checkbox"> <?php echo $rylf['options']; ?>
															<? 
														}?>	
                                                </label>
                                                
												</div>	
												<?php
											}
											
										$btcount++;
										}
										?><?php */?>
                                        
                                        
                                        
                                        
                                        
                                        <legend><?php echo $this->lang->line('their_ethnicity');?>:</legend>
                                        <div class="form-group">
											<div class="col-sm-8">
												<?php echo form_dropdown('ethnicity', $match['ethnicity']['options'], $match['ethnicity']['value'], $match['ethnicity']['form_options']);?>
											</div>
                                        </div>
                                        
                                        
                                        

                                    </div>
                                
                                <!--life style-->
                                <div class="content-box-border">
                                        <legend><?php echo $this->lang->line('their_lifestyle');?></legend>
                                        <?php /*?><div class="form-group">
                                            <label class="checkbox-inline col-sm-4 col-sm-offset-1">
												<?php  echo form_radio($match['lifestyle']) . ' ' . $match['lifestyle']['value'];?>
                                            </label>
                                            <label class="checkbox-inline col-sm-4">
                                                <?php echo form_radio($match['lifestyle1']) . ' ' . $match['lifestyle1']['value'];?>
                                            </label>    
                                        </div>
                                        <div class="form-group">
                                            <label class="checkbox-inline col-sm-4 col-sm-offset-1">
                                                <?php echo form_radio($match['lifestyle2']) . ' ' . $match['lifestyle2']['value'];?>
                                            </label>

                                        </div> <hr>
										<?php */?>
                                       
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"><?php echo $this->lang->line('Nationality');?> :</label>
                                            <div class="col-sm-8">
											<?php echo form_dropdown('nationality', $match['nationality']['options'], $match['nationality']['value'], $match['nationality']['form_options']);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"><?php echo $this->lang->line('Education');?></label>
                                            <div class="col-sm-8">
                                                <?php echo form_dropdown('education', $match['education']['options'], $match['education']['value'], $match['education']['form_options']);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"><?php echo $this->lang->line('english_ability');?></label>
                                            <div class="col-sm-8">
                                                <?php echo form_dropdown('english_ability', $match['english_ability']['options'], $match['english_ability']['value'], $match['english_ability']['form_options']);?>
                                            </div>
                                        </div>
                                        <?php /*?><div class="form-group">
                                            <label class="col-sm-3 control-label"><?php echo $this->lang->line('vietnamese_ability');?></label>
                                            <div class="col-sm-8">
                                                 <?php echo form_dropdown('vietnamese_ability', $match['vietnamese_ability']['options'], $match['vietnamese_ability']['value'], $match['vietnamese_ability']['form_options']);?>
                                            </div>
                                        </div><?php */?>										

								
                                    </div>
                                <!--end life style-->
                                </div>
                                
                                
                            </div>
                            
                           
                            
                            
                            <p class="txt-center">
								<input type="hidden" id="form_match_save" name="form_match_save" value="match">
                                <button id="match_save" name="match_save"  type="button" class="btn btn-lg btn-danger">Setup Matches<?php //echo $this->lang->line('Submit')?></button>
                            </p>
                        </form>    
                      </div>
                      
                      
                      <div class="tab-pane" id="interest1">
                         <?php /*?> <h4 class="txt-red txt-upper clearfix"><?php echo $this->lang->line('hobbies');?>
                                <a href="#" class="btn btn-danger pull-right"><?php echo $this->lang->line('view_match');?></a>
                          </h4><?php */?>
                          <h5 class="page-title"><?php echo $this->lang->line('let_another_know_txt');?></h5>
                          <form class="form-horizontal">
                            <div class="box-content-border">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="content-box-border">
                                            <legend><?php echo $this->lang->line('prfmange_what_do_you_do_for_fun');?></legend>
                                        <?php
										//print_r($match['body_type']);
										$hcount = 1;
										foreach($hobbies_data['what_do_you_do_for_fun'] as $hvalue)
										{
											$odd = array(1,3,5,7,9,11,13,15,17,19,21,23,25,27,29,31,33,35,37,39,41,43,45,47,49,51,53,55,57,59,61);
										
											if(in_array($hcount, $odd))
											{
												?>
												<div class="form-group">
												<label class="checkbox-inline col-sm-5 col-sm-offset-1">
													<input id="hobbies_<?php echo str_replace(' ', '_', $hvalue['options']); ?>" name="what_do_you_do_for_fun" <?php if(isset($hvalue['selected'])){ echo "checked=\"checked\"";}?> value="<?php echo $hvalue['options']; ?>" type="checkbox"> <?php echo $hvalue['options']; ?>
												</label>											
												<?php
											} else {
												?>
												<label class="checkbox-inline col-sm-5 col-sm-offset-1">
													<input id="hobbies_<?php echo str_replace(' ', '_', $hvalue['options']); ?>" name="what_do_you_do_for_fun" <?php if(isset($hvalue['selected'])){ echo "checked=\"checked\"";}?> value="<?php echo $hvalue['options']; ?>" type="checkbox"> <?php echo $hvalue['options']; ?>
												</label>
												</div>	
												<?php
											}
											?>
                                        									
										<?php
										$hcount++;
										}
										if(!in_array($hcount, $odd))
										{
										?>
										<!--</div>	-->
										<?php
										}
										?>										
									</div>
                                    
                                    <!-----------------food--------------->
                                    <div class="content-box-border">
                                            <legend><?php echo $this->lang->line('what_sort_of_food_you_like');?></legend>
										<?php
										//print_r($match['body_type']);
										$h2count = 1;
										foreach($hobbies_data['what_sort_of_food_do_you_like'] as $h2value){
										$odd = array(1,3,5,7,9,11,13,15,17,19,21,23,25,27,29,31,33,35,37,39,41,43,45,47,49,51,53,55,57,59,61);
										
										?>
											<?php
											if(in_array($h2count, $odd)){
												?>
												<div class="form-group">
												<label class="checkbox-inline col-sm-5 col-sm-offset-1">
													<input id="" name="what_sort_of_food_do_you_like" <?php if(isset($h2value['selected'])){ echo "checked=\"checked\"";}?> value="<?php echo $h2value['options']; ?>" type="checkbox"> <?php echo $h2value['options']; ?>
												</label>											
												<?php
											} else {
												?>
												<label class="checkbox-inline col-sm-5 col-sm-offset-1">
													<input id="" name="what_sort_of_food_do_you_like" <?php if(isset($h2value['selected'])){ echo "checked=\"checked\"";}?> value="<?php echo $h2value['options']; ?>" type="checkbox"> <?php echo $h2value['options']; ?>
												</label>
												</div>	
												<?php
											}
											
										$h2count++;
										}
										if(!in_array($h2count, $odd))
										{
											?>
											<!--</div>	-->
											<?php
										}
										?>	
                                        </div>
                                  </div>
                                  <div class="col-sm-6">
                                  		<!-------------------------- music ------------------------------->
                                        <div class="content-box-border">
                                            <legend><?php echo $this->lang->line('prfmange_what_sort_of_music_are_you_into');?></legend>
                                        <?php
										//print_r($match['body_type']);
										$mcount = 1;
										foreach($music_data['what_sort_of_music_are_you_into'] as $mvalue)
										{
											$odd = array(1,3,5,7,9,11,13,15,17,19,21,23,25,27,29,31,33,35,37,39,41,43,45,47,49,51,53,55,57,59,61,63,65);
										
											if(in_array($mcount, $odd))
											{
												?>
												<div class="form-group">
												<label class="checkbox-inline col-sm-5 col-sm-offset-1">
													<input id="music_<?php echo str_replace(' ', '_', $mvalue['options']); ?>" name="what_sort_of_music_are_you_into" <?php if(isset($mvalue['selected'])){ echo "checked=\"checked\"";}?> value="<?php echo $mvalue['options']; ?>" type="checkbox"> <?php echo $mvalue['options']; ?>
												</label>											
												<?php
											} else {
												?>
												<label class="checkbox-inline col-sm-5 col-sm-offset-1">
													<input id="music_<?php echo str_replace(' ', '_', $mvalue['options']); ?>" name="what_sort_of_music_are_you_into" <?php if(isset($mvalue['selected'])){ echo "checked=\"checked\"";}?> value="<?php echo $mvalue['options']; ?>" type="checkbox"> <?php echo $mvalue['options']; ?>
												</label>
												</div>	
												<?php
											}
											?>
                                        									
										<?php
										$mcount++;
										}
										if(!in_array($mcount, $odd))
										{
										?>
										</div>	
										<?php
										}
										?>										
									</div>
                                        <!-------------------------- end music option -------------------->
                                        
                                  	<!-------------------------- sports ------------------------------->
                                    <div class="content-box-border">
                                            <legend><?php echo $this->lang->line('prfmange_what_sports_do_you_play_or_like_to_watch');?></legend>
                                        <?php
										//print_r($match['body_type']);
										$scount = 1;
										foreach($sports_data['what_sports_do_you_play_or_like_to_watch'] as $svalue)
										{
											$odd = array(1,3,5,7,9,11,13,15,17,19,21,23,25,27,29,31,33,35,37,39,41,43,45,47,49,51,53,55,57,59,61,63,65);
										
											if(in_array($scount, $odd))
											{
												?>
												<div class="form-group">
												<label class="checkbox-inline col-sm-5 col-sm-offset-1">
													<input id="sports_<?php echo str_replace(' ', '_', $svalue['options']); ?>" name="what_sports_do_you_play_or_like_to_watch" <?php if(isset($svalue['selected'])){ echo "checked=\"checked\"";}?> value="<?php echo $svalue['options']; ?>" type="checkbox"> <?php echo $svalue['options']; ?>
												</label>											
												<?php
											} else {
												?>
												<label class="checkbox-inline col-sm-5 col-sm-offset-1">
													<input id="sports_<?php echo str_replace(' ', '_', $svalue['options']); ?>" name="what_sports_do_you_play_or_like_to_watch" <?php if(isset($svalue['selected'])){ echo "checked=\"checked\"";}?> value="<?php echo $svalue['options']; ?>" type="checkbox"> <?php echo $svalue['options']; ?>
												</label>
												</div>	
												<?php
											}
											?>
                                        									
										<?php
										$scount++;
										}
										if(!in_array($scount, $odd))
										{
										?>
										</div>	
										<?php
										}
										?>										
									</div>
                                    <!-------------------------- end sports option -------------------->
                                    </div>
                                </div>
                            </div>
                            <p class="txt-center">
                                <button value="hobbies_save" type="button" id="hobbies_save" class="btn btn-lg btn-danger"><?php echo $this->lang->line('Submit');?></button>
                            </p>
                          </form>
                      </div>
                      
                      <!-- Tab Personality -->
                      <div class="tab-pane" id="verify">
                          <h4 class="txt-red txt-upper"><?php echo $this->lang->line('profile_verification');?></h4>
                          <h5 class="page-title"> <?php echo $this->lang->line('confirm_your_identity_txt');?></h5>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="content-box-border">
                                            <!--form class="form-horizontal"-->
											<div class="form-horizontal">
                                                <div class="form-group">
                                                    <div class="col-sm-4">
                                                        <?php echo form_input($profile_verify['first_name']);?>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <?php echo form_input($profile_verify['last_name']);?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-8">
                                                        <input type="text" placeholder="Phone Number" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="text" placeholder="Address" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-3">
                                                        <?php echo form_input($profile_verify['zip_code']);?>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <?php echo form_input($profile_verify['city']);?>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <?php echo form_input($profile_verify['state_province']);?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-6">
                                                        <input type="text" placeholder="Country" class="form-control">
                                                    </div>
                                                </div>
                                                <legend><?php echo $this->lang->line('upload_verification_doc_img');?></legend>
												
                                            <!--/form-->
											</div>
											<div>
												<div style="padding-bottom:15px;">
												<?php
												foreach ($submitted_ids as $sidkey => $sidvalue)
												{
													?>
													<a target="_blank" href="http://dating.dev/uploads/id/<?php echo $sidvalue['name']?>">
														<img style="margin:2px;margin-top:6px;" src="http://dating.dev/uploads/id/thumbnail/<?php echo $sidvalue['name']?>">
													</a>
													<?php	
												}
												?>
												</div>	
												<br>
												<legend><?php echo $this->lang->line('upload_verification_doc_img');?> </legend>												
												<span class="btn btn-success fileinput-button">
													<i class="glyphicon glyphicon-plus"></i>
													<span><?php echo $this->lang->line('select_image');?></span>
													<!-- The file input field used as target for the file upload widget -->
													<input id="fileupload" type="file" name="files[]" multiple>
													<input id="user_id" type="hidden" name="user_id" value='<?php echo $this->session->userdata['user_id'];?>'>
												</span>
												<br>
												<br>
												<!-- The global progress bar -->
												<div id="progress" class="progress">
													<div class="progress-bar progress-bar-success"></div>
												</div>
												<!-- The container for the uploaded files -->
												<div id="files" class="files">
										
												</div>
												<br>  

											</div>	
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="content-box-border">
                                        <h5 class="txt-red txt-upper page-title"><?php echo $this->lang->line('why_verify_my_profile');?></h5>
                                        <p><?php echo $this->lang->line('verify_your_profile_txt');?></p>

                                        <p><?php echo $this->lang->line('to_verify_profile_txt');?></p>

                                            <ul class="list-square">
                                                <li><?php echo $this->lang->line('give_another_member');?></li>
                                                <li><?php echo $this->lang->line('reduce_the_likhood');?></li>
                                                <li><?php echo $this->lang->line('distinguish_serious_members');?></li>
                                            </ul>

                                        <p><?php echo $this->lang->line('you_can_also_txt');?></p>
                                        <p><?php echo $this->lang->line('prfmngr_email');?>: <a href="mailto:team@VietnamCupid.com">team@VietnamCupid.com</a></p>
                                        <p><?php echo $this->lang->line('prfmngr_mail_detail');?> </p>

                                    </div>
                                </div>
                            </div>
                      </div>
                      <div class="tab-pane" id="personality">
                            <h4 class="txt-red txt-upper clearfix"><?php echo $this->lang->line('Personality');?>
                               <?php /*?> <a href="#" class="btn btn-danger pull-right"><?php echo $this->lang->line('view_profile');?></a><?php */?>
                            </h4>
                            <p class="page-title"><?php echo $this->lang->line('let_your_personality_shine_txt');?></p>
                            <form class="form" method="post">
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('what_is_your_fav_movie');?></label>
                                     <?php echo form_input($get_profile_personality['fav_movie']);?>
                                    <!--<input type="text" class="form-control" name="fav_movie" id="fav_movie">-->
                                </div>
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('what_is_your_fav_book');?></label>
                                     <?php echo form_input($get_profile_personality['fav_book']);?>
                                    <!--<input type="text" class="form-control" name="fav_book" id="fav_book">-->
                                </div>
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('what_sort_of_food_you_like');?></label>
                                     <?php echo form_input($get_profile_personality['food_you_like']);?>
                                    <!--<input type="text" class="form-control" name="food_you_like" id="food_you_like">-->
                                </div>
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('what_sort_of_music_you_like');?></label>
                                     <?php echo form_input($get_profile_personality['music_you_like']);?>
                                   <!-- <input type="text" class="form-control" name="music_you_like" id="music_you_like">-->
                                </div>
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('what_are_your_hobies');?></label>
                                     <?php echo form_input($get_profile_personality['your_hobies']);?>
                                   <!-- <input type="text" class="form-control" name="your_hobies" id="your_hobies">-->
                                </div>
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('how_would_you_describe_your_dress');?></label>
                                     <?php echo form_input($get_profile_personality['describe_your_dress']);?>
                                    <!--<input type="text" class="form-control" name="describe_your_dress" id="describe_your_dress">-->
                                </div>
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('how_would_you_describe_your_sense');?></label>
                                     <?php echo form_input($get_profile_personality['describe_your_sense']);?>
                                    <!--<input type="text" class="form-control" name="describe_your_sense" id="describe_your_sense">-->
                                </div>
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('how_would_you_describe_your_personality');?></label>
                                     <?php echo form_input($get_profile_personality['describe_your_personality']);?>
                                    <!--<input type="text" class="form-control" name="describe_your_personality" id="describe_your_personality">-->
                                </div>
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('where_have_you_travelled'); ?></label>
                                     <?php echo form_input($get_profile_personality['you_travelled']); ?>
                                   <!-- <input type="text" class="form-control" id="you_travelled" name="you_travelled">-->
                                </div>
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('how_adaptive_are_you');?></label>
                                     <?php echo form_input($get_profile_personality['adaptive_are_you']);?>
                                    <!--<input type="text" class="form-control" name="adaptive_are_you" id="adaptive_are_you">-->
                                </div>
                                <p class="txt-center">
                                <input type="hidden" id="form_save_personality" name="form_save_personality" value="save_personality">
                                    <button type="submit" class="btn btn-lg btn-danger" name="save_personality" id="save_personality"><?php echo $this->lang->line('Submit');?></button>
                                </p>
                            </form>
                      </div>
                      <div class="tab-pane" id="question">
                          <h4 class="txt-red txt-upper page-title"><?php echo $this->lang->line('question_about_person');?></h4>
                          <p><strong><?php echo $this->lang->line('please_read_instruction');?></strong></p>
                          <ul class="list-square">
                                <li><?php echo $this->lang->line('answer_the_questions');?></li>
                                <li><?php echo $this->lang->line('try_not_to_leave_any_neutral_answer');?></li>
                                <li><?php echo $this->lang->line('test_is_quite_long');?></li>
                          </ul>
                          <p><?php echo $this->lang->line('once_finished_press_result');?></p>
                          <p><?php echo $this->lang->line('if_you_do_not_have_much_time');?></p>
                            <form class="form-horizontal">
								<div class="content-box-border">
									<?php
									foreach($questions as $qkey=>$qvalue)
									{
										?>
										<div class="question-ct">
											<h5><?php echo $qkey;?>.  <?php echo $qvalue['value'];?>.</h5>
											<div class="choice">
												<?php //echo $qvalue['selected'];?>
												<label class="radio-inline">
                                                	<input type="radio" id="<?php echo $qvalue['name'];?>" name="<?php echo $qvalue['name'];?>" <?php if($qvalue['selected']=='disagree'){ echo ' checked="checked"';}?> value="disagree"><?php echo $this->lang->line('Disagree')?>
                                                </label>
												<label class="radio-inline">
                                                	<input type="radio" id="<?php echo $qvalue['name'];?>" name="<?php echo $qvalue['name'];?>" <?php if($qvalue['selected']=='partly_dissagree'){ echo ' checked="checked"';}?>value="partly_disagree"><?php echo $this->lang->line('partly_desgree');?>
                                                </label>
												<label class="radio-inline">
                                                	<input type="radio" id="<?php echo $qvalue['name'];?>" name="<?php echo $qvalue['name'];?>" <?php if($qvalue['selected']=='neither'){ echo ' checked="checked"';}?>value="neither">
												<?php echo $this->lang->line('Neither')?>
                                               	</label>
												<label class="radio-inline">
                                                	<input type="radio" id="<?php echo $qvalue['name'];?>" name="<?php echo $qvalue['name'];?>" <?php if($qvalue['selected']=='partly_agree'){ echo ' checked="checked"';}?>value="partly_agree"><?php echo $this->lang->line('partly_agree');?>
                                                </label>
												<label class="radio-inline">
                                                	<input type="radio" id="<?php echo $qvalue['name'];?>" name="<?php echo $qvalue['name'];?>" <?php if($qvalue['selected']=='agree'){ echo ' checked="checked"';}?>value="agree"><?php echo $this->lang->line('Agree')?>
                                                </label>
											</div>
										</div>
										<?php
									}
									?>
                                </div>
                                <p class="txt-center">
                                    <button type="button" id="questions_save" value="questions_save" class="btn btn-lg btn-danger"><?php echo $this->lang->line('Submit')?></button>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /End Tab Panes/ -->
            </div>    
        </section>
    </div><!-- End #content -->