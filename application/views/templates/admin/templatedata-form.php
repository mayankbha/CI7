<?php $id = isset($data['id']) ? $data['id'] : ''; ?>

<div id="center-contents">
  <div class="page-header clearfix">
    <h3 class="pull-left">Create Template Data</h3>
  </div>
  <div class="tabular_cont">
    <?php
		$error_message = validation_errors();
		if ($error_message != "")
		{
	?>
        	<div class="alert error alert-error">
          	<button class="close" data-dismiss="alert"></button>
          	<?php echo $error_message ?> </div>
    <?php
		} //if ends 
	?>
    <form action="<?php echo base_url('admins/template_data/add/' . $id) ?>" id="form_sample_1" class="form-horizontal" method="post" role="form" enctype="multipart/form-data">
      <div class="form-group">
        <label class="col-sm-2 control-label">Group Title</label>
        <div class="col-sm-5">
		  <?php 
		  		$options = isset($all_tempgroup) ? $all_tempgroup : array(0=>'Select');
				echo form_dropdown('group_id', $options, set_value('group_id', isset($data['group_id']) ? $data['group_id'] : ''), 'class="form-control"');
			?>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Section</label>
        <div class="col-sm-5">
          <input type="text" class="form-control" name="section" value="<?php echo set_value('section', isset($data['section']) ? $data['section'] : '') ?>" />
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Image</label>
        <div class="col-sm-5">
          <!--   <input type="file" name="image_location"/>      -->
          <img width="100" height="100" alt="No Image" src="<?php echo isset($data['image_location']) ? $data['image_location'] : '' ?>" >
          <input type="hidden"   name="himage_location"  value="<?php echo set_value('image_location', isset($data['image_location']) ? $data['image_location'] : '') ?>"  />
          <input type="file" class="applicant_input" style="float: right; margin-right: -40px;" id="image_location"  name="image_location" >
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-success">Save</button>
           <button type="button" class="btn btn-danger" onclick="history.go(-1);">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- end right contents -->