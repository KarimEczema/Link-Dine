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

                <h4 style="margin-top:5%">Formation(s)</h4>
                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <div class="row">
                        <div class="col-sm-3" style="background-color: purple; margin-left: 10%"><?php echo htmlspecialchars($row['datedebut']); ?> / <?php echo htmlspecialchars($row['datefin']); ?></div>
                        <div class="col-sm-6" style="background-color: red">
                            <div style="background-color: green; margin:2%; margin-right: 10%">
                                <h5><?php echo htmlspecialchars($row['nom']); ?></h5>
                            </div>
                            <div style="background-color: yellow; margin:2%; margin-right: 10%">
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
                        <div style="background-color: green; margin-top:2%; margin-left: 10%">
                            <h5><?php echo htmlspecialchars($row['nom']); ?> -</h5>
                        </div>
                        <div style="background-color: yellow; margin-top:2%; margin-left: 2%; margin-right: 10%">
                            <h6><?php echo htmlspecialchars($row['description']); ?></h6>
                        </div>
                    </div>
                <?php endwhile; ?>


                <?php
                $sql = "SELECT * FROM users WHERE iduser = $iduser";
                $stmt = $conn->query($sql);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                ?>

                <h6 style="margin-top: 2%;">
                    <?php echo htmlspecialchars($row['email']); ?>
                </h6>

                <?php
            } catch (PDOException $e) {
                echo 'An error occurred: ' . $e->getMessage();
            }
        }
    }
    ?>