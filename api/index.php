<?php

// Inclusion de la Bibliothèque pour les tokens JWT
require __DIR__ . '/vendor/autoload.php';

// Données nécessaire à la connection à la base de données supabase
$host = "ep-twilight-term-343583-pooler.eu-central-1.postgres.vercel-storage.com";
$port = "5432";
$dbname = "verceldb";
$user = "default";
$password = "Y4vuPQm2xyTl";

$dsn = "pgsql:host=db.bmqgiyygwjnnfyrtjkno.supabase.co;port=5432;dbname=postgres;user=postgres;password=Au5SebXYkT3DUnW4";

//Importation des fonction nécessaire pour la création des tokens JWT
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

$message_erreur = ""; // Initialisation du message d'erreur

try {
    // Connection à la base de données ProstgreSQL
    $conn = new PDO($dsn);
    
    // Si le form est remplis
    if($_POST){  

        $email = $_POST['email'];

        // Si l'email n'est pas dans le bon format
        
        
        // Si le nom d'utilisateur existe dans la base de données
        $sql = "SELECT * FROM users WHERE username = :NomUtilisateur";
        $stmt = $conn->prepare($sql);
        
        // Associé les paramètres et executé
        $stmt->bindParam(':NomUtilisateur', $_POST['NomUtilisateur']);
        $stmt->execute();
        
        // Si l'utilisateur existe 
        if($stmt->rowCount()){
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!preg_match("/^[a-zA-Z0-9._%+-]+@edu.ece.fr$/", $email)) {
                $message_erreur = "L'adresse mail doit être sous la forme '...........@edu.ece.fr'";
            }
            // Si l'email rentré correspond à l'email associé à l'utilisateur
            else if($email === $user['email']){
                // Generation du token JWT
                // Clef secrete
                $secretKey = 'fZabvRw78VA746';
                $payload = array(
                    'iduser' => $user['iduser'],
                    'exp' => time() + 3600 // Expire 1h apres le login
                );
                $alg = 'HS256'; // Algorithme utilisé

                $jwt = JWT::encode($payload, $secretKey, $alg);
                
                // Création du cookie avec le token
                setcookie('jwt', $jwt, time()+3600); 
                
                echo '<meta http-equiv="refresh" content="0; url=accueil" />';
                exit;
            }
            else {
                $message_erreur = "Combinaison Nom d'Utilisateur et Email erroné";
            }
        }
        else{
            $message_erreur = "Combinaison Nom d'Utilisateur et Email erroné";
        }
    }
}
catch (PDOException $e){
    // Message d'erreur
    $message_erreur = $e->getMessage();
}
?>
<!-- Inclusion du css -->
<link href="css/index.css" rel="stylesheet" type="text/css"/>
</head>

<body>

<!-- Si le message d'erreur existe -->
<?php if($message_erreur): ?>
  <div class="message-erreur"><?php echo $message_erreur; ?></div>
<?php endif; ?>

<!-- Box de saisie -->
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
