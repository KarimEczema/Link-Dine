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

<nav class = "section">
	<div id = "HebdoEvent">
		<h5 style = "text-align : center; color:red"> Evènements de la semaine</h5>
	</div>
	<div id="carrousel">
		<ul id = "listc" style ="list-style-type : none;">
			<li><img src="images/Celeste.png" width="120" height="100"></li>
			<li><img src="images/Celeste_LVL8_FaceB.png" width="120" height="100"></li>	
			<li><img src="images/CelesteScare.png" width="120" height="100"></li>
			<li><img src="images/CelesteTheo.png" width="120" height="100"></li>
			<li><img src="chibiartforadrienne" width="120" height="100"></li>
			<li><img src="images/HollowKnightWallPaper.jfif" width="120" height="100"></li>
			<li><img src="images/logECE.png" width="120" height="100"></li>
			<li><img src="https://bmqgiyygwjnnfyrtjkno.supabase.co/storage/v1/object/sign/Images/StreetMordred.jpg?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1cmwiOiJJbWFnZXMvU3RyZWV0TW9yZHJlZC5qcGciLCJpYXQiOjE2ODU1NDkyNTYsImV4cCI6MTY4ODE0MTI1Nn0.FOqtr6jvNjSmCcK9k_CeAyBUuo3k_VSmS0VVub_mago&t=2023-05-31T16%3A07%3A38.151Z" width="120" height="100"></li>
			<li><img src="book9.jpg" width="120" height="100"></li>
			<li><img src="book10.jpg" width="120" height="100"></li>
			<li><img src="book11.jpg" width="120" height="100"></li>
			<li><img src="book12.jpg" width="120" height="100"></li>
		</ul>
	</div>
	<div id="buttons">
		<input type="button" value="<" class="prev">
		<input type="button" value=">" class="next">
	</div>
</nav>


	<!--
----------   Affichage    ----------
-->


<h1 style="padding:10% ">Time Line</h1>
<?php
try {
    // create a PostgreSQL database connection
    $conn = new PDO($dsn);

    // query to check if username exists
    $sql = "SELECT ami FROM users WHERE iduser = ?";
    $stmt = $conn->prepare($sql);

    // bind parameters and execute
    $stmt->execute([$iduser]);

    $ami = $stmt->fetch();

    // Check that the user has friends
    if ($ami) {
        $ami = explode(',', trim($ami['ami'], '{}')); // convert the array string into a PHP array

        // Retrieve the friends' posts
        $params = implode(',', array_fill(0, count($ami), '?'));
        $stmt = $conn->prepare("SELECT * FROM posts WHERE iduser IN ($params)");
        $stmt->execute($ami);
        $posts = $stmt->fetchAll();

        // Display the posts
        foreach ($posts as $post) {
            echo "ID: " . $post['id'] . ", Content: " . $post['content'] . "<br>";
        }
    } else {
        echo "This user has no friends.";
    }
    
} catch (PDOException $e) {
    // report error message
    echo $e->getMessage();
}
?>
<?php include 'foot.php';?>
</body>
</html>