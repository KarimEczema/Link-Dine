<?php

echo '<html>';
echo '<head>';
echo '<title>Admin</title>';
echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">'; 
echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> '; 
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>'; 
echo '<link rel="stylesheet" type="text/css" href="css/emplois.css">'; 
echo '<link rel="stylesheet" type="text/css" href="css/global.css">';
include 'login-check.php';
echo '</head>';
echo '<body>';

include 'navbar.php';

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
</head>
<!-- Récupère dans la base de données les informations relatives à Emplois-->
<?php
    
    $sql = "SELECT * FROM Emplois";
	try{
    // Création du contact avec la BDD
            $conn = new PDO($dsn);
            $stmt = $conn->query($sql);

	}catch (PDOException $e){
    	echo $e->getMessage();
	}
    ?>



<!-- Affichage des données récupérées dans un scroller, autant de paragraphe dans le scroller que de ligne dans la BDD -->
<nav class = "section"> 
    <div id = "Emplois"> 
        <h5> Offres d'emploi</h5> 
    </div> 
    <div class="scroll-container"> 
        <table>
            <tbody>
                <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>

                    <div class="scroll-page" id="formation"> 
                        <h5><B><?php echo htmlspecialchars($row['nom']); ?></B>   <?php echo htmlspecialchars($row['employeur']); ?></h5> 
                        <h6>Type de contrat : <?php echo htmlspecialchars($row['contrat']); ?></h6> <br> 
                        <h6>
                            <div class="open-btn">
                                <button class="open-button" onclick="openForm(<?php echo $row['idemploi']?>)"><strong>Description du poste</strong></button>
                            </div> 
                        </h6> 
                        <div class="login-popup">
                            <div class="Description" id="form-<?php echo $row['idemploi'];?>">
                                <div class="descr-container">
                                    <h4>Description de la formation :</h4>
                                    <?php echo htmlspecialchars($row['description']); ?>
                                    <button type="button" class="btn cancel" onclick="closeForm(<?php echo $row['idemploi']?>)" style="background-color: antiquewhite">Fermer</button>
                                </div>
                            </div>
                        </div>
                        <h6>Salaire : <?php echo htmlspecialchars($row['salaire']); ?>/an</h6> 
                    </div> 

                    <script>
                        function openForm(id) {
                            document.getElementById("form-"+id).style.display = "block";
                        }

                        function closeForm(id) {
                            document.getElementById("form-"+id).style.display = "none";
                        }
                    </script>

                <?php endwhile; ?>
            </tbody>
        </table>
    </div> 
</nav> 
<?php include 'foot.php';?>
</body>
</html>