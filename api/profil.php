<?php

include 'login-check.php';

echo '<html>';
echo '<head>';
echo '<title>Admin</title>';
echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">'; 
echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> '; 
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>'; 
echo '<link rel="stylesheet" type="text/css" href="css/profil.css">';
echo '<link rel="stylesheet" type="text/css" href="css/global.css">';
echo '<link rel="stylesheet" type="text/css" href="css/carrousel.css">';
echo '<body>';

include 'navbar.php';
include 'caroussel.php';

// Here, we're adding the links to Bootstrap CSS and jQuery via their CDNs
echo '<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">';
echo '<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>';
echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>';

?>

<link href="css/profil.css" rel="stylesheet" type="text/css"/>

<body>
<!--
============================================
        Profil de l'ami séléctionné
============================================
-->

<!-- recupération en php des informations de la BDD -->
<?php
$expl = $_GET["id"];

$sql = "SELECT * FROM users WHERE iduser = $expl";
try{
    // Création du contact avec la BDD
    $conn = new PDO($dsn);
    $stmt = $conn->query($sql);

}catch (PDOException $e){
    echo $e->getMessage();
}


?>




	<nav class = "profil" style = "border : solid; color: black; padding:7px">
        <div class="container-fluid">
            <table>
                <tbody>
                <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="<?php echo htmlspecialchars($row['pp']); ?>" alt="Cet utilisateur n'a pas de photo de profil" width="200" height="200">
                        </div>
                        <div class="col-sm-8">
                            <p><b>  <?php echo htmlspecialchars($row['nom']); ?></b> <?php echo htmlspecialchars($row['statut']); ?> </p>
                            <h6>Description : </h6>
                            <p><?php echo htmlspecialchars($row['bio']); ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
                </tbody>
            </table>
		</div>
    </nav>


<!--
============================================
     liste des amis non encore ajoutés
============================================
-->


<?php
try {
// create a PostgreSQL database connection
$conn = new PDO($dsn);

// query to check if username exists
$sql = "SELECT amis FROM users WHERE iduser = ?";
$stmt = $conn->prepare($sql);

// bind parameters and execute
$stmt->execute([$expl]);

$ami = $stmt->fetch();

// Check that the user has friends
if ($ami) {
$ami = explode(',', trim($ami['amis'], '{}')); // convert the array string into a PHP array

// Retrieve the friends' posts
$params = implode(',', array_fill(0, count($ami), '?'));
$stmt = $conn->prepare("SELECT * FROM users WHERE iduser IN ($params)");
$stmt->execute($ami);
$amis = $stmt->fetchAll();

?>

    <div id = "friends" style = "margin-top : 10%;">
        <h5 style = "text-align : center; color:#446AA9"> Liste d'amis</h5>
    </div>

<div id="carrousel">
    <ul id = "listc" style ="list-style-type : none;">
        <?php  foreach ($amis as $mesamis){ ?>
            <li>
                <a href="profil?id=<?php echo $mesamis['iduser'] ; ?>">
                    <img src="<?php echo htmlspecialchars($mesamis['pp']); ?>" alt="<?php echo htmlspecialchars($mesamis['nom']); ?>" width="120" height="100">
                </a>
            </li>
        <?php }
        } else {
            echo "This user has no friends.";
        }
        }catch (PDOException $e) {
            // report error message
            echo $e->getMessage();
        }?>
    </ul>
</div>
<div id="buttons">
    <input type="button" value="<" class="prev">
    <input type="button" value=">" class="next">
</div>


<?php include 'foot.php';?>
</body>
</html>
