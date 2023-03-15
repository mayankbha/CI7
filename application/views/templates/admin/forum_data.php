<div id="center-contents">
	<div class="page-header clearfix">
		<h3 class="pull-left">Forum Data</h3>
		<a href="<?php  echo base_url('admins/forums/add') ?>" class="btn btn-primary  pull-right">Create New Forum</a>
	</div>
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
        url: '<?php echo base_url('/admins/forums/get_all'); ?>',
        showPagination: true,
        showFilter: true,
        showFilterRow: true,
        toggleColumns: false,
        allowOverflow: false,
        columns: [
            /*{
                title: "ID",
                sortable: true,
                field: "id",
                filter: false,
            },*/
            {
                title: "Name",
                sortable: true,
                field: "name",
                filter: true,
            },
            {
                title: "Description",
                sortable: true,
                field: "description",
                filter: true,
            },
            {
                title: "Forum Group",
                sortable: true,
                field: "forum_group",
                filter: true,
				callback: function(data, cell)
				{
					var name = data['name'];
					return name;
				}
            },
            {
                title: "Color",
                sortable: false,
                field: "color",
                filter: false,
            },
			{
                title: "Status",
                sortable: false,
                filter: false,
                callback: function(data, cell) {
				
				     if(data['active'] == 1)
					 {
					   var status = "In-Active";
					   var class_name = "btn btn-danger";  
					 }
					 else
					 {
					   var status = "Active";
					   var class_name = "btn btn-success";
					 }
                    return '<a class="'+class_name+'" href="<?php echo base_url('/admins/forums/update_status') ?>/'+data['id']+"/"+data['active']+'" onclick="return confirm_update();">'+status+'</a>';
                }
            },
            {
                title: "Actions",
                sortable: false,
                filter: false,
                callback: function(data, cell) {
                    return '<a class="icn-only" href="<?php echo base_url('/admins/forums/add') ?>/'+data['id']+'"><img src="/template/admin/img/edit_icon.png" class="action-img" alt="edit"/></a>'+
                        '<a class="btn" href="<?php echo base_url('/admins/forums/delete') ?>/'+data['id']+'" onclick="return confirm_delete();"><img class="action-img" src="/template/admin/img/icon-delete.png" alt="Delete"/></i></a>';
                } 
            }
        ]
		
    });
    
    function confirm_delete() {
		return confirm('Are you really want to delete ?');
	}
</script>
<style>
.pr-image
{
	width:40px;
}
.action-img
{	
	width:22px;
}
</style>

<!--<a class="btn icn-only"></a>-->