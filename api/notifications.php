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
echo '<link rel="stylesheet" type="text/css" href="css/accueil.css">';
include 'login-check.php';
echo '</head>';
echo '<body>';

include 'navbar.php';
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

    <!--
=====================================================================================
        Partie Evénements des amis de mes amis (nouveaux posts/formations/projets)
=====================================================================================
-->


    <h1 style="padding:2% ">Cela pourrait aussi vous intéresser :</h1>
    <h4 style="padding:2% ">Les amis de vos amis</h4>
    <?php
    try {
        // create a PostgreSQL database connection
        $conn = new PDO($dsn);

        // query to check if username exists
        $sql = "SELECT amis FROM users WHERE iduser = ?";
        $stmt = $conn->prepare($sql);

        // bind parameters and execute
        $stmt->execute([$iduser]);

        $amis = $stmt->fetch();

        if ($amis && $amis['amis'] !== null) {
            $amis = explode(',', trim($amis['amis'], '{}')); // convert the array string into a PHP array
    
            // Check that the user has friends
            if (!empty($amis)) {
                $combined = [];

                foreach ($amis as $ami) {
                    // Get the friends of the current friend
                    $stmt = $conn->prepare("SELECT amis FROM users WHERE iduser = ?");
                    $stmt->execute([$ami]);
                    $friends = $stmt->fetch();

                    if ($friends && $friends['amis'] !== null) {
                        $friends = explode(',', trim($friends['amis'], '{}')); // convert the array string into a PHP array
    
                        // Remove the user and their friends from the friends' array
                        $friends = array_diff($friends, [$iduser], $amis);

                        foreach ($friends as $friendId) {
                            // Get posts excluding the user's own posts
                            $stmt = $conn->prepare("SELECT users.nom as username, lieu as title, date, descriptionpost as description, datepublication FROM posts INNER JOIN users ON posts.iduser = users.iduser WHERE posts.iduser = ? AND posts.iduser <> ? ORDER BY datepublication DESC");
                            $stmt->execute([$friendId, $iduser]);
                            $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            // Get formations
                            $stmt = $conn->prepare("SELECT users.nom as username, formation.nom as title, (datedebut || ', ' || datefin) as date, institution as description, datepublication FROM formation INNER JOIN users ON formation.iduser = users.iduser WHERE formation.iduser = ? ORDER BY datepublication DESC");
                            $stmt->execute([$friendId]);
                            $formations = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            // Get projects
                            $stmt = $conn->prepare("SELECT users.nom as username, projet.nom as title, NULL as date, description, datepublication FROM projet INNER JOIN users ON projet.iduser = users.iduser WHERE projet.iduser = ? ORDER BY datepublication DESC");
                            $stmt->execute([$friendId]);
                            $projets = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            // Combine all and sort by datepublication
                            $combined = array_merge($combined, $posts, $formations, $projets);
                        }
                    }
                }

                usort($combined, function ($a, $b) {
                    return $b['datepublication'] <=> $a['datepublication'];
                });

                ?>

                <div class="scroll-container">
                    <table>
                        <tbody>
                            <?php
                            foreach ($combined as $item) {
                                ?>
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
            <h5> Evénements organisés par l'ECE :</h5>
        </div>
        <div class="scroll-container">
            <table>
                <tbody>
                    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>

                        <div class="scroll-page" id="eventPerso">
                            <h5><B>
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
                            <?php $row['tabimages'] = trim($row['tabimages'], '{}'); // remove the starting and ending curly braces
                                $decoded_images = json_decode($row['tabimages'], true); ?>
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

</body>

</html>