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
        $sql = "SELECT * FROM users WHERE username = :NomUtilisateur AND password = :Mdp";
        $stmt = $conn->prepare($sql);
        
        // bind parameters and execute
        $stmt->bindParam(':NomUtilisateur', $_POST['NomUtilisateur']);
        $stmt->bindParam(':Mdp', $_POST['Mdp']);
        $stmt->execute();
        
        // if the user exists
        if($stmt->rowCount()){
            echo '<meta http-equiv="refresh" content="0; url= vous" />';
            exit;
        }
        else{
            echo "Invalid username or password!";
        }
    }
    
}catch (PDOException $e){
    // report error message
    echo $e->getMessage();
}
?>

<html>
<head>
    <title>Login</title>
    <style>
body {
    font-family: Arial, sans-serif;
    background: #333;
    color: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    animation: Gradient 15s ease infinite;
    background-size: 200% 200%;
    background-position: center center;
    background-image: linear-gradient(45deg, #333, #444, #555, #666);
}

@keyframes Gradient {
    0% {
        background-position: 100% 0%;
    }
    50% {
        background-position: 0% 100%;
    }
    100% {
        background-position: 100% 0%;
    }
}

form {
    background: rgba(68, 68, 68, 0.9);
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
    text-align: center;
}

input[type="text"], input[type="password"] {
    margin: 10px 0;
    padding: 10px;
    width: 200px;
    border: none;
    border-radius: 5px;
}

input[type="submit"] {
    padding: 10px 20px;
    border: none;
    color: #fff;
    background-color: #888;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s ease;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
}

input[type="submit"]:hover {
    background-color: #555;
    transform: scale(1.05);
    box-shadow: 0px 0px 20px rgba(255, 255, 255, 0.5);
}

h2 {
    margin-bottom: 20px;
}

.error {
    color: #ff0000;
    margin-bottom: 20px;
}

    </style>
</head>
<body>

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
