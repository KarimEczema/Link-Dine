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
include 'pub.php';
echo '</head>'
?>

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

    	<!--
----------   Affichage    ----------
-->


<h1 style="padding:10% ">Time Line</h1>
<?php
    $sql = "SELECT amis FROM users WHERE iduser = $iduser";
    try {
        // create a PostgreSQL database connection
        $conn = new PDO($dsn);
        $ami = $conn->prepare($sql);

        // bind parameters and execute
        $ami->execute([$iduser]);

    } catch (PDOException $e) {
        // report error message
        echo $e->getMessage();
    }

    // Check that the user has friends
    if ($ami!=NULL) {
        while($ami = $stmt->fetch(PDO::FETCH_ASSOC)) :
            
                $ami = explode(',', trim($ami['amis'], '{}')); // convert the array string into a PHP array

                // Retrieve the friends' posts
                $params = implode(',', array_fill(0, count($ami), '?'));
                $stmt = $conn->prepare("SELECT * FROM posts WHERE iduser IN ($params)");
                $stmt->execute($ami);
                $posts = $stmt->fetchAll();

                // Display the posts
                
                    foreach ($posts as $post) {
                        echo "ID: " . $post[$ami] . ", Content: " . $post['descriptionpost'] . "<br>";
                    }
                
            
        endwhile;
    } else {
        echo "This user has no friends.";
    }
?>

	<?php include 'foot.php';?>
</body>
</html>