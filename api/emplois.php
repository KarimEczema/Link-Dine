<?php include 'login-check.php'; 

?>

<?php
$dsn = "pgsql:host=db.bmqgiyygwjnnfyrtjkno.supabase.co;port=5432;dbname=postgres;user=postgres;password=Au5SebXYkT3DUnW4";


echo '<html>';
echo '<head>';
echo '<title>Emploi</title>';

// Here, we're adding the links to Bootstrap CSS and jQuery via their CDNs
echo '<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">';
echo '<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>';
echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>';

?>

<script type="text/javascript"> 
    function textecache(ntexte){ 
        var span =document.getElementById(ntexte); 
        if(span.style.display === "none") 
        { 
            span.style.display="inline"; 
        } 
        else 
        { 
            span.style.display="none"; 
        } 
    }
</script> 

<link href="css/emploi.css" rel="stylesheet" type="text/css"/>

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
		<ul id="liste1">
		  <li><a href="acceuil">Acceuil</a></li>
		  <li><a href="reseau">Mon réseau</a></li>
		  <li><a href="vous">Vous</a></li>
		  <li><a href="notifications">Notifications</a></li>
		  <li><a href="messages">Messageries</a></li>
		  <li><a href="emplois">Emplois</a></li>
		</ul>
	</nav>



    <nav class = "section"> 
        <div id = "Emplois"> 
            <h5> Offres d'emploi</h5> 
        </div> 
 
        <div class="scroll-container"> 
            <div class="scroll-page" id="formation-1"> 
                <h5><B>Intitulé du poste</B>Employeur</h5> 
                <h6>Type de contrat </h6> <br> 
                <h6>Description du poste <button type="button" onclick="textecache('span_text1');">...</button> </h6> 
                <span id="span_text1" style="display: none";>Suite de la description trop longue</span> 
                <h6>Salaire</h6> 
            </div> 
            <div class="scroll-page" id="formation-2"> 
                <h5><B>Intitulé du poste</B>- Employeur </h5> 
                <h6>Type de contrat </h6> <br> 
                <h6>Description du poste <button type="button" onclick="textecache('span_text2');">...</button> </h6> 
                <span id="span_text2" style="display: none";>Suite de la description trop longue</span> 
                <h6>Salaire</h6> 
            </div> 
            <div class="scroll-page" id="formation-3"> 
                <h5><B>Intitulé du poste</B>- Employeur </h5> 
                <h6>Type de contrat </h6> <br> 
                <h6>Description du poste <button type="button" onclick="textecache('span_text3');">...</button> </h6> 
                <span id="span_text3" style="display: none";>Suite de la description trop longue</span> 
                <h6>Salaire</h6> 
            </div> 
        </div> 
    </nav> 


    <footer>
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6" style = "border : solid; color: black; padding:2px">
					<p style = "margin-top:10%;">
					Bienvenue sur Link dine, le plus grand réseau professionnel mondial comptant plus de 2 d'utilisateurs dans plus de 0 pays et territoires du monde.
					</p>
				</div>
				<div class="col-sm-6" style = "border : solid; color: black; padding:2px">
					<p style="text-align : center;">Nous contacter</p>
					
					<a href="mailto:adrienne.vidon@edu.ece.fr"> Mail </a>
					<br>
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2625.3661096301935!2d2.2859856116549255!3d48.851228701091536!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6701b4f58251b%3A0x167f5a60fb94aa76!2sECE%20-%20Ecole%20d&#39;ing%C3%A9nieurs%20-%20Engineering%20school.!5e0!3m2!1sfr!2sfr!4v1685461093343!5m2!1sfr!2sfr" width="100" height="100" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
				</div>
			</div>
		</div>
	</footer>
</body>
 