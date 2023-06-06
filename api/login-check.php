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

            $fruit_gradients = array(
                'pomme' => 'background: linear-gradient(45deg, #004225, #00602b, #2b8e36, #61bb41, #9ce848, #d6ff4d, #ffca2b, #ff963a, #ff6249, #ff2f58);',
                'citron' => 'background: linear-gradient(45deg, #73a942, #99c26d, #bee598, #e4ffc4, #f6ff91, #f9ff5e, #fcff2b, #ffff00);',
                'banane' => 'background: linear-gradient(45deg, #567d46, #8ca65c, #c1cf73, #f6f88a, #f8f466, #faf742, #fcf91e, #ffff00);',
                'fraise' => 'background: linear-gradient(45deg, #ffffff, #ffcccc, #ff9999, #ff6666, #ff3333, #ff0000);',
                'myrtille' => 'background: linear-gradient(45deg, #89c975, #9fd391, #b4deae, #cae9cb, #e0f4e7, #d9edf5, #d2e6ff, #b7d0ff, #9cbaff, #809eff, #6673ff, #4c48ff);'
            );

            if (array_key_exists($color, $fruit_gradients)) {
                echo "
                <style>
                body {
                    position: relative;
                    margin: 0;
                    padding: 0;
                }
            
                body::before, body::after {
                    content: \"\";
                    position: fixed;
                    top: 0;
                    bottom: 0;
                    width: 25%;
                    z-index: -1;
                }
            
                body::before {
                    left: 0;
                    {$fruit_gradients[$color]}
                }
            
                body::after {
                    right: 0;
                    {$fruit_gradients[$color]}
                }
                </style>
                ";
            } else {
                echo "<style>body { background: white; }</style>"; // default background color if fruit name is not recognized
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