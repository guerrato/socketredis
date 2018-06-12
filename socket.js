let app = require('express')()
let http = require('http').Server(app)
let io = require('socket.io')(http)
let fs = require('fs')
let Ioredis = require('ioredis')

let redis = new Ioredis()

redis.subscribe('channel')

redis.on('message', function(channel, message){
    message = JSON.parse(message)
    console.log(message)
    io.emit(channel + ':' + message.event, message.data)
})

http.listen(3000, () => {
	console.log('listening on *:3000')
})