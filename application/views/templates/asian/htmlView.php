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

<div id="wrapper">
  <p id="messagewindow"> <?php echo $html; ?> </p>
  <form id="chatform" action="<?php echo site_url()?>/chat/update" method="post">
    <div id="author"> Name:
      <input type="text" name="name" id="name" />
    </div>
    <br />
    <div id="txt"> Message:
      <input type="text" name="message" id="content" value="" />
    </div>
    <br />
    <input type="hidden" name="action" value="postmsg" />
    <input type="hidden" name="html_redirect" value="true" />
    <input type="submit" value="ok" />
    <br />
  </form>
</div>
