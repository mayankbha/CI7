<?php $id = isset($data['id']) ? $data['id'] : '' ?>
<div id="center-contents">
    <div class="page-header clearfix">
        <h3 class="pull-left"><?php echo isset($page_head) ?  $page_head : 'Donation Popup Setting'?></h3>
    </div>
    <div class="tabular_cont">
        <?php
        $error_message = ($this->session->flashdata('message')) ? $this->session->flashdata('message') : validation_errors();
        if ($error_message != "") {
            ?>
            <div class="alert alert-error">
                <button class="close" data-dismiss="alert"></button>
                <?php echo $error_message ?>
            </div>
            <?php
        } //if ends 
        ?>

        <form action="<?php echo base_url('admins/settings/popup_time' . $id) ?>" id="form_sample_1" class="form-horizontal" method="post" role="form">
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Time <span class="required">*</span></label>
                <div class="col-sm-5">
                    <input name="timer" type="text" class="form-control" value="<?php echo set_value('timer', isset($popup_time) ? $popup_time : '') ?>"/>
                    <span class="help-block">Please add value in Seconds</span>
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
<!-- end right contents --> 
