const supabaseUrl = 'https://bmqgiyygwjnnfyrtjkno.supabase.co';
const supabaseAnonKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImJtcWdpeXlnd2pubmZ5cnRqa25vIiwicm9sZSI6ImFub24iLCJpYXQiOjE2ODUzNzM1NzcsImV4cCI6MjAwMDk0OTU3N30.sQgvRElC6O5e4uE8OVZqLXBiQYQa83mSkTy4s4L0aDw';

let usernameLookup = {};


const envoyerMessage = async (iduser, message, sentTo) => {
    let payload = { iduser, message };

    if (sentTo) {
        payload.sentTo = sentTo;
    }

    try {
        const response = await fetch(`${supabaseUrl}/rest/v1/messages`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'apikey': supabaseAnonKey,
            },
            body: JSON.stringify(payload),
        });

        if (!response.ok) {
            throw new Error('Failed to send message');
        }

        console.log('Message sent successfully');
    } catch (error) {
        console.error('Error:', error.message);
    }
};

const RecupUtilisateurs = async (currentUserId) => {
    try {
        const response = await fetch(`${supabaseUrl}/rest/v1/users?iduser=eq.${currentUserId}&select=username,amis`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'apikey': supabaseAnonKey,
            },
        });


        if (!response.ok) {
            throw new Error('Failed to fetch user data');
        }

        const currentUserData = await response.json();
        console.log(currentUserData);
        // add current user to usernameLookup
        usernameLookup[currentUserId] = currentUserData[0]?.username || 'Unknown user';

        const amis = currentUserData[0]?.amis || [];

        if (amis.length === 0) {
            console.log("The user has no friends.");
            return [];
        }

        // Create a comma-separated string of friend IDs
        const amisIdString = amis.join(',');

        // Now fetch the friends data based on the amis array
        const amisResponse = await fetch(`${supabaseUrl}/rest/v1/users?iduser=in.(${amisIdString})`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'apikey': supabaseAnonKey,
            },
        });

        if (!amisResponse.ok) {
            throw new Error('Failed to fetch friends data');
        }

        const amisData = await amisResponse.json();

        console.log("Amis data: ", amisData);

        return amisData;

    } catch (error) {
        console.error('Failed to fetch user or friends data', error);
    }
};


const recevoirMessage = async (user1, user2) => {
    let url = `${supabaseUrl}/rest/v1/messages?`;
    if (user1 && user2) {
        url += `or=(sentTo.eq.${user1},sentTo.eq.${user2})`;
    }
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

        data = data.filter(msg => (parseInt(msg.sentTo) == user2 && parseInt(msg.iduser) == user1) || (parseInt(msg.sentTo) == user1 && parseInt(msg.iduser) == user2));

        data.sort((a, b) => new Date(b.time) - new Date(a.time));

        $('#chatbox').empty();
        data.forEach(msg => {
            let senderName = (msg.iduser == user1) ? "Vous" : usernameLookup[msg.iduser];
            $('#chatbox').append(`<p><b>${senderName}:</b> ${msg.message}</p>`);
        });

    } catch (error) {
        console.error('Error:', error.message);
    }
};



$(document).ready(async function () {
    const amisData = await RecupUtilisateurs(iduser);

    // Create a lookup object to map user ids to usernames
    usernameLookup = {};
    amisData.forEach((friend) => {
        usernameLookup[friend.iduser] = friend.username; // Add entry to the lookup

        let userButton = $(`<button class='usernameButton' data-id='${friend.iduser}'>${friend.username}</button>`);
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

    $('#messageButton').click(function () {
        $('#chatbox').css('display', 'block'); // Show chatbox
        $('#camera').css('display', 'none');   // Hide camera div
        $(this).addClass('active');
        $('#cameraButton').removeClass('active');
    });

    let api = null;

    $('#videoCallButton').click(function () {
        const selectedUserId = $('.usernameButton.active').data('id');

        if (!selectedUserId) {
            alert('Please select a user to start a video call!');
            return;
        }

        $('#chatbox').css('display', 'none');
        $('#videoCall').css('display', 'block');
        $('#camera').css('display', 'none');
        $(this).addClass('active');
        $('#messageButton').removeClass('active');
        $('#cameraButton').removeClass('active');

        const domain = 'meet.jit.si';

        let roomName;

        if (iduser < selectedUserId) {
            roomName = `${iduser}-${selectedUserId}`;
        } else {
            roomName = `${selectedUserId}-${iduser}`;
        }

        const options = {
            roomName: roomName,
            width: '100%',
            height: '100%',
            parentNode: document.querySelector('#videoCall')
        };

     api = new JitsiMeetExternalAPI(domain, options);
    });

    $('#endCallButton').click(function() {
        if (api) {
            api.dispose();
            api = null;  // Assurez-vous de réinitialiser api à null
        }
    });


    $('#generalChatButton').click(function () {
        $('.usernameButton').removeClass('active');
        $(this).addClass('active');
        recevoirMessage();
    });

    $('#userInput').keypress(async function (e) {
        if (e.which == 13) { // Enter key pressed
            const message = $(this).val().trim();
            const sentTo = $('.usernameButton.active').data('id');

            if ($('#generalChatButton').hasClass('active')) {
                await envoyerMessage(iduser, message);
            } else {
                if (!sentTo) {
                    alert('Please select a user to send message to!');
                    return;
                }


            }

            $(this).val(''); // Clear the input field
        }
    });
});



