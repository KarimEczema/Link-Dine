<?php include 'login-check.php'; 

echo '<html>';
echo '<head>';
echo '<title>Admin</title>';
echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">'; 
echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> '; 
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>'; 
echo '<link rel="stylesheet" type="text/css" href="css/vous.css">'; 
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

<nav>





<nav class = "section"> 
    <div id = "Emplois"> 
        <h5> Offres d'emploi</h5> 
    </div> 
        <div class="scroll-container"> 


        <table>
   <tbody>
     <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>

        <div class="scroll-page" id="formation-1"> 
                <h5><B><?php echo htmlspecialchars($row['nom']); ?></B>   <?php echo htmlspecialchars($row['employeur']); ?></h5> 
                <h6>Type de contrat : <?php echo htmlspecialchars($row['contrat']); ?></h6> <br> 
                <h6>Description du poste <button type="button" onclick="textecache('span_text1');">...</button> </h6> 
                <span id="span_text1" style="display: none";><?php echo htmlspecialchars($row['description']); ?></span> 
                <h6>Salaire : <?php echo htmlspecialchars($row['salaire']); ?>/an</h6> 
            </div> 
     <?php endwhile; ?>
   </tbody>
 </table>

           
        </div> 
    </nav> 


    <footer>
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6" style = "border : solid; color: black; padding:2px">
					<p style = "margin-top:25%;">
					Bienvenue sur Link dine, le plus grand réseau professionnel mondial comptant plus de 2 d'utilisateurs dans plus de 0 pays et territoires du monde.
					</p>
				</div>
				<div class="col-sm-6" style = "border : solid; color: black; padding:2px">
					<p style="text-align : center;">Nous contacter</p>
					
					<a href="mailto:adrienne.vidon@edu.ece.fr"> Mail </a>
					<br>
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2625.3661096301935!2d2.2859856116549255!3d48.851228701091536!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6701b4f58251b%3A0x167f5a60fb94aa76!2sECE%20-%20Ecole%20d&#39;ing%C3%A9nieurs%20-%20Engineering%20school.!5e0!3m2!1sfr!2sfr!4v1685461093343!5m2!1sfr!2sfr" width="200" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
				</div>
			</div>
		</div>
	</footer>
</body>
 