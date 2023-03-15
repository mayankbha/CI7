<script type="text/javascript">
		var trash_list = [];
		$(document).on('click', '.add_to_trash', function(){
			//
			
			if($(this).is(":checked")){
				trash_list.push($(this).attr('value'));
				$(this).attr('class', 'remove_from_trash');
				console.log(trash_list);
				$('#delete_mails').val(trash_list);
			}

		});

		$(document).on('click', '.remove_from_trash', function(){
			//
			if($(this).is(":checked")){

			} else {			
				trash_list.pop($(this).attr('value'));
				$(this).attr('class', 'add_to_trash');
				console.log(trash_list);
				$('#delete_mails').val(trash_list);
			}
		});
		$(document).on('click', '#delete_to_trash', function(){

			if(trash_list.length>0){
				$('<div></div>').appendTo('body')
					.html('<div><h6>Are you sure?</h6></div>')
					.dialog({
					modal: true,
					title: 'Deleting Messages.',
					zIndex: 10000,
					autoOpen: true,
					width: '300',
					resizable: false,
					buttons: {
						Yes: function () {
							doFunctionForYes();
							$(this).dialog("close");
						},
						No: function () {
							doFunctionForNo();
							$(this).dialog("close");
						}
					},
					close: function (event, ui) {
						$(this).remove();
					}
				});
				$('#msg').hide();
			}
			function doFunctionForYes() {
				//alert("Yes");
				$('#delete_mails').submit();
			}

			function doFunctionForNo() {
				alert("No");
				//$('#msg').show();
			}
		});		
		$(document).on('click', '#move_to_trash', function(){

			if(trash_list.length>0){
				$('<div></div>').appendTo('body')
					.html('<div><h6>Are you sure?</h6></div>')
					.dialog({
					modal: true,
					title: 'Moving to Trash',
					zIndex: 10000,
					autoOpen: true,
					width: '300',
					resizable: false,
					buttons: {
						Yes: function () {
							doFunctionForYes();
							$(this).dialog("close");
						},
						No: function () {
							doFunctionForNo();
							$(this).dialog("close");
						}
					},
					close: function (event, ui) {
						$(this).remove();
					}
				});
				$('#msg').hide();
			}
			function doFunctionForYes() {
				//alert("Yes");
				$('#delete_mails').submit();
			}

			function doFunctionForNo() {
				alert("No");
				//$('#msg').show();
			}
		});

		$(document).on('click', '.mail-item-unstarred', function(){
			var mail_id = $(this).attr("id");
			$(this).attr('class', 'mail-item-star mail-item-starred');
			$.post('/ajax', {
				'mail_id': $(this).attr('id'),
				'add_star':'inbox'
				});
				$().toastmessage('showNoticeToast', 'Added to favorite.');
		});	
		
		$(document).on('click', '.mail-item-starred', function(){
			var mail_id = $(this).attr("id");
			$(this).attr('class', 'mail-item-star mail-item-unstarred');
			$.post('/ajax', {
				'mail_id': $(this).attr('id'),
				'remove_star':'inbox'
				});						
				$().toastmessage('showNoticeToast', 'Removed from favorite.');
		});	

		$(document).on('click', '#select_mails', function(){
			if($(this).prop("checked")==true){
				$('.chk').prop("checked", true);
			} else {
				$('.chk').prop("checked", false);
			}
		});	
		var mail_to_users = [];
		$(document).on('click', '.add_user', function(){
			//
			mail_to_users.push($(this).attr('id'));
			$(this).attr('class', 'remove_user');
			console.log(mail_to_users);
			$('#selected_recepients').val(mail_to_users);
		});
		$(document).on('click', '.remove_user', function(){
			//
			mail_to_users.pop($(this).attr('id'));
			$(this).attr('class', 'add_user');
			console.log(mail_to_users);
			$('#selected_recepients').val(mail_to_users);
		});	
			//message recepient select
			 $('#search_recepient').keyup(
				function(event){
						event.preventDefault();
						var mail_to_users = [];
						//alert(this.value);
						$.post('/ajax', {
							'search_recepient': this.value
						}).done(function(data) {
							$('#show_recepients').html(data);
						});
						//$().toastmessage('showNoticeToast', 'Data was saved.');
				}
			 );	
			 
			 
			 
//reply
$('.reply').click(function(){
	{
		$('#reply_box').show();
	}
		});

	//Block user to block list
	$(document).on('click', '.user_block', function(){
			var mail_id = $(this).attr("id");
			$(this).attr('class', 'user_block');
			$.post('/ajax', {
				'mail_id': $(this).attr('id'),
				'user_block':'inbox'
				});
				
				$().toastmessage('showNoticeToast', 'Added to Block List.');
				/*setInterval(function(){0
					$(".reload_cont").load(location.href+" .reload_cont>*","");
				}, 6000);  // 1000 = 1 second, 3000 = 3 seconds*/
				
		});	
	
	//unblock user from block list
	$(document).on('click', '.user_unblock', function(){
			var mail_id = $(this).attr("id");
			$(this).attr('class', 'user_unblock');
			$.post('/ajax', {
				'mail_id': $(this).attr('id'),
				'user_unblock':'user_unblock'
				});
				
				$().toastmessage('showNoticeToast', 'Remove from Block List.');
		});	
	
</script>		