<!DOCTYPE html>
<html>
<body>

<h2>Menu de traitement des employés</h2>

<p>Choisissez une option de traitement :</p>

<ul>
  <li><a href="3TraitementA.php">Ajouter un nouvel employé et afficher tous les employés</a></li>
  <li><a href="3TraitementB.php">Supprimer un employé et afficher tous les employés</a></li>
  <li><a href="3TraitementC.php">Afficher tous les employés par ordre croissant de salaire</a></li>
  <li><a href="3TraitementD.php">Afficher tous les employés par ordre décroissant d'ID</a></li>
  <li><a href="3TraitementE.php">Afficher le salaire minimum et maximum</a></li>
  <li><a href="3TraitementF.php">Afficher le salaire moyen et le nombre total d'employés</a></li>
  <li><a href="3TraitementG.php">Compte le nombre de l’ID_Travail distinct dans la table</a></li>
  <li><a href="3TraitementH.php">Affiche tous les champs de tous les employés dont le patron a un ID de 100</a></li>
</ul>

</body>
</html>

<?php
$host = "your_host_here";
$port = "your_port_here";
$dbname = "your_database_name_here";
$user = "your_username_here";
$password = "your_password_here";

$dsn = "pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password";

try {
    // create a PostgreSQL database connection
    $conn = new PDO($dsn);

    // display a message if connected to the PostgreSQL successfully
    if($conn){
        echo "Connected to the <strong>$dbname</strong> database successfully!";
        
        // SQL script to select and order data
        $sql = "SELECT * FROM test_table ORDER BY name ASC";

        // prepare and execute the SQL script
        $result = $conn->query($sql);

        // loop through the result set and display the data
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "ID: " . $row['id'] . ", Name: " . $row['name'] . ", Email: " . $row['email'] . "<br>";
        }
    }
} catch (PDOException $e) {
    // report error message
    echo $e->getMessage();
}
?>