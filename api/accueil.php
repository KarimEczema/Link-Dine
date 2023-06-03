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
echo '<link rel="stylesheet" type="text/css" href="css/carrousel.css">';
echo '<body>';

include 'navbar.php';
include 'caroussel.php';
?>

<nav class = "section">
	<div id = "HebdoEvent">
		<h5 style = "text-align : center; color:red"> Evènements de la semaine</h5>
	</div>
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
	<div id="buttons">
		<input type="button" value="<" class="prev">
		<input type="button" value=">" class="next">
	</div>
</nav>


<?php
    $sql = "SELECT tabimages
	FROM evenement
	WHERE DATE(date) >= '2023-06-05'
	  AND DATE(date) <= '2023-06-11';
	";
    try {
        // Création du contact avec la BDD
        $conn = new PDO($dsn);
        $stmt = $conn->query($sql);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    ?>

    <?php $row['tabimages'] = trim($row['tabimages'], '{}'); // remove the starting and ending curly braces
    $decoded_images = json_decode($row['tabimages'], true); // decode the JSON string to an associative array ?>

    <h5 style="text-align: center; color: red; margin:3%">Evénement de la semaine :</h5>

    <div class="carousel" id="test1">
        <?php
        $valueCar = 1;
        $tabimages = explode(',', $row['tabimages']);
        ?>
        <?php foreach ($tabimages as $image):
            if ($valueCar == 1) { ?>
                <input type="radio" name="item" value="<?php echo $valueCar; ?>" checked> 
                <div><img src="<?php echo trim($image); ?>" style="height : 350px; width : 600px"></div>
                <?php $valueCar++;
            } else { ?>
                <input type="radio" name="item" value="<?php echo $valueCar; ?>"> 
                <div><img src="<?php echo trim($image); ?>" style="height : 350px; width : 600px"></div>
                <?php
                $valueCar++;
            }
            ?>
        <?php endforeach; ?>
    </div>
	
	<nav class = "post">
		<form method="post" action="traitement.php">
			<label for="ameliorer">Creer un post</label><br>
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-7"><textarea name="ameliorer" id="ameliorer" rows="10" cols="50" style="margin-right: 10%;"></textarea></div>
					<div class="col-sm-2">
					 	<label for="image_uploads"><img src="https://bmqgiyygwjnnfyrtjkno.supabase.co/storage/v1/object/sign/Images/Photo_site.png?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1cmwiOiJJbWFnZXMvUGhvdG9fc2l0ZS5wbmciLCJpYXQiOjE2ODU2NTA2OTIsImV4cCI6MTY4NjI1NTQ5Mn0.8V7VO2OmDmNFaN6lwNzgsw0zp_qBRhgorvFpWzmQDfc&t=2023-06-01T20%3A18%3A11.492Z"  width="120" height="100" alt="Appareil photo . png"></label>
    					<input type="file" id="image_uploads" name="image_uploads" accept=".jpg, .jpeg, .png" style="display:none">
						<button type="submit"  style = "margin-top : 10%;">Publier</button>
					</div>
				</div>
		</form>
	</nav>
	<?php include 'foot.php';?>
</body>
</html>