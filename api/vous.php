<?php
include 'login-check.php';

echo '<html>'; 
echo '<head>'; 
echo '<title>Your Page Title</title>'; 

// Here, we're adding the links to Bootstrap CSS and jQuery via their CDNs 
echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">'; 
echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> '; 
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>'; 
echo '<link rel="stylesheet" type="text/css" href="css/vous.css">'; 

?>

<body>
 	<header>
		<div class="container-fluid">
			<div class="row">
				 <div class="col-sm-8"><h3>ECE-in : Social Media Professionnel de l'ECE Paris</h3></div>
				 <div class="col-sm" ><img src="image" width="121" height="49.5"></div>
			</div>		
		</div>
	</header>
	
	<nav class = "navigation">
		<ul id="liste1">
		  <li><a href="accueil">Accueil</a></li>
		  <li><a href="reseau">Mon réseau</a></li>
		  <li><a href="vous">Vous</a></li>
		  <li><a href="notifications">Notifications</a></li>
		  <li><a href="messages">Messageries</a></li>
		  <li><a href="emplois">Emplois</a></li>
		</ul>
	</nav>
 
    <!-- Profil --> 
    <nav class = "profil"> 
            <div class="row"> 
                 <div class="col-sm-4" style = "background-color : purple">Photo</div> 
                 <div class="col-sm-8" style="background-color: red">  
                    <div style = "background-color: green; margin:2%"><h1>Nom de l'utilisateur</h1></div> 
                    <div style = "background-color: blue; margin:2%"><h3>Description de l'utilisateur</h3></div> 
                </div> 
            </div>		 
    </nav> 

    <!-- Formations --> 
    <h1 style="padding-top:10%">Formations</h1> 
 
    <nav class = "formations" style="padding:5%"> 
        <div class="row"> 
            <div class="col-sm-4" style = "background-color : purple">Affichage des dates début/fin</div> 
            <div class="col-sm-8" style="background-color: red">Affichage Nom de la formation/description</div> 
        </div>	 
        <div class="row"> 
        <div class="col-sm-4" style = "background-color : purple">Affichage des dates début/fin</div> 
        <div class="col-sm-8" style="background-color: red">Affichage Nom de la formation/description</div> 
        </div>	 
        <div class="row"> 
            <div class="col-sm-4" style = "background-color : purple">Affichage des dates début/fin</div> 
            <div class="col-sm-8" style="background-color: red">Affichage Nom de la formation/description</div> 
        </div>	 
    </nav> 

    <!-- Ajout formations --> 
    <nav class = "Ajout-formation"> 

        <h1 style = "margin-top : 5% ">Ajouter une formation</h1> 
        <div class="row"> 
            <div class="col-sm-4" style = "background-color : purple"> 
                <h5 style="margin-top:15%">Date de début :</h5> 
                <input type="date" name="Formation-debut" value="2023-06-06" min="1960-01-01" max="2023-12-31" style="margin : 15%"> 
                <br> 
                <h5>Date de fin :</h5> 
                <input type="date" name="Formation-fin" value="2023-06-06" min="1960-01-01" max="2040-12-31" style="margin : 15% "> 
            </div> 
            <div class="col-sm-8" style="background-color: grey">  
               <div style = "background-color: grey; margin:2%"><h5>Titre de la formation : <input type="text" name="Formation-titre" style="margin : 5%"> </h5></div> 
               <div style = "background-color: grey; margin:2%"><h5 style="margin:2%">Description de la formation : <textarea id="Formation-text" rows="10" cols="50" style="margin: 3%;"></textarea> </h5></div> 
           </div> 
           
       </div> 
       <button type="submit"  style = " margin-top : 2%;">Publier</button> 

    </nav> 

    <!-- Projets --> 
    <h1 style="padding:10% ">Projets</h1> 

    <div>  
    <input type="radio" name="position" checked /> 
    <input type="radio" name="position" /> 
    <input type="radio" name="position" /> 
    <input type="radio" name="position" /> 
    <input type="radio" name="position" /> 
    <main id="carousel"> 
    <div class="item">Projet 1</div> 
    <div class="item">Projet 2</div> 
    <div class="item">Projet 3</div> 
    <div class="item">Projet 4</div> 
    <div class="item">Projet 5</div> 
    <main></div> 

    <!--Ajout projet -->
    <nav class = "Ajout-projet"> 
    <h1 style = "margin-top : 5% ">Ajouter un projet</h1> 


       <div style = "background-color: grey; margin:2%"><h5>Nom du projet : <input type="text" name="Projet-titre" style="margin : 5%"> </h5></div> 
       <div style = "background-color: grey; margin:2%"><h5 style="margin:2%"> Description du projet : </h5><textarea id="Projet-text" rows="10" cols="50" style="margin: 3%;"></textarea> </div> 

   
    <button type="submit"  style = " margin-top : 2%;">Publier</button> 
    </nav> 

    <!-- Ajout du CV généré automatiquement -->




    <!-- CV -->

    <nav class = "CV" style="margin-top:2%"> 
        
        <div class="row"> 
            <div class="col-sm-4" style = "background-color : purple; margin : 2%">Photo</div> 
            <div class="col-sm-7" style="background-color: red">  
                <div style = "background-color: green; margin:2%"><h3>Nom de l'utilisateur</h3></div> 
                <div style = "background-color: blue; margin:2%"><h5>Description de l'utilisateur</h5></div> 
            </div> 
        </div> 
        <div> 
            <h4 style="margin-top:5%">Formation(s)</h4> 
        </div> 
        <div class="row"> 
            <div class="col-sm-3" style = "background-color : purple; margin-left : 10%">Date Début / Date Fin</div> 
            <div class="col-sm-6" style="background-color: red">  
                <div style = "background-color: green; margin:2%; margin-right : 10%"><h5>Nom de la formation</h5></div> 
                <div style = "background-color: yellow; margin:2%; margin-right : 10%"><h6>Description de la formation</h6></div> 
            </div> 
        </div> 
        <div class="row"> 
            <div class="col-sm-3" style = "background-color : purple; margin-left : 10%">Date Début / Date Fin</div> 
            <div class="col-sm-6" style="background-color: red">  
                <div style = "background-color: green; margin:2%; margin-right : 10%"><h5>Nom de la formation</h5></div> 
                <div style = "background-color: yellow; margin:2%; margin-right : 10%"><h6>Description de la formation</h6></div> 
            </div> 
        </div> 
        <div class="row"> 
            <div class="col-sm-3" style = "background-color : purple; margin-left : 10%">Date Début / Date Fin</div> 
            <div class="col-sm-6" style="background-color: red">  
                <div style = "background-color: green; margin:2%; margin-right : 10%"><h5>Nom de la formation</h5></div> 
                <div style = "background-color: yellow; margin:2%; margin-right : 10%"><h6>Description de la formation</h6></div> 
            </div> 
        </div> 

        <h4 style="margin-top:5%">Projet(s)</h4> 

        <div class="row"> 
            <div style = "background-color: green; margin-top:2%; margin-left : 10%"><h5>Intitulé du projet -</h5></div> 
            <div style = "background-color: yellow; margin-top:2%; margin-left : 2%; margin-right : 10%"><h6>Description du projet</h6></div> 
        </div> 
        <div class="row"> 
            <div style = "background-color: green; margin-top:2%; margin-left : 10%"><h5>Intitulé du projet -</h5></div> 
            <div style = "background-color: yellow; margin-top:2%; margin-left : 2%; margin-right : 10%"><h6>Description du projet</h6></div> 
        </div> 
        <div class="row"> 
            <div style = "background-color: green; margin-top:2%; margin-left : 10%"><h5>Intitulé du projet -</h5></div> 
            <div style = "background-color: yellow; margin-top:2%; margin-left : 2%; margin-right : 10%"><h6>Description du projet</h6></div> 
        </div> 
        <div class="row"> 
            <div style = "background-color: green; margin-top:2%; margin-left : 10%"><h5>Intitulé du projet -</h5></div> 
            <div style = "background-color: yellow; margin-top:2%; margin-left : 2%; margin-right : 10%"><h6>Description du projet</h6></div> 
        </div> 

        <h6 style = "margin-top: 2%;">Mail</h6> 

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