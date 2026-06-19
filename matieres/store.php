<?php
require "../config/db.php";

$nom = $_POST['nom'];

$stmt = $pdo->prepare("INSERT INTO matieres(nom) VALUES(?)");
$stmt->execute([$nom]);

header("Location: index.php");
exit;