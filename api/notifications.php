<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Page notifications</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link href="css/notifications.css" rel="stylesheet" type="text/css"/>


</head>

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


<body>
<header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8"><h3>ECE-in : Social Media Professionnel de l'ECE Paris</h3></div>
            <div class="col-sm" ><img src="LogECE.png" width="121" height="49.5"></div>
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
    <div id = "Semaine">
        <h5> Evènement de la semaine</h5>
    </div>

    <div id="carrousel">
    			<ul style ="list-style-type : none;">
    				<li><img src="images/Celeste.png" width="120" height="100"></li>
    				<li><img src="images/Celeste_LVL8_FaceB.png" width="120" height="100"></li>
    				<li><img src="images/CelesteScare.png" width="120" height="100"></li>
    				<li><img src="images/CelesteTheo.png" width="120" height="100"></li>
    				<li><img src="https://bmqgiyygwjnnfyrtjkno.supabase.co/storage/v1/object/sign/Images/CHIBIART%20FOR%20ADRIENNE.png?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1cmwiOiJJbWFnZXMvQ0hJQklBUlQgRk9SIEFEUklFTk5FLnBuZyIsImlhdCI6MTY4NTQ1MzYwOSwiZXhwIjoxNjg4MDQ1NjA5fQ.WPg1DleVb23PFe2EfTDyFgRNIIDuuhwx6LO7DDheIKU&t=2023-05-30T13%3A33%3A29.160Z" width="120" height="100"></li>
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

<nav class="section">
    <div id = "Amis">
            <h5> Evènement de la semaine</h5>
    </div>

    <div class="scroll-container">
            <div class="scroll-page" id="notif-1">
                <h5>Nom de l'amis </h5>
                <h6>à : Action </h6>
                <h6>30/05/2023</h6>
            </div>
            <div class="scroll-page" id="notif-2">
                <h5>Nom de l'amis  </h5>
                <h6>à : Action </h6>
                <h6>30/05/2023</h6>
            </div>
            <div class="scroll-page" id="notif-3">
                <h5>Nom de l'amis  </h5>
                <h6>à : Action </h6>
                <h6>29/05/2023</h6>
            </div>
        </div>

</nav>

<nav class ="CV">
</nav>


<footer>

</footer>
</body>
</html>
