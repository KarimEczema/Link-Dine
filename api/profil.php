<?php
$host = "ep-twilight-term-343583-pooler.eu-central-1.postgres.vercel-storage.com";
$port = "5432";
$dbname = "verceldb";
$user = "default";
$password = "Y4vuPQm2xyTl";

$dsn = "pgsql:host=db.bmqgiyygwjnnfyrtjkno.supabase.co;port=5432;dbname=postgres;user=postgres;password=Au5SebXYkT3DUnW4";


echo '<html>';
echo '<head>';
echo '<title>Profil</title>';

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
					 <div class="col-sm-2"><a href="messages" style = "border : solid; color: black; padding:2px">Messagerie</a></div>
					 <div class="col-sm-2"><a href="emplois" style = "border : solid; color: black; padding:2px">Emplois</a></div>
				</div>
		</div>
	</nav>

    <nav class = "profil">
        <div class="container-fluid">
            <div class="row">
                    <div class="col-sm-3"><img src="image" width="200" height="200"></div>
                    <div class="col-sm-9">
                        <p>Nom</p><p>Statut</p>
                        <div class="scroll-page">
                            <h6>Description<button type="button" onclick="textecache('span_text3');">...</button> </h6> 
                            <span id="span_text3" style="display: none";>Suite de la description trop longue</span> 
                        </div> 
                    </div>
            </div>
		</div>
    </nav>
    <nav class = "amis">
    <div id = "friends" style = "margin-top : 10%;">
		<h5 style = "text-align : center; color:#446AA9">Amis en commun</h5>	
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

		<!-- Recuperer les noms, les liens et statut + description en php.-->

	</div>
	<div id="buttons">
		<input type="button" value="<" class="prev">
		<input type="button" value=">" class="next">
	</div>
    </nav>
</body>