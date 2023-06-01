<?php
include 'login-check';

echo '<html>';
echo '<head>';
echo '<title>Admin</title>';
echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">'; 
echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> '; 
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>'; 
echo '<link rel="stylesheet" type="text/css" href="css/vous.css">'; 
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
	<header>
		<div class="container-fluid">
			<div class="row">
				 <div class="col-sm-8"><h3>ECE-in : Social Media Professionnel de l'ECE Paris</h3></div>
				 <div class="col-sm" ><img src="images/LogECE.png" width="121" height="49.5"></div>
			</div>		
		</div>
	</header>
	
	<nav class = "navigation">
		<div class="container-fluid">
				<div class="row">
					 <div class="col-sm-2"><a href="accueil" style = "border : solid; color: black; padding:2px">Accueil</a></div>
					 <div class="col-sm-2"><a href="reseau" style = "border : solid; color: black; padding:2px">Réseau</a></div>
					 <div class="col-sm-2"><a href="vous" style = "border : solid; color: black; padding:2px">Vous</a></div>
					 <div class="col-sm-2"><a href="notifs" style = "border : solid; color: black; padding:2px">Notifications</a></div>
					 <div class="col-sm-2"><a href="chat" style = "border : solid; color: black; padding:2px">Messagerie</a></div>
					 <div class="col-sm-2"><a href="emplois" style = "border : solid; color: black; padding:2px">Emplois</a></div>
				</div>
		</div>
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
    <nav class = "amis" style = "margin-top : 40px;">
        <div id = "friends">
            <h5>Amis en commun</h5>	
        </div>
        <div id="carrousel">
            <ul style ="list-style-type : none;">
                <li><img src="images/Celeste.png" width="120" height="100"></li>
                <li><img src="images/Celeste_LVL8_FaceB.png" width="120" height="100"></li>
                <li><img src="images/CelesteScare.png" width="120" height="100"></li>
                <li><img src="images/CelesteTheo.png" width="120" height="100"></li>
                <li><img src="images/CHIBIARTFORADRIENNE.png" width="120" height="100"></li>
                <li><img src="images/HollowKnightWallPaper.jfif" width="120" height="100"></li>
                <li><img src="images/logECE.png" width="120" height="100"></li>
                <li><img src="images/StreetMordred.jpg" width="120" height="100"></li>
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
	<footer>
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6" style = "border : solid; color: black; padding:2px">
					<p style = "margin-top:25%;">
					Bienvenue sur Link dine, le plus grand réseau professionnel mondial comptant plus de 2 d'utilisateurs dans plus de 0 pays et territoires du monde.
					</p>
				</div>
				<div class="col-sm-6" style = "border : solid; color: black; padding:2px">
					<p style="text-align : center;">Nous contacter</p>
					
					<a href="mailto:adrienne.vidon@edu.ece.fr"> Mail </a>
					<br>
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2625.3661096301935!2d2.2859856116549255!3d48.851228701091536!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6701b4f58251b%3A0x167f5a60fb94aa76!2sECE%20-%20Ecole%20d&#39;ing%C3%A9nieurs%20-%20Engineering%20school.!5e0!3m2!1sfr!2sfr!4v1685461093343!5m2!1sfr!2sfr" width="200" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
				</div>
			</div>
		</div>
	</footer>
</body>