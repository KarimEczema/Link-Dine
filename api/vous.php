<?php
include 'login-check.php';

echo '<html>'; 
echo '<head>'; 
echo '<title>Vous</title>'; 

// Here, we're adding the links to Bootstrap CSS and jQuery via their CDNs 
echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">'; 
echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> '; 
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>'; 
echo '<link rel="stylesheet" type="text/css" href="css/vous.css">';
echo '<link rel="stylesheet" type="text/css" href="css/global.css">'; 
echo '<body>';

include 'navbar.php';
?>

<body>
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
               <div style = "background-color: grey; margin:2%"><h5 style="margin:2%">Description de la formation : <textarea id="Formation-text" rows="10" cols="45" wrap="hard" style="margin: 3%;" required></textarea> </h5></div> 
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
    <?php include 'foot.php';?>
</body>
</html>