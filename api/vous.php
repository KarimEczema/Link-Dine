<?php
$host = "ep-twilight-term-343583-pooler.eu-central-1.postgres.vercel-storage.com";
$port = "5432";
$dbname = "verceldb";
$user = "default";
$password = "Y4vuPQm2xyTl";

$dsn = "pgsql:host=db.bmqgiyygwjnnfyrtjkno.supabase.co;port=5432;dbname=postgres;user=postgres;password=Au5SebXYkT3DUnW4";


echo '<html>';
echo '<head>';
echo '<title>ECE-in</title>';

// Here, we're adding the links to Bootstrap CSS and jQuery via their CDNs
echo '<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">';
echo '<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>';
echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>';

?>
<body>
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
<!--

Photo gauche

Nom droite

Description droite

-->

<!-- Création d'un conteneur à 2 colonnes -->
<div class="container features">
        <div class="row">

            <!-- Colonne 1 -->
        <div class="col-lg-4 col-md-4 col-sm-12">
        <h3 class="feature-title">Lorem ipsum</h3>
        <img src="Images/column1.jpg" class="img-fluid">
        <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque interdum quam odio, quis placerat ante 
        luctus eu. Sed aliquet dolor id sapien rutrum, id vulputate quam iaculis.
        </p>
        </div>
            <!-- Colonne 2 -->
        <div class="col-lg-4 col-md-4 col-sm-12">
        <h3 class="feature-title">Lorem ipsum</h3>
        <img src="Images/column2.jpg" class="img-fluid">
        <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque interdum quam odio, quis placerat ante
        luctus eu. Sed aliquet dolor id sapien rutrum, id vulputate quam iaculis.
        </p>
    </div>

<!--
    Formation middle

    Bloc middle

    Affichage des formations database 

-->

<!--
    Ajouter une formation

    Bloc sélection date début et fin

    Nom de formation

-->

<!--
    Projets

    Affichage en carrousel des noms + Description des projets

-->

<!--
    Ajouter un projet

    Nom et description bdd

-->

<!--
    Ajouter un CV (génération automatique) : boutton

-->

<footer>
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6" style = "border : solid; color: black; padding:2px">
					<p>
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

</html>
