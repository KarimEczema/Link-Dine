<!DOCTYPE html>
<html>
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
					 <div class="col-sm-2"><a href="accueil.html" style = "border : solid; color: black; padding:2px">Accueil</a></div>
					 <div class="col-sm-2"><a href="Reseau.html" style = "border : solid; color: black; padding:2px">Mon Réseau</a></div>
					 <div class="col-sm-2"><a href="profil.html" style = "border : solid; color: black; padding:2px">Vous</a></div>
					 <div class="col-sm-2"><a href="notifs.html" style = "border : solid; color: black; padding:2px">Notifications</a></div>
					 <div class="col-sm-2"><a href="messages.html" style = "border : solid; color: black; padding:2px">Messagerie</a></div>
					 <div class="col-sm-2"><a href="emplois.html" style = "border : solid; color: black; padding:2px">Emplois</a></div>
				</div>
		</div>
	</nav>



	<nav class = "section">
		<div id = "Event">
			<h5 style = "text-align : center; color:red"> Evennements</h5>

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
			<!-- Ce serait cool de mettre une musique ^^ -->
			<!-- <div id="audio"> -->
				<!-- <audio controls autoplay loop> -->
				 <!-- <source src="serenity.mp3" type="audio/ogg"> -->
				 <!-- <source src="river.mp3" type="audio/mpeg"> -->
				<!-- </audio> -->
			<!-- </div> -->

		</div>
		<div id="buttons">
			<input type="button" value="<" class="prev">
			<input type="button" value=">" class="next">
		</div>
	</nav>

	<nav class = "post">
		<form method="post" action="traitement.php">
			<label for="ameliorer">Creer un post</label><br>
			<div class="container-fluid">
				<div class="row">
					 <div class="col-sm-2"><textarea name="ameliorer" id="ameliorer" rows="10" cols="50" style="margin-right: 35px;"></textarea></div>
					 <div class="col-sm-2">
						<input type="file" id="image" name="image" accept="image/png, image/jpeg" style = "margin-left : 280% ; margin-top : 90%;">
						<button type="submit"  style = "margin-left : 280%; margin-top : 10%;">Publier</button>
					 </div>
				</div>
		</form>
	</nav>

	<nav class ="CV">
	</nav>


	<footer>

	</footer>
</body>
</html>
