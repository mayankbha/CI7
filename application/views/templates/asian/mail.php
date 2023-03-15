    <!-- MAIN CONTENT -->
    <div class="content-box">
        <section class="container">
            <div class="row">
                <ol class="breadcrumb">
                    <li><i class="fa fa-user fa-2x icon-round-border"></i></li>
                    <li class="inactive"><span> Mail </span></li>
					<li class="active"><span> Inbox </span></li>
                </ol>
            </div>
            <div class="mail-wrap row">
				<?php echo $side_navigation;?>
                <div class="col-sm-9">
                    <div class="mail-action page-title">
                        <div class="row">
                            <div class="col-sm-6 col-xs-6">
                                <div class="btn-group btn-group-lg">
                                    <div class="btn btn-default">
                                        <input id="select_mails" type="checkbox">
                                    </div>
                                    <a id="move_to_trash" href="#" class="btn btn-default"><i class="fa fa-trash-o"></i></a>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <div class="btn-group btn-group-lg pull-right">
									<?php
									if(isset($back))
									{
										?>
                                    	<a href="#" class="btn btn-default"><i class="fa fa-angle-left"></i></a>
										<?php									
									}
									if(isset($next))
									{
										$next_page = $page+1;
										//echo $next_page;
										?>
                                    	<a href="page/<?php echo $next_page;?>" class="btn btn-default"><i class="fa fa-angle-right"></i></a>
										<?php									
									}
									?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mail-ct content-box-border">
                        <div class="mail-tbl">
                            <table class="table table-hover">
                            <tbody><form id="delete_mails" action="/mail" method="post">
								<?php
								foreach($inbox as $ikey=>$ivalue){
									$profile = $this->member_model->get_profile_by_id2($ivalue['from_user_id']);
									$mail_time = strtotime($ivalue['date']);
			
									$datetime1 = new DateTime();
									$datetime2 = new DateTime($ivalue['date'], new DateTimeZone('Asia/Manila'));
									$interval = date_diff($datetime1, $datetime2);
									if($interval->h > 0 && $interval->d == 0){
										if($interval->h <2){
											$timeformat = $interval->format('%h hour ago');
										} else {
											$timeformat = $interval->format('%h hours ago');
										}
									}elseif($interval->d > 0){
										if($interval->d < 2){
											$timeformat = $interval->format('%d day ago');
										} else {
											$timeformat = $interval->format('%d days ago');
										}
										
									} else {
										$timeformat = $interval->format('%i minutes ago');
									}
									//print_r($ivalue);
									$avatar = $this->member_model->get_active_avatar($ivalue['from_user_id']);
									?>
									<tr class="mail-item <?php if(isset($ivalue['read'])&&$ivalue['read']>0){
											echo 'mail-item-read';
										} else {
											echo 'mail-item-unread';
										}
										?>">
										<td width="5%"><input id="" class="add_to_trash" value="<?php echo $ivalue['id']; ?>" type="checkbox" name="checked_mail_item[]"></td>
                                        <?php //echo $ivalue['id']; ?>
										<td width="5%"><a style="cursor:pointer" id="<?php echo $ivalue['id'];?>" <?php 
										if($ivalue['favorite'] == 0){
											echo ' class="mail-item-star mail-item-unstarred"';
										} else {
											echo ' class="mail-item-star mail-item-starred"';
										}										
										?>><i class="fa fa-star"></i></a></td>
										<td width="5%"><a href="#" class="mail-sender-pic"><img src="/uploads/profile/<?php echo $avatar;?>" alt=""></a></td>
										<td width="15%"><?php echo $profile['first_name'] . ' ' . $profile['last_name'] ?><?php if($ivalue['count']>1){ echo ' ('.$ivalue['count'].')' ;}?></td>
										<?php /*?><td width="55%"><a href="/mail/view_email/<?php echo $ivalue['id'];?>"><div><?php echo $ivalue['subject'];?></div></a></td><?php */?>
                                        <td width="55%"><a href="/mail/view_email/<?php echo $ivalue['id'].'/'.$ivalue['from_user_id'].'/'.$ivalue['to_user_id'].'/'.$ivalue['subject'];?>"><div><?php echo $ivalue['subject'];?></div></a></td>
										<td width="15%"><a href="/mail/view_email/<?php echo $ivalue['id'].'/'.$ivalue['from_user_id'].'/'.$ivalue['to_user_id'].'/'.$ivalue['subject'];?>"><div><?php echo $timeformat; ?></div></a></td>
									</tr>									
									<?php
								}
								?>
                               </form>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
		</section>
	</div><!-- End #content -->