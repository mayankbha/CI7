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
        <li class="active"><span> Message View </span></li>
      </ol>
    </div>
    <!-- /BREADCRUMB/ -->
    <div class="box gray-bg">
      <div class="row">
        <div class="col-sm">
          <div class="content-box-border">
            <h4 class="box-title clearfix bg-red"> <i class="fa fa-search"></i> <span class="txt-upper">Message View</span> </h4>
            <div class="box-ct">
              <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Profile</th>
                    <th>User Name</th>
                    <th>Message</th>
                  </tr>
                </thead>
                <?php 
					foreach($warning_message_list as $member)
					  {
						  ?>
						<tr>
						  <td><?php if($users[$member['id']]['avatar'] == ''){
								?>
							<a class="pull-left avatar-sm" href="/profile/user/<?php echo $member['id']; ?>"><img class="media-object img-circle" src="/resources/img/No_image_available.svg" alt="" width="80" height="80"></a>
							<?php }else{?>
							<a class="pull-left avatar-sm" href="/profile/user/<?php echo $member['id']; ?>"><img class="media-object" src="/uploads/profile/thumbnail/<?php echo $users[$member['id']]['avatar']; ?>"></a>
							<?php } ?></td>
						  <td><?php echo $member['first_name'].' '.$member['last_name']; ?></td>
						  <td><?php echo $member['message']; ?></td>
						</tr>
						<?php }
				?>
              </table>
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