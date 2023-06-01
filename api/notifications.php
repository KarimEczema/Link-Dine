<?php
    include 'login-check.php';

echo '<html>';
echo '<head>';
echo '<title>Admin</title>';
echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">'; 
echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> '; 
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>'; 
echo '<link rel="stylesheet" type="text/css" href="css/accueil.css">';
echo '<link rel="stylesheet" type="text/css" href="css/global.css">';
echo '<body>';

include 'navbar.php';
?>


<body>
    <nav class = "section">
        <div id = "Semaine" style = "color:red;">
            <h5> Evènement de la semaine</h5>
        </div>
        <nav style="padding-bottom: 10%">
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
        </nav>
        <div id="buttons" >
            <input type="button" value="<" class="prev">
            <input type="button" value=">" class="next">
        </div>
    </nav>

    <nav class="section" style = "color : black;">
        <div id = "Amis">
            <h5> Que font mes amis</h5>
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

    <?php include 'foot.php' ?>
    
</body>
</html>
