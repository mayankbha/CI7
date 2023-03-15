<?php //echo '<pre>'; print_r($cart_products); die;    ?>
<div class="content-box">
	<section class="container">
		<div class="row">
			<ol class="breadcrumb">
				<li><i class="fa fa-user fa-2x icon-round-border"></i></li>
				<li><span><?php echo $this->lang->line('ecommerce'); ?></span></li>
				<li class="active"><span><?php echo $this->lang->line('view_cart'); ?></span></li>
			</ol>
		</div>
       
		<div class="cart-btn" id="cartsummary">
			<?php /*Content will load using ajax*/ ?>
			<button class="btn btn-lg dropdown-toggle btn-danger" type="button" data-toggle="dropdown">
				<i class="fa fa-shopping-cart"></i><span class="badge">0</span>
			</button>
			<div class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
				<div class="cart-item-ct clearfix">
					<table class="table table-hover">
						<tr>
                            <td>
						      <?php echo $this->lang->line('empty_cart'); ?>  
                            </td>
						</tr>
					</table>
					<div class="cart-total">
						<h5>Total: <span class="txt-red">$ 0.00</span></h5>
					</div>
					<div class="cart-action">
						<a href="<?php echo base_url('store/view_cart'); ?>" class="btn btn-danger btn-sm">View Cart</a>
						<a href="#" class="btn btn-warning btn-sm">Checkout</a>
					</div>
				</div>
			</div>
		</div>
		<div class="row ecommerce viewcart">
			<div class="content-box-border">
				<h4 class="page-title txt-upper"><i class="fa fa-shopping-cart"></i><span><?php echo $this->lang->line('your_cart'); ?></h4>
				<form class="viewcart-frm form-horizontal" method="post" action="<?php echo site_url('checkout/billing'); ?>">
					<table class="table table-bordered table-hover tbl-viewcart">
						<thead>
							<tr>
								<th><?php echo $this->lang->line('image'); ?></th>
								<th><?php echo $this->lang->line('prdduct_name'); ?></th>
								<th class="model-title"><?php echo $this->lang->line('sku'); ?></th>
								<th><?php echo $this->lang->line('qty'); ?></th>
								<th><?php echo $this->lang->line('unit_price'); ?></th>
								<th><?php echo $this->lang->line('total'); ?></th>
							</tr>
						</thead>
						<tbody>
							<?php $totalAmount = 0; ?>
							<?php if(isset($cart_products) && !empty($cart_products)):  ?>
							<?php foreach($cart_products as $product): ?>
								<tr id="cart_row<?php echo $product['product_id'] ?>">
									<td>
										<?php $img = isset($product['product_images'][0]['path']) ? base_url('uploads/product/'.$product['product_id'].'/'.$product['product_images'][0]['path']) : '' ?>
										<a href="#" class="avatar-md cart-thumb"><img src="<?php echo $img; ?>" alt="<?php echo $product['product_title'] ?>"> </a>
									</td>
									<td><strong><?php echo $product['product_title'] ?></strong></td>
									<td class="model-no"><?php echo $product['sku'] ?></td>
									<td class="qty-action">
										<div class="row">
											<div class="col-sm-3">
												<input type="text" class="form-control cart-qty-input" id="quantity<?php echo $product['product_id'] ?>" value="<?php echo $product['quantity'] ?>">
											</div>
											<label class="control-label">
												<a href="javascript:void(0);" onclick="updateCart('<?php echo $product['product_id'] ?>', 'remove');"><i class="fa fa-times"></i></a>
											</label>
											<label class="control-label">
												<a href="javascript:void(0);" onclick="updateCart('<?php echo $product['product_id'] ?>', 'update');"><i class="fa fa-refresh"></i></a>
											</label>
										</div>
									</td>
									<td>$<?php echo $product['price'] ?></td>
									<td>
										<?php
											$total = (float)$product['price'] * (float) $product['quantity'] ;
											$totalAmount = $total + $totalAmount;
											$total = number_format($total,'2','.','');
										?>
										<strong>$<?php echo $total ?></strong>	
									</td>
								</tr>
                              
                            
                              <input type="hidden" name="product_title[]" id="product_id" value="<?php echo $product['product_title'] ?>  ">
                                
                              <input type="hidden" name="product_id[]" id="product_id" value="<?php echo $product['product_id'] ?>">
                              
                              <input type="hidden" name="unit_price[]" id="unit_price" value="<?php echo $product['price'] ?>">
                               
                              <input type="hidden" name="unit_total[]" id="total" value="<?php echo $total ?>">
                              
                              <input type="hidden" name="quantity[]" id="quantity" value="<?php echo $product['quantity'] ?>">
                              
                              
                                 
							<?php endforeach; ?>
							<?php else: ?>
								<tr>
									<td colspan="6"><div class="alert alert-danger"><?php echo $this->lang->line('empty_cart'); ?></div></td>
								</tr>
                               <?php endif; ?>
						</tbody>
					</table>
                    <?php if(isset($cart_products) && !empty($cart_products)):  ?>
					<div class="viewcart-total row">
						<div class="col-sm-4 col-sm-offset-8">
							<p class="clearfix txt-right"><strong class="pull-left"><?php echo $this->lang->line('price'); ?>:</strong> $<?php echo $totalAmount ?> </p>
							
							<p class="clearfix txt-right">
								<strong class="pull-left">
									<?php echo $this->lang->line('tax'); ?> (<?php echo $tRate = isset( $tax_rate['tax_rate'] ) ? $tax_rate['tax_rate'] : 0.0 ?>%):
								</strong> 
								<?php 
									$tax = ($tRate*$totalAmount)/100 ;
									echo  $tax_amt = '$'.number_format($tax,'2','.','');
									$tax_amout = number_format($tax,'2','.',''); 
								?>
                                 <input type="hidden" name="tax_amount" id="tax_rate" value="<?php echo $tax_amout; ?>">
                                
                                 <input type="hidden" name="total" id="total_amt" value="<?php echo $totalAmount; ?>">
                                
								<!--$12.5-->
							
							<h4 class="txt-red txt-right clearfix"><strong class="pull-left"><?php echo $this->lang->line('total'); ?>:</strong> $<?php echo number_format($totalAmount + $tax,'2','.',''); ?></h4>
                            
                            <input type="hidden" name="product_amount" id="product_amount" value="<?php echo number_format($totalAmount + $tax,'2','.','');?>" >
						</div>
					</div>
					
					<div class="viewcart-action clearfix">
						<a href="<?php echo base_url('store') ?>" class="btn btn-default">Continue Shopping</a>
						<button type="submit" name="submit" value="submit" class="btn btn-danger pull-right">Checkout</button>
                       
					</div>
                   
                    <?php endif; ?>
				</form>
			</div>
		</div>
	</div><!-- End .row -->
    </section><!-- End .container -->
</div><!-- End #content -->
<script>
	function onRedirect()
	{
		window.location.replace('<?php echo base_url('checkout') ?>');
	}
	
	
</script>
