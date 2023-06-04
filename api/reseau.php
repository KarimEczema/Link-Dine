<?php

echo '<html>';
echo '<head>';
echo '<title>Réseau</title>';


// Here, we're adding the links to Bootstrap CSS and jQuery via their CDNs
echo '<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">';
echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>';
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>';
echo '<link rel="stylesheet" type="text/css" href="css/global.css">';
echo '<link rel="stylesheet" type="text/css" href="css/carrousel.css">';
echo '<link rel="stylesheet" type="text/css" href="css/reseau.css">';


include 'login-check.php';
echo '</head>';
echo '<body>';

?>
<nav id = "bg">
<?php


include 'navbar.php';
include 'caroussel.php';


?>


<body>


    <!--
======================================================
        Partie Profil
======================================================
-->

    <!-- récupération des donnée dans la table users -->

    <?php

    $sql = "SELECT * FROM users WHERE iduser= $iduser";
    try {
        // Création du contact avec la BDD
        $conn = new PDO($dsn);
        $stmt = $conn->query($sql);

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    ?>

    <!-- affichage des données de la bdd avec php -->
    <?php $row = $stmt->fetch(PDO::FETCH_ASSOC) ?>

    <nav class="profil">
        <div class="row">
            <div class="col-sm-4" style="background-color : purple">Photo</div>
            <div class="col-sm-8" style="background-color: red ; margin-left: 2%">
                <div style="background-color: green; margin:2%">
                    <h1>
                        <?php echo htmlspecialchars($row['username']); ?>
                    </h1>
                    <h3>
                        <?php echo htmlspecialchars($row['statut']); ?>
                    </h3>
                </div>
                <div style="background-color: blue; margin:2%">
                    <h3>
                        <?php echo htmlspecialchars($row['bio']); ?>
                    </h3>
                </div>
            </div>
        </div>
    </nav>

    <?php
    try {
        // create a PostgreSQL database connection
        $conn = new PDO($dsn);

        // query to check if username exists
        $sql = "SELECT amis FROM users WHERE iduser = ?";
        $stmt = $conn->prepare($sql);

        // bind parameters and execute
        $stmt->execute([$iduser]);

        $result = $stmt->fetch();

        if ($result && $result['amis'] !== null) {
            $amis = explode(',', trim($result['amis'], '{}')); // convert the array string into a PHP array
    

            // Check that the user has friends
            if (!empty($amis)) {

                // Retrieve the friends' posts
                $params = implode(',', array_fill(0, count($amis), '?'));
                $stmt = $conn->prepare("SELECT * FROM users WHERE iduser IN ($params)");
                $stmt->execute($amis);
                $friends = $stmt->fetchAll();


                ?>
                <div id="friends" style="margin-top : 10%;">
                    <h5 style="text-align : center; color:#446AA9"> Liste d'amis</h5>
                </div>

                <div id="carrousel">
                    <ul id="listc" style="list-style-type : none;">
                        <?php foreach ($friends as $friend) { ?>
                            <li>
                                <a href="profil?id=<?php echo $friend['iduser']; ?>">
                                    <img src="<?php echo htmlspecialchars($friend['pp']); ?>"
                                        alt="<?php echo htmlspecialchars($friend['nom']); ?>" width="120" height="100">
                                </a>
                            </li>
                        <?php }
            } else {
                echo "This user has no friends.";
            }
        } else {
            echo "This user has no friends.";
        }
    } catch (PDOException $e) {
        // report error message
        echo $e->getMessage();
    } 
    
    if ($result && $result['amis'] !== null) {?>
    </ul>
    </div>
    <div id="buttons">
        <input type="button" value="<" class="prev">
        <input type="button" value=">" class="next">
    </div>
    
    <?php }
        ?>
        

    <?php include 'foot.php'; ?>

    </nav>
</body>
</html>