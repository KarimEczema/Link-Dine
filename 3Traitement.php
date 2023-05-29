<!DOCTYPE html>
<html>
<body>

<h2>Menu de traitement des employés</h2>

<p>Choisissez une option de traitement :</p>

<ul>
  <li><a href="3Traitement.php">Ajouter un nouvel employé et afficher tous les employés</a></li>
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
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tpnote2";



// Créez la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifiez la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>