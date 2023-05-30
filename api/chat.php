<!DOCTYPE html>
<html>
<head>
    <title>Live Chat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        #chatbox {
            width: 500px;
            height: 400px;
            border: 1px solid #000;
            padding: 10px;
            overflow-y: scroll;
            margin-bottom: 10px;
        }
        #userInput {
            width: 400px;
            padding: 5px;
        }
    </style>
</head>
<body>
    <div id="chatbox">
        <!-- Messages will be dynamically inserted here -->
    </div>

    <input type="text" id="usernameInput" placeholder="Enter username" /><br>
    <input type="text" id="userInput" placeholder="Type your message..." />

    <button id="sendButton">Send</button>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            const receiveMessages = () => {
                $.get('/api/receive', function(data) {
                    $('#chatbox').empty();
                    data.data.forEach(msg => {
                        $('#chatbox').prepend(`<p><b>${msg.username}:</b> ${msg.message}</p>`);
                    });
                });
            }

            $('#sendButton').click(function() {
                const username = $('#usernameInput').val().trim();
                const message = $('#userInput').val().trim();

                if (username === '' || message === '') {
                    alert('Both username and message are required!');
                    return;
                }

                $.post('/api/send', {username, message}, function(data) {
                    if (data.error) {
                        alert('Error sending message!');
                    } else {
                        $('#userInput').val('');
                        receiveMessages();
                    }
                });
            });

            setInterval(receiveMessages, 3000); // Poll server every 3 seconds for new messages
        });
    </script>
</body>
</html>
