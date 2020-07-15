var app = require('express')();
var server = require('http').createServer(app);
//http server를 socket io erver로 upgrade한다.
var io = require('socket.io')(server);

//localhost:3001으로 서버에 접속하면 클라이언트로 index2.html을 전송한다.
app.get('/',function(req,res){
    res.sendFile(__dirname +'/index-room.html');
});

//룸을 저장하기 위한 방식.
var socketRoom = {};

//닉네임과 방이름
var name;
var room;


//chat 이라는 변수에 io객체를 연결 (socket 연결)
//chat 이라는 변수에 "chat" 네임스페이스를 연결 시킨다.
var chat = io.of('/chat').on('connection',function(socket){

    adminsocket=null;

    //대화방 입장
    socket.on('NewUser',function(data){

        if(data.name=="groovejumat@naver.com"){
            adminsocket=socket.id;
            console.log(socket.id + " 저장완료.");
        }

        //chat.to(data.room).emit('chat message',data);
        if(data.name!="groovejumat@naver.com"){
            console.log(data.name + "이 채팅을 대기 중입니다.");
            //해당 namespace에 있는 room이름으로 데이터를 전달.
            chat.to("groovejumat@naver.com").emit('alarm',"["+data.name + "이 "+ "현재 채팅 대기 중입니다.]");
            //소켓아이디로 전달
            socket.to(adminsocket).emit('alarm',"["+data.name + "이 현재 채팅 대기 중입니다.]")
        }
    });



    //대화방 참가
    socket.on('join',function(data){
        socket.join(data.room);
        //chat.to(data.room).emit('chat message',data);
        console.log(data.name + "이 "+ data.room + "에 join완료.");
        if(data.name=="groovejumat@naver.com"){
            //adminsocket=socket.id;
            //console.log(socket.id + " 저장완료.");
        }

        //해당 namespace에 있는 room이름으로 데이터를 전달.
        //chat.to(data.room).emit('alarm',data.name + "이 " + data.room + "에 들어옴.");
        if(data.name==data.room){
            if(data.name!="groovejumat@naver.com"){
                chat.to(data.room).emit('alarm',"[방에 입장하였습니다. 잠시 기다려 주세요.]");
            }

            //chat.to(data.room).emit('alarm',data.name + "이 " + data.room + "에 들어옴.");
        }
        else{
            if(data.name=="groovejumat@naver.com"){
                chat.to(data.room).emit('alarm',"[관리자가 채팅방에 접속했습니다.]");
            }
            else{
                chat.to(data.room).emit('alarm',"["+data.name + "이 " + data.room + "에 들어옴.]");
            }
        }


    });


    //대화방 나가기
    socket.on('leave',function(data){

        //chat.to(data.room).emit('chat message',data);
        console.log(data.name + "이 "+ data.room + "을 떠났음.");

        //해당 namespace에 있는 room이름으로 데이터를 전달.
        if(data.name=="groovejumat@naver.com"){
            chat.to(data.room).emit('alarm',"[관리자가 "+ "방을 나갔습니다.]");
        }
        else{
            chat.to(data.room).emit('alarm',"["+data.name + "이 "+ "방을 나갔습니다.]");
        }


        socket.leave(data.room);
    });



   socket.on('chat message', function(data){
       //콘솔로그에서 받아온 데이터를 출력시킴(data)
     console.log('message from client: ', data);
     //클라이언트 별로 아이디가 구분이 되어져 있는지 확인.
     console.log('message from socketid: ', socket.id);
     //변수에 가지고 온 데이터를 저장시킴 (이름정보, 그리고 룸정보)
     name = socket.name = data.name;
     room = socket.room = data.room;

     //room에 join 한다.
       //설정된 룸값에 join참가함.
       //socket.join(room);
       //socket.join(room);

       //room에 join되어 있는 클라이언트에게 메시지를 전송한다. 룸에 join 되어진 클라이언트에게만 메시지를날려준다.
       chat.to(room).emit('chat message',data);


       // chat.to(room).emit('chat message',data.msg);
       // chat.to(room).emit('chat message',data.name);
    });


    // io.to(room).emit('some event')

});




//연결 포트 방식//
server.listen(3001, function() {
    console.log('Socket IO server listening on port 3000');
});


