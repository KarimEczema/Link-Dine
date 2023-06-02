<?php
include 'login-check.php';

echo '<html>';
echo '<head>';
echo '<title>Réseau</title>';


echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">'; 
echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> '; 
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>'; 
echo '<link rel="stylesheet" type="text/css" href="css/reseau.css">'; 
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

<link href="css/reseau.css" rel="stylesheet" type="text/css"/>
<body>
<?php

$sql = "SELECT iduser, pp, nom FROM users WHERE iduser IN (SELECT amis FROM users WHERE iduser = $iduser)";
try {
    // Création du contact avec la BDD
    $conn = new PDO($dsn);
    $stmt = $conn->query($sql);

} catch (PDOException $e) {
    echo $e->getMessage();
}
?>

	<div id = "friends" style = "margin-top : 10%;">
        <a href = "profil"><h5 style = "text-align : center; color:#446AA9"> Liste d'amis</h5></a>
	</div>

	<div id="carrousel">
			<ul id = "listc" style ="list-style-type : none;">
                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <li>
                        <a href="profil.php?id=<?php echo $row['iduser']; ?>">
                            <img src="<?php echo htmlspecialchars($row['pp']); ?>" alt="<?php echo htmlspecialchars($row['nom']); ?>" width="120" height="100">
                        </a>
                    </li>
                <?php endwhile; ?>
			</ul>
		</div>
	<div id="buttons">
		<input type="button" value="<" class="prev">
		<input type="button" value=">" class="next">
	</div>
	<?php include 'foot.php';?>
</body>
</html>