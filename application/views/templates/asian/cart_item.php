<?php //echo '<pre>'; print_r($cart_products); die; ?>
<?php $cart_products = (isset($cart_products)) ? $cart_products : array() ?>
<div class="dropdown">
	<button class="btn btn-lg dropdown-toggle btn-danger" type="button" data-toggle="dropdown">
		<i class="fa fa-shopping-cart"></i><span class="badge"><?php echo count($cart_products) ?></span>
	</button>
	<div class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
		<div class="cart-item-ct clearfix">
			<table class="table table-hover">
				<tbody>
					<?php $totalAmount = 0; ?>
					<?php if(isset($cart_products) && !empty($cart_products)): ?>
					<?php foreach($cart_products as $product): ?>
						<?php
							$total = (int)$product['price'] * (int) $product['quantity'] ;
							$totalAmount = $total + $totalAmount;
							$img = isset($product['product_images'][0]['path']) ? base_url('uploads/product/'.$product['product_id'].'/'.$product['product_images'][0]['path']) : '';
						?>
						<tr>
							<td><a href="#" class="cart-item-img avatar-sm"><img src="<?php echo $img  ?>" alt="<?php echo $product['product_title'] ?>"></a></td>
							<td><a href="#" class="cart-item-info"><strong><?php echo $product['product_title'] ?></strong></a><br>
								<span class="cart-item-price">$ <?php echo $product['price'] ?> * <?php echo $product['quantity'] ?></span>
							</td>
							<td><a href="javascript:void(0);" onclick="updateCart('<?php echo $product['product_id'] ?>', 'remove');" class="cart-item-edit" title="Delete Item" ><i class="fa fa-times"></i></a></td>
						</tr>
					<?php endforeach; ?>
					<?php else: ?>
						<tr>
							<td><?php echo $this->lang->line('empty_cart'); ?></td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
			<div class="cart-total">
				<h5>Total: <span class="txt-red">$ <?php echo $totalAmount ?></span></h5>
			</div>
			<div class="cart-action">
				<a href="<?php echo base_url('store/view_cart'); ?>" class="btn btn-danger btn-sm">View Cart</a>
				<a href="<?php echo base_url('checkout'); ?>" class="btn btn-warning btn-sm">Checkout</a>
			</div>
		</div>
	</div>
</div>
