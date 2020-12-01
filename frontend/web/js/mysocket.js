$('document').ready(function (){


    let socket = new WebSocket("wss://new.texnomart.uz:1212");


    console.log(socket)


    socket.onopen = function(e) {
        alert("[open] Connection established");
        alert("Sending to server");
        socket.send("My name is John");
    };


})