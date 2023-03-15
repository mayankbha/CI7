<?php
	foreach($login_user as $value)
	{
		if($users[$value['id']]['invisible_status'] == '0')
		{
			if($users[$value['id']]['block_user'] != $value['id'])
			{
				?>
				<div class="media">
					<?php if($users['donate_user'] == '') { ?>
						<a class="pull-left avatar-sm" href="#JavaScript: void(0);" onClick="$('#donate').click();">
					<?php } else { ?>
						<a class="pull-left avatar-sm" href="/profile/user/<?php echo $value['id']; ?>">
					<?php } ?>
							<img class="media-object" src="/uploads/profile/thumbnail/<?php echo $users[$value['id']]['avatar']; ?>" alt="...">
					</a>

					<div class="media-body">
						<h3 class="media-heading">
							<?php if($users['donate_user'] == '') { ?>
								<a href="#" onClick="$('#donate').click();"><?php echo $value['first_name'].' '. $value['last_name']; ?></a>
							<?php } else { ?>
								<a href="/profile/user/<?php echo $value['id']; ?>"><?php echo $value['first_name'].' '. $value['last_name']; ?></a>
							<?php } ?>
							&nbsp;&nbsp;

							<?php if($users[$value['id']]['busy_status'] != '0') { ?>
								<i class="fa fa-circle txt-red"></i>
							<?php } ?>

							<?php if($users[$value['id']]['available_status'] != '0') { ?>
								<i class="fa fa-circle txt-green"></i>
							<?php } ?>
						</h3>
					</div>
				</div>
				<?php
			}
		}
	}
?>