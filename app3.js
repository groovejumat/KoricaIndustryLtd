/* socket\room_chat\app.js */


const app = require('express')();
const http = require('http').Server(app);
const io = require('socket.io')(http);

app.set('views', '/usr/local/webstack/apache2.4.10/htdocs');
app.set('view engine', 'ejs');

let room = ['room1', 'room2', 'room3'];
let a = 0;


app.get('/', (req, res) => {
    res.render('chat');
});


io.on('connection', (socket) => {
    socket.on('disconnect', () => {
        console.log('user disconnected');
    });


    socket.on('leaveRoom', (num, name) => {
        socket.leave(room[num], () => {
            console.log(name + ' leave a ' + room[num]);
            io.to(room[num]).emit('leaveRoom', num, name);
        });
    });


    socket.on('joinRoom', (num, name) => {
        socket.join(room[num], () => {
            console.log(name + ' join a ' + room[num]);
            io.to(room[num]).emit('joinRoom', num, name);
        });
    });


    socket.on('chat message', (num, name, msg) => {
        a = num;
        io.to(room[a]).emit('chat message', name, msg);
    });
});


http.listen(3005, () => {
    console.log('Connect at 3005');
});