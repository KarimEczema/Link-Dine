<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['creerCV']) && $_POST['creerCV'] === 'creationCV') {
    // The 'creerCV' button with value 'creationCV' was clicked
    echo'fonctionne';
  }
}
?>