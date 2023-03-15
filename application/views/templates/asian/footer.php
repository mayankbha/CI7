<div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <ul class="footer-links">
                        <li><a href="#"><?php echo $this->lang->line('about_us');?> </a></li>
                        <li><a href="#"><?php echo $this->lang->line('privacy_terms');?> </a></li>
                        <li><a href="#"><?php echo $this->lang->line('faq');?> </a></li>
                        <li><a href="#"><?php echo $this->lang->line('invite_a_friend');?> </a></li>
                        <li><a href="#"><?php echo $this->lang->line('contact_us');?> </a></li>
                        <li><a href="#"><?php echo $this->lang->line('bookmark');?> </a></li>
                        <li><a href="#"><?php echo $this->lang->line('language_en');?> </a></li>
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
	<div id="dictionary"></div>
    
    <div class="modal fade" id="modal-login">
      <div class="modal-dialog">
        <div class="modal-content">
	       <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>   
            <h4 class="txt-red txt-upper"><i class="fa fa-user"></i> <span><?php echo $this->lang->line('member_login')?></span></h4>
          </div>
    
          <div class="modal-body">
            <form action="/auth/login" method="post" class="frm-login form-horizontal">
                <input type="hidden" name="location" value="<?php if(isset($_GET['location'])){ echo htmlspecialchars($_GET['location']); } ?>" />
                <div class="form-group">
                    <label class="col-sm-2 control-label col-sm-offset-2"><?php echo $this->lang->line('username');?></label>
                    <div class="col-sm-6">
                    <input type="text" name="identity" class="form-control" placeholder="Username " required></div>
                </div>
    
                <div class="form-group">
                    <label class="col-sm-2 control-label col-sm-offset-2"><?php echo $this->lang->line('password'); ?></label>
                    <div class="col-sm-6">
                    <input type="password"  name="password" class="form-control" placeholder="Password " required></div>
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
				<?php echo $this->lang->line('not_have_an_account'); ?>
                	<a href="<?php echo site_url('register');?>"><?php echo $this->lang->line('create_acc'); ?></a>
				<?php echo $this->lang->line('or'); ?>
                	<a href="/auth/forgot_password"><?php echo $this->lang->line('get_password'); ?></a>
				<?php echo $this->lang->line('if_you_lose'); ?></p>
          </div>
        </div>
      </div>
    </div>

<!-- Modal Upload -->
    <div class="modal fade" id="modal-upload">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="txt-red txt-upper"><i class="glyphicon glyphicon-upload"></i> <span><?php echo $this->lang->line('Upload'); ?></span></h4>
          </div>
          <div class="modal-body">
            <form id="fileupload" action="#" method="POST" enctype="multipart/form-data">
                <noscript><input type="hidden" name="redirect" value="#"></noscript>
                <div class="row fileupload-buttonbar">
                    <div class="fileupload-btns">
                        <span class="btn btn-blue btn-xs fileinput-button">
                            <i class="fa fa-plus"></i> <?php echo $this->lang->line('Select'); ?>
                            <input type="file" name="files[]" multiple>
                        </span> 
                        <div class="btn-group btn-group-xs">    
                            <button type="submit" class="btn btn-default btn-xs start">    
                                <i class="glyphicon glyphicon-upload"></i> <?php echo $this->lang->line('Upload'); ?>    
                            </button>    
                            <button type="reset" class="btn btn-default btn-xs cancel">
                                <i class="glyphicon glyphicon-ban-circle"></i> <?php echo $this->lang->line('Cancel'); ?>    
                            </button>    
                        </div>    
                       <button type="button" title="Delete" class="btn btn-warning btn-xs delete">    
                            <i class="glyphicon glyphicon-trash"></i>    
                        </button>   
                        <input type="checkbox" class="toggle" />
                        <span class="fileupload-process"></span>
                    </div>    
                    <div class="fileupload-progress fade">
                        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">    
                            <div class="progress-bar progress-bar-success" style="width:0%;"></div>    
                        </div>    
                        <div class="progress-extended">&nbsp;</div>
                    </div>    
                </div>    
                <div class="fileupload-data-list">
                    <table role="presentation" class="table table-bordered table-upload">
                    	<tbody class="files"></tbody>
                    </table>
                </div>
            </form> 
          </div>    
        </div>    
      </div>    
    </div>    


