<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script> 
    var time = 0;
  
    var updateTime = function (cb) {
      $.getJSON("index.php/chat/time", function (data) {
          cb(~~data);
      });
    };
    
    var sendChat = function (message, cb) {
      $.getJSON("index.php/chat/insert_chat?message=" + message, function (data){
        cb();
      });
    }
    
    var addDataToReceived = function (arrayOfData) {
      arrayOfData.forEach(function (data) {
        $("#received").val($("#received").val() + "\n" + data[0]);
      });
    }
    
    var getNewChats = function () {
      $.getJSON("index.php/chat/get_chats?time=" + time, function (data){
        addDataToReceived(data);
        // reset scroll height
        setTimeout(function(){
           $('#received').scrollTop($('#received')[0].scrollHeight);
        }, 0);
        time = data[data.length-1][1];
      });      
    }
    // using JQUERY's ready method to know when all dom elements are rendered
    $( document ).ready ( function () {
      // set an on click on the button
      $("form").submit(function (evt) {
        evt.preventDefault();
        var data = $("#text").val();
		
        $("#text").val('');
        
		
		// get the time if clicked via a ajax get queury
        sendChat(data, function (){
          alert("dane");
        });
      });
      setInterval(function (){
        getNewChats(0);
      },1500);
    });
    
  </script>
<?php
$gender = array('m' => 'Male', 'f' => 'Female');
?>
<!-- MAIN CONTENT -->

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
        <div class="col-sm">
          <div class="content-box-border">
            <h4 class="box-title clearfix bg-red"> <i class="fa fa-search"></i> <span class="txt-upper">Chat</span> </h4>
            <div class="box-ct">
              <textarea id="received" rows="10" cols="50"></textarea>
              <form class="form-horizontal">
                <input id="text" type="text" name="user">
                <input type="submit" value="Send">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End .container -->
</div>
<!-- End #content  -->
