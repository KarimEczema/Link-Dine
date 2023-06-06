<?php

echo '<html>';
echo '<head>';
echo '<title>Messagerie</title>';
echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">';
echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">';
echo '<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">';

echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>';
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>';
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>';
echo '<script src="https://meet.jit.si/external_api.js"></script>';

include 'login-check.php';

echo '<link rel="stylesheet" type="text/css" href="css/chat.css">';
echo '<link rel="stylesheet" type="text/css" href="css/global.css">';

echo '</head>';


include 'navbar.php';
?>

<body>



    <div id="chatbox">
    </div>
    <div id="userSelect">
        <div id="buttonArea" style="position: fixed; bottom: 0;">
            <div id="buttonArea" style="position: fixed; bottom: 0;">
                <button id="messageButton" class="btn btn-primary"><i class="fas fa-comment-dots"></i></button>
                <button id="videoCallButton" class="btn btn-primary"><i class="fas fa-video"></i></button>
                <button id="endCallButton" class="btn btn-primary"><i class="fas fa-phone-slash"></i></button>
                <!-- Bouton de fin d'appel -->
            </div>
        </div>
    </div>

    <div id="videoCall" style="display: none; width: 100%; height: 100%;">
    </div>

    <input type="text" id="userInput" placeholder="Ecrivez ici..." style="color: white;" />

    <script src="js/chat.js"></script>

</body>

</html>