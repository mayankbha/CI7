<center>
<div style="margin:40px;margin-top:10px;width:400px;text-align:left;">
<h1>Demo File Upload</h1>
<?php 
if(isset($error)){
	echo $error;
}
?>
<?php echo form_open_multipart('/demo/upload_id');?>


<input id="imgInp" type="file" name="userfile" size="20" />
<br>
<div style="padding:5px;width:100px;height:100px;overflow:hidden">
<img id="blah" src="#" alt="your image" />
</div>
<br>
<input type="submit" value="upload" />

</form>
</div>
</center>