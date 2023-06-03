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

<?php

// Include the JWT library
require __DIR__ . '/vendor/autoload.php';


$host = "ep-twilight-term-343583-pooler.eu-central-1.postgres.vercel-storage.com";
$port = "5432";
$dbname = "verceldb";
$user = "default";
$password = "Y4vuPQm2xyTl";

$dsn = "pgsql:host=db.bmqgiyygwjnnfyrtjkno.supabase.co;port=5432;dbname=postgres;user=postgres;password=Au5SebXYkT3DUnW4";



use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;


try{
    if($_POST)
    {
        $ecriture = $_POST['write'];
        $image = $_POST['image_uploads'];
        $lieu = $_POST['lieu'];
        $dates = $_POST['dates'];
        $secu = $_POST['secu'];

        //On se connecte à la BDD
        $conn = new PDO($dsn);

        //On insère les données reçues
        $sth = $conn->prepare(" INSERT INTO posts(write, image_uploads, lieu, dates, secu) VALUES(:descriptionpost, :photo, :lieu, :dates, :secu");
        $sth->bindParam(':descriptionpost',$ecriture);
        //$sth->bindParam(':photo',$image);  INSERER L image du post
        $sth->bindParam(':lieu',$lieu);
        $sth->bindParam(':dates',$dates);
        $sth->bindParam(':secu',$secu);
        $sth->execute();
    }
    
}
catch(PDOException $e){
    echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
}
?>


<nav class = "post" style =" background-color: cyan;">
    <form method="post" action="">
        <label for="ameliorer">Creer un post</label><br>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-7"><input type = "text" name="write" id="write" style = "height : 50%" required/></div>
                <div class="col-sm-5">
                    <label for="image_uploads"><img src="https://bmqgiyygwjnnfyrtjkno.supabase.co/storage/v1/object/sign/Images/Photo_site.png?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1cmwiOiJJbWFnZXMvUGhvdG9fc2l0ZS5wbmciLCJpYXQiOjE2ODU2NTA2OTIsImV4cCI6MTY4NjI1NTQ5Mn0.8V7VO2OmDmNFaN6lwNzgsw0zp_qBRhgorvFpWzmQDfc&t=2023-06-01T20%3A18%3A11.492Z"  width="120" height="100" alt="Appareil photo . png"></label>
                    <input type="file" id="image_uploads" name="image_uploads" accept=".jpg, .jpeg, .png" style="display:none">
                    <button type="radio"  style = "margin-top : 10%; margin-left : 3%;">Publier</button>
                    <fieldset>
                        <p>A qui voulez vous le partager ?</p>

                        <div>
                            <input type="radio" id="friend" name="secu" value="friend" checked>
                        <label for="huey">Vos amis</label>
                        </div>

                        <div>
                            <input type="radio" id="all" name="secu" value="all">
                            <label for="dewey">Tout le monde</label>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </form>
    <label for="start">Quand ?</label>
    <input type="date" id="dates" name="dates" value="2023-03-22" min="2015-01-01" max="2026-12-31" style = "text-align : left">
    <label for="where"style = "text-align : right;">Où ?</label>
    <input type="text" id="lieu" name="lieu" style = "margin-left : 10%;">
</nav>

<nav class = "like" style =" background-color: bisque;">
   <h5> Que vous pourriez aimer :</h5><br>
</nav>