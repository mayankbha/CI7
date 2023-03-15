<div class="content-box">
    <section class="container"> 
     <?php /*?>
		<!--<div align="center" ><h3 class="success"><font color="#006633"><?php echo $_GET['msg']; ?></font></h3></div>-->   
		<?php }?><?php */?>
        <div class="row">
            <ol class="breadcrumb">
                <li><i class="fa fa-user fa-2x icon-round-border"></i></li>
                <li class="active"><span> <?php echo $this->lang->line('search_title');?> </span></li>
            </ol>
        </div>
       
        <div class="section-title bg-red txt-upper"> <?php echo $this->lang->line('search_title');?> </div>
        <?php
			$gender = array('m' => 'Male', 'f' => 'Female');
		?>
        <!-- search form -->
        <div class="box-ct">
            <form class="form-horizontal" method="POST" action="<?php echo site_url('search'); ?>">
                <div class="form-group col-sm-3">
                    <label class="col-sm-3 control-label"> <?php echo $this->lang->line('iam_search');?> </label>
                    <div class="col-sm-4">
                        <?php echo $gender[$profile['gender']]; ?>
                    </div>
                </div>
                <div class="form-group col-sm-4">
                    <label class="col-sm-4 control-label"><?php echo lang('loogin_for'); ?></label>
                    <div class="col-sm-4">
                        <?php echo form_dropdown('looking_for', $looking_for['options'], $looking_for['value'], $looking_for['form_options']); ?>	
                    </div>   
                </div>    
                <div class="form-group col-sm-4">
                    <label class="col-sm-3 control-label"><?php echo lang('age'); ?></label>
                    <div class="col-sm-4">
                        <?php 
							//$age_arr =  array(lang('select')) + array_combine(range(16, 50), range(16, 50));
							$age_arr_min =   array_combine(range(18, 99), range(18, 99));
							$age_arr_max =   array_combine(range(99, 18), range(99, 18));
							$select_min_age = ($this->input->post('min_age')) ? $this->input->post('min_age') : lang('select') ;
                            //echo $this->input->post('min_age');
							//echo $select_age; 
                        ?>
                        <?php echo form_dropdown('min_age', $age_arr_min, $select_min_age, 'class="form-control"'); ?>
                    </div>
                    <label class="col-sm-1 control-label"> to </label>
                    <div class="col-sm-4">
                    	<?php $select_max_age = ($this->input->post('max_age')) ? $this->input->post('max_age') : lang('select');?>
                        <?php echo form_dropdown('max_age', $age_arr_max, $select_max_age, 'class="form-control"'); ?>
                    </div>
                </div>
                <div class="form-group col-sm-4">
                    <label class="col-sm-3 control-label"><?php echo lang('country'); ?></label>
                    <div class="col-sm-8">
                    
                     <?php 
						$selected = ($this->input->post('country')) ? $this->input->post('country') : array_unshift($countries, lang('selecect_country')); 
						//echo countries;
						array_unshift($countries, lang('selecect_country')); ?>
                        <?php echo form_dropdown('country', $countries,$selected, 'id="country", class="form-control"');?>
                       <?php /*?> <?php 
						
						array_unshift($countries, lang('selecect_country')); ?>
                        <?php echo form_dropdown('country', $countries, '#', 'id="country", class="form-control"'); ?><?php */?>
                    </div>
                </div>
                <div class="form-group col-sm-4">
                    <label class="col-sm-3 control-label"><?php echo lang('state'); ?></label>
                    <div class="col-sm-8" id="divState">
                    
                    
                   		<?php
                        $country = $this->input->post('country');  
						$result  =  $this->lang->line('reg_'.$country.'_state');
						echo '<select name="state_province" id="state" class="form-control">';
							echo '<option value="">Select State</option>';
							echo '<option value="">All</option>';
					
							foreach($result as $key => $val)
							{  
							?>
								<option value="<?php echo $key;?>" <?php if(isset($key) AND $key == $this->input->post('state_province')){ echo 'selected="selected"';} ?>><?php echo $val;?></option>
							<?php  
						}
						echo '</select>';
						?>
                 
                       <?php /*?> <select class="form-control" name="state_province">
                        
                        
                        <option <?php echo (isset($_POST['state_province'])) ? 'selected="selected"' : $this->input->post('state_province'); ?> value=" <?php echo $this->input->post('state_province');  ?>"><?php echo $this->input->post('state_province')?></option>
                            <!--<option value=""><?php echo $this->lang->line('select_state'); ?></option> -->
                        </select><?php */?>
                    </div>
                   
                </div>
                
                <div class="form-group col-sm-4">
                    <label class="col-sm-3 control-label"><?php echo lang('city'); ?></label>
                    <div class="col-sm-8" id="divCity">
                   		<?php
                        $state_id = $this->input->post('state_province');
						$county_id = $this->input->post('country');
				
						$states = $this->lang->line('reg_'.$county_id.'_state');
						$state_name = strtolower(str_replace(' ', '_', $states[$state_id]));
				
						$result = $this->lang->line( 'reg_'.$county_id . '_' . $state_name);
				
						echo  '<select name="city" class="form-control">';
						echo  '<option value="">Select City</option>';
						echo  '<option value="">All</option>';
						 foreach($result as $key => $val)
						{
							   //echo '<option value="'.$key.'">'.$val.'</option>';
						?>
							<option value="<?php echo $key;?>" <?php if(isset($key) AND $key == $this->input->post('city')){ echo 'selected="selected"';} ?>><?php echo $val;?></option>
						<?php
						}
						echo '</select>'; 
						?>
                    </div>
                </div>
                
                <div class="form-group col-sm-1">
                        <button class="btn btn-danger btn-block" type="submit"><i class="fa fa-search"></i></button>
                </div>
                <div class="form-group">
                    <div class="col-sm-5"></div>   
                    <div class="col-sm-3"></div>   
                </div>
            </form>
		</div>
        <!-- End search form-->
        <div class="row search-result-ct"></div>   
        <div class="">
            <div class="section-title bg-red txt-upper">
                <?php echo $this->lang->line('highest_matching'); ?>
            </div>
            <?php
          	if($search_result == 0)
            {
                echo '<div class="row">
                        <div class="col-sm-12">
                            <div class="member-box content-box-border">
                                Search found (0) members matching your criteria.
                                <br>
                                Pls. Widen your search to get better results.
                            </div>
                        </div>
                    </div>';   
            } else
            {
                $found_users_count = 1;   
                $odd = array(1, 3, 5, 7, 9, 11, 13, 15, 17, 19, 21);
             	foreach ($found_users as $fid => $fvalue)
                {
                    if (in_array($found_users_count, $odd))
                    {
                        ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="member-box content-box-border">
                                    <div class="member-avatar pull-left">
                                     <?php if($users[$fid]['avatar'] == '')
									 		{
												if($fvalue['gender'] == 'm')
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
                                                <img class="media-object img-circle" src="/uploads/profile/thumbnail/<?php echo $users[$fid]['avatar'];?>" width="110" height="110" >
												<?php 
											}
									?>
                                    </div>
                                    <p class="member-id"><a href="/profile/user/<?php echo $fid; ?>"><strong><?php echo $fvalue['first_name'] . ' ' . $fvalue['last_name'] . ' (' . $fvalue['age'] . ')'; ?></strong></a></p>
                                    <p class="member-quote"><em><i class="fa fa-quote-left"></i> <?php echo $fvalue['profile_head']; ?></em></p>   
                                    <p class="member-loc"><?php echo ucfirst($fvalue['state_province']); ?> <?php echo ucfirst($fvalue['city']); ?>, <?php echo $fvalue['country']; ?></p>
                                    <!--<p class="member-status"><strong><?php echo $this->lang->line('seeking'); ?> </strong> <?php echo $fvalue['im_seeking_a']; ?> <?php echo str_replace(';', '-', $users[$fid]['age_between']); ?></p>-->  
                                    
                                    <p class="member-status"><strong><?php echo $this->lang->line('seeking'); ?> </strong> <?php if($fvalue['looking_for']=='m'){echo "male";}else{ echo "Female";} ?> <?php echo str_replace(';', '-', $users[$fid]['age_between']); ?></p>
                                   <?php /*?> gender <?php echo $fvalue['gender'];?><?php looking_for*/ ?>
                                    <p class="member-action">
                                    	<!--chat-->
                                        <a href="#modal-livechat" title="Live Chat" data-toggle="modal"><i class="fa fa-comments"></i></a>   
                                        <!--send heart-->
                                        <a href="#modal-heart<?php echo $fid; ?>" title="Send Heart" data-toggle="modal"><i class="fa fa-heart"></i></a> 
                                        <?php /*?><a href="#modal-like" title="Like" data-toggle="modal"><i class="fa fa-thumbs-up"></i></a>  <?php */?>
                                        <!--Like-->
                                        <?php 
										if($fvalue['like'] == '1'){ ?>
											<a href="search/unlike/<?php echo $fid; ?>/<?php echo $this->session->userdata['user_id']; ?>" title="Unlike" ><i class="fa fa-thumbs-up fav"></i></a>
										<?php  }else{ ?>
											<a href="search/like/<?php echo $fid; ?>/<?php echo $this->session->userdata['user_id']; ?>" title="Like" ><i class="fa fa-thumbs-up"></i></a>   
										<?php } ?>
                                        <!--warning-->
                                        <?php if($fvalue['warning_message'] == '1')
                                        {
                                            ?>
                                            <a href="#modal-warningsend"  data-toggle="modal"><span class="fa fa-warning label-warning">  </span></a> 
                                            <?php
                                        }else{ 
                                            ?>
                                            <a href="#modal-warning<?php echo $fid; ?>"  data-toggle="modal"><span class="fa fa-warning label-warning">  </span></a>
                                            <?php 
                                        } ?>
                                        
                                       <?php /*?> <a href="#modal-warning<?php echo $fid; ?>" title="Warning" data-toggle="modal"><i class="fa fa-exclamation"></i></a>   <?php */?>
                                        <!--favorite-->
                                         <?php 
										if($fvalue['favourite'] >= '1')
										{ 
											?> 
											<a href="#" title="" ><i class="fa fa-minus fav"></i></a>   
											<?php  
										}else{ 
											?>
											<a href="search/favorite/<?php echo $fid; ?>/<?php echo $this->session->userdata['user_id']; ?>" title="Favourite" ><i class="fa fa-plus"></i></a>
											<?php 
										} ?> 
                                    </p>
                                </div>
                            </div>
                            <?php
                        } else
                        {
                            ?>
                            <div class="col-sm-6"> 
                                <div class="member-box content-box-border"> 
                                   	<div class="member-avatar pull-left">
                                    <?php if($users[$fid]['avatar'] == '')
										{	
											if($fvalue['gender'] == 'm')
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
										?><img class="media-object img-circle" src="/uploads/profile/thumbnail/<?php echo $users[$fid]['avatar'];?>" width="110" height="110" >
										<!-- <a href="" data-toggle="modal"><img src="/resources/img/gallery_1.png" alt=""></a>   -->
										<?php 
									} ?>
                                        
                                    </div>
                                    <p class="member-id"><a href="/profile/user/<?php echo $fid;?>" data-toggle="modal"><strong><?php echo $fvalue['first_name'] . ' ' . $fvalue['last_name'] . ' (' . $fvalue['age'] . ')'; ?></strong></a></p>
                                    <p class="member-quote"><em><i class="fa fa-quote-left"></i> <?php echo $fvalue['profile_head']; ?></em></p>
                                    <p class="member-loc"><?php echo ucfirst($fvalue['state_province']); ?> <?php echo ucfirst($fvalue['city']); ?>, <?php echo $fvalue['country']; ?></p> 
                                    <p class="member-status"><strong><?php echo $this->lang->line('seeking'); ?> </strong> <?php if($fvalue['looking_for']=='m'){echo "male";}else{ echo "Female";} ?> <?php echo str_replace(';', '-', $users[$fid]['age_between']); ?></p>
                                    
                                    <!--<p class="member-status"><strong> <?php echo $this->lang->line('seeking'); ?> </strong> <?php echo $fvalue['im_seeking_a']; ?> <?php echo str_replace(';', '-', $users[$fid]['age_between']); ?></p>-->
                                    <p class="member-action">
                                        <!--chat-->
                                        <a href="#modal-livechat" title="Live Chat" data-toggle="modal"><i class="fa fa-comments"></i></a>
                                        <!--send heart-->
                                        <a href="#modal-heart<?php echo $fid; ?>" title="Send Heart" data-toggle="modal"><i class="fa fa-heart"></i></a>
                                        <!--Like-->
										<?php 
										if($fvalue['like'] == '1')
										{ ?>
											<a href="search/unlike/<?php echo $fid; ?>/<?php echo $this->session->userdata['user_id']; ?>" title="Unlike" ><i class="fa fa-thumbs-up fav"></i></a>
										<?php  }else{ ?>
											<a href="search/like/<?php echo $fid; ?>/<?php echo $this->session->userdata['user_id']; ?>" title="Like" ><i class="fa fa-thumbs-up"></i></a>   
										<?php } ?>
										 <!--warning-->
                                        <?php if($fvalue['warning_message'] == '1')
                                        {
                                            ?>
                                            <a href="#modal-warningsend" data-toggle="modal"><span class="fa fa-warning label-warning">  </span></a> 
                                            <?php
                                        }else{
                                            ?>
                                            <a href="#modal-warning<?php echo $fid; ?>" data-toggle="modal"><span class="fa fa-warning label-warning">  </span></a>
                                            <?php 
                                        } ?>
                                       <?php /*?> <a href="#modal-warning<?php echo $fid; ?>" title="Warning" data-toggle="modal"><i class="fa fa-exclamation"></i></a><?php */?>
                                       <!--favorite-->
									   <?php
										if($fvalue['favourite'] >= '1')
										{ 	
											?>
											<a href="#" title="" ><i class="fa fa-minus fav"></i></a>   
											<?php  
										}else{ 
											?>
											<a href="search/favorite/<?php echo $fid; ?>/<?php echo $this->session->userdata['user_id']; ?>" title="Favourite" ><i class="fa fa-plus"></i></a>     
											<?php 
										} ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    $found_users_count++;
                }
                if (!in_array($found_users_count, $odd))
                {
                    echo '</div>';
                }
                ?>

                <!-- Pagination -->
                <!--<div class="pagination">
                    <span class="disabled">Prev</span>
                    <a href="#" class="active">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <a href="#">4</a>
                    <span class="disabled">...</span>
                    <a href="#">8</a>
                    <a href="#">Next</a>
                </div>		-->				
                <?php
            }
            ?>						
        </div>
       
        
<div class="content-box-border">
   	<div class="box-title bg-red txt-upper"><?php echo $this->lang->line('newest_Members'); ?> </div>
    <div class="member-slider">
	<?php 
	foreach($newest_member as $new_member)
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
					  <?php } ?>
					</div> 
					<div class="clearfix"></div>
					<p class="member-id"><a href="/profile/user/<?php echo $new_member['id'];?>" data-toggle="modal"><strong><?php echo $new_member['first_name'].' '.$new_member['last_name']. ' (' . $new_member['age'] . ')';?> </strong></a></p>
					
					<p class="member-quote"><em><i class="fa fa-quote-left"></i> <?php echo $new_member['profile_head']; ?> </em></p> 
				   
					<p class="member-loc"><?php echo ucfirst($new_member['state_province']); ?> <?php echo ucfirst($new_member['city']); ?>, <?php echo $new_member['country']; ?></p>
					<!--<p class="member-status"><strong> <?php echo $this->lang->line('seeking'); ?> </strong> <?php echo $new_member['im_seeking_a']; ?> <?php echo str_replace(';', '-', $users[$new_member['id']]['age_between']); ?></p>-->
					<p class="member-status"><strong> <?php echo $this->lang->line('seeking'); ?> </strong> <?php if($new_member['looking_for'] == 'm'){ echo 'Male' ; }else{ echo 'Female';}?> <?php echo str_replace(';', '-', $users[$new_member['id']]['age_between']); ?></p>
					
					<?php /*?><p class="member-action">
						<a href="/chat" title="Live Chat" data-toggle="modal"><i class="fa fa-comments"></i></a>  
						<?php 
						if($new_member['like'] >= '1'){ ?>
							<a href="search/unlike/<?php echo $new_member['id']; ?>/<?php echo $this->session->userdata['user_id']; ?>" title="Unlike" ><i class="fa fa-thumbs-up"></i></a>
						<?php  }else{ ?>
							<a href="search/like/<?php echo $new_member['id']; ?>/<?php echo $this->session->userdata['user_id']; ?>" title="Like" ><i class="fa fa-thumbs-down"></i></a>   
						<?php } ?>
						<a href="#modal-heart<?php echo $new_member['id']; ?>" title="Send Heart" data-toggle="modal"><i class="fa fa-heart"></i></a> 
						<a href="#modal-warning<?php echo $new_member['id']; ?>"  data-toggle="modal"><span class="fa fa-warning label-warning">  </span></a>
						<?php 
						if($new_member['favourite'] >= '1'){ ?>
							<a href="#" title="" ><i class="fa fa-minus fav"></i></a>   
						<?php  }else{ ?>
						<a href="search/favorite/<?php echo $new_member['id']?>/<?php echo $this->session->userdata['user_id']; ?>" title="Favourite" ><i class="fa fa-plus"></i></a>     
						<?php } ?>
					</p><?php */?>
					  <?php if($new_member['block_user_id'] == $new_member['id'])
							{
								?>
								<p class="member-action">
									<a href="<?php echo base_url('/mail/unblock_user').'/'.$new_member['id']; ?>" class="btn btn-danger fa fa-ban"> Unblock </a>
									<!--<a href="javascript:alert('Please Unblock User')" onclick="alert('Please Unblock User')"><i class="fa fa-comments"></i></a>  
									<a href="javascript:alert('Please Unblock User')" ><i class="fa fa-thumbs-up"></i></a>   -->
							   </p>
								<?
							}else{
								?>
								<p class="member-action">
									<a href="/chat" title="Live Chat" data-toggle="modal"><i class="fa fa-comments"></i></a>  
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
									<a href="#modal-heart<?php echo $new_member['id']; ?>" title="Send Heart" data-toggle="modal"><i class="fa fa-heart"></i></a> 
									 <!--warning-->
									<?php if($new_member['warning_message'] == '1')
										{
											?>
											<a href="#modal-warningsend"  data-toggle="modal"><span class="fa fa-warning label-warning">  </span></a> 
											<?php
										}else{ 
											?>
											<a href="#modal-warning<?php echo $new_member['id']; ?>"  data-toggle="modal"><span class="fa fa-warning label-warning">  </span></a>
											<?php 
										} 
									?>
									<!--Favorites-->
									<?php 
									if($new_member['favourite'] >= '1')
									{ 
										?>
										<a href="#" title="" ><i class="fa fa-minus fav"></i></a>   
										<?php  
									}else{ ?>
										<a href="search/favorite/<?php echo $new_member['id']?>/<?php echo $this->session->userdata['user_id']; ?>" title="Favourite" ><i class="fa fa-plus"></i></a>     
										<?php 
									} ?>
									<?php /*?><a href="search/favorite/<?php echo $new_member['id']?>/<?php echo $this->session->userdata['user_id']; ?>" title="Favourite" ><i class="fa fa-plus"></i></a>   <?php */?>
									<!--<a href="#modal-fav<?php echo $new_member['id']; ?>" title="Add to Favourite" data-toggle="modal"><i class="fa fa-plus"></i></a>-->
								</p>
								<?php 
							} ?>
				</div>
			<?php } 
	}	?>
    </div>
</div>


</div><!-- End .row -->
</section><!-- End .container -->
</div><!-- End #content -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>     
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

        $("#divState").on("change", function(){
            var state_id = $("#state").val();
            var country_id = $("#country").val();
			//alert(state_id);
			//alert(country_id);
            $.ajax({
                type: "POST",
                url: "<?php echo site_url(); ?>register/get_city/",
                data: {state_id: state_id, country_id: country_id},
                success: function(data)
                {
                    $('#divCity').html(data); 
                }
            });
        });

    });
	
</script>

<?php if(isset($_GET['msg']))
		{ 
	 		echo "<script type='text/javascript'>alert('".$_GET['msg']."');</script>";
		} 
?>
       		