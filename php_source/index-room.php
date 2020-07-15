<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Socket.io Chat Example</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<style>
    ul{
        list-style:none;
        padding-left:0px;
    }
</style>
<body>
<div class="container">
    <h3>Socket.io Chat Example</h3>
    <!-- <form class="form-inline"> -->
    <form class="form-horizontal">
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" placeholder="Name">
            </div>
        </div>
        <div class="form-group">
            <label for="room" class="col-sm-2 control-label">Room</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="room" placeholder="Room">
            </div>
        </div>
        <div class="form-group">
            <label for="msg" class="col-sm-2 control-label">Message</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="msg" placeholder="Message" value="<?php echo "헬로월드"?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Send</button>
            </div>
        </div>
    </form>
    <ul id="chat"></ul>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<!--해당스크립트를 실행한다(라이브러리가 생성되는 개념?)-->
<script src="/socket.io/socket.io.js"></script>
<script>
    //yourname 이라는 변수를 담아서 검사하는 기능
    var yourname;

    <?php echo "헬로헬로"?>

    //socket io 서버로 보내기 기능//
    $(function() {
        // 지정 namespace로 접속한다
        var chat = io('http://192.168.244.100:3001/chat'),
            news = io('/news');

        //받아온 정보값이 내 이름과 같은지를 조회함.


        $("form").submit(function(e) {
            yourname = $("#name").val();
            e.preventDefault();

            // 서버로 자신의 정보를 전송한다.
            chat.emit("chat message", {
                name: $("#name").val(),
                room: $("#room").val(),
                msg: $("#msg").val()
            });
        });

        // 서버로부터의 메시지가 수신되면 (서버가 해당 클라이언트로 메시지를 보내면)
        // "chat message가 이벤트의 이름이다."
        chat.on("chat message", function(data) {

            //내가 친 채팅 일때.
            if(yourname==data.name){
                $("#chat").append($('<li>').text("[니가 지금 채팅을 쳣음.]"));
                // $("#chat").append($('<li>').text(yourname)); //현재 담긴 변수 출력.
                $("#chat").append($('<li> 메시지').text("[메시지]:"+data.msg)); //메시지
                $("#chat").append($('<li> 받는사람').text("[받는사람]:"+data.name));
            }

            //상대방이 친 채팅 일때.
            else {
                $("#chat").append($('<li align="right">').text("[상대방이 채팅을 쳤음.]"));
                // $("#chat").append($('<li align="right">').text(yourname)); //현재 담긴 변수 출력.
                $("#chat").append($('<li align="right">').text("[메시지]:"+data.msg)); //메시지
                $("#chat").append($('<li align="right">').text("[보낸사람]:"+data.name));
            }

        });
    });
</script>
</body>
</html>