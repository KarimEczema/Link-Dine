<?php
// Connect to the database
$dsn = "pgsql:host=db.bmqgiyygwjnnfyrtjkno.supabase.co;port=5432;dbname=postgres;user=postgres;password=Au5SebXYkT3DUnW4";
$conn = new PDO($dsn);

if($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Get the post ID
  $idpost = $_POST['idpost'];
  // Get the user ID
  $iduser = $_SESSION['iduser'];

  // Insert the new like
  $sql = "INSERT INTO likes(idpost, iduser) VALUES(:post, :personne)";
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
