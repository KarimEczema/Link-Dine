<?php

include 'login-check.php';

echo '<html>';
echo '<head>';
echo '<title>Auteur</title>';

// Here, we're adding the links to Bootstrap CSS and jQuery via their CDNs
echo '<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>';
echo "Logged in as: " . $iduser;
echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">'; 
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>'; 
echo '<link rel="stylesheet" type="text/css" href="css/auteur.css">';
echo '<link rel="stylesheet" type="text/css" href="css/global.css">';
echo '<link rel="stylesheet" type="text/css" href="css/carrousel.css">';
echo '<body>';

include 'navbar.php';
?>


<nav class = "post">
    <form method="post" action="traitement.php">
        <label for="ameliorer">Creer un post</label><br>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-7"><textarea name="ameliorer" id="ameliorer" rows="10" cols="50" style="margin-right: 10%;" required></textarea></div>
                <div class="col-sm-2">
                    <label for="image_uploads"><img src="https://bmqgiyygwjnnfyrtjkno.supabase.co/storage/v1/object/sign/Images/Photo_site.png?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1cmwiOiJJbWFnZXMvUGhvdG9fc2l0ZS5wbmciLCJpYXQiOjE2ODU2NTA2OTIsImV4cCI6MTY4NjI1NTQ5Mn0.8V7VO2OmDmNFaN6lwNzgsw0zp_qBRhgorvFpWzmQDfc&t=2023-06-01T20%3A18%3A11.492Z"  width="120" height="100" alt="Appareil photo . png"></label>
                    <input type="file" id="image_uploads" name="image_uploads" accept=".jpg, .jpeg, .png" style="display:none">
                    <button type="radio"  style = "margin-top : 10%; margin-left : 3%;">Publier</button>
                    <fieldset>
                        <legend>A qui voulez vous le partager ?</legend>

                        <div>
                            <input type="radio" id="huey" name="drone" value="huey" checked>
                        <label for="huey">Vos amis</label>
                        </div>

                        <div>
                            <input type="radio" id="dewey" name="drone" value="dewey">
                            <label for="dewey">Tout le monde</label>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </form>
</nav>