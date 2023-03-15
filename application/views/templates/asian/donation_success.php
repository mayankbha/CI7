
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
            <div class="content-box-border">
            
            <?php //echo "<pre>"; print_r($donation_details); 
			//echo "<pre>"; print_r($order_details); 
			?>
            
            <div class="reg-step">
                <div class="alert alert-info">
                   <p><?php echo isset($message) ? $message : "Thank you for activate message service it will be valid only for limited days!";   ?></p>
                 </div>
             </div><!-- End .row -->
             <?php //echo "<pre>"; print_r($donation_details);?>
             <div class="reg-step">
             <?php if(isset($donation_details) && !empty($donation_details)): ?>
                <table class="table table-bordered">
                       <tr>
                        <td class="field-label col-xs-3 active">
                          <label>Donation Id#:</label>
                        </td>
                        <td class="col-md-9">
                          <?php echo $donation_details[0]->donation_id; ?>
                        </td>
                      </tr>
                      <tr>
                        <td class="field-label col-xs-3 active">
                          <label>Payer Name:</label>
                       
                        <td class="col-md-9">
                          <?php echo $donation_details[0]->b_first_name." ".$donation_details[0]->b_last_name; ?>
                        </td>
                      </tr>
                      
                       <tr>
                        <td class="field-label col-xs-3 active">
                          <label>Activation Date:</label>
                        </td>
                        <td class="col-md-9">
                           <?php echo $donation_details[0]->activate_date; ?>
                        </td>
                      </tr>
                      <tr>
                        <td class="field-label col-xs-3 active">
                          <label>Plan Amount:</label>
                        </td>
                        <td class="col-md-9">
                           <?php echo "$".$donation_details[0]->plan_amount."&nbsp;USD"; ?>
                        </td>
                      </tr>
                      <tr>
                        <td class="field-label col-xs-3 active">
                          <label>Validity:</label>
                        </td>
                        <td class="col-md-9">
                         <?php if($donation_details[0]->plan_amount == '1.00'): ?>
                         <?php echo "3 Days"; ?>
                         <?php endif;?>
                         <?php if($donation_details[0]->plan_amount == '2.00'): ?>
                         <?php echo "7 Days"; ?>
                         <?php endif;?>
                         <?php if($donation_details[0]->plan_amount == '3.00'): ?>
                         <?php echo "12 Days"; ?>
                         <?php endif;?>
                        </td>
                      </tr>
                      <tr>
                        <td class="field-label col-xs-3 active">
                          <label>Email Address:</label>
                        </td>
                        <td class="col-md-9">
                           <?php echo $donation_details[0]->email; ?>
                        </td>
                      </tr>
                      <tr>
                        <td class="field-label col-xs-3 active">
                          <label>Transaction Id:</label>
                        </td>
                        <td class="col-md-9">
                           <?php echo $donation_details[0]->paypal_txn_id; ?>
                        </td>
                      </tr>
                      
                         
               </table>
                <?php endif;?>
                
                
             </div><!-- End .row -->
            
            
            <div class="reg-step">
               <p>We are pleased to bring to you exciting offers as part of our Special Privillage, Customer delight edition.</p>
               <p><h2><a href="<?php echo site_url('/profile/') ?>">Click here to enjoy various offers on your gift items.</a></h2></p>       
            </div>
            </div>
          
          
    </section><!-- End .container -->
</div><!-- End #content -->

  
