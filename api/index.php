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

$error_message = ""; // initialize error message

try {
    // create a PostgreSQL database connection
    $conn = new PDO($dsn);
    
    // if form is submitted
    if($_POST){  

        $email = $_POST['email'];

        // Check if the email is in the correct format
        if (!preg_match("/^[a-zA-Z0-9._%+-]+@edu.ece.fr$/", $email)) {
            $error_message = "L'adresse mail doit être sous la forme '...........@edu.ece.fr'";
        }
        
        // query to check if username exists
        $sql = "SELECT * FROM users WHERE username = :NomUtilisateur";
        $stmt = $conn->prepare($sql);
        
        // bind parameters and execute
        $stmt->bindParam(':NomUtilisateur', $_POST['NomUtilisateur']);
        $stmt->execute();
        
        // if the user exists
        if($stmt->rowCount()){
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // assuming that your password field is 'Mdp'
            if($email === $user['email']){
                // Generate JWT token
                // Your secret key
                $secretKey = '123';
                $payload = array(
                    'iduser' => $user['iduser'],
                    'exp' => time() + 3600 // Expires in 1 hour
                );
                $alg = 'HS256'; // Specify the desired algorithm here

                $jwt = JWT::encode($payload, $secretKey, $alg);
                
                // Set JWT as a cookie
                setcookie('jwt', $jwt, time()+3600); 
                
                echo '<meta http-equiv="refresh" content="0; url=accueil" />';
                exit;
            }
            else {
                $error_message = "Invalid username or password!";
            }
        }
        else{
            $error_message = "Invalid username or password!";
        }
    }
}
catch (PDOException $e){
    // report error message
    $error_message = $e->getMessage();
}
?>
<link href="css/index.css" rel="stylesheet" type="text/css"/>
</head>
<body>

<div class="error-message"><?php echo $error_message; ?></div>

<form method="post" action="">
  Nom d'utilisateur:<br>
  <input type="text" name="NomUtilisateur">
  <br>
  Adresse mail:<br>
  <input type="text" name="email">
  <br><br>
  <input type="submit" value="Submit">
</form> 

</body>
</html>
