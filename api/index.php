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
$host = "ep-twilight-term-343583-pooler.eu-central-1.postgres.vercel-storage.com";
$port = "5432";
$dbname = "verceldb";
$user = "default";
$password = "Y4vuPQm2xyTl";


$dsn = "pgsql:host=db.bmqgiyygwjnnfyrtjkno.supabase.co;port=5432;dbname=postgres;user=postgres;password=Au5SebXYkT3DUnW4";
try{

    // create a PostgreSQL database connection
    $conn = new PDO($dsn);
    
    // display a message if connected to the PostgreSQL successfully
    if($conn){
        echo "Connected to the <strong>$db</strong> database successfully!";
    }
}catch (PDOException $e){
    // report error message
    echo $e->getMessage();
}

?>