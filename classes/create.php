<?php
require "../includes/functions.php";
include "../includes/header.php";
include "../includes/navbar.php";
?>

<h2>Ajouter une Classe</h2>

<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-error"><?= h($_GET['error']) ?></div>
<?php endif; ?>

<div class="form-box">
    <form action="store.php" method="POST">
        <label>Nom de la classe :</label>
        <input type="text" name="nom_classe" placeholder="Ex: 1APIC-1" required>

        <label>Niveau :</label>
        <input type="text" name="niveau" placeholder="Ex: 1ère Année Collège" required>

        <label>Capacité maximale :</label>
        <input type="number" name="capacite_max" min="1" required>

        <label>Année scolaire :</label>
        <input type="text" name="annee_scolaire" placeholder="Ex: 2025-2026" pattern="\d{4}-\d{4}" required>

        <div class="form-actions">
            <button type="submit" class="btn btn-save">Enregistrer</button>
            <a href="index.php" class="btn btn-cancel">Annuler</a>
        </div>
    </form>
</div>

<?php include "../includes/footer.php"; ?>