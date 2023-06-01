<?php

include 'login-check.php';

echo '<html>';
echo '<head>';
echo '<title>Accueil</title>';

// Here, we're adding the links to Bootstrap CSS and jQuery via their CDNs
echo '<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>';
echo "Logged in as: " . $iduser;
echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">'; 
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>'; 
echo '<link rel="stylesheet" type="text/css" href="css/accueil.css">'; 
echo '<link rel="stylesheet" type="text/css" href="css/global.css">'; 
echo '<body>';

include 'navbar.php';
include 'caroussel.php';
?>
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



    <nav class = "section">
        <div id = "Semaine">
            <h5> Evènement de la semaine</h5>
        </div>
        <nav style="padding-bottom: 10%">
        <?php include 'caroussel.php' ?>
        </nav>
        <nav style="padding-top: 3%; padding-bottom: 6%">
            <div id="buttons" >
                <input type="button" value="<" class="prev">
                <input type="button" value=">" class="next">
            </div>
        </nav>

    </nav>

    <nav class="section">
        <div id = "Amis">
            <h5> Que font mes amis</h5>
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
    <?php include 'foot.php' ?>
    
</body>