dasdas
<script src="<?php echo base_url('/assets/jquery.min.js') ?>"></script>
<script type="text/javascript">
	var SITE_URL = '<?php echo site_url() ?>';
            //var TO_USER = 2;
</script>
<script type="text/javascript" src="<?php echo base_url('/assets/chat.js') ?>"></script>
<style type="text/css">
#chat-box {
	border: 1px solid #CCC;
	width: 400px;
	height: 200px;
	margin: 0 0 10px 0;
	overflow-y: scroll;
}
.from-msg {
	float: right;
	text-align: right;
	margin-right: 2px;
}
.to-msg {
	float: left;
	text-align: left;
	margin-left:2px;
}
.clear {
	clear: both;
}
.chat-msg {
	max-width: 50%;
	border: 1px solid #eee;
	padding:2px;
	margin-top: 1px;
}
.text-box {
	font-size: larger;
	font-weight: bold;
	height: 40px;
	padding-left: 10px;
	width: 330px;
}
#right {
	width: 40%;
	float: left;
}
.datas {
	width: 40%;
	float: left;
	border: 1px solid #EEE;
	padding: 5px;
	margin-left: 20px;
}
.user-list {
 height:350px;
 overflow:auto;
}
</style>
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
          <div class="content-box-border col-sm-6">
            <h4 class="box-title clearfix bg-red"> <i class="fa fa-search"></i> <span class="txt-upper">Welcome <?php echo $user->first_name . ' ' .$user->last_name; ?></span> </h4>
            <div id="chat-box"></div>
            <div>
              <form onSubmit="return false;">
                <input id="to_user" type="hidden" value=""/>
                <input id="message" type="text" name="message" class="text-box">
                <input type="submit" value="Send" id="messagebtn" class="btn btn-danger" onClick="send_chat('message')">
              </form>
            </div>
          </div>
          <div class="datas user-list col-sm-5">
            <h4 class="box-title clearfix"> <i class="fa fa-user"></i> <span class="txt-upper">User List</span> </h4>
            <div id="users-box"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End .container -->
</div>
