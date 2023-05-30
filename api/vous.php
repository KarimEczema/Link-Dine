<!DOCTYPE html>
<html>
<head>
<title>ECE-in</title>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="vous.css">


</head>

<body>

    <!-- Header avec inclusions nécessaires -->
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
					 <div class="col-sm-2"><a href="Reseau.html" style = "border : solid; color: black; padding:2px">Mon Réseau</a></div>
					 <div class="col-sm-2"><a href="profil.html" style = "border : solid; color: black; padding:2px">Vous</a></div>
					 <div class="col-sm-2"><a href="notifs.html" style = "border : solid; color: black; padding:2px">Notifications</a></div>
					 <div class="col-sm-2"><a href="messages.html" style = "border : solid; color: black; padding:2px">Messagerie</a></div>
					 <div class="col-sm-2"><a href="emplois" style = "border : solid; color: black; padding:2px">Emplois</a></div>
				</div>		
		</div>
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
            <div class="col-sm-4" style = "background-color : purple">Affichage des date début/fin</div>
            <div class="col-sm-8" style="background-color: red">Affichage Nom de la formation/description</div>
        </div>	
        <div class="row">
        <div class="col-sm-4" style = "background-color : purple">Affichage des date début/fin</div>
        <div class="col-sm-8" style="background-color: red">Affichage Nom de la formation/description</div>
        </div>	
        <div class="row">
            <div class="col-sm-4" style = "background-color : purple">Affichage des date début/fin</div>
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
    <main>
        


<!--
    Ajouter un projet

    Nom et description bdd

-->

<!--
    Ajouter un CV (génération automatique) : boutton

-->

</body>

</html>
