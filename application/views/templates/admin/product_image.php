<div id="center-contents">
	<div class="page-header clearfix">
		<h3 class="pull-left">All Products Images</h3>
        <input type="file"  style="display:none"  name="product_image" />
        <input type="button"   value="Add New Product Image"  id="product_image_button"   class="btn btn-primary  pull-right"  />
	</div>
	<div class="tabular_cont">
        <div  id="product_image_loader" style="text-align:center;"></div>
		<div id="client_table">
			<table class="table table-striped table-bordered"  id="image">
				<tr>
					<td>Sr. No</td>
					<td>Image</td>
					<td>Actions</td>
				</tr>
				<?php $counter = 1; ?>
				<?php if($product_image_list): ?>
				<?php foreach($product_image_list as $product) : ?>
					<tr>
						<?php /*<td><?php echo  $product->product_image_id; ?></td>*/ ?>
						<td><?php echo  $counter; ?></td>
						<td><img  src="<?php echo base_url('/uploads/product')."/".$product->fk_product."/".$product->path; ?>"  width="50"  height="50"  /></td>
						<td><a class="btn red icn-only" href="<?php echo base_url('/admins/product_images/delete') ?>/<?php echo $product->product_image_id; ?>/<?php echo $product->fk_product; ?>" onclick="return confirm_delete();"><img src="/template/admin/img/icon-delete.png" alt="Delete"/></i></a></td>
					</tr>
				<?php $counter++; ?>
				<?php endforeach; else :   ?>
				<tr>
					<td></td>
					<td>
					<?php echo "No Record"; ?>
					</td>
					<td></td>
				</tr>
				<?php endif; ?>
			</table> 
        </div>
	</div>
</div>
<!-- end right contents --> 
<script type="text/javascript" src="<?php echo base_url('template/admin/js/Ajaxfileupload-jquery-1.3.2.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('template/admin/js/ajaxupload.3.5.js'); ?>"></script>
<link href="<?php echo base_url('template/admin/css/Ajaxfile-upload.css'); ?>" rel="stylesheet" type="text/css">
<script>
	
$(function(){
		var counter = <?php echo $counter ?>;
        var loader    = $("#product_image_loader");
		var btnUpload = $('#product_image_button');
		
		new AjaxUpload(btnUpload, {
			action: '<?php echo base_url('/admins/product_images/add_image');?>',
			name: 'product_image',
			onSubmit: function(file, ext){
				if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
                    // extension is not allowed 
					return false;
				}
			  loader.html('<img src="<?php echo base_url('template/admin/img/ajax-loader.gif'); ?>" height="100" width="100">');
			},
			onComplete: function(file, response){ 
					loader.html("");
					location.reload();
					return true;
					/*
					var img = '<?php echo base_url('/uploads')?>/'+response;
					var image = "<img src="+img+"   width='50'  height='50'  />";
					$("#image").append(image);
					*/
					
			}
		});
		
	});
	function confirm_delete() {
		return confirm('Are you really want to delete ?');
	}	
</script>


