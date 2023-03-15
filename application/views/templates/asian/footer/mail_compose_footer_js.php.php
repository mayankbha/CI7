<script type="text/javascript">
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
</script>