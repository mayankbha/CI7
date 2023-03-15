<!-- / Upload Script / -->     
    <!--script src="/template/main/jquery-1.10.2.min.js"></script>     
	<script src="/template/main/jquery.min.js"></script-->  
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript" src="/template/asian/resources/js/bootstrap.min.js"></script>     
    <script type="text/javascript" src="/template/asian/resources/js/datepicker.js"></script>     
    <script type="text/javascript" src="/template/asian/resources/js/ion.rangeSlider.min.js"></script>     
    <script type="text/javascript" src="/template/asian/resources/js/owl.carousel.min.js"></script>     
    <script type="text/javascript" src="/template/asian/resources/js/ckeditor.js"></script>     
    <script type="text/javascript" src="/template/asian/resources/js/adapters/jquery.js"></script>     
	<script type="text/javascript" src="/template/asian/resources/js/jquery.toastmessage.js"></script>     
    <script type="text/javascript" src="/template/asian/resources/js/main.js"></script>     


<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="<?php echo base_url(); ?>template/main/jQuery-File-Upload-9.5.7/js/vendor/jquery.ui.widget.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="<?php echo base_url(); ?>template/main/jQuery-File-Upload-9.5.7/js/load-image.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="<?php echo base_url(); ?>template/main/jQuery-File-Upload-9.5.7/js/canvas-to-blob.min.js"></script>
<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->

<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?php echo base_url(); ?>template/main/jQuery-File-Upload-9.5.7/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="<?php echo base_url(); ?>template/main/jQuery-File-Upload-9.5.7/js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="<?php echo base_url(); ?>template/main/jQuery-File-Upload-9.5.7/js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="<?php echo base_url(); ?>template/main/jQuery-File-Upload-9.5.7/js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="<?php echo base_url(); ?>template/main/jQuery-File-Upload-9.5.7/js/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="<?php echo base_url(); ?>template/main/jQuery-File-Upload-9.5.7/js/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="<?php echo base_url(); ?>template/main/jQuery-File-Upload-9.5.7/js/jquery.fileupload-validate.js"></script>


<script src="<?php echo base_url(); ?>js_image/js/vasplus_programming_blog_footer_contact.js"></script>

<script src="<?php echo base_url(); ?>js_image/js/post_watermarkinput.js"></script>
<script src="/template/asian/resources/js/jquery-ui-1.11.0/jquery-ui.js"></script>	
<script>
/*jslint unparam: true, regexp: true */
/*global window, $ */

