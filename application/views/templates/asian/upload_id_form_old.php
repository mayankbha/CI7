<script>

</script>
<center>
<div style="margin:40px;margin-top:10px;width:400px;text-align:left;">
<h1>Demo File Upload</h1>
<?php 
if(isset($error)){
	echo $error;
}
?>
<?php echo form_open_multipart('/demo/upload_id');?>

<img id="previewHolder">
<input type="file" name="userfile" size="20" />

<br /><br />

<input type="submit" value="upload" />

</form>
</div>
</center>