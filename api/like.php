<?php
$dsn = "pgsql:host=db.bmqgiyygwjnnfyrtjkno.supabase.co;port=5432;dbname=postgres;user=postgres;password=Au5SebXYkT3DUnW4";
$conn = new PDO($dsn);

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the post ID and user ID
    $idpost = $_POST['idpost'];
    $iduser = $_POST['iduser'];

    // Check if the user has already liked this post
    $stmt = $conn->prepare("SELECT * FROM likes WHERE idpost = :post AND iduser = :personne");
    $stmt->bindParam(':post', $idpost);
    $stmt->bindParam(':personne', $iduser);
    $stmt->execute();
    $alreadyLiked = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($alreadyLiked) {
        // User already liked this post, so remove the like
        $sql = "DELETE FROM likes WHERE idpost = :post AND iduser = :personne";
    } else {
        // User has not liked this post yet, so add the like
        $sql = "INSERT INTO likes(idpost, iduser) VALUES(:post, :personne)";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':post', $idpost);
    $stmt->bindParam(':personne', $iduser);
    $stmt->execute();

    // Get the new like count
    $sql = "SELECT COUNT(*) as count FROM likes WHERE idpost = :post";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':post', $idpost);
    $stmt->execute();
    $likeCount = $stmt->fetch(PDO::FETCH_ASSOC)['count'];    

    // Return the new like count
    echo $likeCount;
}
?>