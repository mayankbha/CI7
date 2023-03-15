<?php $id = isset($data['id']) ? $data['id'] : ''; ?>

<div id="center-contents">
	<div class="page-header clearfix">
		<h3 class="pull-left">Create New Forum</h3>
	</div>
	<div class="tabular_cont">
		<?php
		$error_message = validation_errors();
		if ($error_message != "") 
		{
		?>
			<div class="alert alert-error">
				<button class="close" data-dismiss="alert"></button>
				<?php echo $error_message ?>
			</div>
		<?php
		} //if ends     
		?>
       <form action="<?php echo base_url('admins/forums/add/'.$id) ?>" id="form_sample_1" class="form-horizontal" method="post" role="form">
        
			<div class="form-group">
				<label class="col-sm-2 control-label"> Forum Name <span class="required">*</span></label>
				<div class="col-sm-5">
					<input name="name" type="text" class="form-control" value="<?php echo set_value('name', isset($data['name']) ? $data['name'] : '') ?>"/>
				</div>
			</div>
            
			<div class="form-group">
				<label class="col-sm-2 control-label"> Description </label>
				<div class="col-sm-5">
					<textarea class="form-control" rows="6" name="description" ><?php echo set_value('description', isset($data['description']) ? $data['description'] : '') ?></textarea>
				</div>
			</div>
            
            <div class="form-group">
				<label class="col-sm-2 control-label"> Order </label>
				<div class="col-sm-5">
					<input name="order" type="text" class="form-control" value="<?php echo set_value('order', isset($data['order']) ? $data['order'] : '') ?>"/>
				</div>
			</div>
            
            <div class="form-group">
				<label class="col-sm-2 control-label"> Color </label>
				<div class="col-sm-5">  
                  <?php 
		  		$options = isset($forum_color) ? $forum_color : array(0=>'Select');
				echo form_dropdown('color', $options, set_value('color', isset($data['color']) ? $data['color'] : ''), 'class="form-control"');
				?>
					<!--<input name="color" type="text" class="form-control" value="<?php echo set_value('color', isset($data['color']) ? $data['color'] : '') ?>"/>-->
				</div>
			</div>
            
			<div class="form-group">
				<label class="col-sm-2 control-label"> Forum Group </label>
				<div class="col-sm-5">
					<?php
						$options = isset($all_forumgroup) ? $all_forumgroup : array(0 => 'Select');
						echo form_dropdown('forum_group', $options, set_value('forum_group', isset($data['forum_group']) ? $data['forum_group'] : ''), 'class="form-control"');
					?>
				</div>
			</div>
            
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
				  <button type="submit" class="btn btn-success"> Save </button>
                  <button type="button" class="btn btn-danger" onclick="history.go(-1)"> Cancel </button>
				</div>
			</div>
        </form>
	</div>
</div>

<!-- end right contents --> 