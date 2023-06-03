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
            // Retrieve the friends' posts
            $params = implode(',', array_fill(0, count($amis), '?'));

            $stmt = $conn->prepare("SELECT * FROM posts WHERE iduser IN ($params)");
            $stmt->execute($amis);
            $posts = $stmt->fetchAll(); ?>


            <div class="scroll-container">
                <table>
                    <tbody>
                        <?php

                        // Display the posts
                        foreach ($posts as $post) {

                            $temp = $post['idpost'];

                            $sql2 = "SELECT u.nom
            FROM users u
            JOIN posts p ON u.iduser = p.iduser
            WHERE p.idpost = ?";

                            $stmt2 = $conn->prepare($sql2);
                            $stmt2->execute([$temp]);
                            $result = $stmt2->fetch();
                            ?>

                            <div class="scroll-page" id="formation">
                                <div class="col-sm-4" style="background-color:#d6a3b7">
                                    <?php echo $result['nom']; ?>
                                </div>
                                <div class="col-sm-8" style="background-color:#a7d4d4 margin-bottom:3%">
                                    <?php echo htmlspecialchars($post['descriptionpost']); ?>
                                </div>
                            </div>


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
    $stmt = $conn->prepare("SELECT CONCAT(nom, ', ', institution) as title, datedebut as date, datedebut as description, datepublication FROM formation WHERE iduser = ? ORDER BY datepublication DESC");
    $stmt->execute([$iduser]);
    $formations = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // get projets
    $stmt = $conn->prepare("SELECT nom as title, NULL as date, description, datepublication FROM projet WHERE iduser = ? ORDER BY datepublication DESC");
    $stmt->execute([$iduser]);
    $projets = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // combine all and sort by datepublication
    $combined = array_merge($posts, $formations, $projets);
    usort($combined, function($a, $b) {
        return $b['datepublication'] <=> $a['datepublication'];
    });

    // display
    foreach($combined as $item) {
        echo "<div>";
        echo "<h2>" . htmlspecialchars($item['title']) . "</h2>";
        echo "<p>" . htmlspecialchars($item['description']) . "</p>";
        echo "<p>Publication date: " . $item['datepublication'] . "</p>";
        echo "</div>";
    }

} catch (PDOException $e) {
    // report error message
    echo $e->getMessage();
}
?>

<br><br>
<h1 style="padding:10% ">Mes événements</h1>

<?php

$sql = "SELECT * FROM posts WHERE DATE(date)<= '2023-06-06'  ORDER BY DATE(date) DESC";
try {
    // Création du contact avec la BDD
    $conn = new PDO($dsn);
    $stmt = $conn->query($sql);

} catch (PDOException $e) {
    echo $e->getMessage();
}
?>

<nav class="myEvents">
    <div class="scroll-container">
        <table>
            <tbody>
                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>

                    <div class="scroll-page" id="eventperso">
                        <div style="padding:2%; border:solid;">
                            <h5>
                                    <?php echo htmlspecialchars($row['Lieu']."-"); ?>
                                
                                <?php echo htmlspecialchars($row['date']); ?>
                            </h5>
                            <h6>
                                <div class="open-btn">
                                    <button class="open-button"
                                        onclick="openForm(<?php echo $row['idpost'] ?>)"><strong>Description du post</strong></button>
                                </div>
                            </h6>
                            <div class="login-popup">
                                <div class="Description" id="form-<?php echo $row['idpost']; ?>">
                                    <div class="descr-container">
                                        <h4>Description de l'événement :</h4>
                                        <?php echo htmlspecialchars($row['descriptionpost']); ?>
                                        <button type="button" class="btn cancel"
                                            onclick="closeForm(<?php echo $row['idpost'] ?>)"
                                            style="background-color: antiquewhite">Fermer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        function openForm(id) {
                            document.getElementById("form-" + id).style.display = "block";
                        }

                        function closeForm(id) {
                            document.getElementById("form-" + id).style.display = "none";
                        }
                    </script>

                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</nav>


<?php include 'foot.php'; ?>
</body>

</html>