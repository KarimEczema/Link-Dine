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
    
    // if form is submitted
    if($_POST){  
        // query to check if NomUtilisateur and Mdp are correct
        $sql = "SELECT * FROM 'Users' WHERE NomUtilisateur = :NomUtilisateur AND Mdp = :Mdp";
        $stmt = $conn->prepare($sql);
        
        // bind parameters and execute
        $stmt->bindParam(':NomUtilisateur', $_POST['NomUtilisateur']);
        $stmt->bindParam(':Mdp', $_POST['Mdp']);
        $stmt->execute();
        
        // if the user exists
        if($stmt->rowCount()){
            echo '<meta http-equiv="refresh" content="0; url= acceuil" />';
            exit;
        }
        else{
            echo "Invalid username or password!";
        }
    }
    
}catch (PDOException $e){
    // report error message
    echo $e->getMessage();
}?>

<html>
<head>
    <title>Login</title>
    <!-- Add your CSS styles here -->
</head>
<body>

<h2>Login</h2>
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
