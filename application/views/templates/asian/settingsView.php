<?php
$gender = array('m' => 'Male', 'f' => 'Female');
?>
<!-- MAIN CONTENT -->
<body id="shelf">
<div class="content-box">
  <section class="container">
    <div class="row">
      <ol class="breadcrumb">
        <li><i class="fa fa-user fa-2x icon-round-border"></i></li>
        <li class="active"><span><?php echo $this->lang->line('manage_templates');?></span></li>
      </ol>
    </div>
    <!-- /BREADCRUMB/ -->
    <div class="box gray-bg">
      
      <div class="row">
        <div class="col-sm">
          <div class="content-box-border">
            <h4 class="box-title clearfix bg-red"> <i class="fa fa-search"></i> <span class="txt-upper"><?php echo $this->lang->line('manage_templates')?></span> </h4>
            <div class="box-ct">
              <form action="<?php echo site_url();?>settings/add/" method="post">
                <?php 
					
					$options = isset($all_tempgroup) ? $all_tempgroup : array(0=>'Select');
					
					echo form_dropdown('image_location',$options, set_value('image_location', isset($data['image_location']) ? base_url().'public/'.$data['image_location'] : ''), 'class="form-control" id="group_id" onChange="changeTheme();"');
				
				?><br>

                <input type="submit" name="submit" value="Save" class="btn btn-danger" />
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End .container -->
</div>
<!-- End #content -->

</body>
