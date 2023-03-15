

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" style="font-size:12px;">
	<caption><b>Submitted IDs (approved)</b></caption>
	<thead style="color:#fff;background:#000;">
		<th>Image</th>
		<th>Filename</th>
		<th>Date</th>
	</thead>
	<tbody>
	<?php
	foreach($pending as $pkey=>$pvalue){
	?>
		<tr>
			<td>
				<div style="width:200px;">
					<a class="fancybox"  src="/template/asian/id/<?php echo $pvalue['filename'];?>" href="/admin/approve_image/<?php echo $pvalue['id'];?>" data-width="400" data-fancybox-type="iframe">
						<img src="/template/asian/id/<?php echo $pvalue['filename'];?>" class="img-responsive" alt="Responsive image">
					</a>
				</div>
			</td>
			<td><a class="fancybox"  src="/template/asian/id/<?php echo $pvalue['filename'];?>" href="/admin/approve_image/<?php echo $pvalue['id'];?>" data-width="400" data-fancybox-type="iframe">
			<div><?php echo $pvalue['filename'];?></div>
			</a>
			</td>
			<td><a class="fancybox"  src="/template/asian/id/<?php echo $pvalue['filename'];?>" href="/admin/approve_image/<?php echo $pvalue['id'];?>" data-width="400" data-fancybox-type="iframe">
			<div><?php echo $pvalue['date'];?></div>
			</a>
			</td>

		</tr>
	<?php
	}
	?>
	</tbody>
</table>
</div>

   
