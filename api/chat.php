<?php
// Inclusion du test de login
include 'login-check.php';

// Inclusion des bibliothèques
echo '<html>';
echo '<head>';
echo '<title>Messagerie</title>';
echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">'; 
echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> '; 
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>';
echo '<link rel="stylesheet" type="text/css" href="css/global.css">';
echo '<link rel="stylesheet" type="text/css" href="css/chat.css">';
echo '<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">';
echo '<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>';
echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>';
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>';
echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">';
echo '<script src="https://meet.jit.si/external_api.js"></script>';
echo '</head>';
echo '<body>';

// Inclusion de la barre de navigation
include 'navbar.php';

?>

<body>

    <div id="chatbox">
        <!-- Les Messages sont insérés dynamiquement ici -->
    </div>
    <div id="userSelect">
    <!-- La sélection des utilisateurs est dynamiquement insérés ici -->
        <div id="buttonArea" style="position: fixed; bottom: 0;">
            <button id="messageButton" class="btn btn-primary"><i class="fas fa-comment-dots"></i></button>
            <button id="cameraButton" class="btn btn-primary"><i class="fas fa-camera"></i></button>
            <button id="videoCallButton" class="btn btn-primary"><i class="fas fa-video"></i></button>
        </div>
    </div>


    <div id="videoCall" style="display: none; width: 100%; height: 100%;">
        <!-- The video call will be inserted here -->
    </div>

    <input type="text" id="userInput" placeholder="Ecrivez ici..." />


    <script>
        const supabaseUrl = 'https://bmqgiyygwjnnfyrtjkno.supabase.co';
        const supabaseAnonKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImJtcWdpeXlnd2pubmZ5cnRqa25vIiwicm9sZSI6ImFub24iLCJpYXQiOjE2ODUzNzM1NzcsImV4cCI6MjAwMDk0OTU3N30.sQgvRElC6O5e4uE8OVZqLXBiQYQa83mSkTy4s4L0aDw'

        const envoyerMessage = async (iduser, message, sentTo) => {
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

        const RecupUtilisateurs = async () => {
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



                return data.map(user => ({ iduser: user.iduser, username: user.username })); // assuming each user has a 'username' field
            } catch (error) {
                console.error('Error:', error.message);
            }
        };

        const recevoirMessage = async (user1, user2) => {
            try {
                const response = await fetch(`${supabaseUrl}/rest/v1/messages?or=(sentTo.eq.${user1},sentTo.eq.${user2})`, {
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
                //console.log('Received messages:', data);

                data = data.filter(msg => (parseInt(msg.sentTo) == user2 && parseInt(msg.iduser) == user1) || (parseInt(msg.sentTo) == user1 && parseInt(msg.iduser) == user2));

                // Filter the data to include only the conversation between user1 and user2
                //data = data.filter(msg => (msg.sentTo === user1 && msg.iduser === user2) || (msg.iduser === user1 && msg.sentTo === user2));

                // Sort the data based on the 'time' field in descending order (newest first)
                data.sort((a, b) => new Date(b.time) - new Date(a.time));

                $('#chatbox').empty();
                data.forEach(msg => {
                    $('#chatbox').append(`<p><b>${msg.iduser}:</b> ${msg.message}</p>`);
                });

            } catch (error) {
                console.error('Error:', error.message);
            }
        };

        $(document).ready(async function () {
            const users = await RecupUtilisateurs();
            users.forEach((user) => {
                let userButton = $(`<button class='usernameButton' data-id='${user.iduser}'>${user.username}</button>`);
                userButton.click(function () {
                    $('.usernameButton').removeClass('active');
                    $(this).addClass('active');
                    recevoirMessage(iduser, $(this).data('id'));
                });

                $('#userSelect').append(userButton);
            });

            $('#userInput').keypress(async function (e) {
                if (e.which == 13) { // Enter key pressed
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

                    await envoyerMessage(iduser, message, sentTo);
                    $(this).val(''); // Clear the input field
                }
            });

            setInterval(() => {
                const activeUserId = $('.usernameButton.active').data('id');
                console.log("iduser: ", iduser);
                console.log("activeUserId: ", activeUserId);
                if (activeUserId) {  // check if activeUserId is defined
                    recevoirMessage(iduser, activeUserId);
                }
            }, 500);
            
            $('#messageButton').click(function() {
                $('#chatbox').css('display', 'block'); // Show chatbox
                $('#camera').css('display', 'none');   // Hide camera div
                $(this).addClass('active');
                $('#cameraButton').removeClass('active');
            });

            $('#cameraButton').click(function() {
                $('#chatbox').css('display', 'none');   // Hide chatbox
                $('#camera').css('display', 'block');  // Show camera div
                $(this).addClass('active');
                $('#messageButton').removeClass('active');
            });

            $('#videoCallButton').click(function() {
            $('#chatbox').css('display', 'none');   // Hide chatbox
            $('#videoCall').css('display', 'block');  // Show videoCall div
            $('#camera').css('display', 'none');   // Hide camera div
            $(this).addClass('active');
            $('#messageButton').removeClass('active');
            $('#cameraButton').removeClass('active');

            const domain = 'meet.jit.si';
            const options = {
                roomName: 'JitsiMeetAPIExample', // You might want to use a dynamic room name based on the chat context
                width: '100%',
                height: '100%',
                parentNode: document.querySelector('#videoCall')
            };
            let api = new JitsiMeetExternalAPI(domain, options);
        });
    });



    </script>

</body>

</html>