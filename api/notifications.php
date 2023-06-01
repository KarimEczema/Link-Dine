<?php
    include 'login-check.php';

echo '<html>';
echo '<head>';
echo '<title>Admin</title>';
echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">'; 
echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> '; 
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>'; 
echo '<link rel="stylesheet" type="text/css" href="css/notifications.css">'; 
echo '<body>';

include 'navbar.php';
?>


<body>
    <nav class = "section">
        <div id = "Semaine">
            <h5 style = "text-align : center; color:red; border: 3px solid black; border-radius: 5%; padding : 3px;"> Evènement de la semaine</h5>
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

        <div id = "Emplois">
                <h5 style = "text-align : center; color:red; border: 3px solid black; border-radius: 5%; padding : 3px;"> Evènement de la semaine</h5>
        </div>
    </nav>
    <?php include 'foot.php';?>
</body>