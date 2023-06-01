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
include 'foot.php';

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
        $img.eq(i+1).css('margin-left','50px').css('display', 'inline');
        $img.eq(i+2).css('margin-left','50px').css('display', 'inline');
        $img.eq(i+3).css('margin-left','50px').css('display', 'inline');
        //si on clique sur « next » ou « > »
        $('.next').click(function () { // image suivante
            i+=4; // on incrémente le compteur
            if (i < max-4) {
            i = i+4;
            $img.css('margin-left','0').css('display', 'none'); //on cache
            $img.eq(i).css('display', 'inline'); //on affiche l'image courante
            $img.eq(i+1).css('margin-left','50px').css('display', 'inline');
            $img.eq(i+2).css('margin-left','50px').css('display', 'inline');
            $img.eq(i+3).css('margin-left','50px').css('display', 'inline'); } 
            else {
            i = 0;
            }
        });
        //si on clique sur « prev » ou « < »
        $('.prev').click(function () { // groupe des images précédentes
            i-=4; // on décrémente le compteur
            if (i >= 0) {
            $img.css('margin-left','0').css('display', 'none'); //on cache
            $img.eq(i).css('display', 'inline'); //on affiche l'image courante
            $img.eq(i+1).css('margin-left','50px').css('display', 'inline');
            $img.eq(i+2).css('margin-left','50px').css('display', 'inline');
            $img.eq(i+3).css('margin-left','50px').css('display', 'inline');
            } else {
            i = 0;
            }
        });
    });
</script>

<link href="css/profil.css" rel="stylesheet" type="text/css"/>

<body>
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
    <?php include 'foot.php';?>
</body>