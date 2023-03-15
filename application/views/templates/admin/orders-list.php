
<div id="center-contents">
	<div class="page-header clearfix">
		<h3 class="pull-left">All Orders</h3>
		
	</div>
	<div class="tabular_cont">
		<div id="client_table"></div>
	</div>
</div>
<!-- end right contents --> 
<?php //echo "<pre>"; print_r($data); ?>
<script type="text/javascript" src="<?php echo base_url('template/admin/bootstrap-data-table/bootstrap-datatable.js'); ?>"></script>
<script type="text/javascript">
    $("#client_table").datatable({
        title: '',
        perPage: 10,
        allowTableinfo: false,
        url: '<?php echo base_url('/admins/orders/get_all'); ?>',
        showPagination: true,
        showFilter: true,
        showFilterRow: true,
        toggleColumns: false,
        allowOverflow: false,
        columns: [
            {
                title: "Order ID",
                sortable: true,
                field: "order_id",
                filter: false,
            },
			{
                title: "Client Name",
                sortable: true,
				field: "b_first_name", //+"b_last_name",
                filter: false,
				callback: function(data, cell) {
					return '<a href="#'+data['user_id']+'">' + data['b_first_name'] +'&nbsp;'+ data['b_last_name'] + '</a>';
				}
		 	},
			/*
			{
                title: "Product Name",
                sortable: true,
                field: "product_title",
                filter: false,
            },
			
			 {
                title: "Quantity",
                sortable: true,
                field: "quantity",
                filter: false,
            },
            {
                title: "Unit Price",
                sortable: true,
                field: "unit_price",
                filter: false,
            },*/
			{
                title: "Payment Type",
                sortable: true,
                field: "paypal_txn_id",
                filter: false,
				callback: function(data, cell) {
					var temp = parseInt(data['pay_type']);
					switch(temp){
						case 1:
							pay_type = 'Paypal';
							break;
						case 2:
							pay_type = 'Credit Card';
							break;
						default:
							pay_type = 'N/A';
					}
					return pay_type;
				}
            },
			{
                title: "Transaction Id",
                sortable: true,
                field: "paypal_txn_id",
                filter: false,
            },
			{
                title: "Total",
                sortable: true,
                field: "total_amount",
                filter: false,
            },
			{
                title: "Purchasing Date",
                sortable: true,
                field: "created_date",
                filter: true,
            },
			{
                title: "Actions",
                sortable: false,
                filter: false,
				callback: function(data, cell) {
				     
                    return '<a class="icn-only" href="<?php echo base_url('/admins/orders/get_details') ?>/'+data['order_id']+'"><span class="glyphicon glyphicon-search col-md-4" style="font-size: 22px;color: gray;padding: 0;"></span></a>'+
                        '<a class="icn-only" href="<?php echo base_url('/admins/orders/delete') ?>/'+data['order_id']+'" onclick="return confirm_delete();"><span class="glyphicon glyphicon-trash" style="font-size: 22px;color: gray;"></span></i></a>';
                }
            }
        ]
    });
    
    function confirm_delete() {
		return confirm('Are you really want to delete ?');
	}
</script>

