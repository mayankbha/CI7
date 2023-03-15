
<div id="center-contents">
	<div class="page-header clearfix">
		<h3 class="pull-left">All Transactions</h3>
		
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
        url: '<?php echo base_url('/admins/transactions/get_all'); ?>',
        showPagination: true,
        showFilter: true,
        showFilterRow: true,
        toggleColumns: false,
        allowOverflow: false,
        columns: [
            {
                title: "ID",
                sortable: true,
                field: "id",
                filter: false,
            },
            {
                title: "Email",
                sortable: true,
                field: "email",
                filter: true,
            },
            {
                title: "Transaction ID",
                sortable: true,
                field: "paypal_txn_id",
                filter: true,
            },
			{
                title: "Purchase Date",
                sortable: true,
                field: "purchased_at",
                filter: true,
            },
            {
                title: "Actions",
                sortable: false,
                filter: false,
                callback: function(data, cell) {
                    return '<a class="btn red icn-only" href="<?php echo base_url('/admins/transactions/delete') ?>/'+data['order_id']+'" onclick="return confirm_delete();"><img src="/template/admin/img/icon-delete.png" alt="Delete"/></i></a>';
                }
            }
        ]
    });
    
    function confirm_delete() {
		return confirm('Are you really want to delete ?');
	}
</script>

