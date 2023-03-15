<?php 
//$preURL = parse_url($_SERVER['REQUEST_URI']);
//$redirectUrl = array('redirectUrl' => 'http://' . $_SERVER['SERVER_NAME'] . $preURL['path']);
//$CI->session->set_userdata($redirectUrl);
  ?>
<center>
  <?php	if(isset($message)){  ?>
  		<div id="infoMessage"><?php echo $message; ?></div>  
  <?php	} ?>

  <div class="content-box">     
        <section class="container">    
          <div class="modal-dialog">    
                <div class="modal-content">     
                      <div class="modal-header">    
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="txt-red txt-upper"><i class="fa fa-user"></i> <span><?php echo $this->lang->line('member_login'); ?></span></h4>   
                      </div>
                      <div class="modal-body"> 
                           <form class="frm-login form-horizontal" action="/auth/login" method="post"> 
                           <?php //echo $_GET['location'];die;?>
                           <input type="hidden" name="location" value="<?php if(isset($_GET['location'])){ echo htmlspecialchars($_GET['location']); } ?>" />
                          
                                  <div class="form-group">
                                   		<label class="col-sm-2 control-label col-sm-offset-2"><?php echo $this->lang->line('username'); ?></label>
                                    	<div class="col-sm-6">   
                                      	<input type="text" class="form-control" name="identity" placeholder="Username" required>
                                    	</div>
                                  </div>
                                  
                                  <div class="form-group">
                                   	 <label class="col-sm-2 control-label col-sm-offset-2"><?php echo $this->lang->line('password'); ?></label>  
                                    	<div class="col-sm-6">    
                                      	<input type="password" class="form-control"  name="password" placeholder="Password " required>
                                    	</div>    
                                   </div>        
                                   
                                  <div class="form-group"> 
                                  	  <label class="col-sm-4 col-sm-offset-2 checkbox-inline">   
                                    	<input type="checkbox">
                                    	<?php echo $this->lang->line('remember_me'); ?> </label>
                                    	<div class="col-sm-4">      
                                      	<input type="submit" class="btn btn-lg btn-danger pull-right" value="login">
                                    	</div>    
                                  </div>
                            </form>
                      </div>
                      
                  <div class="modal-footer">
                    <p class="txt-center"> <?php echo $this->lang->line('not_have_an_account'); ?> <a href="/register"><?php echo $this->lang->line('create_acc');?></a>
                      <?php /*?><?=$this->lang->line('or');?> 
					   
                            <a href="#"><?= $this->lang->line('get_password')?></a> 
							
                        <?= $this->lang->line('if_you_lose');?></p><?php */?>                       
                  </div>
                </div>
          </div>
      <br>
      <br>
      <br>
      <br>
    </section>
    <!-- End .container -->   
  </div>   
  <!-- End #content -->                                                       
</center>