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
        //On se connecte à la BDD
        $conn = new PDO($dsn);

        //On définit certaines variables.
        $ecriture = $_POST['write'];
        $lieu = $_POST['lieu'];
        $date = $_POST['date'];
        $secu = $_POST['secu'];

        //On insère les données reçues
        $sql = "INSERT INTO posts(descriptionpost, iduser, lieu, date, accessibilite) VALUES(:write, :personne, :lieu, :date, :secu)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':write',$ecriture);
        $stmt->bindParam(':personne',$iduser);
        $stmt->bindParam(':lieu',$lieu);
        $stmt->bindParam(':date',$date);
        $stmt->bindParam(':secu',$secu);
        $stmt->execute();
        
        if(isset($_FILES['image_uploads'])) {
            $file_name = $_FILES['image_uploads']['name'];
            $file_tmp = $_FILES['image_uploads']['tmp_name'];
            $file_size = $_FILES['image_uploads']['size'];
        
            $target_dir = "Images/";
            $target_file = $target_dir . basename($file_name);
            echo "Target file: " . $target_file;
            
            $url = 'https://bmqgiyygwjnnfyrtjkno.supabase.co/storage/v1/sign/'.$target_file;
        
            $headers = array(
                'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImJtcWdpeXlnd2pubmZ5cnRqa25vIiwicm9sZSI6ImFub24iLCJpYXQiOjE2ODUzNzM1NzcsImV4cCI6MjAwMDk0OTU3N30.sQgvRElC6O5e4uE8OVZqLXBiQYQa83mSkTy4s4L0aDw',
                'Content-Type: '.mime_content_type($file_tmp),
                'Cache-Control: no-cache',
            );
         
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, file_get_contents($file_tmp));
            
            $response = curl_exec($ch);
        
            // Print out the response
            echo "Response: ";
            var_dump($response);
            
            // Print out the HTTP status code
            echo "HTTP Status Code: ";
            var_dump(curl_getinfo($ch, CURLINFO_HTTP_CODE));
        
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            } else {
                $response_array = json_decode($response, true);
                if(array_key_exists('Key', $response_array)){
                    echo "Image successfully uploaded";
                }else{
                    echo "Failed to upload image";
                }
            }
        
            curl_close ($ch);
        } else {
            // Print out details of the received file if file was not received
            echo "File details: ";
            var_dump($_FILES['image_uploads']);
        }

        //Message de confirmation pour l'utilisateur
         echo "Post publié !";
    }
    
}
catch(PDOException $e){
    echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
}
?>


<nav class = "post" style =" background-color: cyan;">
    <form method="post" action="" enctype="multipart/form-data">
        <label for="ameliorer">Creer un post</label><br>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-7"><textarea name="write" id="write" cols = "50" rows = "10" wrap="hard" required></textarea></div>
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
        <label for="start">Quand ?</label>
        <input type="date" id="date" name="date" value="2023-03-22" min="2015-01-01" max="2026-12-31" style = "text-align : left">
        <label for="where"style = "text-align : right;">Où ?</label>
        <input type="text" id="lieu" name="lieu" style = "margin-left : 10%;">
    </form>
</nav>

<nav class = "like" style =" background-color: bisque;">
   <h5> Que vous pourriez aimer :</h5><br>
</nav>