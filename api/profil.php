<?php

echo '<html>';
echo '<head>';
echo '<title>Profil</title>';

// Here, we're adding the links to Bootstrap CSS and jQuery via their CDNs
echo '<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>';
echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">';
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>';
echo '<link rel="stylesheet" type="text/css" href="css/accueil.css">';
echo '<link rel="stylesheet" type="text/css" href="css/global.css">';
echo '<link rel="stylesheet" type="text/css" href="css/carrousel.css">';
include 'login-check.php';
echo '</head>';
echo '<body>';
?>
<nav class="bg">
    <?php

    include 'navbar.php';
    include 'caroussel.php';

    ?>
    <!--
============================================
        Profil de l'ami séléctionné
============================================
-->

    <!-- recupération en php des informations de la BDD -->
    <?php
    $expl = $_GET["id"];

    $sql = "SELECT * FROM users WHERE iduser = $expl";
    try {
        // Création du contact avec la BDD
        $conn = new PDO($dsn);
        $stmt = $conn->query($sql);

    } catch (PDOException $e) {
        echo $e->getMessage();
    }


    ?>




    <nav class="profil" style="border : solid; color: black; padding:7px">
        <div class="container-fluid">
            <table>
                <tbody>
                    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                        <?php
                        $pp = !empty($row['pp']) ? htmlspecialchars($row['pp']) : 'https://bmqgiyygwjnnfyrtjkno.supabase.co/storage/v1/object/public/Images/ppdebase';
                        ?>
                        <div class="row">
                            <div class="col-sm-3">
                                <img src="<?php echo $pp ?>" alt="Cet utilisateur n'a pas de photo de profil" width="200"
                                    height="200">
                            </div>
                            <div class="col-sm-8">
                                <p><b>
                                        <?php echo htmlspecialchars($row['nom']); ?>
                                    </b>
                                    <?php echo htmlspecialchars($row['statut']); ?>
                                </p>
                                <h6>Description : </h6>
                                <p>
                                    <?php echo htmlspecialchars($row['bio']); ?>
                                </p>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </nav>


    <!--
============================================
     liste des amis non encore ajoutés
============================================
-->


    <?php
    try {
        // create a PostgreSQL database connection
        $conn = new PDO($dsn);

        // query to check if username exists
        $sql = "SELECT amis FROM users WHERE iduser = ?";
        $stmt = $conn->prepare($sql);

        // bind parameters and execute
        $stmt->execute([$expl]);

        $ami = $stmt->fetch();

        // Check that the user has friends
        if ($ami) {
            $ami = explode(',', trim($ami['amis'], '{}')); // convert the array string into a PHP array
    
            // Retrieve the friends' posts
            $params = implode(',', array_fill(0, count($ami), '?'));
            $stmt = $conn->prepare("SELECT * FROM users WHERE iduser IN ($params)");
            $stmt->execute($ami);
            $amis = $stmt->fetchAll();

            ?>

            <div id="friends" style="margin-top : 10%;">
                <h5 style="text-align : center; color:#446AA9"> Liste d'amis</h5>
            </div>

            <div id="carrousel">
                <ul id="listc" style="list-style-type : none;">
                    <?php foreach ($amis as $mesamis) { ?>
                        <li>
                            <a href="profil?id=<?php echo $mesamis['iduser']; ?>">
                                <img src="<?php echo htmlspecialchars($mesamis['pp']); ?>"
                                    alt="<?php echo htmlspecialchars($mesamis['nom']); ?>" width="120" height="100">
                            </a>
                        </li>
                    <?php }
        } else {
            echo "This user has no friends.";
        }
    } catch (PDOException $e) {
        // report error message
        echo $e->getMessage();
    } ?>
        </ul>
    </div>
    <div id="buttons">
        <input type="button" value="<" class="prev">
        <input type="button" value=">" class="next">
    </div>


    <?php include 'foot.php'; ?>
</nav>
</body>

</html>