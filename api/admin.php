<?php

include 'login-check.php';

echo '<html>';
echo '<head>';
echo '<title>Admin</title>';

// Here, we're adding the links to Bootstrap CSS and jQuery via their CDNs
echo '<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">';
echo '<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>';
echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>';

?>

<script type="text/javascript">
	$(document).ready(function() {
		var $img = $('#carrousel img');
		var max = $img.length;
		var i = 0; // compteur
		$img.css('margin-left','0').css('display', 'none'); //on cache les images
		$img.eq(i).css('display', 'inline'); //on affiche l'image courante
		$img.eq(i+1).css('margin-left','200px').css('display', 'inline');
		$img.eq(i+2).css('margin-left','400px').css('display', 'inline');
		$img.eq(i+3).css('margin-left','600px').css('display', 'inline');
		//si on clique sur « next » ou « > »
		$('.next').click(function () { // image suivante
			 i+=4; // on incrémente le compteur
			 if (i < max-4) {
			 i = i+4;
			 $img.css('margin-left','0').css('display', 'none'); //on cache
			 $img.eq(i).css('display', 'inline'); //on affiche l'image courante
			 $img.eq(i+1).css('margin-left','200px').css('display', 'inline');
			 $img.eq(i+2).css('margin-left','400px').css('display', 'inline');
			 $img.eq(i+3).css('margin-left','600px').css('display', 'inline'); } else {
			 i = 0;
			 }
		 });
		//si on clique sur « prev » ou « < »
		 $('.prev').click(function () { // groupe des images précédentes
			 i-=4; // on décrémente le compteur
			 if (i >= 0) {
			 $img.css('margin-left','0').css('display', 'none'); //on cache
			 $img.eq(i).css('display', 'inline'); //on affiche l'image courante
			 $img.eq(i+1).css('margin-left','200px').css('display', 'inline');
			 $img.eq(i+2).css('margin-left','400px').css('display', 'inline');
			 $img.eq(i+3).css('margin-left','600px').css('display', 'inline');
			 } else {
			 i = 0;
			 }
		 });
		function slideImg() {
			 setTimeout(function() {
			 $img.eq(i).css('display', 'inline').css('transition-delay','0.25s');
			 $img.eq(i + 1).css('margin-left','200px').css('display',
			 'inline').css('transition-delay','0.5s');
			 $img.eq(i + 2).css('margin-left','400px').css('display',
			 'inline').css('transition-delay','0.75s');
			 $img.eq(i + 3).css('margin-left','600px').css('display',
			 'inline').css('transition-delay','1s');
			 if (i < max-4) {
			i = i+4;
			 } else {
			i = 0;
			 }
			 $img.css('margin-left','0').css('display', 'none');
			 $img.eq(i).css('display', 'inline').css('transition-delay','1.25s');
			 $img.eq(i + 1).css('margin-left','200px').css('display',
			 'inline').css('transition-delay','1.5s');
			 $img.eq(i + 2).css('margin-left','400px').css('display',
			 'inline').css('transition-delay','1.75s');
			 $img.eq(i + 3).css('margin-left','600px').css('display',
			 'inline').css('transition-delay','2s');
			slideImg();
			}, 4000);
		}
		slideImg();
	});
</script>

<link href="css/admin.css" rel="stylesheet" type="text/css"/>
<body>
	<header>
		<div class="container-fluid">
			<div class="row">
				 <div class="col-sm-8"><h3>ECE-in : Social Media Professionnel de l'ECE Paris</h3></div>
				 <div class="col-sm" ><img src="https://bmqgiyygwjnnfyrtjkno.supabase.co/storage/v1/object/sign/Images/CHIBIART%20FOR%20ADRIENNE.png?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1cmwiOiJJbWFnZXMvQ0hJQklBUlQgRk9SIEFEUklFTk5FLnBuZyIsImlhdCI6MTY4NTQ1MzYwOSwiZXhwIjoxNjg4MDQ1NjA5fQ.WPg1DleVb23PFe2EfTDyFgRNIIDuuhwx6LO7DDheIKU&t=2023-05-30T13%3A33%3A29.160Z" width="121" height="49.5"></div>
			</div>		
		</div>
	</header>
	
	<nav class = "navigation">
		<div class="container-fluid">
				<div class="row">
					 <div class="col-sm-2"><a href="accueil" style = "border : solid; color: black; padding:2px">Accueil</a></div>
					 <div class="col-sm-2"><a href="reseau" style = "border : solid; color: black; padding:2px">Mon Réseau</a></div>
					 <div class="col-sm-2"><a href="vous" style = "border : solid; color: black; padding:2px">Vous</a></div>
					 <div class="col-sm-2"><a href="notifications" style = "border : solid; color: black; padding:2px">Notifications</a></div>
					 <div class="col-sm-2"><a href="messages" style = "border : solid; color: black; padding:2px">Messagerie</a></div>
					 <div class="col-sm-2"><a href="emplois" style = "border : solid; color: black; padding:2px">Emplois</a></div>
				</div>		
		</div>
	</nav>
	
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



    <nav class = "Supp-compte">

        <h1 style = "margin : 5% ">Supprimer un utilisateur</h1>

        <script>
            const supabaseUrl = 'https://bmqgiyygwjnnfyrtjkno.supabase.co/';
            const supabaseAnonKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImJtcWdpeXlnd2pubmZ5cnRqa25vIiwicm9sZSI6ImFub24iLCJpYXQiOjE2ODUzNzM1NzcsImV4cCI6MjAwMDk0OTU3N30.sQgvRElC6O5e4uE8OVZqLXBiQYQa83mSkTy4s4L0aDw'
        const getUsernames = async () => {
        try {


            const response = await fetch(${supabaseUrl}/rest/v1/users, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'apikey': supabaseAnonKey,
                },


                $sql = "SELECT idUsers FROM users"
            });
        if (!response.ok) {
            throw new Error('Failed to fetch usernames');
        }
        const data = await response.json();
        return data.map(user => user.username); // assuming each user has a 'username' field
        } catch (error) {
            console.error('Error:', error.message);
        }
    };


    $(document).ready(async function() {
          const usernames = await getUsernames();
          usernames.forEach((user) => {
              $('#ChoixUser').append(new Option(user, user));
            });

            $('#boutonSuppr').click(async function() {
              const sentTo = $('#ChoixUser').val(); // Get the selected username
              if (!sentTo) {
                  alert('Please select a user to send message to!');
                  return;
              }
          });
      });

        </script>
        <select id="ChoixUser" placeholder="Choisissez l'utilisateur à supprimer :"></select>
        <button type="submit"  style = " margin-top : 2%;" id="boutonSuppr">Supprimer le compte</button>

    </nav>

	
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


