<?php
require "../includes/functions.php";
include "../includes/header.php";
include "../includes/navbar.php";
?>

<h2>Ajouter une Matière</h2>

<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-error"><?= h($_GET['error']) ?></div>
<?php endif; ?>

<div class="form-box">
    <form action="store.php" method="POST">
        <label>Nom de la matière :</label>
        <input type="text" name="nom_matiere" required>

        <label>Coefficient :</label>
        <input type="number" name="coefficient" step="0.5" min="0.5" value="1" required>

        <div class="form-actions">
            <button type="submit" class="btn btn-save">Enregistrer</button>
            <a href="index.php" class="btn btn-cancel">Annuler</a>
        </div>
    </form>
</div>

<?php include "../includes/footer.php"; ?>