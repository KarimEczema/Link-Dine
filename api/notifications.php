<?php
    include 'login-check.php';
?>

<?php
$dsn = "pgsql:host=db.bmqgiyygwjnnfyrtjkno.supabase.co;port=5432;dbname=postgres;user=postgres;password=Au5SebXYkT3DUnW4";


echo '<html>';
echo '<head>';
echo '<title>Admin</title>';
echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">'; 
echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> '; 
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>'; 
echo '<link rel="stylesheet" type="text/css" href="css/notifications.css">';
echo '<link rel="stylesheet" type="text/css" href="css/global.css">'; 
echo '<body>';

include 'navbar.php';
include 'foot.php';
?>

<script type="text/javascript">
    $(document).ready(function() {
        var $img = $('#carrousel img');
        var max = $img.length;
        var i = 0; // compteur
        $img.css('margin-left','0').css('display', 'none'); //on cache les images
        $img.eq(i).css('display', 'inline'); //on affiche l'image courante
        $img.eq(i+1).css('margin-left','200px').css('display', 'inline');
        $img.eq(i+2).css('margin-left','400px').css('display', 'inline');
        $img.eq(i+3).css('margin-left','600px').css('display', 'inline');
        //si on clique sur « next » ou « > »
        $('.next').click(function () { // image suivante
            i+=4; // on incrémente le compteur
            if (i < max-4) {
                i = i+4;
                $img.css('margin-left','0').css('display', 'none'); //on cache
                $img.eq(i).css('display', 'inline'); //on affiche l'image courante
                $img.eq(i+1).css('margin-left','200px').css('display', 'inline');
                $img.eq(i+2).css('margin-left','400px').css('display', 'inline');
                $img.eq(i+3).css('margin-left','600px').css('display', 'inline'); } else {
                i = 0;
            }
        });
        //si on clique sur « prev » ou « < »
        $('.prev').click(function () { // groupe des images précédentes
            i-=4; // on décrémente le compteur
            if (i >= 0) {
                $img.css('margin-left','0').css('display', 'none'); //on cache
                $img.eq(i).css('display', 'inline'); //on affiche l'image courante
                $img.eq(i+1).css('margin-left','200px').css('display', 'inline');
                $img.eq(i+2).css('margin-left','400px').css('display', 'inline');
                $img.eq(i+3).css('margin-left','600px').css('display', 'inline');
            } else {
                i = 0;
            }
        });
        function slideImg() {
            setTimeout(function() {
                $img.eq(i).css('display', 'inline').css('transition-delay','0.25s');
                $img.eq(i + 1).css('margin-left','200px').css('display',
                    'inline').css('transition-delay','0.5s');
                $img.eq(i + 2).css('margin-left','400px').css('display',
                    'inline').css('transition-delay','0.75s');
                $img.eq(i + 3).css('margin-left','600px').css('display',
                    'inline').css('transition-delay','1s');
                if (i < max-4) {
                    i = i+4;
                } else {
                    i = 0;
                }
                $img.css('margin-left','0').css('display', 'none');
                $img.eq(i).css('display', 'inline').css('transition-delay','1.25s');
                $img.eq(i + 1).css('margin-left','200px').css('display',
                    'inline').css('transition-delay','1.5s');
                $img.eq(i + 2).css('margin-left','400px').css('display',
                    'inline').css('transition-delay','1.75s');
                $img.eq(i + 3).css('margin-left','600px').css('display',
                    'inline').css('transition-delay','2s');
                slideImg();
            }, 4000);
        }
        slideImg();
    });
</script>

<link href="css/notifications.css" rel="stylesheet" type="text/css"/>

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
        </div>
    </nav>
    <nav style="padding-top: 3%; padding-bottom: 6%">
        <div id="buttons" >
            <input type="button" value="<" class="prev">
            <input type="button" value=">" class="next">
        </div>
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
    <?php include 'foot.php';?>
</body>
