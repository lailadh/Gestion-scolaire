<?php
require "../config/db.php";

$eleves = $pdo->query("SELECT * FROM eleves")->fetchAll();
$classes = $pdo->query("SELECT * FROM classes")->fetchAll();
?>

<h2>Nouvelle inscription</h2>

<form action="store.php" method="POST">

    <select name="id_eleve">
        <?php foreach($eleves as $e): ?>
            <option value="<?= $e['id'] ?>"><?= $e['nom'] ?></option>
        <?php endforeach; ?>
    </select>

    <select name="id_classe">
        <?php foreach($classes as $c): ?>
            <option value="<?= $c['id'] ?>"><?= $c['nom'] ?></option>
        <?php endforeach; ?>
    </select>

    <input name="annee_scolaire" placeholder="2025-2026">

    <button>Save</button>
</form>