<script type="text/javascript" src="<?php echo base_url()?>public/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript">
		$(document).ready(function(){
			loadMsg();			
			hideLoading();
			$("form#chatform").submit(function(){
				$.post("<?php echo site_url();?>/chat/update",{
							message: $("#content").val(),
							name: $("#name").val(),
							action: "postmsg"
						}, function() {
					
					$("#messagewindow").prepend("<b>"+$("#name").val()+"</b>: "+$("#content").val()+"<br />");
					$("#content").val(""); 					
					$("#content").focus(); 
				});		
				return false; 
			});
		});

		function showLoading(){
			$("#contentLoading").show(); 
			$("#txt").hide(); 
			$("#author").hide(); 
		}
		function hideLoading(){ 
			$("#contentLoading").hide(); 
			$("#txt").show(); 
			$("#author").show(); 
		}
		
		function loadMsg() {
			$.get("<?php echo site_url();?>/chat/backend", function(xml) {
				$("#loading").remove();				
				addMessages(xml);
			});
			//setTimeout('loadMsg()', 4000);
		}

		function addMessages(xml) {
			
			$(xml).find('message').each(function() { 
				author = $(this).find("author").text(); 
				msg = $(this).find("text").text(); 
				$("#messagewindow").append("<b>"+author+"</b>: "+msg+"<br />");
			});
			
		}
	</script>
<style type="text/css">
#messagewindow {
	height: 250px;
	border: 1px solid;
	padding: 5px;
	overflow: auto;
}
#wrapper {
	margin: auto;
	width: 438px;
}
</style>
<div id="wrapper"> </div>
<div class="content-box">
  <section class="container">
    <div class="row">
      <ol class="breadcrumb">
        <li><i class="fa fa-user fa-2x icon-round-border"></i></li>
        <li class="active"><span>Chat</span></li>
      </ol>
    </div>
    <!-- /BREADCRUMB/ -->
    <div class="box gray-bg">
      <div class="row">
        <div class="messageload">
          <div class="content-box-border">
            <h4 class="box-title clearfix bg-red"> <i class="fa fa-search"></i> <span class="txt-upper">Chat</span> </h4>
            <p id="messagewindow" class="messageload"><span id="loading">Loading...</span></p>
            <form id="chatform">
              <div id="author"> Name:
                <input type="text" id="name" value="<?php echo $this->session->userdata['first_name']?>" readonly />
              </div>
              <br />
              <div id="txt"> Message:
                <input type="text" name="content" id="content" value="" />
              </div>
              <div id="contentLoading" class="contentLoading"> <img src="<?php echo base_url();?>/public/images/blueloading.gif" alt="Loading data, please wait..."> </div>
              <br />
              <input type="submit" value="Send" />
              <br />
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End .container -->
</div>
<?php /*?><?php
  $bg = array('http://dumpflings.local/chat/uploads/templates/1_defaultsection_201416.jpg', 'bg-02.jpg', 'bg-03.jpg', 'bg-04.jpg', 'bg-05.jpg', 'bg-06.jpg', 'bg-07.jpg' ); // array of filenames

  $i = rand(0, count($bg)-1); // generate random number size of the array
  $selectedBg = "$bg[$i]"; // set variable equal to which random filename was chosen
?>
<style type="text/css">
<!--
body{
background: url(<?php echo site_url()?>uploads/templates/<?php echo $selectedBg; ?>) no-repeat;
}
-->
</style><?php */?>




<!--  https://www.youtube.com/watch?v=AH_wdJ3Gxmo

http://stackoverflow.com/questions/2019802/dynamic-background-images-advice
function dealer(){
	if($('#role_name').val() == 3)
	{
		$('#dealer').show();
		}
		else{
				$('#dealer').hide();
			}
	}
$(document).ready(function() {
    if($('#role_name').val() == 3)
	{
		$('#dealer').show();
		}
		else{
				$('#dealer').hide();
			}
	});
    
    <select name="role_name" onchange="dealer();" id="role_name">
            <option>Select</option>
            <?php  if($role_name) :   ?>
            <?php  foreach($role_name as $r) :   ?>
            <option value="<?php echo $r->id; ?>" id="<?php echo $r->role_name; ?>" <?php if(isset($user->user_type) && $user->user_type==$r->id) {   ?>  selected="selected" <?php }  ?> ><?php echo $r->role_name; ?></option>
            <?php  endforeach;  ?>
            <?php  endif;  ?>
          </select>

-->






<!--<script type="text/javascript">
setInterval(function() {
    $(".messageload").load(location.href+" .messageload>*","");
}, 2000);
</script>-->


