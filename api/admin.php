<?php

include 'admin-check.php';

echo '<html>';
echo '<head>';
echo '<title>Admin</title>';
echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">'; 
echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> '; 
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>'; 
echo '<link rel="stylesheet" type="text/css" href="css/vous.css">'; 
echo '<body>';

include 'navbar.php';
?>
<script>                import { createClient } from '@supabase/supabase-js';
</script>

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>

<link href="css/admin.css" rel="stylesheet" type="text/css"/>

</head>
<body>
	
	<nav class = "Ajout-compte">

        <h1 style = "margin-top : 5% ">Ajouter un utilisateur</h1>
        <form method="post" action="">
        <div style = "background-color: grey; margin-top:2%" ><h5>Pseudo : <input type="text" name="nom" style="margin : 5%"> </h5></div>
        <div style = "background-color: grey; margin:2%"><h5>Email : <input type="text" name="email" style="margin : 5%"> </h5></div>

       <input type="submit"  style = "margin-top : 2%;" name="ajouter" value="Creer">
        </form>
    </nav>

    <?php
        
try{
    // create a PostgreSQL database connection
    $conn = new PDO($dsn);

    // if form is submitted
    if($_POST){
        if(isset($_POST['ajouter']) && $_POST['ajouter'] == 'Creer') {
            // query to add new user
            $sql = "INSERT INTO users (username, Email) VALUES (:nom, :email)";
            $stmt = $conn->prepare($sql);

            // bind parameters and execute
            $stmt->bindParam(':nom', $_POST['nom']);
            $stmt->bindParam(':email', $_POST['email']);
            $stmt->execute();

            echo "Utilisateur ajouté !";
        }
    }
}catch (PDOException $e){
    // report error message
    echo $e->getMessage();
}
    ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("#sendButton").click(function(){
        var username = $("#userSelect").val();

        $.ajax({
            url: 'delete', // path to your PHP script
            type: 'post',
            data: {username: username},
            success: function(response) {
                alert(response);
                location.reload(); // Refresh the page
            },
            error: function(jqXHR, textStatus, errorThrown) {
               console.log(textStatus, errorThrown);
            }
        });
    });
});

</script>

      <h1 style = "margin : 5% ">Supprimer un utilisateur</h1>
      
	<select id="userSelect" placeholder="Select user to send to">
        <!-- User options will be dynamically inserted here -->
    </select><br>

    <button id="sendButton" style="padding:5%">Supprimer l'utilisateur</button>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	
    <script>

const supabaseUrl = 'https://bmqgiyygwjnnfyrtjkno.supabase.co';
const supabaseAnonKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImJtcWdpeXlnd2pubmZ5cnRqa25vIiwicm9sZSI6ImFub24iLCJpYXQiOjE2ODUzNzM1NzcsImV4cCI6MjAwMDk0OTU3N30.sQgvRElC6O5e4uE8OVZqLXBiQYQa83mSkTy4s4L0aDw'


const getUsernames = async () => {
    try {
        const response = await fetch(`${supabaseUrl}/rest/v1/users`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'apikey': supabaseAnonKey,
            },
        });
        const data = await response.json();
        return data.map(user => user.username); // assuming each user has a 'username' field
        } catch (error) {
        console.error('Error:', error.message);
        
    }
};


$(document).ready(async function() {
    // Get the list of users and populate the select dropdown
    const usernames = await getUsernames();
    usernames.forEach((user) => {
        $('#userSelect').append(new Option(user, user));
    });
});

    </script>

	<footer>
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6" style = "border : solid; color: black; padding:2px">
					<p style = "margin-top:25%;">
					Bienvenue sur Link dine, le plus grand réseau professionnel mondial comptant plus de 2 d'utilisateurs dans plus de 0 pays et territoires du monde.
					</p>
				</div>
				<div class="col-sm-6" style = "border : solid; color: black; padding:2px">
					<p style="text-align : center;">Nous contacter</p>
					
					<a href="mailto:adrienne.vidon@edu.ece.fr"> Mail </a>
					<br>
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2625.3661096301935!2d2.2859856116549255!3d48.851228701091536!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6701b4f58251b%3A0x167f5a60fb94aa76!2sECE%20-%20Ecole%20d&#39;ing%C3%A9nieurs%20-%20Engineering%20school.!5e0!3m2!1sfr!2sfr!4v1685461093343!5m2!1sfr!2sfr" width="200" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
				</div>
			</div>
		</div>
	</footer>
</body>
</html>


