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
echo '</head>';

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

    <?php 
    $row['tabimages'] = trim($row['tabimages'], '{}'); // remove the starting and ending curly braces
    $tabimages = explode(',', $row['tabimages']);
    $decoded_images = json_decode($row['tabimages'], true);  // decode the JSON string to an associative array ?>

<div class="section">
    <div id="myCarousel" class="carousel slide custom-carousel" data-ride="carousel">
      <ol class="carousel-indicators">
        <?php foreach ($decoded_images as $key => $image) { ?>
          <li data-target="#myCarousel" data-slide-to="<?php echo $key; ?>" <?php if ($key === 0) echo 'class="active"'; ?>></li>
        <?php } ?>
      </ol>
      <div class="carousel-inner">
        <?php foreach ($decoded_images as $key => $image) { ?>
          <div class="carousel-item <?php if ($key === 0) echo 'active'; ?>">
            <img class="d-block w-100" src="<?php echo $image; ?>" alt="Slide <?php echo $key; ?>">
          </div>
        <?php } ?>
      </div>
      <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
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