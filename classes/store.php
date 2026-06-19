<?php
require "../config/db.php";

$nom = $_POST['nom'];
$niveau = $_POST['niveau'];
$capacite = $_POST['capacite'];

$stmt = $pdo->prepare("INSERT INTO classes(nom, niveau, capacite) VALUES(?,?,?)");
$stmt->execute([$nom, $niveau, $capacite]);

header("Location: index.php");
exit;