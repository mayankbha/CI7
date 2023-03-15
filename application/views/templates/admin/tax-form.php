<?php $id = isset($data['tax_id']) ? $data['tax_id'] : '' ?>
<div id="center-contents">
	<div class="page-header clearfix">
		<h3 class="pull-left"><?php echo isset($page_head) ?  $page_head : 'Create New Tax Recoed'?></h3>
	</div>
	<div class="tabular_cont">
		<?php
		$error_message = validation_errors();
		if ($error_message != "") {
			?>
			<div class="alert alert-error">
				<button class="close" data-dismiss="alert"></button>
				<?php echo $error_message ?>
			</div>
			<?php
		} //if ends 
		?>
		<form action="<?php echo base_url('admins/tax/add/' . $id) ?>" id="form_sample_1" class="form-horizontal" method="post" role="form">
			
			<div class="form-group">
				<label class="col-sm-2 control-label">Country</label>
				<div class="col-sm-5">
					<?php
						$options = isset($countries) ? $countries : array(0=>'Select');
						echo form_dropdown('country_id', $options, set_value('country_id', isset($data['country_id']) ? $data['country_id'] : ''), 'class="form-control"');
					?>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-2 control-label">Tax Rate<span class="required">*</span></label>
				<div class="col-sm-5">
					<input name="tax_rate" type="text" class="form-control" value="<?php echo set_value('tax_rate', isset($data['tax_rate']) ? $data['tax_rate'] : '') ?>"/>
					<span class="help-block">Please add value in %</span>
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
