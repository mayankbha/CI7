<div class="content-box">
    <section class="container">
<? //echo "<pre>";print_r($found_users);die;?>
        <div class="row">
            <ol class="breadcrumb">
                <li><i class="fa fa-user fa-2x icon-round-border"></i></li>
                <li class="active"><span>Member Homepage</span></li>
            </ol>
        </div>

        <div class="row search-result-ct">
            
        </div>
        <div class="">
            <div class="section-title bg-red txt-upper">
                Highest matching
            </div>
            
            <?php
           if ($search_result == 0)
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
														<a class="pull-left avatar-md" href="#"><img class="media-object img-circle" src="/resources/img/avatar-blank.png" alt="" width="110" height="110"></a>
														<?php	
													}else{
														?>
														<a class="pull-left avatar-md" href="#"><img class="media-object img-circle" src="/resources/img/no_profile_female.jpg" alt="" width="110" height="110"></a>
														<?php
													}
												}else{
													?><img class="media-object img-circle" src="/uploads/profile/thumbnail/<?php echo $users[$fid]['avatar'];?>" width="110" height="110" >
												<?php 
										} ?>
                                    </div>
                                    <p class="member-id"><a href="/profile/user/<?php echo $fid; ?>"><strong><?php echo $fvalue['first_name'] . ' ' . $fvalue['last_name'] . ' (' . $fvalue['age'] . ')'; ?></strong></a></p>
                                    <p class="member-quote"><em><i class="fa fa-quote-left"></i><?php echo $fvalue['profile_head']; ?></em></p>
                                    <p class="member-loc"><?php echo ucfirst($fvalue['state_province']); ?> <?php echo ucfirst($fvalue['city']); ?>, <?php echo $fvalue['country']; ?></p>
                                    <p class="member-status"><strong> Seeking: </strong><?php echo $fvalue['im_seeking_a']; ?> <?php echo str_replace(';', '-', $fvalue['age_between']); ?></p>
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
														<a class="pull-left avatar-md" href="#"><img class="media-object img-circle" src="/resources/img/avatar-blank.png" alt="" width="110" height="110"></a>
														<?php
													}else{
														?>
														<a class="pull-left avatar-md" href="#"><img class="media-object img-circle" src="/resources/img/no_profile_female.jpg" alt="" width="110" height="110"></a>
														<?php
													}
												}else{
													?><img class="media-object img-circle" src="/uploads/profile/thumbnail/<?php echo $users[$fid]['avatar'];?>" width="110" height="110" >
													<?php 
												} ?>
                                    </div>
                                    <p class="member-id"><a href="/profile/user/<?php echo $fid; ?>"><strong><?php echo $fvalue['first_name'] . ' ' . $fvalue['last_name'] . ' (' . $fvalue['age'] . ')'; ?></strong></a></p>
                                    <p class="member-quote"><em><i class="fa fa-quote-left"></i> <?php echo $fvalue['profile_head']; ?></em></p>
                                    <p class="member-loc"><?php echo ucfirst($fvalue['state_province']); ?> <?php echo ucfirst($fvalue['city']); ?>, <?php echo $fvalue['country']; ?></p>
                                    <p class="member-status"><strong> Seeking: </strong> <?php echo $fvalue['im_seeking_a']; ?> <?php echo str_replace(';', '-', $fvalue['age_between']); ?></p>	
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
                
            }
            ?>						
        </div>
</div>
</div><!-- End .row -->
</section><!-- End .container -->
</div><!-- End #content -->