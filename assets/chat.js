/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var last_chat_id = 0;
var count = 0;

$(document).ready(function() {
    init_chat(count);
});

function init_chat()
{
    var chatter = setInterval(function() {
        get_chat();
        online_users();
        count++;
        if (count == 2) {
            clearInterval(chatter);
        }
    }, 1500);
}

function get_chat()
{
    var TO_USER = $('#to_user').val();
	
    $.ajax({
        dataType: "json",
        url: SITE_URL + 'chat/get_chat',
        type: 'POST',
        data: {to_user: TO_USER, last_chat_id: last_chat_id},
        success: function(res) {
            if (res.last_chat_id != "") {
                last_chat_id = res.last_chat_id;
            }
			
            chat = parse_chat(res.chat_history);
            $('#chat-box').append(chat);
			 
            $("#chat-box").animate({ scrollTop: $('#chat-box')[0].scrollHeight}, 1000);
        }
    });
}

function send_chat(messge_box)
{
    var TO_USER = $('#to_user').val();
    message = $('#' + messge_box).val();
    $.ajax({
        dataType: "json",
        url: SITE_URL + 'chat/add_chat',
        type: 'POST',
        data: {to_user: TO_USER, message: message},
        success: function(res) {
            if (res.status == true)
            {
                $('#' + messge_box).val('');
                get_chat();
            }
        }
    });
}

/*function parse_chat(chats)
{
    result = "";
    var TO_USER = $('#to_user').val();
    for (chat in chats)
    {
        chat = chats[chat];
        //console.log(chat);
        if (chat.fk_from_user_id == TO_USER) {
            result += '<div class="chat-msg to-msg">' + chat.message + '</div>';
            result += '<div class="clear"></div>';
			//alert(result);
        } else {
            result += '<div class="chat-msg from-msg">' + chat.message + '</div>';
            result += '<div class="clear"></div>';
			//alert('else');
        }
    }
    
    return result;
}*/

function parse_chat(chats)
{
    result = "";
    var TO_USER = $('#to_user').val();
    for (chat in chats)
    {
        chat = chats[chat];
        //console.log(chat);
        if (chat.fk_from_user_id == TO_USER) {
            result += '<div class="chat-msg to-msg">' + chat.message + '</div>';
            result += '<div class="clear"></div>';
			//alert(result);
        } else {
            result += '<div class="chat-msg from-msg">' + chat.message + '</div>';
            result += '<div class="clear"></div>';
			//alert('else');
        }
    }
    
    return result;
}

function online_users()
{
    $.ajax({
        dataType: "json",
        url: SITE_URL + 'chat/get_online_users',
        type: 'POST',
        success: function(res) {
            if (res.count > 0)
            {
                $('#users-box').html('');
                users = parse_user(res.online_users);
				//alert(users);
                //console.log(users);
                $('#users-box').append(users);
            }
        }
    });
}

function parse_user(users)
{
    result = "";
    for (user in users)
    {
        user = users[user];
        result += '<div>';
        result += '<a href="javascript:void(0);" id="chat-user-'+user['id']+'" onclick="start_chat(\''+user['id']+'\');">' + user['first_name'] +" "+ user['last_name'] + '</a>';
        result += '</div>';
    }
    
    return result;
}

function start_chat(user_id)
{
	
    $('#chat-box').html('');
    $('#to_user').val(user_id);
	//alert('hello');
    last_chat_id = 0;
    init_chat();
}