$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = window.location.hostname === 'http://dating.dev' ?
                '//jquery-file-upload.appspot.com/' : '/template/main/jQuery-File-Upload-9.5.7/server/php/',
        uploadButton = $('<button/>')
            .addClass('btn btn-primary')
            .prop('disabled', true)
            .text('Processing...')
            .on('click', function () {
                var $this = $(this),
                    data = $this.data();
                $this
                    .off('click')
                    .text('Abort')
                    .on('click', function () {
                        $this.remove();
                        data.abort();
                    });
                data.submit().always(function () {
                    $this.remove();
                });
            });
			
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        autoUpload: false,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 5000000, // 5 MB
        // Enable image resizing, except for Android and Opera,
        // which actually support image resizing, but fail to
        // send Blob objects via XHR requests:
        disableImageResize: /Android(?!.*Chrome)|Opera/
            .test(window.navigator.userAgent),
        previewMaxWidth: 100,
        previewMaxHeight: 100,
        previewCrop: true,
		formData: {user_id: $("#user_id").val(), save:'ID'}		
    }).on('fileuploadadd', function (e, data) {
        data.context = $('<div/>').appendTo('#files');
        $.each(data.files, function (index, file) {
            var node = $('<p/>')
                    .append($('<span/>').text(file.name));
            if (!index) {
                node
                    .append('<br>')
                    .append(uploadButton.clone(true).data(data));
            }
            node.appendTo(data.context);
        });
    }).on('fileuploadprocessalways', function (e, data) {
        var index = data.index,
            file = data.files[index],
            node = $(data.context.children()[index]);
        if (file.preview) {
            node
                .prepend('<br>')
                .prepend(file.preview);
        }
        if (file.error) {
            node
                .append('<br>')
                .append($('<span class="text-danger"/>').text(file.error));     
        }
        if (index + 1 === data.files.length) {
            data.context.find('button')
                .text('Upload')
                .prop('disabled', !!data.files.error);
        }
    }).on('fileuploadprogressall', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress .progress-bar').css(
            'width',
            progress + '%'
        );
    }).on('fileuploaddone', function (e, data) {
        $.each(data.result.files, function (index, file) {
            if (file.url) {
                var link = $('<a>')
                    .attr('target', '_blank')
                    .prop('href', file.url);
                $(data.context.children()[index])
                    .wrap(link);
            } else if (file.error) {
                var error = $('<span class="text-danger"/>').text(file.error);
                $(data.context.children()[index])
                    .append('<br>')
                    .append(error);
            }
        });
    }).on('fileuploadfail', function (e, data) {
        $.each(data.files, function (index, file) {
            var error = $('<span class="text-danger"/>').text('File upload failed.');
            $(data.context.children()[index])
                .append('<br>')
                .append(error);
        });
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
		
		
    $('#fileupload2').fileupload({
        url: url,
        dataType: 'json',
        autoUpload: false,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 5000000, // 5 MB
        // Enable image resizing, except for Android and Opera,
        // which actually support image resizing, but fail to
        // send Blob objects via XHR requests:
        disableImageResize: /Android(?!.*Chrome)|Opera/
            .test(window.navigator.userAgent),
        previewMaxWidth: 100,
        previewMaxHeight: 100,
        previewCrop: true,
		formData: {user_id: $("#user_id2").val(), save:'profile'}		
    }).on('fileuploadadd', function (e, data) {
        data.context = $('<div/>').appendTo('#files2');
        $.each(data.files, function (index, file) {
            var node = $('<p/>')
                    .append($('<span/>').text(file.name));
            if (!index) {
                node
                    .append('<br>')
                    .append(uploadButton.clone(true).data(data));
            }
            node.appendTo(data.context);
        });
    }).on('fileuploadprocessalways', function (e, data) {
        var index = data.index,
            file = data.files[index],
            node = $(data.context.children()[index]);
        if (file.preview) {
            node
                .prepend('<br>')
                .prepend(file.preview);
        }
        if (file.error) {
            node
                .append('<br>')
                .append($('<span class="text-danger"/>').text(file.error));
        }
        if (index + 1 === data.files.length) {
            data.context.find('button')
                .text('Upload')
                .prop('disabled', !!data.files.error);
        }
    }).on('fileuploadprogressall', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress2 .progress-bar').css(
            'width',
            progress + '%'
        );
    }).on('fileuploaddone', function (e, data) {
		// data.context = $('<div/>').appendTo('#profile_pic_list');           
		 //$( "<p>Test</p>" ).appendTo( "#profile_pic_list" );          

        $.each(data.result.files, function (index, file) {
            if (file.url) {
                var link = $('<a>')
                    .attr('target', '_blank')
                    .prop('href', file.url);
                $(data.context.children()[index])
                    .wrap(link);
					//alert(file.url);
            } else if (file.error) {
                var error = $('<span class="text-danger"/>').text(file.error);
                $(data.context.children()[index])
                    .append('<br>')
                    .append(error);
            }
        });
    }).on('fileuploadfail', function (e, data) {
        $.each(data.files, function (index, file) {
            var error = $('<span class="text-danger"/>').text('File upload failed.');
            $(data.context.children()[index])
                .append('<br>')
                .append(error);
        });
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');		
});
</script>	
    <script type="text/javascript">
		<?php
		if(isset($template_footer)&&is_array($template_footer)){
			//print_r($template_footer);
			foreach($template_footer as $tfkey=>$tfvalue){
				echo $tfvalue;
			}
		}
		?>	
		var mail_to_users = [];
		$(document).on('click', '.add_user', function(){
			//
			mail_to_users.push($(this).attr('id'));
			$(this).attr('class', 'remove_user');
			//console.log(mail_to_users);
			$('#selected_recepients').val(mail_to_users);
		});
		$(document).on('click', '.remove_user', function(){
			//
			mail_to_users.pop($(this).attr('id'));
			$(this).attr('class', 'add_user');
			//console.log(mail_to_users);
			$('#selected_recepients').val(mail_to_users);
		});

		$(document).ready(function(){
			 $('.select_avatar').click(
				function(event){
						event.preventDefault();
						var picClass = $(this).attr("rel");
						//alert(picClass);
						$.post('/ajax', {
							'id': $(this).find('input.name').val(),
							'save':'select_avatar',
							'id': picClass
						},
						function(data) {
							$('#main_profile_photo').html(data);
							//$('#dictionary').html(data);
						});						
						$().toastmessage('showNoticeToast', 'Data was saved.');
				}
			 );		
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
			if(isset($active_forum_thanks)){
			?>
			 $('.add_thanks').click(
				
				function(event){
						event.preventDefault();
						$.post('/forum/thanks', {
							'id': $(this).attr('name'), 
						},
						function(data) {
							//$('#dictionary').html(data);
							$().toastmessage('showNoticeToast', data);
						});
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
			
			 $('#upload-save').click(
				function(event){
					event.preventDefault();
					//alert($('input[name="xxx"]').val());
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
			/*$( '.editor-ck' ).ckeditor();
			function readURL(input) {

				if (input.files && input.files[0]) {
					var reader = new FileReader();

					reader.onload = function (e) {
						$('#blah').attr('src', e.target.result);
					}

					reader.readAsDataURL(input.files[0]);
				}
			}*/
			$("#submit_content").click(function(){
				//alert();
				$("#content_body").val(CKEDITOR.instances.editor1.getData());
				this.form.submit();
			});
			$("#reply_to_thread").click(function(){
				//alert();
				$("#reply_body").val(CKEDITOR.instances.editor1.getData());
				this.form.submit();
			});			
			$( '.editor-ck' ).ckeditor();

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
				from: <?php echo $age_between_array[0]; ?>,
				to: <?php echo $age_between_array[1]; ?>,                     
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
			
			if(isset($match['height_range_array'])&&is_array($match['height_range_array']))
			{
				?>
				$("#match_height-slider").ionRangeSlider({
					from: <?php echo $match['height_range_array'][0]; ?>,                    
					to: <?php echo $match['height_range_array'][1]; ?>,                     
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
				from: <?php echo $match['weight_range_array'][0]; ?>,
				to: <?php echo $match['weight_range_array'][1]; ?>,
				type: "double",
				hideMinMax: true,
				step: 1,
				postfix: " kg"
			});
			<?php
			}
			?>
			//message recepient select
			 $('#search_recepient').keyup(
				function(event){
						event.preventDefault();
						//alert(this.value);
						$.post('/ajax', {
							'search_recepient': this.value
						}).done(function(data) {
							$('#show_recepients').html(data);
						});
						//$().toastmessage('showNoticeToast', 'Data was saved.');
				}
			 );
        });
    </script>