<?php

try {
    $conn = new PDO($dsn);

    $sql = "SELECT * FROM users WHERE iduser = $iduser";
    $stmt = $conn->query($sql);
    ?>

    <nav style="background: #E6F0FF;border-radius: 20px; padding:2%">

        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
            <?php
                        $pp = !empty($row['pp']) ? htmlspecialchars($row['pp']) : 'https://bmqgiyygwjnnfyrtjkno.supabase.co/storage/v1/object/public/Images/ppdebase.png?t=2023-06-05T22%3A42%3A42.335Z';
                ?>
            <nav class="profil">
                <div class="row">
                    <div class="col-sm-4"
                        style="background-color : #B4D2FF; border-top-left-radius: 20px; border-bottom-left-radius: 20px;"><img src="<?php echo $pp ?>" alt="Cet utilisateur n'a pas de photo de profil" width="200"
                                    height="200">
                    </div>
                    <div class="col-sm-8" style="background: #C9DDFB;border-radius: 0px 20px 20px 0px;">
                        <div style="background: #ECEEF3; border-radius: 50px; margin:2%">
                            <h1>
                                <?php echo htmlspecialchars($row['username']); ?>
                            </h1>
                            <h3>
                                <?php echo htmlspecialchars($row['statut']); ?>
                            </h3>
                        </div>
                        <div style="background: #ECEEF3; border-radius: 50px; margin:2%">
                            <h3>
                                <?php echo htmlspecialchars($row['bio']); ?>
                            </h3>
                        </div>
                    </div>
                </div>
            </nav>
        <?php endwhile; ?>

        <?php
        $sql = "SELECT * FROM formation WHERE iduser = $iduser";
        $stmt = $conn->query($sql);
        ?>

        <h4 style="margin-top:5%">Formation(s)</h4>

        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>



            <div class="row">
                <div class="col-sm-3" style="background-color:aliceblue ; margin-left: 10%">
                    <?php echo htmlspecialchars($row['datedebut']); ?> /
                    <?php echo htmlspecialchars($row['datefin']); ?>
                </div>
                <div class="col-sm-6" style="background-color: aliceblue">
                    <div style=" margin:2%; margin-right: 10%">
                        <h5>
                            <?php echo htmlspecialchars($row['nom']); ?>
                        </h5>
                    </div>
                    <div style=" margin:2%; margin-right: 10%">
                        <h6>
                            <?php echo htmlspecialchars($row['institution']); ?>
                        </h6>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>

        <h4 style="margin-top:5%">Projet(s)</h4>

        <?php
        $sql = "SELECT * FROM projet WHERE iduser = $iduser";
        $stmt = $conn->query($sql);
        ?>

        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
            <div class="row">
                <div class="col-sm-3" style="background-color:aliceblue ; margin-left: 10%">
                    <?php echo htmlspecialchars($row['nom']); ?>
                </div>
                <div class="col-sm-6" style="background-color: aliceblue">
                    <div style=" margin:2%; margin-right: 10%">
                        <h5>
                            <?php echo htmlspecialchars($row['description']); ?>
                        </h5>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>


        <?php
        $sql = "SELECT * FROM users WHERE iduser = $iduser";
        $stmt = $conn->query($sql);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>

        <h6 style="margin-top: 2%;">
            <?php echo htmlspecialchars("email : "); ?>
            <?php echo htmlspecialchars($row['email']); ?>
        </h6>

    </nav>
    <?php

    try {
        $conn = new PDO($dsn);

        // Execute the update query
        $sql = "UPDATE users SET constantecv = 1 WHERE iduser = $iduser";
        $conn->exec($sql);

        // Display a success message or perform further actions

    } catch (PDOException $e) {
        // Handle any database errors
        echo "Update failed: " . $e->getMessage();
    }

} catch (PDOException $e) {
    echo 'An error occurred: ' . $e->getMessage();
}


?>