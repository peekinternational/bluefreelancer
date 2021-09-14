var server = require('http').Server();
var app= require('express')();
var io= require('socket.io')(server);
// var redis= require('redis');


server.listen(3000, function() {
    console.log('Listening on Port: 3000');
});
io.on('connection', function (socket) {
    console.log(socket);
    var redisClient = redis.createClient();
    redisClient.subscribe('message');

    redisClient.on('message', function(channel, message) {
        socket.emit(channel,message);
        console.log('message');
    });

    socket.on('disconnect', function() {
        redisClient.quit();
        console.log('disconnect');
    });
    
});