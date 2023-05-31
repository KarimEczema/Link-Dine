<?php
$host = "ep-twilight-term-343583-pooler.eu-central-1.postgres.vercel-storage.com";
$port = "5432";
$dbname = "verceldb";
$user = "default";
$password = "Y4vuPQm2xyTl";

$dsn = "pgsql:host=db.bmqgiyygwjnnfyrtjkno.supabase.co;port=5432;dbname=postgres;user=postgres;password=Au5SebXYkT3DUnW4";


echo '<html>';
echo '<head>';
echo '<title>Your Page Title</title>';

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

<!-- <link href="css/accueil.css" rel="stylesheet" type="text/css"/> -->
<body>
	<header>
		<div class="container-fluid">
			<div class="row">
				 <div class="col-sm-8"><h3>ECE-in : Social Media Professionnel de l'ECE Paris</h3></div>
				 <div class="col-sm" ><img src="https://bmqgiyygwjnnfyrtjkno.supabase.co/storage/v1/object/sign/Images/CHIBIART%20FOR%20ADRIENNE.png?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1cmwiOiJJbWFnZXMvQ0hJQklBUlQgRk9SIEFEUklFTk5FLnBuZyIsImlhdCI6MTY4NTQ1MzYwOSwiZXhwIjoxNjg4MDQ1NjA5fQ.WPg1DleVb23PFe2EfTDyFgRNIIDuuhwx6LO7DDheIKU&t=2023-05-30T13%3A33%3A29.160Z" width="121" height="49.5"></div>
			</div>		
		</div>
	</header>
	
	<nav class = "navigation">
		<div class="container-fluid">
				<div class="row">
					 <div class="col-sm-2"><a href="accueil" style = "border : solid; color: black; padding:2px">Accueil</a></div>
					 <div class="col-sm-2"><a href="Reseau" style = "border : solid; color: black; padding:2px">Mon Réseau</a></div>
					 <div class="col-sm-2"><a href="admin" style = "border : solid; color: black; padding:2px">Vous</a></div>
					 <div class="col-sm-2"><a href="notifications" style = "border : solid; color: black; padding:2px">Notifications</a></div>
					 <div class="col-sm-2"><a href="messages" style = "border : solid; color: black; padding:2px">Messagerie</a></div>
					 <div class="col-sm-2"><a href="emplois" style = "border : solid; color: black; padding:2px">Emplois</a></div>
				</div>		
		</div>
	</nav>
	
	
	
	<nav class = "section">

		<div id = "ajout">
			<button type="" style = "text-align : center; color:red"> Ajouter un compte</button>
		</div>

        <div id = "suppr">
			<button type="" style = "text-align : center; color:red"> Supprimer un compte</button>
		</div>
		
	</nav>
	
	<footer>
	
	</footer>
</body>
</html>


