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
?>

<!--
======================================================
        Partie Evénement de la semaine
======================================================
-->

<?php
$sql = "SELECT tabimages
	FROM evenement
	WHERE DATE(date) >= '2023-06-05'
	  AND DATE(date) <= '2023-06-11';
	";
$sql2 = "SELECT nom, organisateur, description
FROM evenement
WHERE DATE(date) >= '2023-06-05'
  AND DATE(date) <= '2023-06-11';
";
try {
    // Création du contact avec la BDD
    $conn = new PDO($dsn);
    $stmt = $conn->query($sql);
    $stmt2 = $conn->query($sql2);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>

<?php $row['tabimages'] = trim($row['tabimages'], '{}'); // remove the starting and ending curly braces
$decoded_images = json_decode($row['tabimages'], true); // decode the JSON string to an associative array ?>
<?php $row2 = $stmt2->fetch(PDO::FETCH_ASSOC) ?>

<div style="border:solid;">

    <h3 style="text-align: center; margin:3%; text-decoration:underline;">Evénement de la semaine :</h3>
    <h2 style="text-align: center; margin:1%">
        <?php echo htmlspecialchars($row2['nom']); ?>
    </h2>
    <h3 style="text-align: center; margin:1%">
        <?php echo htmlspecialchars($row2['organisateur']); ?>
    </h3>



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

</div>

<!--
======================================================
        Partie Evénements de mes amis (nouveaux posts)
======================================================
-->


<h1 style="padding:10% ">Evénements de mes amis</h1>
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
                                    if($item['title'] !== NULL)
                                    {
                                        echo "<h2>" . htmlspecialchars($item['title']) . "</h2>";

                                    }
                                    echo "<p>Posté par: " . htmlspecialchars($item['username']) . "</p>"; ?>
                                    <h6 style="font-style:italic">Date de publication: " <?php $item['datepublication'] ?> "</h6>;
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

<!--
======================================================
        Partie derniers évènements de l'auteur
======================================================
-->


<?php
try {
    // create a PostgreSQL database connection
    $conn = new PDO($dsn);

    // get posts
    $stmt = $conn->prepare("SELECT lieu as title, date, descriptionpost as description, datepublication FROM posts WHERE iduser = ? ORDER BY datepublication DESC");
    $stmt->execute([$iduser]);
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // get formations
    $stmt = $conn->prepare("SELECT nom as title, (datedebut, ', ', datefin) as date,  institution as description, datepublication FROM formation WHERE iduser = ? ORDER BY datepublication DESC");
    $stmt->execute([$iduser]);
    $formations = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // get projets
    $stmt = $conn->prepare("SELECT nom as title, NULL as date, description, datepublication FROM projet WHERE iduser = ? ORDER BY datepublication DESC");
    $stmt->execute([$iduser]);
    $projets = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // combine all and sort by datepublication
    $combined = array_merge($posts, $formations, $projets);
    usort($combined, function ($a, $b) {
        return $b['datepublication'] <=> $a['datepublication'];
    });



} catch (PDOException $e) {
    // report error message
    echo $e->getMessage();
}
?>

<br><br>
<h1 style="padding:10% ">Mes événements</h1>





<nav class="myEvents" style="margin-bottom:5%">
    <div class="scroll-container">
        <table>
            <tbody>
                <?php

                // display
                foreach ($combined as $item) {
                    ?>
                    <div class="scroll-page" id="eventperso">
                        <div style="padding:2%; border:solid;">

                            <?php
                            echo "<div>";
                            echo "<h2>" . htmlspecialchars($item['title']) . "</h2>";
                            ?>
                                    <h6 style="font-style:italic">Date de publication: " <?php $item['datepublication'] ?> "</h6>;
<?php
                            if($item['description'] !== NULL)
                            {
                                echo "<h6>" . htmlspecialchars($item['description']) . "</h6>";
                            }
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

                    <?php } ?>
            </tbody>
        </table>
    </div>
</nav>


<?php include 'foot.php'; ?>
</body>

</html>