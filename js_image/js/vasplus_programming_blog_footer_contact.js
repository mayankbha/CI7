/********************************************************************************
* This script is brought to you by Vasplus Programming Blog to whom all copyrights are reserved.
* Website: www.vasplus.info
* Email: info@vasplus.info
* Do not remove this information from the top of this code.
*********************************************************************************/

$(document).ready(function()
{
	$('#vpv_tooltip_image').mouseenter(function(){
		$(this).fadeOut('fast');
	});
	$("#vpb_fullname").Watermark("<click here> and type your Name"); 
	$("#vpb_email_address").Watermark("<click here> and type your Email");
	$("#vpb_message_body").Watermark("We're not around but we still want to hear from you!  Leave us a note:");
});

function vpb_leave_a_message_show() {
	$('#vasplus_programming_blog_bottom').slideUp('fast');
	$('#vpv_tooltip_image').fadeOut('fast');
	$('.vasplus_programming_blog_bottom').slideDown('slow');
}

function vpb_leave_a_message_hide() {
	$("#vpb_message_body").val('').animate({
			"height": "80px"
	}, "fast" );
	$("#vpb_fullname").val('');
	$("#vpb_email_address").val('');
	$("#vpb_phone_number").val('');
	$("#vpb_fullname").Watermark("<click here> and type your Name"); 
	$("#vpb_email_address").Watermark("<click here> and type your Email");
	$("#vpb_message_body").Watermark("We're not around but we still want to hear from you!  Leave us a note:");
	$('#vasplus_programming_blog_mailer_status').html('').hide();
	$('.vasplus_programming_blog_bottom').slideUp('fast');
	$('#vasplus_programming_blog_bottom').slideDown('slow');
	$('#vpv_tooltip_image').fadeIn('fast');
}

//Send Mails
function Contact_Form_Submission_By_Vasplus_Programming_Blog() 
{
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	var vpb_fullname = $("#vpb_fullname").val();
	var vpb_email_address = $("#vpb_email_address").val();
	var vpb_phone_number = $("#vpb_phone_number").val();
	var vpb_message_body = $("#vpb_message_body").val();
	
	if(vpb_fullname == "" || vpb_fullname == "Your Fullname")
	{
		$('#vasplus_programming_blog_mailer_status').show().css("background-color","#F1F1F1").html('Please enter your fullname in the specified field to proceed. Thanks.');
		 $("#vpb_fullname").focus();
	}
	else if(vpb_email_address == "" || vpb_email_address == "Email Address")
	{
		$('#vasplus_programming_blog_mailer_status').show().css("background-color","#F1F1F1").html('Please enter your email address in its field to move on. Thanks.');
		$("#vpb_email_address").focus();
	}
	else if(reg.test(vpb_email_address) == false)
	{
		$('#vasplus_programming_blog_mailer_status').show().css("background-color","#F1F1F1").html('Please enter a valid email address to proceed. Thanks.');
		$("#vpb_email_address").focus();
	}
	else if(vpb_phone_number == "" || vpb_phone_number == "phone number")
	{
		$('#vasplus_programming_blog_mailer_status').show().css("background-color","#F1F1F1").html('Please enter the phone number to proceed. Thanks.');
		$("#vpb_phone_number").focus();
	}
	else if(vpb_message_body == "" || vpb_message_body == "Email Message")
	{
		$('#vasplus_programming_blog_mailer_status').show().css("background-color","#F1F1F1").html('Please enter your message content in the required field to go. Thanks.');
		$("#vpb_message_body").focus();
	}
	else 
	{
		var dataString = 'vpb_fullname=' + vpb_fullname + '&vpb_email_address=' + vpb_email_address + '&vpb_phone_number=' + vpb_phone_number + '&vpb_message_body=' + vpb_message_body;
		
		$.ajax({
			type: "POST",
			url: "../footercontactmail.php",
			data: dataString,
			cache: false,
			beforeSend: function() 
			{
				$('#vasplus_programming_blog_mailer_status').show().css("background-color","white").html('<font style="font-family:Verdana, Geneva, sans-serif; font-size:12px;color:gray;">Please wait</font> <img style="" src="../img/33.gif" align="absmiddle" alt="Loading" />');
			},
			success: function(response) 
			{
				if(response=="success"){
				$("#vpb_message_body").val('').animate({
						"height": "80px"
				}, "fast" );
				$("#vpb_fullname").val('');
				$("#vpb_email_address").val('');
				$("#vpb_phone_number").val('');
				$('#vasplus_programming_blog_mailer_status').show().css("color","#009900").html("Thank You For Contacting Us!");
				}
			}
		});
		return false;
	}
}