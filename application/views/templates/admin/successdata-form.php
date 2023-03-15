<?php $id = isset($data['id']) ? $data['id'] : '' ; ?>

<div id="center-contents">
  <div class="page-header clearfix">
    <h3 class="pull-left"> Create Success Story </h3>
  </div>
  <div class="tabular_cont">
   
    <?php  
		$error_message = validation_errors();
		if ($error_message != "") 
		{
	?>
        	<div class="alert error alert-error">   
                <button class="close" data-dismiss="alert"></button>  
                <?php echo $error_message; ?>
            </div>
    <?php
		}  //if ends             
	?>
    
    <form action="<?php echo base_url('admins/success_story/add/'.$id); ?>" id="form_sample_1" class="form-horizontal" method="post" role="form" enctype="multipart/form-data">  
      
      <div class="form-group">      
        <label class="col-sm-2 control-label"> Description </label>     
        <div class="col-sm-5">      
         <?php /*?> <input type="text" class="form-control" name="description" value="<?php echo set_value('description', isset($data['description']) ? $data['description'] : '') ?>" /><?php */?>  
         
          <textarea class="form-control" name="description"/><?php echo set_value('description', isset($data['description']) ? $data['description'] : '') ?></textarea>   
         
        </div>             
      </div>
                                     
      <div class="form-group">   
        <label class="col-sm-2 control-label">Image</label>   
        <div class="col-sm-5">     
          <img width="100" height="100" alt="No Image" src="<?php echo isset($data['image']) ? $data['image'] : ''; ?>" >
          <input type="hidden" name="himage" value="<?php echo set_value('image', isset($data['image']) ? $data['image'] : ''); ?>" />
          <input type="file" class="applicant_input" style="float: right; margin-right: -40px;" id="image"  name="image" >
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
<!-- end right contents   -->