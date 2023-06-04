<?php
$dsn = "pgsql:host=db.bmqgiyygwjnnfyrtjkno.supabase.co;port=5432;dbname=postgres;user=postgres;password=Au5SebXYkT3DUnW4";
$conn = new PDO($dsn);

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the post ID and user ID
    $idpost = $_POST['idpost'];
    $iduser = $_POST['iduser'];

    // Check if a like record already exists for this user and post
    $sql = "SELECT * FROM likes WHERE idpost = :post AND iduser = :user";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':post', $idpost);
    $stmt->bindParam(':user', $iduser);
    $stmt->execute();
    $likeRecord = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($likeRecord) {
        // A like record exists, so this is a 'dislike' action. Delete the record.
        $sql = "DELETE FROM likes WHERE idpost = :post AND iduser = :user";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':post', $idpost);
        $stmt->bindParam(':user', $iduser);
        $stmt->execute();
    } else {
        // No like record exists, so this is a 'like' action. Insert a new record.
        $sql = "INSERT INTO likes (idpost, iduser) VALUES (:post, :user)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':post', $idpost);
        $stmt->bindParam(':user', $iduser);
        $stmt->execute();
    }

    // Get the updated like count
    $sql = "SELECT COUNT(*) as count FROM likes WHERE idpost = :post";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':post', $idpost);
    $stmt->execute();
    $likeCount = $stmt->fetch(PDO::FETCH_ASSOC)['count'];

    // Return the updated like count
    echo $likeCount;
}
?>
