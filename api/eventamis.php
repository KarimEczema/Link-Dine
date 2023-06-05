<!--
======================================================
        Partie Evénements de mes amis (nouveaux posts)
======================================================
-->


<h1 style="padding:10% ">Evénements de mes amis</h1>
<h4></h4>
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
                // get posts
                $stmt = $conn->prepare("SELECT users.nom as username, lieu as title, date, descriptionpost as description, datepublication FROM posts INNER JOIN users ON posts.iduser = users.iduser WHERE posts.iduser = ? ORDER BY datepublication DESC");
                $stmt->execute([$ami]);
                $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // get formations
                $stmt = $conn->prepare("SELECT users.nom as username, formation.nom as title, (datedebut, ', ' ,datefin) as date, institution as description, datepublication FROM formation INNER JOIN users ON formation.iduser = users.iduser WHERE formation.iduser = ? ORDER BY datepublication DESC");
                $stmt->execute([$ami]);
                $formations = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // get projets
                $stmt = $conn->prepare("SELECT users.nom as username, projet.nom as title, NULL as date, description, datepublication FROM projet INNER JOIN users ON projet.iduser = users.iduser WHERE projet.iduser = ? ORDER BY datepublication DESC");
                $stmt->execute([$ami]);
                $projets = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // combine all and sort by datepublication
                $combined = array_merge($combined, $posts, $formations, $projets);
            }

            usort($combined, function ($a, $b) {
                return $b['datepublication'] <=> $a['datepublication'];
            });

            usort($combined, function ($a, $b) {
                return $b['datepublication'] <=> $a['datepublication'];
            }); ?>

            <div class="scroll-container">
                <table>
                    <tbody>
                        <?php


                        foreach ($combined as $item) {
                            ?>
                            <div class="scroll-page" id="eventperso">
                                <div style="padding:2%; border:solid;">

                                    <?php
                                    echo "<div>";
                                    if ($item['title'] !== NULL) {
                                        echo "<h2>" . htmlspecialchars($item['title']) . "</h2>";

                                    }
                                    echo "<p>Posté par: " . htmlspecialchars($item['username']) . "</p>"; ?>
                                    <h6 style="font-style:italic">Date de publication:
                                        <?php echo htmlspecialchars($item['datepublication']) ?>
                                    </h6>;

                                    <?php
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