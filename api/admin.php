<?php

echo '<html>';
echo '<head>';
echo '<title>Admin</title>';
echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">'; 
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>'; 
echo '<link rel="stylesheet" type="text/css" href="css/admin.css">'; 
echo '<link rel="stylesheet" type="text/css" href="css/global.css">';
include 'admin-check.php';
echo '</head>';
echo '<body>';
?>
    <nav class = "bg">
<?php
include 'navbar.php';
?>



<!--
======================================================
        Partie Profil
======================================================
-->

<!-- récupération des donnée dans la table users -->


<?php
$sql = "SELECT * FROM users WHERE iduser= $iduser";
try {
    // Création du contact avec la BDD
    $conn = new PDO($dsn);
    $stmt = $conn->query($sql);

} catch (PDOException $e) {
    echo $e->getMessage();
}
?>

<!-- affichage des données de la bdd avec php -->
<?php $row = $stmt->fetch(PDO::FETCH_ASSOC) ?>

<nav class="profil" style = "margin-top:5% ">
    <div class="row">
        <div class="col-sm-4" style="background-color : purple">
        <img src="<?php echo htmlspecialchars($row['pp']); ?>" alt="Cet utilisateur n'a pas de photo de profil" width="200" height="200"> 
    </div>
        <div class="col-sm-8" style="background-color: grey">
            <div style="background-color: #d6a3b7; margin:2%">
                <h3>
                    <?php echo htmlspecialchars($row['username']); ?>
                </h3>
                <h5>
                    <?php echo htmlspecialchars($row['statut']); ?>
                </h5>
            </div>
            <div style="background-color: #a7d4d4; margin:2%">
                <h3>
                    <?php echo htmlspecialchars($row['bio']); ?>
                </h3>
            </div>
        </div>
    </div>
</nav>

<!-- Ajout d'un compte : on cré un formulaire ou l'on demande le nom et l'email de la personne à créer que l'on récupère dans des variables nonmées -->

<nav class = "Ajout-compte">
    <h1 style = "margin-top : 5% ">Ajouter un utilisateur</h1>
    <form id ="ajout" method="post" action="">
    <div style = "background-color: grey; margin-top:2%" ><h5>Pseudo : <input type="text" name="nom" style="margin : 5%" required> </h5></div>
    <div style = "background-color: grey; margin:2%"><h5>Email : <input type="text" name="email" style="margin : 5%" required> </h5></div>

    <input type="submit"  style = "margin-top : 2%;" name="ajouter" value="Creer">
    </form>
</nav>

<!--  La modification dans la base de donnée se fait en PHP  -->

<?php
    
try{
    // Création du contact avec la BDD
    $conn = new PDO($dsn);

// Si un formulaire a été récupéré et si le bouton a été pressé
if($_POST){
    if(isset($_POST['ajouter']) && $_POST['ajouter'] == 'Creer') {

        // On lance une requête SQL pour insérer une nouvelle ligne avec les données récupérées

        $sql = "INSERT INTO users (username, Email) VALUES (:nom, :email)";
        $stmt = $conn->prepare($sql);

        // bind parameters and execute
        $stmt->bindParam(':nom', $_POST['nom']);
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->execute();

        //Message de confirmation pour l'utilisateur
        echo "Utilisateur ajouté !";
        $stmt->closeCursor();
    }
}
}catch (PDOException $e){
    // Message d'erreur si le formulaire n'a pas pu être récupéré
    echo $e->getMessage();
}
?>


<!-- Suppression d'un compte -->

<!-- Fonction permettant de définir la fonction à lancer lorsque le bouton est pressé, indique que l'utilisateur sélectionné est récupéré et indique le PHP à lancer -->
<!-- + Actualisation de la page ce qui permet de supprimer de la liste l'utilisateur supprimé -->
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
            //location.reload(); // Refresh the page
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
});
});
</script>

<!-- Affichage -->

<h1 style = "margin : 5% ">Supprimer un utilisateur</h1>
<select id="userSelect" placeholder="Sélectionner l'utilisateur à supprimer">
    <!-- User options will be dynamically inserted here -->
</select><br><br><br>
<button id="sendButton" style="margin-top: 3% width:6% height:2%">Supprimer l'utilisateur</button>	
<br>

<!-- Défini la fonction ajax comme une fonction existante et permet la suppression -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>

// Récupération des infos de la base de donnée (url et clé)
const supabaseUrl = 'https://bmqgiyygwjnnfyrtjkno.supabase.co';
const supabaseAnonKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImJtcWdpeXlnd2pubmZ5cnRqa25vIiwicm9sZSI6ImFub24iLCJpYXQiOjE2ODUzNzM1NzcsImV4cCI6MjAwMDk0OTU3N30.sQgvRElC6O5e4uE8OVZqLXBiQYQa83mSkTy4s4L0aDw'

// Récupération de l'utilisateur 
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
    return data.map(user => user.username); 
    } catch (error) {
    console.error('Error:', error.message);
    
}
};

// Récupération de la liste des utilisateurs et affichage dans le menu déroulant
$(document).ready(async function() {
const usernames = await getUsernames();
usernames.forEach((user) => {
    $('#userSelect').append(new Option(user, user));
});
});

</script>
<?php include 'foot.php';?>

</nav>
</body>
</html>