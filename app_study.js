var app = require('express')();
var server = require('http').createServer(app);

//http server를 socket.io server로 업그레이드 하기.
var io = require('socket.io')(server);

app.get('/',function (req,res) {
   res.sendFile(__dirname + '/index.html');
});

server.listen(3000,function(){
    console.log('Socekt IO server listening on port 3000');
});

//connection event handler
//connection 수립되면 event handler function의 인자로 socket이 들어온다
io.on('connection',function (socket) {
//socket 객체는 개별 클라이언트 와의 상호작용을 위한 기본적인 객체. io객체는 전체 클라이언트와의 상호작용을 위한 객체
});

//현재 접속되어져 있는 클라이언트로부터의 메시지를 받기 위하해서는 on 메소드를 사용한다.
//event name : 클라이언트가 메시지 보낼 때 지정한 이벤트 명
//function : 이벤트 핸들러. 핸들러 함수의 인자로 클라이언트가 송신한 메시지가 전달

socket.on('event_name',function(data){
    console.log('Message from Client: ' + data);
});

//접속된 모든 클라이언트에게 메시지를 전송한다.
//io.emit('event_name',msg);

//메시지를 전송한 클라이언트에게만 메시지를 전송한다.
socket.emit('event_name',msg);

//메시지를 전송한 클라리언트를 제외한 모든 클라이언트에게 메시지를 전송한다.
socket.broadcast.emit('event_name',msg);

//특정 클라이언트에게만 메시지를 전송한다.
io.to(id).emit('event_name',data);
