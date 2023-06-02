<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['creerCV']) && $_POST['creerCV'] === 'creationCV') {
        // The 'creerCV' button with value 'creationCV' was clicked

        $conn = new PDO($dsn);

        try {
            $conn = new PDO($dsn);

            $sql = "SELECT * FROM formation WHERE iduser = $iduser";
            $stmt = $conn->query($sql);
            ?>

            <nav style="background-color:grey; padding:2%">

                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <nav class="profil">
                    <div class="row">
                        <div class="col-sm-4" style="background-color : aliceblue">Photo</div>
                        <div class="col-sm-8" style="background-color: grey">
                            <div style="background-color: #d6a3b7; margin:2%">
                                <h1>
                                    <?php echo htmlspecialchars($row['username']); ?>
                                </h1>
                                <h3>
                                    <?php echo htmlspecialchars($row['statut']); ?>
                                </h3>
                            </div>
                            <div style="background-color: #a7d4d4; margin:2%">
                                <h3>
                                    <?php echo htmlspecialchars($row['bio']); ?>
                                </h3>
                            </div>
                        </div>
                    </div>
                </nav>

                <h4 style="margin-top:5%">Formation(s)</h4>
                
                    <div class="row">
                        <div class="col-sm-3" style="background-color:aliceblue ; margin-left: 10%">
                            <?php echo htmlspecialchars($row['datedebut']); ?> /
                            <?php echo htmlspecialchars($row['datefin']); ?>
                        </div>
                        <div class="col-sm-6" style="background-color: grey">
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
                        <div class="col-sm-6" style="background-color: grey">
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
        } catch (PDOException $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }
}
?>