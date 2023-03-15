<?php $id = isset($data['id']) ? $data['id'] : '' ?>

<div id="center-contents">
  <div class="page-header clearfix">
    <h3 class="pull-left"><?php echo isset($action) ? $action : ''; ?>Donation</h3>
  </div>
  <div class="tabular_cont">
    <?php
        $error_message = validation_errors();
        if ($error_message != "")
        {
    ?>
    		<div class="alert alert-error">
      		<button class="close" data-dismiss="alert"></button>
      		<?php echo $error_message ?> </div>
    <?php
        } //if ends 
    ?>
    <form action="<?php echo base_url('admins/donations/add/'.$id) ?>" id="form_sample_1" class="form-horizontal" method="post" role="form">
      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo $this->lang->line('donation_name');?><span class="required">*</span></label>
        <div class="col-sm-5">
          <input type="text" class="form-control" name="donation_name" value="<?php echo set_value('donation_name', isset($data['donation_name']) ? $data['donation_name'] : '') ?>" />
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo $this->lang->line('donation_amount'); ?></label>
        <div class="col-sm-5">          
        	<input type="text" class="form-control" name="amount" value="<?php echo set_value('amount', isset($data['amount']) ? $data['amount'] : '') ?>" />

        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo $this->lang->line('donation_benifits'); ?></label>
        <div class="col-sm-5">
          <?php
				$options = isset($donation_benifits) ? $donation_benifits : array(0=>'Select');
				//echo form_dropdown('benifits', $options, set_value('benifits', isset($data['benifits']) ? $data['benifits'] : ''), 'class="form-control"');
					?>
                     <?php echo form_multiselect('benifits[]', $options, set_value('benifits', isset($data['benifits']) ? explode(",", $data['benifits']) : ''), 'class="form-control"'); ?>
          <?php echo form_error('benifits'); ?> </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-success"><?php echo $this->lang->line('donation_save'); ?></button>
        </div>
      </div>
    </form>
  </div>
</div>
<!--  end right contents  -->