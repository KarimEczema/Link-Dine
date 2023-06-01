<?php

include 'login-check.php';

echo '<html>';
echo '<head>';
echo '<title>Admin</title>';
echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">'; 
echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> '; 
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>'; 
echo '<link rel="stylesheet" type="text/css" href="css/chat.css">'; 
echo '<body>';

include 'navbar.php';
echo '<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">';
echo '<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>';
echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>';

?>



</head>
<body>
    <div id="chatbox">
        <!-- Messages will be dynamically inserted here -->
    </div>
    <div id="userSelect">
        <!-- User options will be dynamically inserted here -->
    </div>
    <input type="text" id="userInput" placeholder="Type your message..." />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        const supabaseUrl = 'https://bmqgiyygwjnnfyrtjkno.supabase.co';
        const supabaseAnonKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImJtcWdpeXlnd2pubmZ5cnRqa25vIiwicm9sZSI6ImFub24iLCJpYXQiOjE2ODUzNzM1NzcsImV4cCI6MjAwMDk0OTU3N30.sQgvRElC6O5e4uE8OVZqLXBiQYQa83mSkTy4s4L0aDw'

const sendMessage = async (iduser, message, sentTo) => {
    try {
        const response = await fetch(`${supabaseUrl}/rest/v1/messages`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'apikey': supabaseAnonKey,
            },
            body: JSON.stringify({ iduser, message, sentTo }), // include sentTo field
        });

        if (!response.ok) {
            throw new Error('Failed to send message');
        }

        console.log('Message sent successfully');
    } catch (error) {
        console.error('Error:', error.message);
    }
};


const getUsers = async () => {
    try {
        const response = await fetch(`${supabaseUrl}/rest/v1/users`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'apikey': supabaseAnonKey,
            },
        });
        
        if (!response.ok) {
            throw new Error('Failed to fetch usernames');
        }

        const data = await response.json();



        return data.map(user => ({iduser: user.iduser, username: user.username})); // assuming each user has a 'username' field
    } catch (error) {
        console.error('Error:', error.message);
    }
};


const receiveMessages = async (sentTo) => {
    try {
        const response = await fetch(`${supabaseUrl}/rest/v1/messages?sentTo=eq.${sentTo}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'apikey': supabaseAnonKey,
            },
        });

        if (!response.ok) {
            throw new Error('Failed to fetch messages');
        }

        let data = await response.json();

        // Sort the data based on the 'time' field in descending order (newest first)
        data.sort((a, b) => new Date(b.time) - new Date(a.time));

        $('#chatbox').empty();
        data.forEach(msg => {
            $('#chatbox').append(`<p><b>${msg.username}:</b> ${msg.message}</p>`);
        });
    } catch (error) {
        console.error('Error:', error.message);
    }
};


$(document).ready(async function() {
          const users = await getUsers();
          users.forEach((user) => {
              let userButton = $(`<button class='usernameButton' data-id='${user.iduser}'>${user.username}</button>`);
              userButton.click(function() {
                  $('.usernameButton').removeClass('active');
                  $(this).addClass('active');
                  receiveMessages($(this).data('id'));
              });
              $('#userSelect').append(userButton);
          });

          $('#userInput').keypress(async function(e) {
              if(e.which == 13) { // Enter key pressed
                  const message = $(this).val().trim();
                  const sentTo = $('.usernameButton.active').data('id');

                  if (message === '') {
                      alert('Message is required!');
                      return;
                  }

                  if (!sentTo) {
                      alert('Please select a user to send message to!');
                      return;
                  }

                  await sendMessage(iduser, message, sentTo);
                  $(this).val(''); // Clear the input field
              }
          });

            setInterval(() => {
        const activeUserId = $('.usernameButton.active').data('id');
        if (activeUserId) {
            receiveMessages(activeUserId);
        }
    }, 1000);
        });
    </script>
</body>
</html>