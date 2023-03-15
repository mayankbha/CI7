<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
        $(document).ready(function()
        {
            $("#country").on("change",function(){
                var country_id = $("#country").val();
                $.ajax({
                    type:"POST",
                    url:"<?php echo site_url()?>register/get_state/", //controller url
                    data:"county_id="+country_id,
                    success:function(data)
                    {
                        $('#divState').html(data);
                    } 
                });
            });
           
            $("#divState").on("change",function(){
                var state_id = $("#state").val(); 
                var country_id = $("#country").val();
                $.ajax({
                    type:"POST",
                    url:"<?php echo site_url();?>register/get_city/",
                    data:{state_id:state_id,country_id:country_id},
                    success:function(data)
                    {
                        $('#divCity').html(data);
                    }
                });
            });
           
        });
    </script>

<div class="content-box">
  <section class="container">
  <div class="row">
    <ol class="breadcrumb">
      <li><i class="fa fa-home fa-2x icon-round-border"></i></li>
      <li><a  class="icon_home" href="#"><?php echo $this->lang->line('home'); ?></a></li>
      <li class="active"><span><?php echo $this->lang->line('reg_label');?> <i>(<?php echo $this->lang->line('reg_steps'); ?>)</i></span></li>
    </ol>
  </div>
  <h3 class="page-title txt-red txt-upper"><?php echo $this->lang->line('reg_step'); ?></h3>
  <div class="row">
    <div class="col-sm-4">
      <div class="content-box-border"> <?php echo form_open("/register/", array('id'=>'registration_form', 'class'=>'frm-register form-horizontal'));	?>
        <div class="form-group">
          <label class="col-sm-4 control-label"><?php echo $this->lang->line('reg_first_name'); ?></label>
          <div class="col-sm-8"> <?php echo form_error('first_name') . form_input($first_name); ?> </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label"><?php echo $this->lang->line('reg_last_name'); ?></label>
          <div class="col-sm-8"> <?php echo form_error('last_name') . form_input($last_name); ?> </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label"><?php echo $this->lang->line('reg_password'); ?></label>
          <div class="col-sm-8"> <?php echo form_error('password') . form_input($password); ?> </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label"><?php echo $this->lang->line('reg_confirm_password'); ?></label>
          <div class="col-sm-8"> <?php echo form_error('password_confirm') . form_input($password_confirm);?> </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label"><?php echo $this->lang->line('reg_email'); ?></label>
          <div class="col-sm-8"> <?php echo form_error('email') . form_input($email); ?> </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4"><?php echo $this->lang->line('reg_im_a'); ?></label>
          <div class="col-sm-8"><?php echo form_error('gender'); ?> </div>
          <div class="col-sm-4">
            <label for="radio_1" class="radio-inline"><?php echo form_input($gender2);?> <?php echo $this->lang->line('female'); ?> </label>
          </div>
          <div class="col-sm-4">
            <label for="radio_2" class="radio-inline"> <?php echo form_input($gender);?> <?php echo $this->lang->line('male'); ?> </label>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4"><?php echo $this->lang->line('reg_looking_for'); ?></label>
          <div class="col-sm-4">
            <label for="radio_3" class="radio-inline"> <?php echo form_error('looking_for'); ?> <?php echo form_input($looking_for2); ?><?php echo $this->lang->line('female'); ?> </label>
          </div>
          <div class="col-sm-4">
            <label for="radio_4" class="radio-inline">
              <input type="radio" id="radio_4" name="radio_2">
              <?php echo form_input($looking_for);?> <?php echo $this->lang->line('male'); ?> </label>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label"><?php echo $this->lang->line('reg_birthdate');  ?></label>
          <div class="col-sm-8">
            <div class="input-group"> <?php echo form_error('dob') . form_input($dob);?> <span class="input-group-addon"><i class="fa fa-calendar"></i></span> </div>
          </div>
        </div>
        <div class="form-group">
          <label for="country" class="col-sm-4 control-label"><?php echo $this->lang->line('reg_country'); ?></label>
          <div class="col-sm-8">
          <?php echo form_error('countries'); ?>
            <?php $countries['#'] = 'Select'; ?>
            <?php echo form_dropdown('countries', $countries, '#', 'id="country", class="form-control"'); ?> </div>
        </div>
        <div class="form-group">
          <label for="state" class="col-sm-4 control-label"><?php echo $this->lang->line('reg_state_province'); ?></label>
          <div id="divState" class="col-sm-8">
          <?php echo form_error('state_province'); ?>
            <select class="form-control" name="state_province">
              <option value=""><?php echo $this->lang->line('select_state'); ?></option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="city" class="col-sm-4 control-label"><?php echo $this->lang->line('reg_city'); ?></label>
          <div id="divCity" class="col-sm-8">
            <select class="form-control" name="city">
              <option value=""><?php echo $this->lang->line('select_city'); ?></option>
            </select>
          </div>
        </div>
        <?php /*?><label class="col-sm-4 control-label"><?php echo $this->lang->line('reg_country');?></label>
          <div class="col-sm-8"> 
		  	<?php echo form_dropdown('countries', $countries['options'], $countries['value'], $countries['form_options']);?> 
		  </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label"><?php echo $this->lang->line('reg_state_province');?></label>
          <div class="col-sm-8"> <?php echo form_error('state_province'); ?> <?php echo form_input($state_province);?> </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label"><?php echo $this->lang->line('reg_city');?></label>
          <div class="col-sm-8"> <?php echo form_error('city'); ?> <?php echo form_input($city);?> </div>
        </div><?php */?>
        <div class="form-group">
          <label class="col-sm-11 col-sm-offset-1 checkbox-inline"> <?php echo form_error('terms'); ?> 
		  <?php echo form_input($terms);?> <?php echo $this->lang->line('reg_terms'); ?> 
          <a href="#"><?php echo $this->lang->line('reg_terms_link'); ?></a> 
          </label>
        </div>
        <div class="content-center">
          <button class="btn btn-danger"><?php echo $this->lang->line('continue'); ?></button>
        </div>
        </form>
      </div>
    </div>
    <div class="col-sm-8">
      <div class="content-box-border">
        <h3 class="page-title"><?php echo $this->lang->line('reg_title'); ?></h3>
        <p> <?php echo str_replace("\n", '<br />', $this->lang->line('reg_body')); ?> </p>
      </div>         
    </div>     
  </div>        
</div>   
<!-- End .row -->       
</section>
<!-- End .container -->       
</div>              
<!-- End #content -->  
<style>
.reg-none{ visibility:hidden !important;}
</style>        