<?php
require "../config/db.php";

$id = $_GET['id'];
$e = $pdo->prepare("SELECT * FROM eleves WHERE id=?");
$e->execute([$id]);
$eleve = $e->fetch();
?>

<form action="update.php" method="POST">
    <input type="hidden" name="id" value="<?= $eleve['id'] ?>">
    <input type="text" name="nom" value="<?= $eleve['nom'] ?>">
    <input type="text" name="prenom" value="<?= $eleve['prenom'] ?>">
    <button>Update</button>
</form>