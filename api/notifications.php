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
?>
    <nav class = "bg">
<?php
include 'navbar.php';
?>
    <?php include 'eventamis.php'; ?>

    <!--
=====================================================================================
        Partie Evénements des amis de mes amis (nouveaux posts/formations/projets)
=====================================================================================
-->


    <h1 style="padding:2% ">Cela pourrait aussi vous intéresser :</h1>
    <h4 style="padding:2% ">Les amis de vos amis</h4>
    <?php
    try {
        // Connexion database
        $conn = new PDO($dsn);

        // requete SQL pour récupérer les infos des amis
        $sql = "SELECT amis FROM users WHERE iduser = ?";
        $stmt = $conn->prepare($sql);

        $stmt->execute([$iduser]);

        $amis = $stmt->fetch();

        if ($amis && $amis['amis'] !== null) {
            $amis = explode(',', trim($amis['amis'], '{}')); // conversion pour récupérer le bon type
    
            // Si l'utilisateur a des amis
            if (!empty($amis)) {
                $combined = [];

                foreach ($amis as $ami) {
                    // Récupère les infos des amis
                    $stmt = $conn->prepare("SELECT amis FROM users WHERE iduser = ?");
                    $stmt->execute([$ami]);
                    $friends = $stmt->fetch();

                    if ($friends && $friends['amis'] !== null) {
                        $friends = explode(',', trim($friends['amis'], '{}')); 
    
                        $friends = array_diff($friends, [$iduser], $amis);

                        foreach ($friends as $friendId) {
                            // Récupère Posts
                            $stmt = $conn->prepare("SELECT users.nom as username, lieu as title, date, descriptionpost as description, accessibilite as acces, datepublication FROM posts INNER JOIN users ON posts.iduser = users.iduser WHERE posts.iduser = ? AND posts.iduser <> ? ORDER BY datepublication DESC");
                            $stmt->execute([$friendId, $iduser]);
                            $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            // Formations
                            $stmt = $conn->prepare("SELECT users.nom as username, formation.nom as title, (datedebut || ', ' || datefin) as date, institution as description, NULL as acces, datepublication FROM formation INNER JOIN users ON formation.iduser = users.iduser WHERE formation.iduser = ? ORDER BY datepublication DESC");
                            $stmt->execute([$friendId]);
                            $formations = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            // Projects
                            $stmt = $conn->prepare("SELECT users.nom as username, projet.nom as title, NULL as date, description, NULL as acces, datepublication FROM projet INNER JOIN users ON projet.iduser = users.iduser WHERE projet.iduser = ? ORDER BY datepublication DESC");
                            $stmt->execute([$friendId]);
                            $projets = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            // Combine
                            $combined = array_merge($combined, $posts, $formations, $projets);
                        }
                    }
                }

                usort($combined, function ($a, $b) {
                    return $b['datepublication'] <=> $a['datepublication'];
                });

                ?>
                <!-- Affiche le scroller avec les infos des amis en bouclant pour tous -->
                <div class="scroll-container">
                    <table>
                        <tbody>
                            <?php
                            foreach ($combined as $item) {

                                if ($item['acces'] != 'Amis') { ?>
                                    <div class="scroll-page" id="eventPerso">
                                        <div style="padding:2%; border:solid;">
                                            <?php
                                            echo "<div>";
                                            if ($item['title'] !== NULL) {
                                                echo "<h2>" . htmlspecialchars($item['title']) . "</h2>";
                                            }
                                            echo "<p>Posté par: " . htmlspecialchars($item['username']) . "</p>";
                                            echo "<h6 style='font-style:italic'>Date de publication: " . htmlspecialchars($item['datepublication']) . "</h6>";
                                            echo "<h6>" . htmlspecialchars($item['description']) . "</h6>";
                                            echo "</div>";
                                            ?>
                                        </div>
                                        <script>
                                            function openForm(id) {
                                                document.getElementById("form-" + id).style.display = "block";
                                            }

                                            function closeForm(id) {
                                                document.getElementById("form-" + id).style.display = "none";
                                            }
                                        </script>
                                        <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <?php

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
    ?>

    <!--
=====================================================================================
        Partie Evénements organisés par l'école
=====================================================================================
-->

    <?php

    $sql = "SELECT * FROM evenement WHERE organisateur LIKE 'ECE%' ORDER BY date DESC";
    try {
        // Création du contact avec la BDD
        $conn = new PDO($dsn);
        $stmt = $conn->query($sql);

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    ?>

    <!-- Affichage des données récupérées dans un scroller, autant de paragraphe dans le scroller que de ligne dans la BDD -->
    <nav class="section">
        <div id="events">
            <h4> Evénements organisés par l'ECE :</h4> <br><br><br>
        </div>
        <div class="scroll-container">
            <table>
                <tbody>

                    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>

                        <div class="scroll-page" id="eventPerso" style="border:solid; padding-bottom:3px">
                            <h5>
                                <br><B>
                                    <?php echo htmlspecialchars($row['nom']); ?>
                                </B>

                                <?php echo htmlspecialchars($row['organisateur']); ?>
                            </h5>
                            <h6>Date de l'événement:
                                <?php echo htmlspecialchars($row['date']); ?>
                            </h6> <br>
                            <h6>
                                <div class="open-btn">
                                    <button class="open-button"
                                        onclick="openForm(<?php echo $row['idevent'] ?>)"><strong>Description de
                                            lévénement</strong></button>
                                </div>
                            </h6>
                            <div class="login-popup">
                                <div class="Description" id="form-<?php echo $row['idevent']; ?>">
                                    <div class="descr-container">
                                        <h4>Description de la formation :</h4>
                                        <?php echo htmlspecialchars($row['description']); ?>
                                        <button type="button" class="btn cancel"
                                            onclick="closeForm(<?php echo $row['idevent'] ?>)"
                                            style="background-color: antiquewhite">Fermer</button>
                                    </div>
                                </div>
                            </div>
                            <?php
                            //Conversion depuis le tableau json en type utilisable
                            if ($row['tabimages'] !== NULL) {
                                $row['tabimages'] = trim($row['tabimages'], '{}'); // Enlève les accolades au débéut et à la fin
                                $decoded_images = json_decode($row['tabimages'], true); ?>
                                <div class="carousel" id="test1" style="padding-bottom:3%">
                                    <?php
                                    $valueCar = 1;
                                    $tabimages = explode(',', $row['tabimages']);
                                    ?>
                                    <?php foreach ($tabimages as $image): ?>
                                        <input type="radio" name="item" value="<?php echo $valueCar; ?>">
                                        <div><img src="<?php echo trim($image); ?>" style="height : 350px; width : 600px"></div>
                                        <?php $valueCar++;
                                        ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php } ?>

                            <script>
                                function openForm(id) {
                                    document.getElementById("form-" + id).style.display = "block";
                                }

                                function closeForm(id) {
                                    document.getElementById("form-" + id).style.display = "none";
                                }
                            </script>


                        </div>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </nav>

    <!--
=====================================================================================
        Partie Evénements organisés par des partenaires de l'ECE
=====================================================================================
-->


<?php

$sql = "SELECT * FROM evenement WHERE organisateur NOT LIKE 'ECE%' ORDER BY date DESC";
try {
    // Création du contact avec la BDD
    $conn = new PDO($dsn);
    $stmt = $conn->query($sql);

} catch (PDOException $e) {
    echo $e->getMessage();
}
?>

<!-- Affichage des données récupérées dans un scroller, autant de paragraphe dans le scroller que de ligne dans la BDD -->
<nav class="section">
    <div id="events">
        <h4> Evénements organisés par les partenaires de l'ECE :</h4> <br><br><br>
    </div>
    <div class="scroll-container">
        <table>
            <tbody>
                <!-- Boucle pour chaque Evenement -->
                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>

                    <div class="scroll-page" id="eventPerso" style="border:solid; padding-bottom:3px">
                        <h5>
                            <br><B>
                                <?php echo htmlspecialchars($row['nom']); ?>
                            </B>

                            <?php echo htmlspecialchars($row['organisateur']); ?>
                        </h5>
                        <h6>Date de l'événement:
                            <?php echo htmlspecialchars($row['date']); ?>
                        </h6> <br>
                        <h6>
                            <div class="open-btn">
                                <button class="open-button"
                                    onclick="openForm(<?php echo $row['idevent'] ?>)"><strong>Description de
                                        lévénement</strong></button>
                            </div>
                        </h6>
                        <div class="login-popup">
                            <div class="Description" id="form-<?php echo $row['idevent']; ?>">
                                <div class="descr-container">
                                    <h4>Description de la formation :</h4>
                                    <?php echo htmlspecialchars($row['description']); ?>
                                    <button type="button" class="btn cancel"
                                        onclick="closeForm(<?php echo $row['idevent'] ?>)"
                                        style="background-color: antiquewhite">Fermer</button>
                                </div>
                            </div>
                        </div>
                        <!-- Insertion des images et conversion depuis le json -->
                        <?php
                        if ($row['tabimages'] !== NULL) {
                            $row['tabimages'] = trim($row['tabimages'], '{}'); 
                            $decoded_images = json_decode($row['tabimages'], true); ?>
                            <div class="carousel" id="test1" style="padding-bottom:3%">
                                <?php
                                $valueCar = 1;
                                $tabimages = explode(',', $row['tabimages']);
                                ?>
                                <?php foreach ($tabimages as $image): ?>
                                    <input type="radio" name="item" value="<?php echo $valueCar; ?>">
                                    <div><img src="<?php echo trim($image); ?>" style="height : 350px; width : 600px"></div>
                                    <?php $valueCar++;
                                    ?>
                                <?php endforeach; ?>
                            </div>
                        <?php } ?>

                        <script>
                            function openForm(id) {
                                document.getElementById("form-" + id).style.display = "block";
                            }

                            function closeForm(id) {
                                document.getElementById("form-" + id).style.display = "none";
                            }
                        </script>


                    </div>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</nav>


    <?php include 'foot.php' ?>

</nav>
</body>
</html>