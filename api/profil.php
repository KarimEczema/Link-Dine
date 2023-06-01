<?php
include 'login-check';

echo '<html>';
echo '<head>';
echo '<title>Admin</title>';
echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">'; 
echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> '; 
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>'; 
echo '<link rel="stylesheet" type="text/css" href="css/profil.css">';
echo '<link rel="stylesheet" type="text/css" href="css/global.css">'; 
echo '<body>';

include 'navbar.php';
include 'caroussel.php';

// Here, we're adding the links to Bootstrap CSS and jQuery via their CDNs
echo '<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">';
echo '<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>';
echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>';

?>

<body>
	<header>
		<div class="container-fluid">
			<div class="row">
				 <div class="col-sm-8"><h3>ECE-in : Social Media Professionnel de l'ECE Paris</h3></div>
				 <div class="col-sm" ><img src="images/LogECE.png" width="121" height="49.5"></div>
			</div>		
		</div>
	</header>
	
	<nav class = "navigation">
		<ul id="liste1">
		  <li><a href="accueil">Accueil</a></li>
		  <li><a href="reseau">Mon réseau</a></li>
		  <li><a href="vous">Vous</a></li>
		  <li><a href="notifications">Notifications</a></li>
		  <li><a href="messages">Messageries</a></li>
		  <li><a href="emplois">Emplois</a></li>
		</ul>
	</nav>

    <nav class = "profil" style = "border : solid; color: black; padding:7px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3">
					<img src="image" width="200" height="200">
				</div>
				<div class="col-sm-9">
					<p><b>  [Nom]</b> [Statut] </p>
					<h6>Description : </h6> 
					<p>Ceci est ma description</p>  
				</div>
			</div>
		</div>
    </nav>
	
    <nav class = "section">
		<div id = "amis">
			<h5 style = "text-align : center; color:white"> Liste d'amis en commun</h5>
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
				<li><img src="book12.jpg" width="120" height="100"></li>w
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