<!-- /Chatbox/ -->
    <div class="page-social">
        <ul>
            <!--<li><a href="social.html" class="bg-blue-plain" title="Social" data-placement="right"><i class="fa fa-group"></i></a></li>-->
            <li><a href="<?php echo base_url('chat');?>" class="bg-orange-plain" title="Chat" data-placement="right"><i class="fa fa-comments"></i></a></li>
            <li><a href="profile-member.html" class="bg-pink-plain" title="Dating" data-placement="right"><i class="fa fa-heart"></i></a></li>
        </ul>
    </div>
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript" src="/template/asian/resources/js/bootstrap.min.js"></script>     
    <script type="text/javascript" src="/template/asian/resources/js/datepicker.js"></script>     
    <script type="text/javascript" src="/template/asian/resources/js/ion.rangeSlider.min.js"></script>     
    <script type="text/javascript" src="/template/asian/resources/js/owl.carousel.min.js"></script>     
    <script type="text/javascript" src="/template/asian/resources/js/ckeditor.js"></script>     
    <script type="text/javascript" src="/template/asian/resources/js/adapters/jquery.js"></script>     
	<script type="text/javascript" src="/template/asian/resources/js/jquery.toastmessage.js"></script>     
    <script type="text/javascript" src="/template/asian/resources/js/main.js"></script>  
    <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
    <script src="<?php echo base_url(); ?>template/main/jQuery-File-Upload-9.5.7/js/vendor/jquery.ui.widget.js"></script>
    <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
    <script src="<?php echo base_url(); ?>template/main/jQuery-File-Upload-9.5.7/js/load-image.min.js"></script>
    <!-- The Canvas to Blob plugin is included for image resizing functionality -->
    <script src="<?php echo base_url(); ?>template/main/jQuery-File-Upload-9.5.7/js/canvas-to-blob.min.js"></script>
    <!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
    
    <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
    <script src="<?php echo base_url(); ?>template/main/jQuery-File-Upload-9.5.7/js/jquery.iframe-transport.js"></script>
    <!-- The basic File Upload plugin -->
    <script src="<?php echo base_url(); ?>template/main/jQuery-File-Upload-9.5.7/js/jquery.fileupload.js"></script>
    <!-- The File Upload processing plugin -->
    <script src="<?php echo base_url(); ?>template/main/jQuery-File-Upload-9.5.7/js/jquery.fileupload-process.js"></script>
    <!-- The File Upload image preview & resize plugin -->
    <script src="<?php echo base_url(); ?>template/main/jQuery-File-Upload-9.5.7/js/jquery.fileupload-image.js"></script>
    <!-- The File Upload audio preview plugin -->
    <script src="<?php echo base_url(); ?>template/main/jQuery-File-Upload-9.5.7/js/jquery.fileupload-audio.js"></script>
    <!-- The File Upload video preview plugin -->
    <script src="<?php echo base_url(); ?>template/main/jQuery-File-Upload-9.5.7/js/jquery.fileupload-video.js"></script>
    <!-- The File Upload validation plugin -->
    <script src="<?php echo base_url(); ?>template/main/jQuery-File-Upload-9.5.7/js/jquery.fileupload-validate.js"></script>
    
    
    <script src="<?php echo base_url(); ?>js_image/js/vasplus_programming_blog_footer_contact.js"></script>
    
    <script src="<?php echo base_url(); ?>js_image/js/post_watermarkinput.js"></script>
    <script src="/template/asian/resources/js/jquery-ui-1.11.0/jquery-ui.js"></script>	
	
		<?php
		if(isset($template_footer)&&is_array($template_footer))
		{
			foreach($template_footer as $tfkey=>$tfvalue)
			{
				echo $tfvalue;
			}
		}
		?>	
        <?php 
		if(isset($this->session->userdata['user_id']))
		{
			foreach($newest_member as $new_member)
				{
					?>   
						<!--heart modal-->
						<div class="modal fade" id="modal-heart<?php echo $new_member['id'];?>">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>  
										<h4 class="txt-red txt-upper"><i class="fa fa-heart"></i>  <span> <?php echo $this->lang->line('send_heart');?> </span></h4>
									</div>
									<div class="modal-body">
										<form class="frm-login form-horizontal" action="/search/add" method="post">
											<input type="hidden" name="user_id_receiver" value="<?php echo $new_member['id']?>" />
											<input type="hidden" name="user_id_sender" value="<?php echo $this->session->userdata['user_id']; ?>" />
											<div class="" align="center"> 
												<h3> Do You Really want to send this heart to  <font color="#FF0000"><strong><?php echo $new_member['first_name'].' '.$new_member['last_name']?></strong></font></h3>
											</div>
											<div align="center" class="col-sm-12 clearfix">
												<div class="col-sm-1" align="center"></div>
												<?php if($users[$this->session->userdata['user_id']]['avatar'] == '')
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
															?><img class="media-object img-circle col-sm-3" src="/uploads/profile/thumbnail/<?php echo $users[$this->session->userdata['user_id']]['avatar'];?>" width="110" height="110">
															<?php 
														} ?>
												
												<img alt="" class="img-circle col-sm-3" src="/resources/img/LoveGoingOut.gif">
									
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
														?><img class="media-object img-circle col-sm-3" src="/uploads/profile/thumbnail/<?php echo $users[$new_member['id']]['avatar'];?>" width="110" height="110">
														<?php 
													} ?>
											</div>
											<p></p>
											<div  class="form-group txt-center"> 
												<div class=""><input type="submit" class="btn btn-danger" value="Send"></div>
											</div>
										</form>  
									</div>    
								</div>
							</div>
						</div>
					<!--End heart modal-->
				<?php 
			}
		 ?>


