<?php echo $this->load->view('templates/asian/header'); ?>

<body id="landing-page-2" class="rose-bg">    
    <div class="content-box">    
          <section class="container">    
                <div class="row">    
                      <div class="messageload">    
                            <div class="content-box-border">    
                                <h1><?php echo lang('reset_password_heading'); ?></h1>    
                                <div id="infoMessage"><?php echo $message; ?></div>     
                               
                                <?php echo form_open('auth/reset_password/' . $code); ?>    
                               	 	<p>
                                    	<label for="new_password"><?php echo sprintf(lang('reset_password_new_password_label'), $min_password_length); ?></label>
                                    	<br />
                                		<?php echo form_input($new_password); ?> 
                                    </p>
                                	<p> 	
										<?php echo lang('reset_password_new_password_confirm_label', 'new_password_confirm'); ?> <br />
                                		<?php echo form_input($new_password_confirm); ?> 
                                    </p>
                                	
                                    	<?php echo form_input($user_id); ?> <?php echo form_hidden($csrf); ?>
                                	
                                    <p>      
										<?php echo form_submit('submit', lang('reset_password_submit_btn'),'class="btn btn-danger"'); ?>       
                                   	</p>     
                                
								<?php echo form_close();?>     
                           </div>    
					  </div>    
                </div>    
          </section>    
      <!-- End .container -->   
    </div>    
    
<?php echo $this->load->view('templates/asian/footer'); ?>    