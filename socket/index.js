const express = require("express");
const socket = require("socket.io");
const http = require("http");

const app = express();
const server = http.Server(app);
const io = socket(server);

server.listen(3333, () => {
    console.log(`Server started on 3333`);
});

app.get("/", (req, res) => {
    res.sendFile(__dirname + "/index.html");
});

io.on("connection", socket => {
    console.log("A connection is made");
    // socket.on("specific.event", message => {
    //     io.emit("specifi.event");
    // });

    // socket.on('disconnect', () => {
    //     io.emit('specific.event', 'User disconnected')
    // })
});
