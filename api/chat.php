<!DOCTYPE html>
<html>
<head>
    <title>Live Chat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f3f3;
            color: #444;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            transition: background-color 0.3s ease;
        }

        #chatbox {
            max-width: 500px;
            width: 100%;
            height: 400px;
            border-radius: 10px;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            margin-bottom: 20px;
        }

        #usernameInput, #userInput {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        #sendButton {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #sendButton:hover {
            background-color: #2980b9;
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
      const supabaseUrl = 'https://bmqgiyygwjnnfyrtjkno.supabase.co';
const supabaseAnonKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImJtcWdpeXlnd2pubmZ5cnRqa25vIiwicm9sZSI6ImFub24iLCJpYXQiOjE2ODUzNzM1NzcsImV4cCI6MjAwMDk0OTU3N30.sQgvRElC6O5e4uE8OVZqLXBiQYQa83mSkTy4s4L0aDw'

      const sendMessage = async (username, message) => {
    try {
        const response = await fetch(`${supabaseUrl}/rest/v1/messages`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'apikey': supabaseAnonKey,
            },
            body: JSON.stringify({ username, message }),
        });

        if (!response.ok) {
            throw new Error('Failed to send message');
        }

        console.log('Message sent successfully');
    } catch (error) {
        console.error('Error:', error.message);
    }
};

      const receiveMessages = async () => {
    try {
        const response = await fetch(`${supabaseUrl}/rest/v1/messages`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'apikey': supabaseAnonKey,
            },
        });

        if (!response.ok) {
            throw new Error('Failed to fetch messages');
        }

        const data = await response.json();

        $('#chatbox').empty();
        data.forEach(msg => {
            $('#chatbox').prepend(`<p><b>${msg.username}:</b> ${msg.message}</p>`);
        });
    } catch (error) {
        console.error('Error:', error.message);
    }
};
    $(document).ready(function() {
    $('#sendButton').click(async function() {
        const username = $('#usernameInput').val().trim();
        const message = $('#userInput').val().trim();

        if (username === '' || message === '') {
            alert('Both username and message are required!');
            return;
        }

        await sendMessage(username, message);
        await receiveMessages();
    });

    setInterval(receiveMessages, 3000); // Poll server every 3 seconds for new messages
});

    </script>
</body>
</html>
