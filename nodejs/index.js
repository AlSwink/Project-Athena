var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);

io.on('connection',function(socket){
	console.log('someone connected');

	socket.on('disconnect', function(){
		console.log('user disconnected');
	});

	socket.on('command',function(m){
		command = m.substring(0,1);
		val = m.substring(1);
		if(command == '/'){
			cmd = 'command';
		}else{
			cmd = 'chat'
		}
		
		io.emit(cmd,val);
	});

	socket.on('notify',function(m){
		console.log(m);
		params = m.split('-');
		io.emit('notify',params[0],params[1]);
	});
});

http.listen(3000,function(){
	console.log('listening on port 3000');
});