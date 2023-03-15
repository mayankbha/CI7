
<div class="content-box">
        <section class="container">
            <div class="row">
                <ol class="breadcrumb">
                    <li><i class="fa fa-user fa-2x icon-round-border"></i></li>
                    <li><span><?php echo $this->lang->line('ecommerce'); ?></span></li>
                    <li class="active"><span><?php echo $this->lang->line('Successful'); ?></span></li>
                </ol>
            </div>
            <div class="content-box-border">
            
            <?php //echo "<pre>"; print_r($user_details); 
			//echo "<pre>"; print_r($order_details); 
			?>
            
            <div class="reg-step">
                <div class="alert alert-info">
                   <p><?php echo isset($message) ? $message : "";   ?></p>
                 </div>
             </div><!-- End .row -->
             
             <div class="reg-step">
             
                <table class="table table-bordered">
                       <tr>
                        <td class="field-label col-xs-3 active">
                          <label>Order Id:</label>
                        </td>
                        <td class="col-md-9">
                      
                          <?php echo $user_details['order_id']; ?>
                        </td>
                      </tr>
                      <tr>
                        <td class="field-label col-xs-3 active">
                          <label>Payer Name:</label>
                        </td>
                        <td class="col-md-9">
                          <?php echo $user_details['u_first_name']." ".$user_details['u_last_name']; ?>
                        </td>
                      </tr>
                      
                      <tr>
                        <td class="field-label col-xs-3 active">
                          <label>Refered User Name:</label>
                        </td>
                        <td class="col-md-9">
                          <?php echo $user_details['b_first_name']." ".$user_details['b_last_name']; ?>
                        </td>
                      </tr>
                      
                       <tr>
                        <td class="field-label col-xs-3 active">
                          <label>Purchasing Date:</label>
                        </td>
                        <td class="col-md-9">
                           <?php echo $user_details['purchasing_date']; ?>
                        </td>
                      </tr>
                      
                         <tr>
                        <td class="field-label col-xs-3 active">
                          <label>Transaction ID:</label>
                        </td>
                        <td class="col-md-9">
                          <?php if(isset($transactionId)) { echo $transactionId; } ?>
                         <?php if(isset($user_details['paypal_txn_id'])) { echo $user_details['paypal_txn_id']; }?>
                        </td>
                      </tr>
                      
                      <tr>
                        <td class="field-label col-xs-3 active">
                          <label>Email Id of payer:</label>
                        </td>
                        <td class="col-md-9">
                            <?php echo $this->session->userdata('email'); ?>
                        </td>
                      </tr>
                   
                     
                   <?php if(isset($order_details) && !empty($order_details)):  ?>
                     <?php 
						$counter = 1;
						foreach($order_details as $ud): 
					?>
                      <?php /*
                      <tr>
                        <td class="field-label col-xs-3 active">
                          <label>Product ID:</label>
                        </td>
                        <td class="col-md-9">
                          <?php echo "$".$ud->product_id; ?>
                        </td>
                      </tr>
                      */?>
                      <tr>
                        <td class="field-label col-xs-3 active">
                          <label>Product Title:</label>
                        </td>
                        <td class="col-md-9">
                          <?php echo $ud->product_title; ?>
                        </td>
                      </tr>
                      <tr>
                        <td class="field-label col-xs-3 active">
                          <label>Product Price:</label>
                        </td>
                        <td class="col-md-9">
                          <?php echo "$".$ud->unit_price ." X " .$ud->quantity.' = $' . $ud->total ; ?>
                        </td>
                      </tr>
					  <?php /*
                      <tr>
                        <td class="field-label col-xs-3 active">
                          <label>Unit Price:</label>
                        </td>
                        <td class="col-md-9">
                          <?php echo "$".$ud->unit_price; ?>
                        </td>
                      </tr>
                      
                       <tr>
                        <td class="field-label col-xs-3 active">
                          <label>Quantity:</label>
                        </td>
                        <td class="col-md-9">
                          <?php echo $ud->quantity; ?>
                        </td>
                      </tr>
                      
                      <tr>
                        <td class="field-label col-xs-3 active">
                          <label>Product Price:</label>
                        </td>
                        <td class="col-md-9">
                          <?php echo $ud->total; ?>
                        </td>
                      </tr>
						*/?>

                      
				   <?php	$counter++;
						endforeach; 
					?>
					   
                       <?php endif; ?>  
                      
                      
                     <tr align="right">
                        <td colspan="" align="">
                          <?php /*<label>Tax Amount:</label>
                          <?php echo "$".$user_details['tax_amount']; */ ?>
						  <label>Final Amount:</label>
                        </td>
                        <td  align="left">
                          <?php echo "$".$user_details['product_amount']; ?>
                        </td>
                      </tr>
                      
                         
               </table>
                
                
                
             </div><!-- End .row -->
            
            
            <div class="reg-step">
               <p>We are pleased to bring to you exciting offers as part of our Special Privillage, Customer delight edition.</p>
               <p><h2><a href="<?php echo site_url('/store/') ?>">Click here to enjoy various offers on your gift items.</a></h2></p>       
            </div>
            </div>
          
          
    </section><!-- End .container -->
</div><!-- End #content -->

  
