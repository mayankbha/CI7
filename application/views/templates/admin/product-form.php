<?php $id = isset($data['product_id']) ? $data['product_id'] : '' ?>
<div id="center-contents">
	<div class="page-header clearfix">
		<h3 class="pull-left">Create New Product</h3>
	</div>
	<div class="tabular_cont">
		
        <form action="<?php echo base_url('admins/product/add/' . $id) ?>" id="form_sample_1" class="form-horizontal" method="post" role="form">
			<div class="form-group">
				<label class="col-sm-3 control-label">Product Title<span class="required">*</span></label>
				<div class="col-sm-5">
					<input name="product_title" type="text" class="form-control" value="<?php echo set_value('product_title', isset($data['product_title']) ? $data['product_title'] : '') ?>"/>
					<?php echo form_error('product_title'); ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Description</label>
				<div class="col-sm-5">
					<textarea class="form-control" rows="6" name="description" ><?php echo set_value('description', isset($data['description']) ? $data['description'] : '') ?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Price<span class="required">*</span></label>
				<div class="col-sm-5">
					<input name="price" type="text" class="form-control" value="<?php echo set_value('price', isset($data['price']) ? $data['price'] : '') ?>"/>
					<?php echo form_error('price'); ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Weight<span class="required">*</span></label>
				<div class="col-sm-5">
					<input name="weight" type="text" class="form-control" value="<?php echo set_value('weight', isset($data['weight']) ? $data['weight'] : '') ?>"/>
					<span class="help-block">In Grams</span>
					<?php echo form_error('weight'); ?>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-3 control-label">Featured</label>
				<div class="col-sm-5">
					<?php  $yes = (isset($data['featured']) && $data['featured']==1) ? TRUE : FALSE; ?>
					<?php  $no = (isset($data['featured']) && $data['featured']==0 && $yes==FALSE) ? TRUE : FALSE; ?>
					<?php echo form_radio('featured', '1', $yes); ?> <?php echo form_label('Yes', 'featured'); ?>
					<?php echo form_radio('featured', '0', $no); ?> <?php echo form_label('No', 'active'); ?>
					<?php echo form_error('featured'); ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">SKU<span class="required">*</span></label>
				<div class="col-sm-5">
					<input name="sku" type="text" class="form-control" value="<?php echo set_value('sku', isset($data['sku']) ? $data['sku'] : '') ?>"/>
					<?php echo form_error('sku'); ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Active</label>
				<div class="col-sm-5">
					<?php  $yes = (isset($data['active']) && $data['active']==1) ? TRUE : TRUE; ?>
					<?php  $no = (isset($data['active']) && $data['active']==0) ? TRUE : FALSE; ?>
					<?php echo form_radio('active', '1', $yes); ?> <?php echo form_label('Yes', 'active'); ?>
					<?php echo form_radio('active', '0', $no); ?> <?php echo form_label('No', 'featured'); ?>
					<?php echo form_error('active'); ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Quanity<span class="required">*</span></label>
				<div class="col-sm-5">
					<input name="quantity" type="text" class="form-control" value="<?php echo set_value('quantity', isset($data['quantity']) ? $data['quantity'] : 0) ?>"/>
					<?php echo form_error('quantity'); ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Product Category</label>
				<div class="col-sm-5">
					<?php
						$options = isset($all_category) ? $all_category : array(0=>'Select');
						echo form_dropdown('fk_product_cat', $options, set_value('fk_product_cat', isset($data['fk_product_cat']) ? $data['fk_product_cat'] : ''), 'class="form-control"');
					?>
					<?php echo form_error('fk_product_cat'); ?>
				</div>
			</div>
			
			<?php  //echo '<pre>'; print_r($product_countries) ; die;
				$counter = 0;
				do{ 
					$country = 0;
					$nrm_ship = '';
					$exp_ship = '';
					if (!empty($product_countries)) 
					{
						$country  = $product_countries[$counter]['country_id'];
						$nrm_ship = $product_countries[$counter]['shipping_normal'];
						$exp_ship = $product_countries[$counter]['shipping_express'];
						
					}
			?>
			<div id="panelBox<?php echo $counter?>" class="panelBox">
				<?php if($counter!==0) : ?>
				<div class="form-group"><div class="col-sm-12"><button type="button" class="btn btn-danger pull-right" onclick="remove_country('panelBox<?php echo $counter ?>');">Remove</button></div></div>
				<?php endif ?>
			
				<input type="hidden" value="" name="product_country_id[]"/>
				<div class="form-group">
					<label class="col-sm-3 control-label">Product Country</label>
					<div class="col-sm-5">
						<?php
							$options = isset($countries) ? $countries : array(0=>'Select');
							echo form_dropdown('countries[]', $countries, 	set_value('countries', $country), 'class="form-control"');
						?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Normal Shipping Charge</label>
					<div class="col-sm-5">
						<input name="shipping_normal[]" type="text" class="form-control" value="<?php echo set_value('shipping_normal', $nrm_ship); ?>"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Express Shipping Charge</label>
					<div class="col-sm-5">
						<input name="shipping_express[]" type="text" class="form-control" value="<?php echo set_value('shipping_express', $exp_ship); ?>"/>
					</div>
				</div>
			</div>		
			<?php $counter++; } while( $counter < count($product_countries)); ?>
			<div id="countryBox"></div>
			<div class="form-group">
				<div class="col-sm-12">
					<button type="button" class="btn btn-info pull-right" onclick="add_more_country();">Add More Country</button>
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-10">
					<button type="submit" class="btn btn-success">Save</button>
				</div>
			</div>
        </form>
	</div>
</div>
<!-- end right contents --> 
<script type="text/javascript">
	var countryBox = '';
	var counter = <?php echo isset($product_countries) ? count($product_countries) : 0 ?>;
	jQuery(document).ready(function(){
		countryBox = jQuery('#panelBox0').html();
		//console.log(countryBox);
	});
	
	function add_more_country()
	{
		//Do not put this increment opertor at last
		counter++;
		
		//console.log(countryBox);
		var divData = '<div class="form-group"><div class="col-sm-12"><button type="button" class="btn btn-danger pull-right" onclick="remove_country(\'panelBox'+counter+'\');">Remove</button></div></div>';
		jQuery('<div class="panelBox" id="panelBox'+counter+'">'+divData+countryBox+'</div>').insertAfter('#countryBox');
		
	}
	
	function remove_country(id)
	{
		jQuery('#'+id).remove();
	}
</script>
