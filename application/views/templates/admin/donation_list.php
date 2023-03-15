<div id="center-contents">
    <div class="page-header clearfix">
        <h3 class="pull-left">Donation</h3>
        <a href="<?php echo base_url('admins/donations/add') ?>" class="btn btn-primary  pull-right">Create New Donation</a>
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
        url: '<?php echo base_url('/admins/donations/get_all_record'); ?>',
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
                title: "Donation Name",
                sortable: true,
                field: "donation_name",
				filter: true,
				
            },
            {
                title: "Amount",
                sortable: true,
                field: "amount",
                filter: true,
            },
            {
                title: "Benifits",
                sortable: true,
                field: "benifits",
                filter: true,
            },
            {
                title: "Actions",
                sortable: false,
                filter: false,
                callback: function(data, cell) {
                    return '<a class="icn-only" href="<?php echo base_url('/admins/donations/add') ?>/' + data['id'] + '"><img src="/template/admin/img/edit_icon.png" class="action-img" alt="edit"/></a>' +
                            '<a class="btn" href="<?php echo base_url('/admins/donations/delete') ?>/' + data['id'] + '" onclick="return confirm_delete();"><img class="action-img" src="/template/admin/img/icon-delete.png" alt="Delete"/></i></a>';
                }
            }
        ]

    });

    function confirm_delete() {
        return confirm('Are you really want to delete ?');
    }
</script>

<!--<a class="btn icn-only" ></a>-->