<div id="center-contents">
    <div class="page-header clearfix">
        <h3 class="pull-left">All Members</h3>
        <a href="<?php echo base_url('admins/member/add') ?>" class="btn btn-primary  pull-right">Create New User</a>
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
        url: '<?php echo base_url('/admins/member/get_all_record'); ?>',
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
                title: "Name",
                sortable: true,
                field: "first_name",
                filter: true,
                callback: function(data, cell) {
                    return data['first_name'] + " " + data['last_name'];
                }
            },
            {
                title: "Email",
                sortable: true,
                field: "email",
                filter: true,
            },
            {
                title: "Status",
                sortable: false,
                field: "active",
                filter: false,
                callback: function(data, cell) {
                    res = '';
                    if (data['active'] == 1) {
                        res = '<a href="javascript:void(0);" onclick="return change_user_status(\'' + data['id'] + '\');" class="btn btn-danger btn-sm">Deactivate</a>';
                    } else {
                        res = '<a href="javascript:void(0);" onclick="return change_user_status(\'' + data['id'] + '\');"  class="btn btn-success ">Activate</a>';
                    }
                    return res;
                }
            },
            {
                title: "Actions",
                sortable: false,
                filter: false,
                callback: function(data, cell) {
                    return '<a class="icn-only" href="<?php echo base_url('/admins/member/add') ?>/' + data['id'] + '"><img src="/template/admin/img/edit_icon.png" class="action-img" alt="edit"/></a>';//+
                    //'<a class="btn" href="<?php echo base_url('/admins/member/delete') ?>/' + data['id'] + '" onclick="return confirm_delete();"><img class="action-img" src="/template/admin/img/icon-delete.png" alt="Delete"/></i></a>';
                }
            }
        ]

    });

    function confirm_delete() {
        return confirm('Are you really want to delete ?');
    }

    function change_user_status(id)
    {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('/admins/member/update_status'); ?>',
            data: {user_id: id},
            success: function(res) {
                alert(res.message);
                if (res.status) {
                    window.location.reload();
                }
            }
        });
    }
</script>
<style>.pr-image{ width:40px; }.action-img{ width:22px; }</style>
<!--<a class="btn icn-only" ></a>-->