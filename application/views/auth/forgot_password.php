<?php echo $this->load->view('templates/asian/header'); ?>

<body id="landing-page-2" class="rose-bg">    
	
    <div class="content-box">
      	<section class="container">   
            <div class="row">
              	<div class="messageload">   
                	<div class="content-box-border">   
                  	<h1><?php echo lang('forgot_password_heading'); ?></h1>
                  
                  <div> 
                        <p>       
                            <?php echo sprintf(lang('forgot_password_subheading'), $identity_label); ?>
                        </p>    
                        <div id="infoMessage"><font color="#006600"> <?php echo $message; ?> </font></div>
                        <?php echo form_open("auth/forgot_password"); ?>
                        <p>     
                          <label for="email"> <?php echo sprintf(lang('forgot_password_email_label'), $identity_label); ?> </label>   
                          <br />    
                          <?php echo form_input($email); ?>   
                        </p>
                        <p>  
							<?php echo form_submit('submit', lang('forgot_password_submit_btn'),'class = "btn btn-danger"'); ?>                        </p>    
                        
						<?php echo form_close(); ?>     
                  </div> 
                                    
                </div>  
              </div>  
            </div>  
      	</section>
  		<!----------------- End .container ----------------------->
    </div>
    

<?php echo $this->load->view('templates/asian/footer'); ?>                                            