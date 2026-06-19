<?php
require "../config/db.php";

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];

$stmt = $pdo->prepare("INSERT INTO eleves(nom, prenom) VALUES(?, ?)");
$stmt->execute([$nom, $prenom]);

header("Location: index.php");
exit;