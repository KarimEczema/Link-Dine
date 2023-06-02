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

$sql = "SELECT * FROM users WHERE iduser= (SELECT amiexplore FROM users WHERE iduser= $iduser)";
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
                            <img src="image" alt="Cet utilisateur n'a pas de photo de profil" width="200" height="200">
                        </div>
                        <div class="col-sm-9">
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


    <nav class = "amis" style = "margin-top : 40px;">
        <div id = "friends">
            <h5>Amis en commun</h5>	
        </div>
        <div id="carrousel">
			<ul id = "listc" style ="list-style-type : none;">
				<li><img src="images/Celeste.png" alt="pp Ami 1" width="120" height="100"></li>
				<li><img src="images/Celeste_LVL8_FaceB.png" alt="pp Ami 2" width="120" height="100"></li>
				<li><img src="images/CelesteScare.png" alt="pp Ami 3" width="120" height="100"></li>
				<li><img src="images/CelesteTheo.png" alt="pp Ami 4" width="120" height="100"></li>
				<li><img src="chibiartforadrienne" alt="pp Ami 5" width="120" height="100"></li>
				<li><img src="images/HollowKnightWallPaper.jfif" alt="pp Ami 6" width="120" height="100"></li>
				<li><img src="images/logECE.png" alt="pp Ami 7" width="120" height="100"></li>
				<li><img src="https://bmqgiyygwjnnfyrtjkno.supabase.co/storage/v1/object/sign/Images/StreetMordred.jpg?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1cmwiOiJJbWFnZXMvU3RyZWV0TW9yZHJlZC5qcGciLCJpYXQiOjE2ODU1NDkyNTYsImV4cCI6MTY4ODE0MTI1Nn0.FOqtr6jvNjSmCcK9k_CeAyBUuo3k_VSmS0VVub_mago&t=2023-05-31T16%3A07%3A38.151Z" width="120" height="100"></li>
				<li><img src="book9.jpg" alt="pp Ami 9" width="120" height="100"></li>
				<li><img src="book10.jpg" alt="pp Ami 10" width="120" height="100"></li>
				<li><img src="book11.jpg" alt="pp Ami 11" width="120" height="100"></li>
				<li><img src="book12.jpg" alt="pp Ami 12" width="120" height="100"></li>
			</ul>
		</div>
		<div id="buttons">
			<input type="button" value="<" class="prev">
			<input type="button" value=">" class="next">
		</div>
	</nav>
	
	<?php include 'foot.php';?>
</body>
</html>
