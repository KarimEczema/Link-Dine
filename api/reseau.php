<head>
	<title>ECE-in</title>
	<meta charset="utf-8" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Chargement du JavaScript de Bootstrap -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
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
			function slideImg() {
				setTimeout(function() {
				$img.eq(i).css('display', 'inline').css('transition-delay','0.25s');
				$img.eq(i + 1).css('margin-left','200px').css('display',
				'inline').css('transition-delay','0.5s');
				$img.eq(i + 2).css('margin-left','400px').css('display',
				'inline').css('transition-delay','0.75s');
				$img.eq(i + 3).css('margin-left','600px').css('display',
				'inline').css('transition-delay','1s');
				if (i < max-4) {
				i = i+4;
				} else {
				i = 0;
				}
				$img.css('margin-left','0').css('display', 'none');
				$img.eq(i).css('display', 'inline').css('transition-delay','1.25s');
				$img.eq(i + 1).css('margin-left','200px').css('display',
				'inline').css('transition-delay','1.5s');
				$img.eq(i + 2).css('margin-left','400px').css('display',
				'inline').css('transition-delay','1.75s');
				$img.eq(i + 3).css('margin-left','600px').css('display',
				'inline').css('transition-delay','2s');
				slideImg();
				}, 4000);
			}
			slideImg();
		});
	</script>
</head>

<link href="css/accueil.css" rel="stylesheet" type="text/css"/>
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
					 <div class="col-sm-2"><a href="reseau" style = "border : solid; color: black; padding:2px">Mon Réseau</a></div>
					 <div class="col-sm-2"><a href="vous" style = "border : solid; color: black; padding:2px">Vous</a></div>
					 <div class="col-sm-2"><a href="notifs" style = "border : solid; color: black; padding:2px">Notifications</a></div>
					 <div class="col-sm-2"><a href="messages" style = "border : solid; color: black; padding:2px">Messagerie</a></div>
					 <div class="col-sm-2"><a href="emplois" style = "border : solid; color: black; padding:2px">Emplois</a></div>
				</div>
		</div>
	</nav>
	
	
	
	<div id = "friends">
		<h5 style = "text-align : center; color:#446AA9"> Liste d'amis</h5>	
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
		<!-- Recuperer les noms, les liens et statut + description.-->

	</div>
	<div id="buttons">
		<input type="button" value="<" class="prev">
		<input type="button" value=">" class="next">
	</div>
	
    

	<footer>
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6" style = "border : solid; color: black; padding:2px">
					<p>
						Ce site est une plate-forme en ligne permettant à des utilisateurs
						de se connecter avec son réseau dans un cadre professionnel, vous pouvez ainsi regarder des posts, des évènements ou
						des offres d'emploi.
						Chaque utilisateur peut aussi poster des évènements, des photos, des vidéos, son CV et le/s afficher, partager, etc...
					</p>
				</div>
				<div class="col-sm-6" style = "border : solid; color: black; padding:2px">
					<a mailto="adrienne.vidon@edu.ece.fr">Nous contacter</a>
					<!-- Insertion Maps? -->
				</div>
			</div>
		</div>
	</footer>
</body>
</html>

