<?php
try{
    // create a PostgreSQL database connection
    $conn = new PDO($dsn);

    // if request is received
    if($_POST){
        if(isset($_POST['username'])) {
            // query to delete user
            $sql = "DELETE FROM users WHERE username = :username";
            $stmt = $conn->prepare($sql);

            // bind parameters and execute
            $stmt->bindParam(':username', $_POST['username']);
            $stmt->execute();

            echo "Utilisateur supprimé !";
        }
    }
}catch (PDOException $e){
    // report error message
    echo $e->getMessage();
}
?>
