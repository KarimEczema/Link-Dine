<?php
// Inclure la bibliothèque JWT
require __DIR__ . '/vendor/autoload.php';

$host = "ep-twilight-term-343583-pooler.eu-central-1.postgres.vercel-storage.com";
$port = "5432";
$dbname = "verceldb";
$user = "default";
$password = "Y4vuPQm2xyTl";

$dsn = "pgsql:host=db.bmqgiyygwjnnfyrtjkno.supabase.co;port=5432;dbname=postgres;user=postgres;password=Au5SebXYkT3DUnW4";

use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

// Votre clé secrète
$secretKey = new Key('fZabvRw78VA746', 'HS256');

// Vérifier si le JWT existe dans le cookie
if (isset($_COOKIE['jwt'])) {
    // Obtenir le JWT du cookie
    $jwt = $_COOKIE['jwt'];

    try {
        // Décoder le JWT
        $decoded = JWT::decode($jwt, $secretKey);

        // Get the username from the decoded payload
        $iduser = $decoded->iduser;

        echo '<script>';
        echo 'var iduser = "' . $iduser . '";';
        echo '</script>';

        $sql = "SELECT fond FROM users WHERE iduser= $iduser";


        try {
            // Création du contact avec la BDD
            $conn = new PDO($dsn);
            $stmt = $conn->query($sql);

            // Get the color from the query result
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $color = $result['fond'];

            //echo 'The background color is: ' . $color;

            echo '<style>';
            echo $color;
            if ($color == 69420) {
                echo '.bg {
            background: red; /* For browsers that do not support gradients */
            background: -webkit-linear-gradient(left, orange , yellow, green, cyan, blue, violet);
            background: -o-linear-gradient(right, orange, yellow, green, cyan, blue, violet);
            background: -moz-linear-gradient(right, orange, yellow, green, cyan, blue, violet);
            background: linear-gradient(to right, orange , yellow, green, cyan, blue, violet);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: rainbow 5s ease-in-out infinite;
                }

                @keyframes rainbow {
                    0%{background-position:0%}
                    100%{background-position:100%}
                }
            ';
            } else {
                echo '.bg { background-color: #' . $color . '; }';
            }

            echo '</style>';

        } catch (PDOException $e) {
            echo $e->getMessage();
        }


    } catch (Exception $e) {
        // La validation du JWT a échoué
        // Rediriger vers la page de connexion ou afficher le message d'erreur
        echo 'Veuillez vous connecter: ' . $e->getMessage();
        echo '<meta http-equiv="refresh" content="0; url=index" />';
        exit;
    }
} else {

    // Le JWT n'est pas défini, l'utilisateur n'est pas connecté
    // Rediriger vers la page de connexion ou afficher le message d'erreur
    echo 'Veuillez vous connecter';
    echo '<meta http-equiv="refresh" content="0; url=index" />';
    exit;
}