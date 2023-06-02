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

                <h4 style="margin-top:5%">Formation(s)</h4>
                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <div class="row">
                        <div class="col-sm-3" style="background-color:aliceblue ; margin-left: 10%"><?php echo htmlspecialchars($row['datedebut']); ?> / <?php echo htmlspecialchars($row['datefin']); ?></div>
                        <div class="col-sm-6" style="background-color: grey">
                            <div style=" margin:2%; margin-right: 10%">
                                <h5><?php echo htmlspecialchars($row['nom']); ?></h5>
                            </div>
                            <div style=" margin:2%; margin-right: 10%">
                                <h6><?php echo htmlspecialchars($row['institution']); ?></h6>
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
                        <div class="col-sm-3" style="background-color:aliceblue ; margin-left: 10%"><?php echo htmlspecialchars($row['nom']); ?></div>
                        <div class="col-sm-6" style="background-color: grey">
                            <div style=" margin:2%; margin-right: 10%">
                                <h5><?php echo htmlspecialchars($row['description']); ?></h5>
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
                    <?php echo htmlspecialchars("email : " + $row['email']); ?>
                </h6>

                </nav>
                <?php
            } catch (PDOException $e) {
                echo 'An error occurred: ' . $e->getMessage();
            }
        }
    }
    ?>