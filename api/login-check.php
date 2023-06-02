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
        
        // Obtenir le nom d'utilisateur du payload décodé
        $iduser = $decoded->iduser;
        
        echo '<script>';
        echo 'var idUser = "' . $iduser . '";';
        echo '</script>';
        // Continuer le traitement ou rediriger vers la page authentifiée

        echo '<script>';
        echo 'var username = "' . $iduser . '";';
        echo '</script>';
        
    } catch (Exception $e) {
        // La validation du JWT a échoué
        // Rediriger vers la page de connexion ou afficher le message d'erreur
        echo 'Erreur: ' . $e->getMessage();
        header('Location: index.php');
        exit;
    }
} else {
    // Le JWT n'est pas défini, l'utilisateur n'est pas connecté
    // Rediriger vers la page de connexion ou afficher le message d'erreur
    echo 'non';
    header('Location: index.php');
    exit;
}

?>