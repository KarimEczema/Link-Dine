<?php

include 'login-check.php';

echo '<html>';
echo '<head>';
echo '<title>Your Page Title</title>';

echo '<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">';
echo '<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>';
echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>';

?>

<!DOCTYPE html>
<html>
<head>
    <title>Live Chat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #222274;
            color: #fff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            transition: background-color 0.3s ease;
        }

        #chatbox {
            max-width: 60%;
            width: 100%;
            height: 100vh;
            border-radius: 10px;
            padding: 20px;
            background: #4444fc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
        }

        #userInput {
            position: fixed;
            bottom: 0;
            width: 60%;
            padding: 10px;
            border-radius: 5px;
            border: none;
            box-sizing: border-box;
            background: #4040a7;
            color: #fff;
        }

        .usernameButton {
            background-color: #4d4de0;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-bottom: 10px;
            display: block;
        }

        .usernameButton.active {
            background-color: #5353bd;
        }

        #userSelect {
            max-width: 30%;
            height: 100vh;
            overflow-y: auto;
            padding: 20px;
            background: #222274;
            position: fixed;
            right: 0;
            top: 0;
        }
    </style>
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
      // Existing code here...
      $(document).ready(async function() {
          const usernames = await getUsernames();
          usernames.forEach((user) => {
              let userButton = $(`<button class='usernameButton'>${user}</button>`);
              userButton.click(function() {
                  $('.usernameButton').removeClass('active');
                  $(this).addClass('active');
                  receiveMessages(user);
              });
              $('#userSelect').append(userButton);
          });

          $('#userInput').keypress(async function(e) {
              if(e.which == 13) { // Enter key pressed
                  const message = $(this).val().trim();
                  const sentTo = $('.usernameButton.active').text();

                  if (message === '') {
                      alert('Message is required!');
                      return;
                  }

                  if (!sentTo) {
                      alert('Please select a user to send message to!');
                      return;
                  }

                  await sendMessage(username, message, sentTo);
                  $(this).val(''); // Clear the input field
              }
          });

          setInterval(() => {
              const activeUser = $('.usernameButton.active').text();
              if (activeUser) {
                  receiveMessages(activeUser);
              }
          }, 1000); // Poll server every 3 seconds for new messages
      });
    </script>
</body>
</html>
