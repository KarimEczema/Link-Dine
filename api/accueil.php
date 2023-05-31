<?php

$host = "ep-twilight-term-343583-pooler.eu-central-1.postgres.vercel-storage.com";
$port = "5432";
$dbname = "verceldb";
$user = "default";
$password = "Y4vuPQm2xyTl";
$dsn = "pgsql:host=db.bmqgiyygwjnnfyrtjkno.supabase.co;port=5432;dbname=postgres;user=postgres;password=Au5SebXYkT3DUnW4";

// Include the JWT library
require 'path/to/firebase/php-jwt/JWT.php';

use \Firebase\JWT\JWT;

try {
    // create a PostgreSQL database connection
    $conn = new PDO($dsn);
    
    // if form is submitted
    if($_POST){  
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
            if($_POST['Mdp'] === $user['password']){
                // Generate JWT token
                $secretKey = '123';
                $payload = array(
                    'username' => $user['NomUtilisateur'],
                    'exp' => time() + 3600 // Expires in 1 hour
                );
                $jwt = JWT::encode($payload, $secretKey);
                
                // Set JWT as a cookie
                setcookie('jwt', $jwt, time()+3600); 
                
                echo '<meta http-equiv="refresh" content="0; url=accueil.php" />';
                exit;
            }
            else {
                echo "Invalid username or password!";
            }
        }
        else{
            echo "Invalid username or password!";
        }
    }
}
catch (PDOException $e){
    // report error message
    echo $e->getMessage();
}
?>
<link href="css/index.css" rel="stylesheet" type="text/css"/>
</head>
<body>

<?php
if(isset($_POST) && isset($error_message)) {
    echo '<div class="error">' . $error_message . '</div>';
}
?>

<form method="post" action="">
  Username:<br>
  <input type="text" name="NomUtilisateur">
  <br>
  Password:<br>
  <input type="password" name="Mdp">
  <br><br>
  <input type="submit" value="Submit">
</form> 

</body>
</html>
