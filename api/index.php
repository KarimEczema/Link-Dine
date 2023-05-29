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
        // query to check if username and password are correct
        $sql = "SELECT * FROM users WHERE username = :username AND password = :password";
        $stmt = $conn->prepare($sql);
        
        // bind parameters and execute
        $stmt->bindParam(':username', $_POST['username']);
        $stmt->bindParam(':password', $_POST['password']);
        $stmt->execute();
        
        // if the user exists
   // if the user exists
    if($stmt->rowCount()){
        ob_start();
        //echo '<meta http-equiv="refresh" content="0; url=html/Accueil.html" />';
        header("Location: html\Accueil.html");
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
<body>

<h2>Login</h2>

<form method="post" action="">
  Username:<br>
  <input type="text" name="username">
  <br>
  Password:<br>
  <input type="password" name="password">
  <br><br>
  <input type="submit" value="Submit">
</form> 

</body>
</html>
