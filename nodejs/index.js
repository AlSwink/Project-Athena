var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);

app.get('/',function(req,res){
	res.send('<h1>Hello World</h1>');
})

io.on('connection',function(socket){
	console.log('someone connected');
});

http.listen(3000,function(){
	console.log('listening on port 3000');
});