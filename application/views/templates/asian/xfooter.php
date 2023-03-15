    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <ul class="footer-links">
                        <li><a href="#"><?php echo $this->lang->line('about_us');?> </a></li>
                        <li><a href="#"><?php echo $this->lang->line('privacy_terms');?> </a></li>
                        <li><a href="#"><?php echo $this->lang->line('faq');?> </a></li>
                        <li><a href="#"><?php echo $this->lang->line('invite_a_friend');?> </a></li>
                        <li><a href="#"><?php echo $this->lang->line('contact_us');?>  </a></li>
                        <li><a href="#"><?php echo $this->lang->line('bookmark');?> </a></li>
                        <li><a href="#"><?php echo $this->lang->line('language');?> </a></li>
                    </ul>
                </div>
                <div class="col-sm-4">
                    <div class="copyright">
                        <p><?php echo $this->lang->line('copyright');?></p>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- End #footer -->
    <div class="modal fade" id="modal-login">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>  
            <h4 class="txt-red txt-upper"><i class="fa fa-user"></i> <span>Member Login</span></h4>
          </div>
          <div class="modal-body">
            <form class="frm-login form-horizontal" action="/auth/login" method="post">
                <div class="form-group">
                    <label class="col-sm-2 control-label col-sm-offset-2">Username</label>
                    <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder="Username " required></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label col-sm-offset-2">Password</label>
                    <div class="col-sm-6">
                    <input type="password" class="form-control" placeholder="Password " required></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 col-sm-offset-2 checkbox-inline">
                        <input type="checkbox">
                        Remember me
                    </label>
                    <div class="col-sm-4">
                        <input type="submit" class="btn btn-lg btn-danger pull-right" value="login">
                    </div>
                </div></form>
          </div>
          <div class="modal-footer">
                <p class="txt-center">You haven’t any account? <a href="#">Creat account now</a> 
                - Or <a href="#">get password</a> if you lose</p>
          </div>
        </div>
      </div>
    </div>
	<div id="dictionary">test</div>
	<div class="letters">
		<div class="letter" id="letter-f">
			<h3><a href="#">F</a></h3>
			<form action="/ajax">
				<input type="hidden" name="xxx" value="sumpansampi" id="xxx">
				<input type="submit" name="search" value="search" id="search">
				
			</form>	
		</div>
		
	</div>
						<?php
						if(@isset($logged)){
						?>
	<div class="page-social">
        <ul>
            <li><a href="social.html" class="bg-blue-plain" title="Social" data-placement="right"><i class="fa fa-group"></i></a></li>
            <li><a href="forum.html" class="bg-orange-plain" title="Forum" data-placement="right"><i class="fa fa-comments"></i></a></li>
            <li><a href="profile-member.html" class="bg-pink-plain" title="Dating" data-placement="right"><i class="fa fa-heart"></i></a></li>
        </ul>
    </div>
						<?php
						}
						?>	


    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="resources/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="resources/js/datepicker.js"></script>
    <script type="text/javascript" src="resources/js/ion.rangeSlider.min.js"></script>
    <script type="text/javascript" src="resources/js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="resources/js/ckeditor.js"></script>
    <script type="text/javascript" src="resources/js/adapters/jquery.js"></script>
    <script type="text/javascript" src="resources/js/main.js"></script>	
	
	
	
    <script type="text/javascript">
        
		$(document).ready(function(){
			 $('#upload-save').click(
				function(event){
					event.preventDefault();
					alert($('input[name="xxx"]').val());
					$.post('/ajax', {'term': $('input[name="upload-image"]').val(), 'terms': $('input[name="search"]').val()},
						function(data) {
							$('#dictionary').html(data);
						});
					//var requestData = {
						//term: $(this).text()
						//};
					
					//$('#dictionary').load('/ajax', requestData);
					//$.post('/ajax', requestData, function(data){
					//	$('#dictionary').html(data);
					//});
					//$('#dictionary').load('/ajax/');
					//alert('loaded');
					//return false;
				}
			 );		
			$( '.editor-ck' ).ckeditor();
			function readURL(input) {

				if (input.files && input.files[0]) {
					var reader = new FileReader();

					reader.onload = function (e) {
						$('#blah').attr('src', e.target.result);
					}

					reader.readAsDataURL(input.files[0]);
				}
			}
			$("#imgInp").change(function(){
				readURL(this);
			});

			$('#datepicker').datepicker();
			 $( '.editor-ck' ).ckeditor();
			 

        });
    </script>

  </body>
</html>