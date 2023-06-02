<script>
    if(isset($_POST['creerCV'])) {
        <?php
        $sql = "SELECT * FROM users WHERE iduser = $iduser";
        $conn = new PDO($dsn);
        $stmt = $conn->query($sql);
        ?>

            < nav class="CV" style = "margin-top:2%" >

    <div class="row">
        <div class="col-sm-4" style="background-color : purple; margin : 2%">Photo</div>
        <div class="col-sm-7" style="background-color: red">
            <div style="background-color: green; margin:2%">
                <h3><?php echo htmlspecialchars($row['username']); ?></h3>
            </div>
            <div style="background-color: blue; margin:2%">
                <h5><?php echo htmlspecialchars($row['description']); ?></h5>
            </div>
        </div>
    </div>
    }

</script>