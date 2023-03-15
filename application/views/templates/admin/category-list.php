
<div id="center-contents">
	<div class="page-header clearfix">
		<h3 class="pull-left">All Categories</h3>
		<a href="<?php echo base_url('admins/productcategory/add') ?>" class="btn btn-primary  pull-right">Create New Category</a>
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
        url: '<?php echo base_url('/admins/productcategory/get_all'); ?>',
        showPagination: true,
        showFilter: true,
        showFilterRow: true,
        toggleColumns: false,
        allowOverflow: false,
        columns: [
            {
                title: "Category ID",
                sortable: true,
                field: "product_cat_id",
                filter: false,
            },
			{
                title: "Image",
                sortable: false,
                field: "category_name",
                filter: false,
				callback: function(data, cell) {
					//cat_image
					var image = '<img src="'+data['cat_image']+'" alt="'+data['category_name']+'" class="pr-image"/>';
					return image;
					return 
				}
            },
            {
                title: "Category",
                sortable: true,
                field: "category_name",
                filter: true,
            },
            {
                title: "Actions",
                sortable: false,
                filter: false,
                callback: function(data, cell) {
                    return '<a class="btn icn-only" href="<?php echo base_url('/admins/productcategory/add') ?>/'+data['product_cat_id']+'"><img src="/template/admin/img/edit_icon.png" alt="edit"/></a>'+
                        '<a class="btn red icn-only" href="<?php echo base_url('/admins/productcategory/delete') ?>/'+data['product_cat_id']+'" onclick="return confirm_delete();"><img src="/template/admin/img/icon-delete.png" alt="Delete"/></i></a>';
                }
            }
        ]
    });
    
    function confirm_delete() {
		return confirm('Are you really want to delete ?');
	}
</script>

