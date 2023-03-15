
<div id="center-contents">
	<div class="page-header clearfix">
		<h3 class="pull-left">Tax Rates</h3>
		<a href="<?php echo base_url('admins/tax/add') ?>" class="btn btn-primary  pull-right">Add New</a>
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
        url: '<?php echo base_url('/admins/tax/get_all'); ?>',
        showPagination: true,
        showFilter: true,
        showFilterRow: true,
        toggleColumns: false,
        allowOverflow: false,
        columns: [
            {
                title: "Tax ID",
                sortable: true,
                field: "tax_id",
                filter: false,
            },
            {
                title: "Country Name",
                sortable: true,
                field: "country_name",
                filter: true,
            },
            {
                title: "Tax (%)",
                sortable: true,
                field: "tax_rate",
                filter: true,
            },
            {
                title: "Actions",
                sortable: false,
                filter: false,
                callback: function(data, cell) {
                    return '<a class="btn icn-only" href="<?php echo base_url('/admins/tax/add') ?>/'+data['tax_id']+'"><img src="/template/admin/img/edit_icon.png" alt="edit"/></a>'+
                        '<a class="btn red icn-only" href="<?php echo base_url('/admins/tax/delete') ?>/'+data['tax_id']+'" onclick="return confirm_delete();"><img src="/template/admin/img/icon-delete.png" alt="Delete"/></i></a>';
                }
            }
        ]
    });
    
    function confirm_delete() {
		return confirm('Are you really want to delete ?');
	}
</script>

