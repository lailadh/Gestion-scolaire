<?php
require "../config/db.php";

$id = $_POST['id'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];

$stmt = $pdo->prepare("UPDATE eleves SET nom=?, prenom=? WHERE id=?");
$stmt->execute([$nom, $prenom, $id]);

header("Location: index.php");
exit;