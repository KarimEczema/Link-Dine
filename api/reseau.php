<?php
include 'login-check.php';

echo '<html>';
echo '<head>';
echo '<title>Réseau</title>';

// Here, we're adding the links to Bootstrap CSS and jQuery via their CDNs
echo '<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">';
echo '<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>';
echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>';

?>
<script type="text/javascript">
    $(document).ready(function() {
        var $img = $('#carrousel img');
        var max = $img.length;
        var i = 0; // compteur
        $img.css('margin-left','0').css('display', 'none'); //on cache les images
        $img.eq(i).css('display', 'inline'); //on affiche l'image courante
        $img.eq(i+1).css('margin-left','200px').css('display', 'inline');
        $img.eq(i+2).css('margin-left','400px').css('display', 'inline');
        $img.eq(i+3).css('margin-left','600px').css('display', 'inline');
        //si on clique sur « next » ou « > »
        $('.next').click(function () { // image suivante
            i+=4; // on incrémente le compteur
            if (i < max-4) {
            i = i+4;
            $img.css('margin-left','0').css('display', 'none'); //on cache
            $img.eq(i).css('display', 'inline'); //on affiche l'image courante
            $img.eq(i+1).css('margin-left','200px').css('display', 'inline');
            $img.eq(i+2).css('margin-left','400px').css('display', 'inline');
            $img.eq(i+3).css('margin-left','600px').css('display', 'inline'); } else {
            i = 0;
            }
        });
        //si on clique sur « prev » ou « < »
        $('.prev').click(function () { // groupe des images précédentes
            i-=4; // on décrémente le compteur
            if (i >= 0) {
            $img.css('margin-left','0').css('display', 'none'); //on cache
            $img.eq(i).css('display', 'inline'); //on affiche l'image courante
            $img.eq(i+1).css('margin-left','200px').css('display', 'inline');
            $img.eq(i+2).css('margin-left','400px').css('display', 'inline');
            $img.eq(i+3).css('margin-left','600px').css('display', 'inline');
            } else {
            i = 0;
            }
        });
    });
</script>

<link href="css/reseau.css" rel="stylesheet" type="text/css"/>
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
		  <li><a href="acceuil">Acceuil</a></li>
		  <li><a href="reseau">Mon réseau</a></li>
		  <li><a href="vous">Vous</a></li>
		  <li><a href="notifications">Notifications</a></li>
		  <li><a href="messages">Messageries</a></li>
		  <li><a href="emplois">Emplois</a></li>
		</ul>
	</nav>
	
	
	
	<div id = "friends" style = "margin-top : 10%;">
        <a href = "profil"><h5 style = "text-align : center; color:#446AA9"> Liste d'amis</h5></a>
	</div>
	<div id="carrousel">
		<ul style ="list-style-type : none;">
			<li>
				<a href="profil">
				<img src="https://bmqgiyygwjnnfyrtjkno.supabase.co/storage/v1/object/sign/Images/StreetMordred.jpg?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1cmwiOiJJbWFnZXMvU3RyZWV0TW9yZHJlZC5qcGciLCJpYXQiOjE2ODU1NDkyNTYsImV4cCI6MTY4ODE0MTI1Nn0.FOqtr6jvNjSmCcK9k_CeAyBUuo3k_VSmS0VVub_mago&t=2023-05-31T16%3A07%3A38.151Z"" width="120" height="100">
				</a>
			</li>
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

		<!-- Recuperer les noms, les liens et statut + description en php.-->

	</div>
	<div id="buttons">
		<input type="button" value="<" class="prev">
		<input type="button" value=">" class="next">
	</div>
	
    
    
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

