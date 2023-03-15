<div class="content-box">
        <section class="container">
            <div class="row">
                <ol class="breadcrumb">
                    <li><i class="fa fa-user fa-2x icon-round-border"></i></li>
                    <li><span><?php echo $this->lang->line('ecommerce'); ?></span></li>
                    <li><span><?php echo $this->lang->line('checkout'); ?></span></li>
                    <li class="active"><span><?php echo $this->lang->line('donation'); ?></span></li>
                </ol>
            </div>
            <div class="row ecommerce viewcart">
                <div class="content-box-border"> 
                  <?php if(!empty($paypal_error)) {?>
                    <div class="alert alert-danger">
                        
                        <?php 
                            if(is_string($paypal_error)) {
                                echo $paypal_error;
                            }else {
                                echo isset($paypal_error['Errors'][0]['L_LONGMESSAGE']) ? $paypal_error['Errors'][0]['L_LONGMESSAGE'] : "Error occured transaction can not be proceed.";  
                            }
                        ?>
                    </div>
                   <?php }  ?>
                   <?php if(isset($err_msg)) {?>
                   <div class="alert alert-danger">
                      <?php echo $err_msg;  ?>
                    </div>
                   <?php }  ?>
                 
                    <form class="form-horizontal" method="post" enctype="multipart/form-data" novalidate  action="<?php echo base_url('checkout/donation') ?>" >
                    
                     <div class="reg-step">
                            <h4 class="txt-upper page-title txt-red">Message Plans</h4>
                            <p><strong>Please select the preferred message plan to use.</strong></p>
                            <div class="payment-opt gray-bg">
                                <div>
                                    <label class="radio-inline">
                                        <input type="radio" name="donation-plan" value="3.00" checked="checked">12 Days- 3USD
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="donation-plan" value="2.00"  >7 Days- 2USD
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="donation-plan" value="1.00" >3 Days- 1USD
                                    </label>
                                </div>
                            </div>
                            
                        <div class="reg-step"> 
                            <h4 class="txt-upper page-title txt-red">Payment Method</h4> 
                            <p><strong>Please select the preferred payment method to use on this order.</strong></p>
                            <div class="payment-opt gray-bg"> 
                                <div> 
                                    <label class="radio-inline"><input type="radio" name="payment-method" value="credit" checked="checked" class="payment-cc"> Credit Card / Debit Card </label> 
                                    <label class="radio-inline"><input type="radio" id="pay" name="payment-method" <?php if(isset($paypal_flag) && $paypal_flag == 1) { echo 'checked="checked"'; } ?> value="paypal" class="payment-paypal"> Paypal</label>
                                </div>
                            </div> 
                        </div> 
                    
                        <div class="reg-step">
                            <h4 class="txt-upper page-title txt-red">Account Details</h4>
                            <div class="row">
                            <?php if(isset($user_data)):?>
                            
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">First Name <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" name="b_first_name" value="<?php echo isset($user_data) ? $user_data[0]->first_name : set_value('b_first_name');   ?>" id="b_first_name" />
                                            <span class="error"><?php echo form_error('b_first_name'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Last Name <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" name="b_last_name" value="<?php echo isset($user_data) ? $user_data[0]->last_name : set_value('b_last_name');   ?>" id="b_last_name" />
                                            <span class="error"><?php echo form_error('b_last_name'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Phone <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" name="b_phone" value="<?php echo isset($user_data) ? $user_data[0]->phone : set_value('b_phone');   ?>" id="b_phone"  />
                                             <span class="error"><?php echo form_error('b_phone'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Address <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" name="b_address_1" value="<?php echo isset($user_data) ? $user_data[0]->address : set_value('b_address_1');   ?>" id="b_address_1" maxlength="255"/>
                                             <span class="error"><?php echo form_error('b_address_1'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Address 2</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" name="b_address_2" value="<?php echo isset($user_data) ? $user_data[0]->address : set_value('b_address_1');   ?>" id="b_address_2" maxlength="255"/>
                                             <span class="error"><?php echo form_error('b_address_2'); ?></span>
                                        </div>
                                    </div>
                                    
                                    <!--hidden feilds for product amount and tax rate -->
                                    
                                
                                </div> 
                                <div class="col-sm-5 col-sm-offset-1">
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Company</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" type="text" name="b_company" value="<?php echo isset($user_data) ? $user_data[0]->address : set_value('b_company');   ?>" id="b_company" />
                                             <span class="error"><?php echo form_error('b_company'); ?></span>
                                        </div>
                                    </div>
                                   
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Country <span class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                         <select name="b_country_id" id="change" class="form-control">
                                           <?php
                                             if(isset($user_data)) { ?>
                                             
                                               <option value="<?php echo $user_data[0]->country; ?>"><?php echo $country[0]->nicename; ?></option>
                                         
                                           <?php
                                            }  else {
                                            $options = isset($countries) ? $countries : array(0=>'Select');
                                            echo form_dropdown('b_country_id', $options,    set_value('b_country_id', 0), 'class="form-control" id="b_country_id"');
                                            } ?>
                                            
                                                </select>
                                   
                                       
                                            
                                          <span class="error"><?php echo form_error('b_country_id'); ?></span>   
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">State <span class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                        
                                            <input class="form-control" type="text" name="b_state" id="b_state" value="<?php echo isset($user_data) ? $user_data[0]->state_province : set_value('b_state');   ?>" />
                                               <span class="error"><?php echo form_error('b_state'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">City <span class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <input class="form-control" type="text" name="b_city" value="<?php echo isset($user_data) ? $user_data[0]->city : set_value('b_city');   ?>" id="b_city" />
                                             <span class="error"><?php echo form_error('b_city'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Zip <span class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <input class="form-control" value="<?php echo isset($user_data) ? $user_data[0]->zip_code : set_value('b_zip'); ?>" type="text" name="b_zip" id="b_zip" />
                                             <span class="error"><?php echo form_error('b_zip'); ?></span>
                                        </div>
                                    </div>
                                </div> 
                                <?php endif; ?>
                            </div>
                        </div>
                           
                        <div class="reg-step">
                            <?php /*
                            <h4 class="txt-upper page-title txt-red">Payment Method</h4>
                            <p><strong>Please select the preferred payment method to use on this order.</strong></p>
                            <div class="payment-opt gray-bg">
                                <div>
                                    <label class="radio-inline"><input type="radio" name="payment-method" value="credit" checked="checked" class="payment-cc"> Credit Card / Debit Card </label>
                                    <label class="radio-inline"><input type="radio" id="pay" name="payment-method" <?php if(isset($paypal_flag) && $paypal_flag == 1) { echo 'checked="checked"'; } ?> value="paypal" class="payment-paypal"> Paypal</label>
                                </div>
                            </div>
                            */?>
                            <div id="payment-cc">
                                <div class="row">
                                    <div class="col-sm-6 card">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Card Type <span class="text-danger">*</span></label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="credit_card_type">
                                                <option value="Visa">Visa</option>
                                                <option value="MasterCard">Master Card</option>
                                                <option value="Discover">Discover</option>
                                                <option value="Amex">Amex</option>
                                                </select>
                                                <span class="error"><?php echo form_error('credit_card_type'); ?></span>
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Card Number <span class="text-danger">*</span></label>
                                            <div class="col-sm-8">
                                               <input type="text" value="<?php echo set_value('credit_card_number'); ?>" autocomplete="off"  class="form-control cc-number" name="credit_card_number" id="ccn">
                                               <span class="error"><?php echo form_error('credit_card_number'); ?></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Name On Card <span class="text-danger">*</span></label>
                                            <div class="col-sm-8">
                                                 <input type="text" autocomplete="off"  class="form-control" name="name" value="<?php echo set_value('name'); ?>"> 
                                                 <span class="error"><?php echo form_error('name'); ?></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            
                                            <label class="col-sm-3 control-label">Exp Month <span class="text-danger">*</span></label>
                                            <div class="col-sm-3">
                                                <?php
                                                   $val = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12); 
                                                   echo form_dropdown('month', $val, set_value('month'), 'class="form-control"' ); ?>
                                                
                                               
                                            </div>
                                            
                                            
                                            
                                            <label class="col-sm-2 control-label">Exp Year <span class="text-danger">*</span></label>
                                            <div class="col-sm-3">
                                                 
                                                 <?php
                                                    for($i=date('Y'); $i<=2032; $i++) { 
                                                         $val2[$i] = $i;
                                                  } ?> 
                                                
                                                <?php  echo form_dropdown('year', $val2, set_value('year'), 'class="form-control"' ); ?>
                                        	</div>
                                             
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">CVV Numbers <span class="text-danger">*</span></label>
                                            <div class="col-sm-3">
                                                 <input type="text" autocomplete="off"  value="<?php echo set_value('cvv'); ?>" class="form-control cc-cvc" name="cvv"> 
                                                  <span class="error"><?php echo form_error('cvv'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="payment-paypal" style="display:none">
                                <?php /*
                                <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Paypal Email <span class="text-danger">*</span></label>
                                            <div class="col-sm-8">
                                                <input type="email" name="paypal_email" autocomplete="off"  value="<?php echo set_value('paypal_email'); ?>" class="form-control" >                                 <span class="error"><?php echo form_error('paypal_email'); ?></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Password <span class="text-danger">*</span></label>
                                            <div class="col-sm-8">
                                                 <input type="password" name="paypal_password" autocomplete="off"  value="" class="form-control">
                                                  <span class="error"><?php echo form_error('paypal_password'); ?></span> 
                                            </div>
                                        </div>
                                       <!-- <button type="submit" class="btn btn-danger">Next</button>-->
                                    </div>
                                </div>
                                */?>
                            </div>
                        </div>
                        
                        <div class="reg-step">
                            <h4 class="txt-upper page-title txt-red">Confirm & Place your order</h4>
                            <p class="txt-center">
                                <label class="checkbox-inline"><input type="checkbox" required name="confirm"> I have read and agree to the <a href="#">Terms & Conditions</a></label>
                                <div class="error" align="center"><?php echo form_error('confirm'); ?></div><br><br>
                                <div align="center"><input type="submit" name="donate" class="btn btn-lg btn-danger"  value="Place Donation"></div>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- End .row -->
    </section><!-- End .container -->
</div><!-- End #content --> 

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
    <?php if(isset($paypal_flag) && $paypal_flag == 1) { ?>
        $('#pay').click();
        $('#pay').attr('checked',true);
        $('#payment-cc').hide();
        $('#payment-paypal').show();
    <?php } ?> 

    $('#change').change(function(){
        $('#countr').show();          
    });
});
</script> 