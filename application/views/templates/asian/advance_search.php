<?php
$gender = array('m' => 'Male', 'f' => 'Female');
?>
<!-- MAIN CONTENT -->

<div class="content-box">
  <section class="container">
    <div class="row">
      <ol class="breadcrumb">
        <li><i class="fa fa-user fa-2x icon-round-border"></i></li>
        <li class="active"><span><?php echo $this->lang->line('advance_search');?></span></li>
      </ol>
    </div>
    <!-- /BREADCRUMB/ -->
    <div class="box gray-bg">
      <div class="row">
        <div class="col-sm">
          <div class="content-box-border">
            <h4 class="box-title clearfix bg-red"> <i class="fa fa-search"></i> <span class="txt-upper"><?php echo $this->lang->line('advance_search'); ?></span> </h4>
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
                  <div class="col-sm-3">
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
                  <div class="col-sm-2">
                    <?php 
					   // $age_arr =  array(lang('select')) + array_combine(range(18, 99), range(18, 99));
						$age_arr_min =  array_combine(range(18, 99), range(18, 99));
						$age_arr_max =  array_combine(range(99, 18), range(99, 18));
					?>
                    <?php echo form_dropdown('min_age', $age_arr_min, '', 'class="form-control"'); ?> </div>
                  <label class="col-sm-1 control-label"> to </label>
                  <div class="col-sm-2"> <?php echo form_dropdown('max_age', $age_arr_max, '', 'class="form-control"'); ?> </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label"><?php echo lang('country') ?></label>
                  <div class="col-sm-5">
                    <?php array_unshift($countries, lang('selecect_country')); // = lang('selecect_country'); ?>
                    <?php echo form_dropdown('country', $countries, '#', 'id="country", class="form-control"'); ?> </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label"><?php echo lang('state') ?></label>
                  <div class="col-sm-5" id="divState">
                    <select class="form-control" name="state_province">
                      <option value=""><?php echo $this->lang->line('select_state'); ?></option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="city" class="col-sm-3 control-label"><?php echo $this->lang->line('reg_city'); ?></label>
                  <div id="divCity" class="col-sm-5">
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
                      <input type="checkbox" name="profile_pic" value="1">
                      <?php echo lang('photo_text') ?> </div>
                  </div>
                  <div class="col-sm-2">
                    <button class="btn btn-danger btn-block" type="submit"><i class="fa fa-search"></i> Search</button>
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
            <div class="box-ct">
              <form class="form-horizontal" method="POST" action="/search/advancesearch">
                <?php /*?> <legend><?php echo $this->lang->line('basic_detail');?></legend>
                
                <div class="form-group">
                  <label class="col-sm-3 control-label"><?php echo lang('loogin_for') ?></label>
                  <div class="col-sm-7">
                    <?php //echo form_dropdown('looking_for', $looking_for['options'], $looking_for['value'], $looking_for['form_options']); ?>
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
                  <label class="col-sm-3 control-label"><?php echo lang('age') ?></label>
                  <div class="col-sm-2">
                    <?php  //$age_arr =  array(lang('select')) + array_combine(range(18, 99), range(18, 99));  ?>
                    <?php  	$age_arr_min =  array_combine(range(18, 99), range(18, 99));
							$age_arr_max =  array_combine(range(99, 18), range(99, 18));
					?>
                    <?php echo form_dropdown('min_age', $age_arr_min, '', 'class="form-control"') ?> </div>
                  <label class="col-sm-1 control-label">to</label>
                  <div class="col-sm-2"> <?php echo form_dropdown('max_age', $age_arr_max, '', 'class="form-control"') ?> </div>
                </div><?php */?>
                <h4 class="box-title clearfix bg-red"> <i class="fa fa-search"></i> <span class="txt-upper">Advance Search</span> </h4>
                <div class="row">
                  <div class="col-md-6">
                    <div class="content-box-border">
                      <legend><?php echo $this->lang->line('their_backgroud'); ?></legend>
                      <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo $this->lang->line('nationality_search');?></label>
                        <div class="col-sm-7"> <?php echo form_dropdown('nationality', $nationality['options'], $nationality['value'], $nationality['form_options']);?> </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo $this->lang->line('education_search')?></label>
                        <div class="col-sm-7"> <?php echo form_dropdown('education', $education['options'], $education['value'], $education['form_options']);?> </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo $this->lang->line('religion_search')?></label>
                        <div class="col-sm-7"> <?php echo form_dropdown('religion', $religion['options'], $religion['value'], $religion['form_options']);?> </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo $this->lang->line('eligibilityability');?></label>
                        <div class="col-sm-7"> <?php echo form_dropdown('english_ability', $english_ability['options'], $religion['value'], $religion['form_options']);?> </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo $this->lang->line('living_situation');?></label>
                        <div class="col-sm-7"> <?php echo form_dropdown('living_situation', $living_situation['options'], $religion['value'], $religion['form_options']);?> </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo $this->lang->line('incomeperyear');?></label>
                        <div class="col-sm-7"> <?php echo form_dropdown('incomeperyear', $incomeperyear['options'], $religion['value'], $religion['form_options']);?> </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo $this->lang->line('workingstatus');?></label>
                        <div class="col-sm-7"> <?php echo form_dropdown('workingstatus', $workingstatus['options'], $religion['value'], $religion['form_options']);?> </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo $this->lang->line('reg_chinese_sign');?></label>
                        <div class="col-sm-7"> <?php echo form_dropdown('chinese_sign', $chinese_sign['options'], $chinese_sign['value'], $chinese_sign['form_options']);?> </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo $this->lang->line('reg_star_sign');?></label>
                        <div class="col-sm-7"> <?php echo form_dropdown('star_sign', $star_sign['options'], $star_sign['value'], $star_sign['form_options']);?> </div>
                      </div>
                      <?php /*?> <div class="form-group">
                	<label class="col-sm-3 control-label"><?php echo $this->lang->line('vietnameseability')?></label>
                    <div class="col-sm-7"> <?php echo form_dropdown('vietnamese_ability', $vietnamese_ability['options'], $vietnamese_ability['value'], $vietnamese_ability['form_options']);?></div>
                </div><?php */?>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="content-box-border">
                      <legend><?php echo $this->lang->line('their_appearances')?></legend>
                      <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo $this->lang->line('reg_hair_color');?></label>
                        <div class="col-sm-7"> <?php echo form_dropdown('hair_color', $hair_color['options'], $hair_color['value'], $hair_color['form_options']);?> </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo $this->lang->line('reg_eye_color');?></label>
                        <div class="col-sm-7"> <?php echo form_dropdown('eye_color', $eye_color['options'], $eye_color['value'], $eye_color['form_options']);?> </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-sm-3" for="amount"><?php echo $this->lang->line('height');?></label>
                        <div class="col-sm-7"> <?php echo form_input($height); ?> </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-sm-3" for="amount"><?php echo $this->lang->line('weight');?></label>
                        <div class="col-sm-7"> <?php echo form_input($weight); ?> </div>
                      </div>
                      <?php /*?> <legend><?php echo $this->lang->line('body_type_search');?></legend><?php */?>
                      <div class="form-group">
                        <label class="control-label col-sm-3" for="amount"><?php echo $this->lang->line('body_type_search')?></label>
                        <div class="col-sm-7"> <?php echo form_dropdown('body_type', $body_type['options'], $body_type['value'], $body_type['form_options']);?> </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Their Appearance as</label>
                        <div class="col-sm-7"> <?php echo form_dropdown('myselfconsider_options', $myselfconsider['options'], $myselfconsider['value'], $myselfconsider['form_options']);?></div>
                      </div>
                      <?php if($profile['gender'] != 'f'){?>
                      <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo $this->lang->line('cupsize');?></label>
                        <div class="col-sm-7"> <?php echo form_dropdown('cupsize', $cupsize['options'], $cupsize['value'], $cupsize['form_options']);?> </div>
                      </div>
                      <?php 
						}?>
                      <?php /*?>  <legend><?php echo $this->lang->line('their_ethnicity_is'); ?></legend>
					 <div class="form-group">
					  <label class="control-label col-sm-3" for="amount"><?php echo $this->lang->line('ethnicity_search');?></label>
					  <div class="col-sm-7">  <?php echo form_dropdown('ethnicity', $ethnicity['options'], $ethnicity['value'], $ethnicity['form_options']);?>  </div>
					</div><?php */?>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="content-box-border">
                      <legend><?php echo $this->lang->line('lifestyle'); ?></legend>
                      <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo $this->lang->line('reg_do_you_drink');?></label>
                        <div class="col-sm-5"> <?php echo form_dropdown('drink', $drink['options'], $drink['value'], $drink['form_options']);?> </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo $this->lang->line('reg_do_you_smoke');?></label>
                        <div class="col-sm-5"> <?php echo form_dropdown('smoke', $smoke['options'], $smoke['value'], $smoke['form_options']);?> </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo $this->lang->line('reg_marital_status');?></label>
                        <div class="col-sm-5"> <?php echo form_dropdown('marital_status', $marital_status['options'], $marital_status['value'], $marital_status['form_options']);?> </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo $this->lang->line('reg_do_you_have_children');?></label>
                        <div class="col-sm-5"> <?php echo form_dropdown('have_children', $have_children['options'], $have_children['value'], $have_children['form_options']);?> </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo $this->lang->line('reg_occupation');?></label>
                        <div class="col-sm-5"> <?php echo form_dropdown('occupation', $occupation['options'], $occupation['value'], $occupation['form_options']);?> </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo $this->lang->line('reg_willing_to_relocate');?></label>
                        <div class="col-sm-5"> <?php echo form_dropdown('willing_to_relocate', $willing_to_relocate['options'], $willing_to_relocate['value'], $willing_to_relocate['form_options']);?> </div>
                      </div>
                      <legend>Looking For</legend>
                      <div class="form-group">
                        <label class="control-label col-sm-3" for="amount">Looking For</label>
                        <div class="col-sm-7">
                          <?php /*?><?php echo form_dropdown('lookingfor_options', $lookingfor['options'], $lookingfor['value'], $lookingfor['form_options']);?><?php */?>
                          <?php foreach($lookingfor['relationship_is_looking_for_options'] as $rylf)
							{
								?>
                              	<input id="Rel_<?php echo str_replace(' ', '_', $rylf['options']); ?>" name="lookingfor[]" <?php if(isset($rylf['selected'])){ echo "checked=\"checked\"";}?> value="<?php echo $rylf['options']; ?>" type="checkbox">
                              	<?php echo $rylf['options']; ?>
                              	<?php 
							}?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div align="center" class="form-group">
                  <?php if($users['donate_user'] == '') { ?>
                  <button id="advance_search" type="button" class="btn btn-lg btn-danger" name="search" onClick="myfunc();"><?php echo $this->lang->line('submit')?></button>
                  <?php } else { ?>
                  <button id="advance_search" type="submit" class="btn btn-lg btn-danger" name="search"><?php echo $this->lang->line('submit')?></button>
                  <?php } ?>
                </div>
              </form>
              <script>
              function myfunc() {
			 	$('#donate').click();
				$('#myModal').modal();
			   }
              </script>
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
						?>
                        <img class="media-object img-circle" src="/uploads/profile/thumbnail/<?php echo $users[$new_member['id']]['avatar'];?>" width="110" height="110">
                        <!-- <a href="" data-toggle="modal"><img src="/resources/img/gallery_1.png" alt=""></a>   -->
                        <?php 
					} ?>
          </div>
          <div class="clearfix"></div>
          <p class="member-id"><a href="/profile/user/<?php echo $new_member['id'];?>" data-toggle="modal"><strong><?php echo $new_member['first_name'].' '.$new_member['last_name']. ' (' . $new_member['age'] . ')';?> </strong></a></p>
          <p class="member-quote"><em><i class="fa fa-quote-left"></i> <?php echo $new_member['profile_head']; ?> </em></p>
          <p class="member-loc"><?php echo ucfirst($new_member['state_province']); ?> <?php echo ucfirst($new_member['city']); ?>, <?php echo $new_member['country']; ?></p>
          <p class="member-status"><strong> <?php echo $this->lang->line('seeking'); ?> </strong> <?php echo $new_member['im_seeking_a']; ?> <?php echo str_replace(';', '-', $new_member['age_between']); ?></p>
          <?php /*?><p class="member-action">
			<a href="/chat" title="Live Chat" data-toggle="modal"><i class="fa fa-comments"></i></a>  
			<?php 
			if($new_member['like'] == '1'){?>
				<a href="search/unlike/<?php echo $new_member['id']?>/<?php echo $this->session->userdata['user_id']; ?>" title="Unlike" ><i class="fa fa-thumbs-up"></i></a>   
			<?php  }else{ ?>
				<a href="search/like/<?php echo $new_member['id']?>/<?php echo $this->session->userdata['user_id']; ?>" title="Like" ><i class="fa fa-thumbs-down"></i></a>   
			<?php } ?>
			<a href="#modal-heart<?php echo $new_member['id']; ?>" title="Send Heart" data-toggle="modal"><i class="fa fa-heart"></i></a> 
			<a href="#modal-warning<?php echo $new_member['id']; ?>"  data-toggle="modal"><span class="fa fa-warning label-warning">  </span></a>
			<a href="search/favorite/<?php echo $new_member['id']?>/<?php echo $this->session->userdata['user_id']; ?>" title="Favourite" ><i class="fa fa-plus"></i></a> 
			<!--<a href="#modal-fav<?php echo $new_member['id']; ?>" title="Add to Favourite" data-toggle="modal"><i class="fa fa-plus"></i></a>-->
			</p><?php */?>
			<?php if($new_member['block_user_id'] == $new_member['id'])
					{
						?>
						<p class="member-action"> <a href="<?php echo base_url('/mail/unblock_user').'/'.$new_member['id']; ?>" class="btn btn-danger fa fa-ban"> Unblock </a> </p>
						<?php
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
                        			<a href="#modal-warningsend"  data-toggle="modal"><span class="fa fa-warning label-warning"> </span></a>
                       				<?php
								}else{ 
									?>
                        			<a href="#modal-warning<?php echo $new_member['id']; ?>"  data-toggle="modal"><span class="fa fa-warning label-warning"> </span></a>
                        			<?php 
								} ?>
                        <!--favorite-->
                        <?php  if($new_member['favourite'] >= '1')
								{ 
									?>
                                    <a href="#" title="" ><i class="fa fa-minus fav"></i></a>
                                    <?php  
								}else{ ?>
                        			<a href="search/favorite/<?php echo $new_member['id']?>/<?php echo $this->session->userdata['user_id']; ?>" title="Favourite" ><i class="fa fa-plus"></i></a>
                        			<?php 
								} ?>
                        </p>
          				<?php 
						} ?>
         	</div>
        	<?php 
			}
		} ?>
      </div>
    </div>
  </section>
  <!-- End .container -->
</div>
<!-- End #content -->
<script type="text/javascript">
    $(document).ready(function() 
    {
        $("#country").on("change", function() { 
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

        $("#divState").on("change", function() {
            var state_id = $("#state").val();
            var country_id = $("#country").val();
            $.ajax({
                type: "POST",
                url: "<?php echo site_url();?>register/get_city/",
                data: {state_id: state_id, country_id: country_id},
                success: function(data)
                {
                    $('#divCity').html(data);
                }
            });
        });
			
    });
</script>
