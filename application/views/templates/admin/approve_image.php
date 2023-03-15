<div style="width:390px;">
<form action="/admin/approve_image/<?php echo $image[0]['id'];?>" method="post">
<center>
<?php

if($image[0]['approved']==0){

?>
<button>Approve</button>
<?php
} else {
?>
Approved
<?php
}
?>

<img style="margin-top:10px;" src="/template/asian/id/<?php echo $image[0]['filename'];?>" class="img-responsive" alt="Responsive image">



<input type="hidden" name="approved">

</form>
</center>
</div>