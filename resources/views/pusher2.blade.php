<!DOCTYPE html>
<head>
    <title>Pusher Test 2</title>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('cf26c5140d04f41f53a5', {
            cluster: 'ap2'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            //alert(data.message.title);
            //alert(data.message.desc);
            alert(JSON.stringify(data));
            //console.log(data);
        });
    </script>
</head>
<body>
<h1>Pusher Test</h1>
<p>
    Try publishing an event to channel <code>my-channel</code>
    with event name <code>my-event</code>.
</p>
</body>
