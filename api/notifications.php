<?php
include 'login-check.php';

echo '<html>';
echo '<head>';
echo '<title>Admin</title>';
echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">';
echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> ';
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>';
echo '<link rel="stylesheet" type="text/css" href="css/notifications.css">';
echo '<link rel="stylesheet" type="text/css" href="css/global.css">';
echo '<link rel="stylesheet" type="text/css" href="css/carrousel.css">';
echo '<body>';

include 'navbar.php';
include 'caroussel.php';
?>


<body>


    <?php
    $sql = "SELECT tabimages FROM evenement WHERE organisateur = 'Centrale Supelec'";
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

    <nav class="section">
        <div id="Event">
            <h5 style="text-align: center; color: red;">Evènements</h5>
        </div>

        <?php 
        $valueCar = 1;
        $tabimages = explode(',', $row['tabimages']); ?>
        <?php foreach ($tabimages as $image): ?>
            <div class="carousel" id="test1">
                <input type="radio" name="item" value=$valueCar>
                <div><img src="<?php echo trim($image); ?>"></div>
            </div>
            $valueCar++;
        <?php endforeach; ?>

    </nav>

    <nav class="section" style="color : black;">
        <div id="Amis">
            <h5> Que font mes amis</h5>
        </div>

        <div class="scroll-container">
            <div class="scroll-page" id="notif-1">
                <h5>Nom de l'amis </h5>
                <h6>à : Action </h6>
                <h6>30/05/2023</h6>
            </div>
            <div class="scroll-page" id="notif-2">
                <h5>Nom de l'amis </h5>
                <h6>à : Action </h6>
                <h6>30/05/2023</h6>
            </div>
            <div class="scroll-page" id="notif-3">
                <h5>Nom de l'amis </h5>
                <h6>à : Action </h6>
                <h6>29/05/2023</h6>
            </div>
        </div>

    </nav>

    <?php include 'foot.php' ?>

</body>

</html>