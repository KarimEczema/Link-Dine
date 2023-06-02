<?php

include 'login-check.php';

echo '<html>';
echo '<head>';
echo '<title>Accueil</title>';

// Here, we're adding the links to Bootstrap CSS and jQuery via their CDNs
echo '<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>';
echo "Logged in as: " . $iduser;
echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">'; 
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>'; 
echo '<link rel="stylesheet" type="text/css" href="css/accueil.css">';
echo '<link rel="stylesheet" type="text/css" href="css/global.css">';
echo '<link rel="stylesheet" type="text/css" href="css/carrousel.css">';
echo '<body>';

include 'navbar.php';
include 'caroussel.php';
?>

<nav class = "section">
	<div id = "HebdoEvent">
		<h5 style = "text-align : center; color:red"> Evènements de la semaine</h5>
	</div>
	<div id="carrousel">
		<ul id = "listc" style ="list-style-type : none;">
			<li><img src="images/Celeste.png" width="120" height="100"></li>
			<li><img src="images/Celeste_LVL8_FaceB.png" width="120" height="100"></li>	
			<li><img src="images/CelesteScare.png" width="120" height="100"></li>
			<li><img src="images/CelesteTheo.png" width="120" height="100"></li>
			<li><img src="chibiartforadrienne" width="120" height="100"></li>
			<li><img src="images/HollowKnightWallPaper.jfif" width="120" height="100"></li>
			<li><img src="images/logECE.png" width="120" height="100"></li>
			<li><img src="https://bmqgiyygwjnnfyrtjkno.supabase.co/storage/v1/object/sign/Images/StreetMordred.jpg?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1cmwiOiJJbWFnZXMvU3RyZWV0TW9yZHJlZC5qcGciLCJpYXQiOjE2ODU1NDkyNTYsImV4cCI6MTY4ODE0MTI1Nn0.FOqtr6jvNjSmCcK9k_CeAyBUuo3k_VSmS0VVub_mago&t=2023-05-31T16%3A07%3A38.151Z" width="120" height="100"></li>
			<li><img src="book9.jpg" width="120" height="100"></li>
			<li><img src="book10.jpg" width="120" height="100"></li>
			<li><img src="book11.jpg" width="120" height="100"></li>
			<li><img src="book12.jpg" width="120" height="100"></li>
		</ul>
	</div>
	<div id="buttons">
		<input type="button" value="<" class="prev">
		<input type="button" value=">" class="next">
	</div>
</nav>


	<!--
----------   Affichage    ----------
-->


<h1 style="padding:10% ">Time Line</h1>

<?php

$pdo = new PDO($dsn);

// Récupérez les amis de l'utilisateur
$stmt = $pdo->prepare("SELECT amis FROM users WHERE iduser = $iduser");
$stmt->execute([$iduser]);
$ami = $stmt->fetch();

// Vérifiez que l'utilisateur a des amis
if ($ami) {
    $ami = explode(',', trim($ami['ami'], '{}')); // convertir la chaîne de caractères du tableau en un tableau PHP

    // Récupérez les posts des amis
    $params = implode(',', array_fill(0, count($ami), '?'));
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE iduser IN ($params)");
    $stmt->execute($ami);
    $posts = $stmt->fetchAll();

    // Affichez les posts
    foreach ($posts as $post) {
        echo "ID: " . $post['idpost'] . ", Content: " . $post['descriptionpost'] . "<br>";
    }
} else {
    echo "Cet utilisateur n'a pas d'amis.";
}
?>

<?php include 'foot.php';?>
</body>
</html>