<!--Send warning message-->
			<?php foreach($newest_member as $new_member)
                    {
                		?>   
                		<!--warning modal-->
                        <div class="modal fade" id="modal-warning<?php echo $new_member['id']; ?>">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                              
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>  
                                <h4 class="txt-black txt-upper"><i class="fa fa-ban"></i>  <span> <?php echo $this->lang->line('send_watning_message_to'); ?> </span><font class="txt-red">  >  <?php echo $new_member['first_name'].' '.$new_member['last_name']; ?></font></h4>
                              
                              </div>
                               <div class="modal-body">
                                <form class="frm-login form-horizontal" action="/search/warning" method="post">
                                    <input type="hidden" name="user_id_receiver" value="<?php echo $new_member['id'];?>" />
                                    <input type="hidden" name="user_id_sender" value="<?php echo $this->session->userdata['user_id']; ?>" />
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <img style="margin-top:12px;" alt="Warning" src="/resources/img/WARNING Animation.gif">
                                        </div>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" name="message" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">   
                                        <div class="txt-center">    
                                            <input type="submit" class="btn btn-danger" value="Send">
                                        </div>
                                    </div>
                                </form>   
                        </div>
                        <div class="modal-footer">
                                <p class="txt-center"></p>
                        </div>
                     </div>
                          </div>
                    </div>
                    <!--End warning modal-->
			<?php } 
		
		} ?>
<!--end warning message-->


    <div class="modal fade" id="modal-warningsend">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close txt-red" data-dismiss="modal" aria-hidden="true"> &times; </button>  
                    <p></p>
                </div>
                <div class="modal-body" align="center">
                    <h3><p class="txt-red">You have already sent warning repot to this user.</p></h3>  
                </div>
            </div>
        </div>
    </div>


<!--advance search donation modal-->
<div class="modal fade" id="modal-advancesearchdon">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times;</button>
            <h4 class="modal-title" id="myModalLabel">Want to Donate to get Advance Search Services?</h4>
          </div>
          <div class="modal-body">
            <p align="center">You have to Donate money to get advance search plans. </p>
           <!-- <p>Get available services in small donation.</p>-->
           <!-- <div align="center"><a href=""><img src="<?php echo base_url()?>/uploads/id/donate.png"></a></div>-->
          </div>
        </div>
	</div>
</div>
<!--end advance search donation modal-->    
    
  </body>
</html>
<?php if(isset($_GET['msg']))
		{ 
	 		echo "<script type='text/javascript'>alert('".$_GET['msg']."');</script>";
		} 
?>
