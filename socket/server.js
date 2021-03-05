const http = require("http");
const socket = require("socket.io");
const Redis = require("ioredis");

const server = http.Server();
const io = socket(server);
const redis = new Redis();

redis.subscribe("hello-channel");

redis.on("message", (channel, message) => {
    message = JSON.parse(message);
    console.log(message);
    // io.emit(`${channel}:${message.event}`, message.data);
});

server.listen(3033, () => console.log("Listening on 3033"));
