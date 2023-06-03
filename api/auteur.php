<?php

include 'login-check.php';

echo '<html>';
echo '<head>';
echo '<title>Auteur</title>';

// Here, we're adding the links to Bootstrap CSS and jQuery via their CDNs
echo '<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>';
echo "Logged in as: " . $iduser;
echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">'; 
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>'; 
echo '<link rel="stylesheet" type="text/css" href="css/auteur.css">';
echo '<link rel="stylesheet" type="text/css" href="css/global.css">';
echo '<link rel="stylesheet" type="text/css" href="css/carrousel.css">';
echo '<script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@1.11.6/dist/umd/supabase.min.js"></script>';
echo '<body>';

include 'navbar.php';
?>

<script>
const supabaseUrl = 'https://bmqgiyygwjnnfyrtjkno.supabase.co';
const supabaseAnonKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImJtcWdpeXlnd2pubmZ5cnRqa25vIiwicm9sZSI6ImFub24iLCJpYXQiOjE2ODUzNzM1NzcsImV4cCI6MjAwMDk0OTU3N30.sQgvRElC6O5e4uE8OVZqLXBiQYQa83mSkTy4s4L0aDw'
const supabase = createClient(supabaseUrl, supabaseAnonKey);


async function handleFormSubmit(event) {
    event.preventDefault();
    const imageFile = event.target.image_uploads.files[0];
    
    // The path where the file will be stored - I'm using the file name here to create the path
    const filePath = 'post/' + imageFile.name;
    
    const { data, error } = await supabase.storage.from('Images').upload(filePath, imageFile);
    if (error) {
        console.error('Error uploading image: ', error);
        return;
    }
    
    // Get the public URL of the uploaded file
    const imageUrl = supabase.storage.from('Images').getPublicUrl(filePath);
    
    // Now you can save this imageUrl to your post's photo column
    // This part depends on how you're interacting with your database from PHP, 
    // you might need to send a request to your PHP backend with the imageUrl
}

</script>

<nav class = "post" style =" background-color: cyan;">
    <form method="post" action="traitement.php" onsubmit="handleFormSubmit(event)">
        <label for="ameliorer">Creer un post</label><br>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-7"><textarea name="ameliorer" id="ameliorer" rows="10" cols="50" style="margin-right: 10%;" required></textarea></div>
                <div class="col-sm-5">
                    <label for="image_uploads"><img src="https://bmqgiyygwjnnfyrtjkno.supabase.co/storage/v1/object/sign/Images/Photo_site.png?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1cmwiOiJJbWFnZXMvUGhvdG9fc2l0ZS5wbmciLCJpYXQiOjE2ODU2NTA2OTIsImV4cCI6MTY4NjI1NTQ5Mn0.8V7VO2OmDmNFaN6lwNzgsw0zp_qBRhgorvFpWzmQDfc&t=2023-06-01T20%3A18%3A11.492Z"  width="120" height="100" alt="Appareil photo . png"></label>
                    <input type="file" id="image_uploads" name="image_uploads" accept=".jpg, .jpeg, .png" style="display:none">
                    <button type="radio"  style = "margin-top : 10%; margin-left : 3%;">Publier</button>
                    <fieldset>
                        <p>A qui voulez vous le partager ?</p>

                        <div>
                            <input type="radio" id="huey" name="drone" value="huey" checked>
                        <label for="huey">Vos amis</label>
                        </div>

                        <div>
                            <input type="radio" id="dewey" name="drone" value="dewey">
                            <label for="dewey">Tout le monde</label>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </form>
    <label for="start">Quand ?</label>
    <input type="date" id="start" name="trip-start" value="2023-03-22" min="2015-01-01" max="2026-12-31" style = "text-align : left">
    <label for="where"style = "text-align : right;">Où ?</label>
    <input type="text" id="where" name="trip-start" style = "margin-left : 10%;">
</nav>

<nav class = "like" style =" background-color: bisque;">
   <h5> Que vous pourriez aimer :</h5><br>
</nav><div>


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