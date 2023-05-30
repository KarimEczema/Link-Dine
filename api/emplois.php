<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>TD JQuery</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link href="css/emploi.css" rel="stylesheet" type="text/css"/>


</head>

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
    <div id = "Emplois">
        <h5 style = "text-align : center; color:red; border: 3px solid black; border-radius: 5%; padding : 3px;"> Offres d'emploi</h5>
    </div>

    <div class="scroll-container">
        <div class="scroll-page" id="formation-1">
            <h5><B>Intitulé du poste</B>- Employeur </h5>
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

<nav class ="CV">
</nav>


<footer>

</footer>
</body>
</html>
