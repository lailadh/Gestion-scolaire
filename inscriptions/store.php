<?php
require "../config/db.php";

$id_eleve = $_POST['id_eleve'];
$id_classe = $_POST['id_classe'];
$annee = $_POST['annee_scolaire'];

$stmt = $pdo->prepare("
INSERT INTO inscriptions(id_eleve, id_classe, annee_scolaire)
VALUES(?,?,?)
");

$stmt->execute([$id_eleve, $id_classe, $annee]);

header("Location: index.php");
exit;