#!/usr/bin/env node
https = require('https');

var options = {
    key: fs.readFileSync('/etc/letsencrypt/live/scitreserve.com/privkey.pem'),
    cert: fs.readFileSync('/etc/letsencrypt/live/scitreserve.com/cert.pem')
};

var server = https.createServer(options);

var io = require('socket.io')(server);

var Redis = require('ioredis');
var redis = new Redis();

redis.subscribe('test-channel');

redis.on('message', function(channel, message) {
    message = JSON.parse(message);
    console.log(channel);

    io.emit("tester", message.data);
});

// io.on('connect', () => {
//     io.emit('tester', "test"); // true
//   });

server.listen(3000);