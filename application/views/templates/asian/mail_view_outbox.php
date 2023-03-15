<? //print_r($mail_data);?>
    <div class="content-box">
        <section class="container">
            <div class="row">
                <ol class="breadcrumb">
                    <li><i class="fa fa-user fa-2x icon-round-border"></i></li>
                    <li class="active"><span> Mail </span></li>
                </ol>
            </div>
            <div class="mail-wrap row">
				<?php echo $side_navigation; ?>
                <div class="col-sm-9">
                    <div class="mail-action page-title">
                        <div class="row">
                            <div class="col-sm-6 col-xs-6">  
                                <a href="/mail/sent" class="btn btn-default btn-lg" title="Back to Maillist"><i class="fa fa-angle-double-left"></i></a>
                            </div>
                            <div class="col-sm-6 col-xs-6"></div>
                        </div>
                    </div>
                    <?php foreach($mail_data as $mail_data)
					{
						$phpdate = strtotime($mail_data['date']); 
						$mail_date = date( 'Y-M-d', $phpdate );
						$mail_time = date( 'H:ia ', $phpdate );
						$boolean_to_text = array('1'=>'yes', '2'=>'no');
						?>
					   
						<div class="mail-ct content-box-border">
						
							<?php /*?><?php if($mail_data['from_user_id'] == $this->session->userdata['user_id']){?>
									<div class="mail-ct-action btn-group">
										<a href="#" class="btn btn-default reply" id="reply"><i class="fa fa-mail-reply"></i> Reply</a>
										<div class="btn-group">
											<a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
											<div class="dropdown-menu" id="mail-ct-action">
												<li><a href="<?php echo base_url('/mail/move_to_spam').'/'.$mail_data['id']; ?>"><i class="fa fa-exclamation"></i> Report Spam</a></li>
												<li><a class="" href="<?php echo base_url('/mail/delete_inbox_msg').'/'.$mail_data['id']; ?>"  onclick="return confirm('Are You sure Want to delete?');"><i class="fa fa-trash-o"></i> Delete Mail</a></li>
												 <!--<li><a class="" href="<?php echo base_url('/mail/delete_inbox_msg').'/'.$mail_id; ?>" onclick="return confirm('Are You sure Want to delete?');"><i class="fa fa-trash-o"></i> Delete Mail</a></li>-->
											</div>
										</div>
									</div>
							<?php }else{ ?>
									<div class="mail-ct-action btn-group">
								<a href="#" class="btn btn-default reply" id="reply"><i class="fa fa-mail-reply"></i> Reply</a>
								<div class="btn-group">
									<a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
									<div class="dropdown-menu" id="mail-ct-action">
										<li><a href="<?php echo base_url('/mail/move_to_spam').'/'.$mail_data['id']; ?>"><i class="fa fa-exclamation"></i> Report Spam</a></li>
										<li><a id="<?php echo $mail_data['from_user_id'];?>" class="user_block"><i class="fa fa-ban"></i> Block User</a></li>
										
										<li><a class="" href="<?php echo base_url('/mail/delete_inbox_msg').'/'.$mail_data['id']; ?>"  onclick="return confirm('Are You sure Want to delete?');"><i class="fa fa-trash-o"></i> Delete Mail</a></li>
										 <!--<li><a class="" href="<?php echo base_url('/mail/delete_inbox_msg').'/'.$mail_id; ?>" onclick="return confirm('Are You sure Want to delete?');"><i class="fa fa-trash-o"></i> Delete Mail</a></li>-->
									   
									</div>
								</div>
							</div>
							<?php } ?><?php */?>
							 <ul class="media-list discuss-list">
								<li class="media">
								<?php if(!empty($mail_data['avatar']))
								{?>
									<a class="pull-left avatar-md" href="#"><img class="media-object img-circle" src="/uploads/profile/<?php echo $mail_data['avatar']; ?>" alt="" width="110" height="110"></a>
									<?php 
								}else
									{
										if($mail_data['gender'] == 'm')
											{
												?>
												<a class="pull-left avatar-md" href="#"><img class="media-object img-circle" src="/resources/img/avatar-blank.png" alt="" width="110" height="110"></a>
												<?php	
											}else{
												?>
												<a class="pull-left avatar-md" href="#"><img class="media-object img-circle" src="/resources/img/no_profile_female.jpg" alt="" width="110" height="110"></a>
												<?php
											}
								 	}?>
								 <?php /*?>   <a class="pull-left avatar-md" href="#" title="<strong>Education:</strong> 12/12<br>
									<strong>Have children:</strong> <?php echo $boolean_to_text[$sender_data['have_children']];?><br>
									<strong>Drink:</strong> <?php echo $boolean_to_text[$sender_data['drink']];?><br>
									<strong>Smoke:</strong> <?php echo $boolean_to_text[$sender_data['smoke']];?><br><br>
	
									<strong>Member overview: </strong><br>
									<?php $sender_data['about_yourself'];?>">
										
									
										<img class="media-object" src="/uploads/profile/<?php echo $avatar; ?>" alt="" >
									</a><?php */?>
									<div class="media-body">
										<h4 class="media-heading txt-red"><?php echo $mail_data['subject'];?></h4>
										<p><strong class="txt-orange"><?php echo $mail_data['name'];?></strong> at <small><?php echo $mail_time.' ' .$mail_date;?></small><br>
										<?php echo $mail_data['content'];?></p>
									</div>
								</li>
							</ul>
							
							<div class="mail-ct content-box-border" id="reply_box" style="display:none;">
							<form class="form-horizontal" method="post" action="/mail/send_reply"> 
							<input type="hidden" name="to_user_id" value="<?php echo $mail_data['from_user_id'];?>" />
								<div class="form-group">
									<label class="col-sm-2 control-label"> Subject </label>
									<div class="col-sm-8">
									   <input name="subject" type="text" value="<?php echo $mail_data['subject']; ?>" class="form-control" readonly="readonly">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label"> Content </label>
									<div class="col-sm-10">
										<textarea cols="80" id="editor1" name="content" rows="10" class="editor-ck form-control"></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2"></label>
									<div class="col-sm-8">
										<button class="btn btn-lg btn-danger" type="submit"> Send </button>
									</div>
								</div>
							</form>
						</div>
						</div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
</div><!-- End #content -->
