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
		<div id = "Emplois">
			<h5 style = "text-align : center; color:red"> Offres d'emploi</h5>
        </div>

        <div class="scroll-container">
          <div class="scroll-page" id="page-1">1</div>
          <div class="scroll-page" id="page-2">2</div>
          <div class="scroll-page" id="page-3">3</div>
        </div>


	</nav>

	<nav class ="CV">
	</nav>


	<footer>

	</footer>
</body>
</html>

