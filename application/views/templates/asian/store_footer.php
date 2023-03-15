    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <ul class="footer-links">
                        <li><a href="#"><?php echo $this->lang->line('about_us');?> </a></li>
                        <li><a href="#"><?php echo $this->lang->line('privacy_terms');?> </a></li>
                        <li><a href="#"><?php echo $this->lang->line('faq');?> </a></li>
                        <li><a href="#"><?php echo $this->lang->line('invite_a_friend');?> </a></li>
                        <li><a href="#"><?php echo $this->lang->line('contact_us');?> </a></li>
                        <li><a href="#"><?php echo $this->lang->line('bookmark');?> </a></li>
                        <li><a href="#"><?php echo $this->lang->line('language_en');?> </a></li>
                    </ul>
                </div>
                <div class="col-sm-4">
                    <div class="copyright">
                        <p><? echo $this->lang->line('copyright');?></p>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- End #footer -->
	<div id="dictionary"></div>
    <div class="modal fade" id="modal-login">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>  
            <h4 class="txt-red txt-upper"><i class="fa fa-user"></i> <span><? echo $this->lang->line('member_login')?></span></h4>
          </div>
          <div class="modal-body">
            <form action="/auth/login" method="post" class="frm-login form-horizontal">
                <div class="form-group">
                    <label class="col-sm-2 control-label col-sm-offset-2"><? echo $this->lang->line('username');?></label>
                    <div class="col-sm-6">
                    <input type="text" name="identity" class="form-control" placeholder="Username " required></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label col-sm-offset-2"><? echo $this->lang->line('password');?></label>
                    <div class="col-sm-6">
                    <input type="password" name="password" class="form-control" placeholder="Password " required></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 col-sm-offset-2 checkbox-inline">
                        <input type="checkbox">
                         <?php echo $this->lang->line('remember_me');?>
                    </label>
                    <div class="col-sm-4">
                        <input type="submit" class="btn btn-lg btn-danger pull-right" value="login">
                    </div>
                </div></form>
          </div>
          <div class="modal-footer">
                <p class="txt-center">
				<? echo $this->lang->line('not_have_an_account');?> 
                	<a href="#"><? echo $this->lang->line('create_acc');?></a> 
				<?=$this->lang->line('or');?> 
                	<a href="#"><?=$this->lang->line('get_password')?></a> 
				<?=$this->lang->line('if_you_lose');?></p>
          </div>
        </div>
      </div>
    </div>

<!-- Modal Upload -->
    <div class="modal fade" id="modal-upload">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>  
            <h4 class="txt-red txt-upper"><i class="glyphicon glyphicon-upload"></i> <span><?=$this->lang->line('Upload')?></span></h4>
          </div>
          <div class="modal-body">
            <form id="fileupload" action="#" method="POST" enctype="multipart/form-data">
                <noscript><input type="hidden" name="redirect" value="#"></noscript>
                <div class="row fileupload-buttonbar">
                    <div class="fileupload-btns">
                        <span class="btn btn-blue btn-xs fileinput-button">
                            <i class="fa fa-plus"></i> <?=$this->lang->line('Select')?>
                            <input type="file" name="files[]" multiple>
                        </span>
                        <div class="btn-group btn-group-xs">
                            <button type="submit" class="btn btn-default btn-xs start">
                                <i class="glyphicon glyphicon-upload"></i> <?=$this->lang->line('Upload');?>
                            </button>
                            <button type="reset" class="btn btn-default btn-xs cancel">
                                <i class="glyphicon glyphicon-ban-circle"></i> <? echo $this->lang->line('Cancel');?>
                            </button>
                        </div>

                        <button type="button" title="Delete" class="btn btn-warning btn-xs delete">
                            <i class="glyphicon glyphicon-trash"></i>
                        </button>
                        <input type="checkbox" class="toggle">
                        <span class="fileupload-process"></span>
                    </div>
                    <div class="fileupload-progress fade">
                        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                        </div>
                        <div class="progress-extended">&nbsp;</div>
                    </div>
                </div>
                <div class="fileupload-data-list">
                    <table role="presentation" class="table table-bordered table-upload"><tbody class="files"></tbody></table>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>


