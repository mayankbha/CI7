
<div class="content-box">
        <section class="container">
            <div class="row">
                <ol class="breadcrumb">
                    <li><i class="fa fa-user fa-2x icon-round-border"></i></li>
                    <li><span><?php echo $this->lang->line('ecommerce'); ?></span></li>
                    <li class="active"><span><?php echo $this->lang->line('checkout'); ?></span></li>
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
                <?php //echo "<pre>"; print_r($this->session->userdata('items')); ?>
                <?php //echo $this->session->userdata('product_id'); //echo "<pre>"; print_r($this->session->userdata("total"));   ?>
                 
                    <form class="form-horizontal" method="post" enctype="multipart/form-data" novalidate  action="<?php echo base_url('checkout/billing') ?>" >
                    
                        <div class="reg-step">
                            <h4 class="txt-upper page-title txt-red">Account & Billing Details</h4>
                            <div class="row">
                                <div class="col-sm-5">
							        <div class="form-group">
                                        <label class="control-label col-sm-3">First Name <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" name="b_first_name" value="<?php echo set_value('b_first_name'); ?>" id="b_first_name" />
                                            <span class="error"><?php echo form_error('b_first_name'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Last Name <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" name="b_last_name" value="<?php echo set_value('b_last_name'); ?>" id="b_last_name" />
                                            <span class="error"><?php echo form_error('b_last_name'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Phone <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" name="b_phone" value="<?php echo set_value('b_phone'); ?>" id="b_phone"  />
                                             <span class="error"><?php echo form_error('b_phone'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Address <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" name="b_address_1" value="<?php echo set_value('b_address_1'); ?>" id="b_address_1" maxlength="255"/>
                                             <span class="error"><?php echo form_error('b_address_1'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3"></label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" name="b_address_2" value="<?php echo set_value('b_address_2'); ?>" id="b_address_2" maxlength="255"/>
                                             <span class="error"><?php echo form_error('b_address_2'); ?></span>
                                        </div>
                                    </div>
                                    
                                    <!--hidden feilds for product amount and tax rate -->
                                    
                                 <?php 
								 if($items = $this->session->userdata('items'))
								 {
										 foreach($items as $itm)
										 { ?>
											 <input type="hidden" name="product_title[]"  value="<?php echo $itm['product_title']; ?>"  />
                                             <input type="hidden" name="product_id[]"  value="<?php echo $itm['product_id']; ?>"  />
											 <input type="hidden" name="quantity[]"    value="<?php echo $itm['quantity']; ?>"  />
											 <input type="hidden" name="unit_price[]"  value="<?php echo $itm['unit_price']; ?>"  />
											 <input type="hidden" name="unit_total[]" value="<?php echo $itm['unit_total']; ?>"  /> 
									
										 <?php 
										 }
								 }		 
								 
                                    
                              if($final_items = $this->session->userdata('final_items'))
							   {
								?>  
                                <input type="hidden" name="product_amount" value="<?php echo $final_items['product_amount'];?>"  />
                                <input type="hidden" name="total" value="<?php echo $final_items['total']; ?>"  />
                                <input type="hidden" name="tax_amount"  value="<?php echo $final_items['tax_amount']; ?>"  />
                          <?php } ?>   
                                </div> 
                                <div class="col-sm-5 col-sm-offset-1">
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Company</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" type="text" name="b_company" value="<?php echo set_value('b_company'); ?>" id="b_company" />
                                             <span class="error"><?php echo form_error('b_company'); ?></span>
                                        </div>
                                    </div>
                                   
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Country <span class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                        
                                         <?php
											$options = isset($countries) ? $countries : array(0=>'Select');
											echo form_dropdown('b_country_id', $options, 	set_value('b_country_id', 0), 'class="form-control" id="b_country_id"');
											?>
                                            </select>
                                          <span class="error"><?php echo form_error('b_country_id'); ?></span>   
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">State <span class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                        
                                            <input class="form-control" type="text" name="b_state" id="b_state" value="<?php echo set_value('b_state'); ?>" />
                                               <span class="error"><?php echo form_error('b_state'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">City <span class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <input class="form-control" type="text" name="b_city" value="<?php echo set_value('b_city'); ?>" id="b_city" />
                                             <span class="error"><?php echo form_error('b_city'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Zip <span class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <input class="form-control" value="<?php echo set_value('b_zip'); ?>" type="text" name="b_zip" id="b_zip" />
                                             <span class="error"><?php echo form_error('b_zip'); ?></span>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <div class="reg-step">
                            <h4 class="txt-upper page-title txt-red">Delivery Details</h4>
                            <div class="reg-step-opt gray-bg">
                                <div class="form-group">
                                    <label class="radio-inline"><input type="radio" name="delivery" checked="checked" class="by_adrs"> Send by address</label>
                                    <label class="radio-inline"><input type="radio" name="delivery"  class="by_mem_id"> Send by ID</label>
                                </div>
                            </div>
                            
                             <div id="send-by-id" style="display:none;">
                                <h3 class="page-title"><strong>Delivery by member ID</strong></h3>
                                <p><strong>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</strong> </p>
                                <div class="row">
                                    <div class="col-sm-3 col-sm-offset-1">
                                        <div class="form-group">
                                            <label class="control-label">Sent to member with ID number</label>
                                            <div class="row">
                                                <div class="col-sm-8">
                                                <input type="text"  class="form-control" name="member_id" value="<?php echo set_value('member_id'); ?>" id="member_id" ></div>
                                                <div class="col-sm-3"><button class="btn btn-danger" id="search" type="button" onclick="get_memberid();"><i class="fa fa-search"></i></button></div>
                                            </div>
                                        </div>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name=""> Pleasy verify when it right
                                        </label>
                                        <span class="s_first_name"></span>
                                    </div>
                                    <div class="col-sm-2 col-sm-offset-1">
                                        <div class="send-by-id-ct">
                                            <h5 id="user_names"></h5>
                                            <a href="#" class="avatar-lg inner" ></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            
                            
                            <div id="send-by-addr">
                                <h5 class="page-title">Delivery by Address</h5>
                                
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                        <label class="control-label col-sm-3">First Name <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" name="s_first_name" value="<?php echo set_value('s_first_name'); ?>" id="s_first_name" />
                                            <span class="error"><?php echo form_error('s_first_name'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Last Name <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" name="s_last_name" value="<?php echo set_value('s_last_name'); ?>" id="s_last_name" />
                                            <span class="error"><?php echo form_error('s_last_name'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Phone <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" name="s_phone" value="<?php echo set_value('s_phone'); ?>" id="s_phone" />
                                            <span class="error"><?php echo form_error('s_phone'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Address <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" name="s_address_1" value="<?php echo set_value('s_address_1'); ?>" id="s_address_1" />
                                            <span class="error"><?php echo form_error('s_address_1'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3"></label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" name="s_address_2" value="<?php echo set_value('s_address_2'); ?>" id="s_address_2" />
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-sm-5 col-sm-offset-1">
                                        <div class="form-group">
											<label class="control-label col-sm-3">Company </label>
											<div class="col-sm-8">
												<input class="form-control" type="text" name="s_company" value="<?php echo set_value('s_company'); ?>" id="s_company" />
                                                <span class="error"><?php echo form_error('s_company'); ?></span>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-3">Country <span class="text-danger">*</span></label>
											<div class="col-sm-8">
												<?php
											$options = isset($countries) ? $countries : array(0=>'Select');
											echo form_dropdown('s_country_id', $options, 	set_value('s_country_id', 0), 'class="form-control" id="s_country_id"');
												?>
                                               <span class="error"><?php echo form_error('s_country_id'); ?></span> 
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-3">State <span class="text-danger">*</span></label>
											<div class="col-sm-8">
												<input class="form-control" type="text" value="<?php echo set_value('s_state'); ?>" name="s_state" id="s_state" />
                                                <span class="error"><?php echo form_error('s_state'); ?></span>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-3">City <span class="text-danger">*</span></label>
											<div class="col-sm-8">
												<input class="form-control" value="<?php echo set_value('s_city'); ?>" type="text" name="s_city" id="s_city" />
                                                <span class="error"><?php echo form_error('s_city'); ?></span>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-3">Zip <span class="text-danger">*</span></label>
											<div class="col-sm-8">
												<input class="form-control" value="<?php echo set_value('s_zip'); ?>" type="text" name="s_zip" id="s_zip" />
                                                <span class="error"><?php echo form_error('s_zip'); ?></span>
											</div>
										</div
                                    ></div>
                                </div>
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
                            
                            <div id="payment-cc">
                                <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3 card">
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
												
                                                <span class="error"><?php echo form_error('month'); ?></span>
                                            </div>
                                            
                                            
                                            
                                            <label class="col-sm-2 control-label">Exp Year <span class="text-danger">*</span></label>
                                            <div class="col-sm-3">
                                                 
                                                 <?php
													for($i=date('Y'); $i<=2032; $i++) { 
											        	 $val2[$i] = $i;
                                                  } ?> 
                                                
                                                <?php  echo form_dropdown('year', $val2, set_value('year'), 'class="form-control"' ); ?>
                                          <span class="error"><?php echo form_error('year'); ?></span>
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
                                <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Paypal Email <span class="text-danger">*</span></label>
                                            <div class="col-sm-8">
                                                <input type="email" name="paypal_email" autocomplete="off"  value="<?php echo set_value('paypal_email'); ?>" class="form-control" required> 
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Password <span class="text-danger">*</span></label>
                                            <div class="col-sm-8">
                                                 <input type="password" name="paypal_password" autocomplete="off"  value="" class="form-control" required> 
                                            </div>
                                        </div>
                                       <!-- <button type="submit" class="btn btn-danger">Next</button>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="reg-step">
                            <h4 class="txt-upper page-title txt-red">Confirm & Place your order</h4>
                            <p class="txt-center">
                                <label class="checkbox-inline"><input type="checkbox" required name="confirm"> I have read and agree to the <a href="#">Terms & Conditions</a></label>
                                <div class="error" align="center"><?php echo form_error('confirm'); ?></div><br><br>
                                <div align="center"><input type="submit" name="place_order" class="btn btn-lg btn-danger"  value="Place Order"></div>
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

 
 if($('#s_first_name').val() != "")
 {
    $('.by_mem_id').prop('checked', true).triggerHandler('click');
    $('#search').click();
    $("#send-by-id").slideDown("slow");
	$("#member_id").val();
	$( ".inner" ).html( "<img id='pro_pic' src='<?php echo base_url() ?>resources/img/"+user.name+"'>" );
	$('#user_names').text(user.first_name+" "+user.last_name);
 }

  $(".by_mem_id").click(function(){
    $("#send-by-id").slideDown("slow");
  });
  $(".by_adrs").click(function(){
	  var member_id = $('#member_id').val();
	$(".send-by-id-ct").hide();
	$("#send-by-id").slideUp("slow");
	$("#send-by-id  input[type='text']").val("");
	$('#send-by-addr input[type="text"]').val("");
	$('#send-by-addr select').val("");
  });
});
</script>
<script>
function get_memberid()
  {
  $(".send-by-id-ct").show();
  var member_id = $('#member_id').val();
  if(member_id == "")
  {
     $('#member_id').css("border-color","red");
	 return false;
  } 
	$.ajax({
		type: "POST",
		url:"<?php echo site_url('checkout/get_member_by_id'); ?>",
		data:{member_id:member_id},
		success: function(res){
			var user = res.user;
			
			if (user == undefined || user == null || user.length == 0){
					$('#user_names').html("User not found!");
			 		$( ".inner" ).html( "<img id='pro_pic' src='<?php echo base_url() ?>template/asian/resources/img/not_found.png'> " ); 
					$('#send-by-addr input[type="text"]').val("");
					$('#send-by-addr select').val("");
					
			}
			else{
			        $('#s_first_name').val(user.first_name);
					$('#s_last_name').val(user.last_name);
					$('#s_company').val(user.company);
					$('#s_phone').val(user.phone);
					$('#s_state').val(user.state_province);
					$('#s_country_id').val(user.country);
					$('#s_city').val(user.city);
					$('#s_zip').val(user.zip_code);
					$('#s_address_1').val(user.address);
					$('#pro_pic').val(user.name);
					if(user.name == null)
					{
					  $( ".inner" ).html( "<img id='pro_pic' src='<?php echo base_url() ?>template/asian/resources/img/no-image.jpg'> " );  
					 
					}
					else
					{
					  $( ".inner" ).html( "<img id='pro_pic' src='<?php echo base_url() ?>resources/img/"+user.name+"'>" );
					}
					  $('#user_names').text(user.first_name+" "+user.last_name);
					 
				     
			        
			}
		}
	});
  }
</script> 
  
