<?php
$dsn = "pgsql:host=db.bmqgiyygwjnnfyrtjkno.supabase.co;port=5432;dbname=postgres;user=postgres;password=Au5SebXYkT3DUnW4";
$conn = new PDO($dsn);

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Get the post ID
    $idpost = $_GET['idpost'];

    // Get the like count
    $sql = "SELECT COUNT(*) as count FROM likes WHERE idpost = :post";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':post', $idpost);
    $stmt->execute();
    $likeCount = $stmt->fetch(PDO::FETCH_ASSOC)['count'];

    // Return the like count
    echo $likeCount;
}
?>