<!-- /Chatbox/ -->
    <div class="page-social">
        <ul>
            <!--<li><a href="social.html" class="bg-blue-plain" title="Social" data-placement="right"><i class="fa fa-group"></i></a></li>-->
            <li><a href="forum.html" class="bg-orange-plain" title="Forum" data-placement="right"><i class="fa fa-comments"></i></a></li>
            <li><a href="profile-member.html" class="bg-pink-plain" title="Dating" data-placement="right"><i class="fa fa-heart"></i></a></li>
        </ul>
    </div>

<!-- / Upload Script / -->
    <script src="/template/main/jquery-1.10.2.min.js"></script>
	<script src="/template/main/jquery.min.js"></script>
    <script type="text/javascript" src="/template/asian/resources/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/template/asian/resources/js/datepicker.js"></script>
    <script type="text/javascript" src="/template/asian/resources/js/ion.rangeSlider.min.js"></script>
    <script type="text/javascript" src="/template/asian/resources/js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="/template/asian/resources/js/ckeditor.js"></script>
    <script type="text/javascript" src="/template/asian/resources/js/adapters/jquery.js"></script>
	<script type="text/javascript" src="/template/asian/resources/js/jquery.toastmessage.js"></script>
    <script type="text/javascript" src="/template/asian/resources/js/main.js"></script>
    <script type="text/javascript" src="/template/asian/resources/js/cart.js"></script>
  
    <script type="text/javascript">
		$(document).ready(function(){
			 <?php
			 if(isset($questions_jquery)){
			 ?>		
			 $('#questions_save').click(
				function(event){
						event.preventDefault();
						$.post('/ajax', {
							<?php 
							echo $questions_jquery;
							?>
							'save': $("#questions_save").val(),
						
						},
						function(data) {
							$('#dictionary').html(data);
						});
						$().toastmessage('showNoticeToast', 'Data was saved.');
				}
			 );
			<?php
			}
			?>
			 $('#match_save').click(
				function(event){
						event.preventDefault();
						$.post('/ajax', {
							'im_seeking_a': $("#match_im_seeking_a").val(), 
							'age_between': $("#match_age-slider").val(),
							'living_in': $("#match_living_in").val(),
							'living_in2': $("#match_living_in2").val(),
							'with_in': $("#match_with_in").val(),
							'distance': $("#match_distance").val(),
							'lifestyle': $("input:radio[name=match_lifestyle]:checked").val(),
							'nationality': $("#match_nationality").val(),
							'education': $( "#match_education" ).val(),
							'english_ability': $("#match_english_ability").val(),
							'height': $("#match_height-slider").val(),
							'weight': $("#match_weight-slider").val(),
							'body_type': $('input[name=match_body_type]:checked').val(),
							'ethnicity': $("#match_ethnicity").val(),
							'vietnamese_ability': $("#match_vietnamese_ability").val(),
							'save': $("#form_match_save").val(),
						
						},
						function(data) {
							$('#dictionary').html(data);
						});
						$().toastmessage('showNoticeToast', 'Data was saved.');
				}
			 );
			 $('#edit_profile_save').click(
				function(event){
						event.preventDefault();
						$.post('/ajax', {
							'hair_color': $("#reg_hair_color").val(), 
							'eye_color': $("#reg_eye_color").val(), 
							'height': $("#reg-height-slider").val(), 
							'weight': $("#reg-weight-slider").val(), 
							'body_type': $("#reg_body_type").val(),
							'ethnicity': $("#reg_ethnicity").val(), 
							'appearance': $("#reg_appearance").val(), 							
							'drink': $("#reg_drink").val(), 
							'smoke': $("#reg_smoke").val(), 
							'marital_status': $("#reg_marital_status").val(), 
							'have_children': $("#reg_have_children").val(), 
							'occupation': $("#reg_occupation").val(), 
							'want_more_children': $("#reg_want_more_children").val(), 
							'willing_to_relocate': $("#reg_willing_to_relocate").val(), 
							'relationship_your_looking_for': $("input:radio[name=reg_relationship_your_looking_for]:checked").val(),
							'nationality': $("#reg_nationality").val(), 
							'education': $("#reg_education").val(), 
							'english_ability': $("#reg_english_ability").val(), 
							'vietnamese_ability': $("#reg_vietnamese_ability").val(), 
							'religion': $("#reg_religion").val(), 
							'chinese_sign': $("#reg_chinese_sign").val(), 
							'star_sign': $("#reg_star_sign").val(), 
							'profile_head': $("#reg_profile_head").val(), 
							'about_yourself': $("#reg_about_yourself").val(), 
							'looking_for_in_partner': $("#reg_looking_for_in_partner").val(),							
							'save': $("#form_edit_profile_save").val(),
						
						},
						function(data) {
							$('#dictionary').html(data);
						});
						$().toastmessage('showNoticeToast', 'Data was saved.');
				}
			 );
			 <?php
			 if(isset($hobbies_jquery)){
			 ?>
			 $('#hobbies_save').click(
				function(event){
						event.preventDefault();
						var hobbies_checked = $('input[name="what_do_you_do_for_fun"]:checked').map(function() {
							return this.value;
						}).get();	
						var food_checked = $('input[name="what_sort_of_food_do_you_like"]:checked').map(function() {
							return this.value;
						}).get();						
						$.post('/ajax', {
							'save': $("#hobbies_save").val(),
							'hobbies': hobbies_checked,
							'food': food_checked,
						
						},
						function(data) {
							$('#dictionary').html(data);
						});
						$().toastmessage('showNoticeToast', 'Data was saved.');
				}
			 );	
			 <?php
			 }
			 ?>	
			
			///////////////////////////// personality //////////////////////////
			<?php
			 if(isset($save_personality)){
			 //echo "hellloooo";
			 ?>
			  $('#save_personality').click(
			 	function(event){
						event.preventDefault();
						$.post('/ajax', {
							'fav_movie': $("#fav_movie").val(), 
							'fav_book': $("#fav_book").val(), 
							'food_you_like': $("#food_you_like").val(), 
							'music_you_like': $("#music_you_like").val(), 
							'your_hobies': $("#your_hobies").val(),
							'describe_your_dress': $("#describe_your_dress").val(), 
							'describe_your_sense': $("#describe_your_sense").val(), 							
							'describe_your_personality': $("#describe_your_personality").val(), 
							'you_travelled': $("#you_travelled").val(), 
							'adaptive_are_you': $("#adaptive_are_you").val(), 
							'save': $("#save_personality").val(),
						
						},
						function(data) {
							$('#dictionary').html(data);
						});
						$().toastmessage('showNoticeToast', 'Data was saved.');
				}
			 );
			 <?php
			 }
			 ?>	
			
			
			///////////////////////////// end personality //////////////////////
			
			
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
			<?php
			if(isset($match['age_between_array'])&&is_array($match['age_between_array'])){
			?>
			$("#match_age-slider").ionRangeSlider({
				from: <?php echo $match['age_between_array'][0];?>,                    
				to: <?php echo $match['age_between_array'][1];?>,                     
				type: "double",              
				step: 1,
				hideMinMax: true,                      
				postfix: ""
			});	
			<?php
			}
			if(isset($age_between_array)&&is_array($age_between_array)){
			?>
			$("#age-slider").ionRangeSlider({
				from: <?php echo $age_between_array[0];?>,                    
				to: <?php echo $age_between_array[1];?>,                     
				type: "double",              
				step: 1,
				hideMinMax: true,                      
				postfix: ""
			});	
			<?php
			}			
			if(isset($reg_height)){
			?>
			$("#reg-height-slider").ionRangeSlider({
				type: "single",
				step: 1,
				postfix: " cm",
				from: <?php echo $reg_height;?>,
				hideMinMax: true,
				hideFromTo: false
			});
			<?php
			}
			if(isset($reg_weight)){
			?>
			$("#reg-weight-slider").ionRangeSlider({
				type: "single",              
				step: 1,                    
				postfix: " kg",
				from: <?php echo $reg_weight;?>,
				hideMinMax: true, 
				hideFromTo: false
				
			});
			<?php
			}
			
			if(isset($match['height_range_array'])&&is_array($match['height_range_array'])){
			?>
			$("#match_height-slider").ionRangeSlider({
				from: <?php echo $match['height_range_array'][0];?>,                    
				to: <?php echo $match['height_range_array'][1];?>,                     
				type: "double",              
				step: 1,
				hideMinMax: true,                      
				postfix: " cm"
			});
			<?php
			}
			
			if(isset($match['weight_range_array'])&&is_array($match['weight_range_array'])){
			?>
			$("#match_weight-slider").ionRangeSlider({
				from: <?php echo $match['weight_range_array'][0];?>,                    
				to: <?php echo $match['weight_range_array'][1];?>,                     
				type: "double",
				hideMinMax: true,              
				step: 1,                      
				postfix: " kg"
			});
			<?php
			}
			?>
        });
    </script>    
  </body>
</html>
