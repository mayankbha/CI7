
<div id="center-contents">
	<div class="page-header clearfix">
		<h3 class="pull-left">All Products</h3>
		<a href="<?php echo base_url('admins/product/add') ?>" class="btn btn-primary  pull-right">Create New Product</a>
	</div>
	<div class="tabular_cont">
		<div id="client_table"></div>
	</div>
</div>
<!-- end right contents --> 
<style>.pr-image{width:40px;}.action-img{width:22px;}</style>
<script type="text/javascript" src="<?php echo base_url('template/admin/bootstrap-data-table/bootstrap-datatable.js'); ?>"></script>
<script type="text/javascript">
    $("#client_table").datatable({
        title: '',
        perPage: 10,
        allowTableinfo: false,
        url: '<?php echo base_url('/admins/product/get_all'); ?>',
        showPagination: true,
        showFilter: true,
        showFilterRow: true,
        toggleColumns: false,
        allowOverflow: false,
        columns: [
            {
                title: "Product ID",
                sortable: true,
                field: "product_id",
                filter: false,
            },
			{
                title: "Image",
                sortable: false,
                field: "product_title",
                filter: false,
				callback: function(data, cell) {
					var image = '<img src="'+data['image']+'" alt="'+data['product_title']+'" class="pr-image"/>';
					return image;
				}
            },
            {
                title: "Product",
                sortable: true,
                field: "product_title",
                filter: true,
            },
            {
                title: "Category Name",
                sortable: true,
                field: "category_name",
                filter: true,
            },
			
			{
                title: "Quantity",
                sortable: true,
                field: "quantity",
                filter: false,
            },
			
			
            {
                title: "Status",
                sortable: false,
                filter: false,
                callback: function(data, cell) {
				     if(data['active'] == 1)
					 {
					   var status = "InActive";
					   var class_name = "btn btn-danger";  
					 }
					 else
					 {
					   var status = "Active";
					   var class_name = "btn btn-success";
					 }
                    return '<a class="'+class_name+'" href="<?php echo base_url('/admins/product/update_status') ?>/'+data['product_id']+"/"+data['active']+'" onclick="return confirm_update();">'+status+'</a>';
                }
            },
			
			{
                title: "Actions",
                sortable: false,
                filter: false,
                callback: function(data, cell) {
				     
                    return '<a class="icn-only" href="<?php echo base_url('/admins/product_images/index') ?>/'+data['product_id']+'"><span class="glyphicon glyphicon-picture action-img" style="font-size: 22px;color: gray;"></span></a>'+
						'<a class="icn-only" href="<?php echo base_url('/admins/product/add') ?>/'+data['product_id']+'"><img src="/template/admin/img/edit_icon.png" alt="edit" class="action-img" /></a>'+
                        '<a class="icn-only" href="<?php echo base_url('/admins/product/delete') ?>/'+data['product_id']+'" onclick="return confirm_delete();"><img src="/template/admin/img/icon-delete.png" class="action-img"  alt="Delete"/></i></a>';
                }
            }
        ]
    });
    
    function confirm_delete() {
		return confirm('Are you really want to delete ?');
	}
	function confirm_update() {
		return confirm('Do you really want to change the status?');
	}
	  
</script>

