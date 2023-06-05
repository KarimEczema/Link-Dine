<?php

$host = "ep-twilight-term-343583-pooler.eu-central-1.postgres.vercel-storage.com";
$port = "5432";
$dbname = "verceldb";
$user = "default";
$password = "Y4vuPQm2xyTl";

$dsn = "pgsql:host=db.bmqgiyygwjnnfyrtjkno.supabase.co;port=5432;dbname=postgres;user=postgres;password=Au5SebXYkT3DUnW4";

try {
    // create a PostgreSQL database connection
    $conn = new PDO($dsn);

    // if request is received
    if ($_POST) {
        if (isset($_POST['username'])) {
            // query to delete user
            $sql = "DELETE FROM users WHERE username = :username";
            $stmt = $conn->prepare($sql);

            // bind parameters and execute
            $stmt->bindParam(':username', $_POST['username']);
            $stmt->execute();

            echo "Utilisateur supprimé !";
        }
    }
} catch (PDOException $e) {
    // report error message
    echo $e->getMessage();
}
?>