<?php $id = isset($data['product_cat_id']) ? $data['product_cat_id'] : '' ?>
<div id="center-contents">
	<div class="page-header clearfix">
		<h3 class="pull-left">Create New Category</h3>
	</div>
	<div class="tabular_cont">
		<?php
		$error_message = validation_errors();
		if ($error_message != "") {
			?>
			<div class="alert error alert-error">
				<button class="close" data-dismiss="alert"></button>
				<?php echo $error_message ?>
			</div>
			<?php
		} //if ends 
		?>
		<form action="<?php echo base_url('admins/productcategory/add/' . $id) ?>" id="form_sample_1" class="form-horizontal" method="post" role="form" enctype="multipart/form-data">
			<div class="form-group">
				<label class="col-sm-2 control-label">Title<span class="required">*</span></label>
				<div class="col-sm-5">
					<input name="category_name" type="text" class="form-control" value="<?php echo set_value('category_name', isset($data['category_name']) ? $data['category_name'] : '') ?>"/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Description</label>
				<div class="col-sm-5">
					<textarea class="form-control" rows="6" name="description" ><?php echo set_value('description', isset($data['description']) ? $data['description'] : '') ?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Parent Category</label>
				<div class="col-sm-5">
					<?php
						$options = isset($all_category) ? $all_category : array(0=>'Select');
						echo form_dropdown('fk_parent', $options, set_value('fk_parent', isset($data['fk_parent']) ? $data['fk_parent'] : ''), 'class="form-control"');
					?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Image</label>
				<div class="col-sm-5">
					<input name="cat_image" type="file"/>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
				  <button type="submit" class="btn btn-success">Save</button>
				</div>
			  </div>
        </form>
	</div>
</div>
<!-- end right contents --> 
