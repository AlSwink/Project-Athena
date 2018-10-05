var socket_port = 'http://'+window.location.hostname+':3000';
var socket = io.connect(socket_port);

$(document).on('click','.close_chat',function(){
	//socket.disconnect(socket_port);
	$('.chatbox_wrapper').addClass('d-none');
});


$(document).on('click','.call_support',function(){
	socket = io.connect(socket_port);
	$('.chatbox_wrapper').removeClass('d-none');
});

$(document).on('click','.chat_send',function(){
	client_msg = $('.client_input').val();

	if(client_msg.length){
		socket.emit('command',client_msg);
		$('.client_input').val('');
	}
});

socket.on('command',function(cmd){
	cmd_arr = cmd.split('-');
	command = cmd_arr[0];
	app = cmd_arr[1];
	act = cmd_arr[2];
	value = cmd_arr[3];

	switch(command){
		case 'refresh':
			if(app_name == app)
				window.location.reload();
			break;
		case 'do':
			app_obj = eval(app);
			app_obj[act](value);
			break;
	}
});

socket.on('chat',function(msg){
	msg_template = '<div class="chat_msg border-bottom border-secondary pl-1" style="background-color: #63cddd;font-size: 13px">';
	msg_template = '<span class="msg_info text-light" style="font-size: 8px;"><i>'+moment()+'</i></span></div>';
	$('.chat_msg_wrapper').append(msg_template);
});

