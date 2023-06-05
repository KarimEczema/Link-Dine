<?php

echo '<html>';
echo '<head>';
echo '<title>Vous</title>';

echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">';
echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> ';
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>';

echo '<link rel="stylesheet" type="text/css" href="css/global.css">';
echo '<link rel="stylesheet" type="text/css" href="css/vous.css">';

include 'login-check.php';

// Ici, we're adding the links to Bootstrap CSS and jQuery via their CDNs


echo '</head>';
echo '<body>';
?>
<nav class="bg">
    <?php
    include 'navbar.php';

    if (!isset($_SESSION['countCV'])) {
        $_SESSION['countCV'] = 0;
    } else {
        $_SESSION['countCV']++;
    }

    ?>
        <script> function previewImage() {
            var file = document.getElementById('image_uploads').files[0];
            if (file) {
                var reader = new FileReader();
                reader.onloadend = function () {
                    document.getElementById('preview').src = reader.result;
                    document.getElementById('preview').style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
    <script type="module" src="js/upload.js"></script>



    <!--
======================================================
        Partie Profil
======================================================
-->

    <!-- récupération des donnée dans la table users -->



    <?php

    try {

        if ($_POST) {
            $image_url = $_POST['image_url'];


            // Create the connection with the database
            $conn = new PDO($dsn);

            // Update the user's profile picture
            $sql = "UPDATE users SET pp = :photo WHERE iduser = $iduser";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':photo', $image_url);
            $stmt->execute();
        }

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    ?>

    <?php


    try {
        $sql = "SELECT * FROM users WHERE iduser= $iduser";
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
            <div class="col-sm-4" style="background-color : purple">
                <form method="post" action="" enctype="multipart/form-data">
                    <input type="hidden" id="image_url" name="image_url">
                    <label for="image_uploads"><img src="<?php echo htmlspecialchars($row['pp']); ?>"
                            alt="Cet utilisateur n'a pas de photo de profil" width="200" height="200">
                    </label>
                    <input type="file" id="image_uploads" name="image_uploads" accept=".jpg, .jpeg, .png"
                        onchange="previewImage();" style="display:none">
                    <button type="submit" id="publish_button">Changer de Photo</button>
                </form>
            </div>
            <div class="col-sm-8" style="background-color: grey">
                <div style="background-color: #d6a3b7; margin:2%">
                    <h1>
                        <?php echo htmlspecialchars($row['username']); ?>
                    </h1>
                    <h3>
                        <?php echo htmlspecialchars($row['statut']); ?>
                    </h3>
                </div>
                <div style="background-color: #a7d4d4; margin:2%">
                    <h3>
                        <?php echo htmlspecialchars($row['bio']); ?>
                    </h3>
                </div>
            </div>
        </div>
    </nav>



    <!--
============================================
     Choix du fond personnalisé
============================================
-->

    <!-- script pour reload la page au clic du bouton -->
    <script type="text/javascript">
        var refresh = window.getElementById('refresh');
        refresh.addEventListener('click', location.reload(), false);
    </script>


    <!-- Choix du fond par l'utilisateur via des boutons radio -->
    <nav class="Choix-fond">
        <h1 style="margin-top : 5%">Choisir son fond</h1>
        <form method="post" action="">
            <p>Cliquez pour choisir le fond que vous préférez </p>

            <div>
                <input type="radio" id="blanc" name="drone" value="white" checked>
                <label for="blanc">Fond blanc (par défaut)</label>
            </div>

            <div>
                <input type="radio" id="bleu" name="drone" value="paleturquoise">
                <label for="bleu">Fond turquoise</label>
            </div>

            <div>
                <input type="radio" id="vert" name="drone" value="#71da88">
                <label for="vert">Fond vert</label>
            </div>

            <div>
                <input type="radio" id="creme" name="drone" value="burlywood">
                <label for="creme">Fond crème</label>
            </div>

            <div>
                <input type="radio" id="rouge" name="drone" value="#e05a5a">
                <label for="rouge">Fond rouge</label>
            </div>
            <button type="submit" name="choixFond" id="refresh" value="Fond"
                style=" margin-top : 2%;">Sélectionner</button>
        </form>
    </nav>


    <!-- Enregistrement des informations dans la bdd -->

    <?php
    try {
        // Création du contact avec la BDD
        $conn = new PDO($dsn);

        // Si un formulaire a été récupéré et si le bouton a été pressé
        if ($_POST) {
            if (isset($_POST['choixFond']) && $_POST['choixFond'] == 'Fond') {
                $drone = $_POST['drone'];
                // On lance une requête SQL pour insérer une nouvelle ligne avec les données récupérées
    
                $sql = "UPDATE users SET fond = '$drone' WHERE iduser = $iduser";
                $stmt = $conn->prepare($sql);

                // bind parameters and execute
                //$stmt->bindParam(':drone', $_POST['fond']);
                $stmt->execute();

                //Message de confirmation pour l'utilisateur
                echo "Choix enregistré!";

            }
        }
    } catch (PDOException $e) {
        // Message d'erreur si le formulaire n'a pas pu être récupéré
        echo $e->getMessage();
    }
    ?>




    <!--
======================================================
        Partie Formations
======================================================
-->

    <!--
----------   Affichage    ----------
-->

    <!-- récupération des donnée dans la table formation -->

    <?php

    $sql = "SELECT * FROM formation WHERE iduser= $iduser";
    try {
        // Création du contact avec la BDD
        $conn = new PDO($dsn);
        $stmt = $conn->query($sql);

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    ?>

    <!-- affichage des données de la bdd avec php -->

    <h1 style="padding-top:10%">Formations</h1>
    <div class="scroll-container">
        <table>
            <tbody>
                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <div class="scroll-page" id="notif-1">
                        <div class="row">
                            <div class="col-sm-4" style="background-color:#d6a3b7">
                                <?php echo htmlspecialchars($row['datedebut']); ?>/
                                <?php echo htmlspecialchars($row['datefin']); ?>
                            </div>
                            <div class="col-sm-8" style="background-color:#a7d4d4">
                                <h3><B>
                                        <?php echo htmlspecialchars($row['nom']); ?>
                                    </B></h3>
                                <br>
                                <h5>
                                    <?php echo htmlspecialchars($row['institution']); ?>
                                </h5>
                            </div>
                        </div>
                    <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!--
----------   Ajout    ----------
-->


    <nav class="Ajout-formation">
        <h1 style="margin-top : 5% ">Ajouter une formation</h1>
        <form method="post" action="">
            <div class="row">
                <div class="col-sm-4" style="background-color : purple">
                    <h5 style="margin-top:15%">Date de début :</h5>
                    <input type="date" name="datedebut" value="2023-01-01" min="1960-01-01" max="2023-12-31"
                        style="margin : 15%">
                    <br>
                    <h5>Date de fin :</h5>
                    <input type="date" name="datefin" value="2023-06-06" min="1960-01-01" max="2040-12-31"
                        style="margin : 15% ">
                </div>
                <div class="col-sm-8" style="background-color: grey">
                    <div style="background-color: grey; margin:2%">
                        <h5>Titre de la formation : <input type="text" name="nom" style="margin : 5%" required> </h5>
                    </div>
                    <div style="background-color: grey; margin:2%">
                        <h5 style="margin:2%">Description de la formation : <textarea name="institution"
                                id="Formation-text" rows="10" cols="50" style="margin: 3%;" required></textarea> </h5>
                    </div>
                </div>
            </div>
            <button type="submit" name="ajouterForm" value="CreerForm" style=" margin-top : 2%;">Publier</button>
        </form>
    </nav>

    <!-- php pour ajouter dans la bdd -->

    <?php


    try {
        // Création du contact avec la BDD
        $conn = new PDO($dsn);

        // Si un formulaire a été récupéré et si le bouton a été pressé
        if ($_POST) {
            if (isset($_POST['ajouterForm']) && $_POST['ajouterForm'] == 'CreerForm') {

                // On lance une requête SQL pour insérer une nouvelle ligne avec les données récupérées
    
                $sql = "INSERT INTO formation ( iduser, datedebut, datefin, nom, institution) VALUES ($iduser, :datedebut, :datefin, :nom, :institution)";
                $stmt = $conn->prepare($sql);

                // bind parameters and execute
                $stmt->bindParam(':datedebut', $_POST['datedebut']);
                $stmt->bindParam(':datefin', $_POST['datefin']);
                $stmt->bindParam(':nom', $_POST['nom']);
                $stmt->bindParam(':institution', $_POST['institution']);
                $stmt->execute();

                //Message de confirmation pour l'utilisateur
                echo "Formation ajoutée !";

            }
        }
    } catch (PDOException $e) {
        // Message d'erreur si le formulaire n'a pas pu être récupéré
        echo $e->getMessage();
    }
    ?>


    <!--
======================================================
        Partie Projets
======================================================
-->

    <!--
----------   Affichage    ----------
-->

    <?php

    $sql = "SELECT * FROM projet WHERE iduser= $iduser";
    try {
        // Création du contact avec la BDD
        $conn = new PDO($dsn);
        $stmt = $conn->query($sql);

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    ?>


    <h1 style="padding:10% ">Projets</h1>

    <div>


        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
            <input type="radio" name="position" />
        <?php endwhile; ?>

        <?php $sql = "SELECT * FROM projet WHERE iduser= $iduser";
        try {
            // Création du contact avec la BDD
            $conn = new PDO($dsn);
            $stmt = $conn->query($sql);

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        ?>


        <main id="carousel">
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <div class="item">

                    <B>
                        <?php echo htmlspecialchars($row['nom']); ?>
                    </B>
                    <br>
                    <br>
                    <div style="padding: 2%; background-color:beige; margin-left: 2%; margin-right: 2%; ">
                        <?php echo htmlspecialchars($row['description']); ?>
                    </div>

                </div>
            <?php endwhile; ?>

        </main>
    </div>

    <!--
----------   Ajout    ----------
-->


    <nav class="Ajout-projet">
        <h1 style="margin-top : 5% "> Ajouter un projet</h1>
        <form method="post" action="">

            <div style="background-color: grey; margin:2%">
                <h5>Nom du projet : <input type="text" name="nompjt" style="margin : 5%" required> </h5>
            </div>
            <div style="background-color: grey; margin:2%">
                <h5 style="margin:2%"> Description du projet : </h5><textarea name="description" id="Projet-text"
                    rows="10" cols="50" style="margin: 3%;" required></textarea>
            </div>

            <button type="submit" name="ajouterPjt" value="CreerPjt" style=" margin-top : 2%;">Publier</button>
        </form>
    </nav>

    <!-- php pour ajouter le projet à la bdd -->

    <?php

    try {
        // Création du contact avec la BDD
        $conn = new PDO($dsn);

        // Si un formulaire a été récupéré et si le bouton a été pressé
        if ($_POST) {
            if (isset($_POST['ajouterPjt']) && $_POST['ajouterPjt'] == 'CreerPjt') {

                // On lance une requête SQL pour insérer une nouvelle ligne avec les données récupérées
    
                $sqlp = "INSERT INTO projet ( iduser, nom, description) VALUES ($iduser, :nompjt, :description)";
                $stmtp = $conn->prepare($sqlp);

                // bind parameters and execute
                $stmtp->bindParam(':nompjt', $_POST['nompjt']);
                $stmtp->bindParam(':description', $_POST['description']);
                $stmtp->execute();

                //Message de confirmation pour l'utilisateur
                echo "Projet ajoutée !";

            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    ?>




    <!-- Ajout du CV généré automatiquement -->

    <!--
======================================================
        Partie CV
======================================================
-->
    <?php
    try {
        // Création du contact avec la BDD
        $conn = new PDO($dsn);

        $cstCV = "SELECT constantecv FROM users WHERE iduser = $iduser";
        $stmt = $conn->query($cstCV);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $cstCVValue = $row['constantecv'];
        ?>

        <script>console.log(<?php echo json_encode($cstCVValue); ?>);</script>
        <?php

        if ($cstCVValue == 0) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['creerCV']) && $_POST['creerCV'] === 'creationCV') {


                    include 'cv.php';
                    exit;
                }
            }
            ?>

            <form method="POST" action="">
                <button type="submit" name="creerCV" value="creationCV">Créer un CV à partir des informations
                    personnelles</button>
            </form>
            <?php
        } else {
            include 'cv.php';
        }





    } catch (PDOException $e) {
        echo $e->getMessage();
    }




    include 'foot.php'; ?>

</nav>
</body>

</html>