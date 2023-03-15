<div id="center-contents">
  <div class="page-header clearfix">
    <h3 class="pull-left"> All Template Data </h3>
    <a href="<?php echo base_url('admins/template_data/add') ?>" class="btn btn-primary  pull-right">Create Template Data</a> </div>
  <div class="tabular_cont">
    <div id="client_table"></div>
  </div>
</div>
<!-- end right contents -->
<script type="text/javascript" src="<?php echo base_url('template/admin/bootstrap-data-table/bootstrap-datatable.js'); ?>"></script>
<script type="text/javascript">
    $("#client_table").datatable({
        title: '',
        perPage: 10,
        allowTableinfo: false,
        url: '<?php echo base_url('/admins/template_data/get_all'); ?>', 
        showPagination: true,
        showFilter: true,
        showFilterRow: true,
        toggleColumns: false,
        allowOverflow: false,
        columns: [
            {
                title: "Template Name",
                sortable: true,
                field: "id",
                filter: false,
				callback: function(data,cell){
					var name = data['name'];
					return name;
				}
            },
			{ 
                title: "Image", 
                sortable: false, 
                field: "group_id", 
                filter: false, 
				callback: function(data, cell) {
					//image_location          
					var image = '<img src="'+data['image_location']+'" alt="'+data['group_id']+'" class="pr-image"/>'; 
					return image; 
					return  
				}
            },
            {
                title: "Section" ,
                sortable: true,
                field: "section",
                filter: true,
            },
            {
                title: "Actions",
                sortable: false,
                filter: false,
                callback: function(data, cell)
				{
                    return '<a class="btn icn-only" href="<?php echo base_url('/admins/template_data/add') ?>/'+data['id']+'"><img src="/template/admin/img/edit_icon.png" alt="edit"/></a>'+
                        '<a class="btn red icn-only" href="<?php echo base_url('/admins/template_data/delete') ?>/'+data['id']+'" onclick="return confirm_delete();"><img src="/template/admin/img/icon-delete.png" alt="Delete"/></i></a>';
                }
            }
        ]
    });
	
    function confirm_delete() {
		return confirm('Are you really want to delete ?'); 
	}
</script>
<style>
.pr-image{width:40px;}.action-img{width:22px;}
</style>
