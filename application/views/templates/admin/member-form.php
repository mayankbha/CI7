<div id="center-contents">
    <div class="page-header clearfix">
        <h3 class="pull-left">Update Member</h3>
    </div>
    <div class="tabular_cont">
        <form action="<?php echo base_url('admins/member/add/' . $userdetail->id) ?>" id="form_sample_1" class="form-horizontal" method="post" role="form" enctype="multipart/form-data">
            <div class="form-group">
                <label class="col-sm-2 control-label">First Name</label>
                <div class="col-sm-5">
                    <?php echo $userdetail->first_name ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Last Name</label>
                <div class="col-sm-5">
                    <?php echo $userdetail->last_name ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Email</label>
                <div class="col-sm-5">
                    <?php echo $userdetail->email ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Groups</label>
                <div class="col-sm-5">
                    <?php echo form_multiselect('group[]', $grouplist, $user_groups, 'class="form-control"'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>