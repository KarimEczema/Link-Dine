<?php

echo '<html>';
echo '<head>';
echo '<title>Notifications</title>';
echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">'; 
echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> '; 
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>'; 
echo '<link rel="stylesheet" type="text/css" href="css/notifications.css">';
echo '<link rel="stylesheet" type="text/css" href="css/global.css">';
echo '<link rel="stylesheet" type="text/css" href="css/carrousel.css">';
include 'login-check.php';
echo '</head>';
echo '<body>';

include 'navbar.php';
include 'caroussel.php';
?>


<body>


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

    <h5 style="text-align: center; margin:3%">Evénement de la semaine :</h5>

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


    <?php include 'eventamis.php'; ?>
    <?php include 'foot.php' ?>

</body>

</html>