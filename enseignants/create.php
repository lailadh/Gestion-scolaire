<?php
require "../includes/functions.php";
include "../includes/header.php";
include "../includes/navbar.php";
?>

<h2>Ajouter un Enseignant</h2>

<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-error"><?= h($_GET['error']) ?></div>
<?php endif; ?>

<div class="form-box">
    <form action="store.php" method="POST">
        <label>Matricule (code enseignant) :</label>
        <input type="text" name="code_enseignant" required>

        <label>Nom :</label>
        <input type="text" name="nom" required>

        <label>Prénom :</label>
        <input type="text" name="prenom" required>

        <label>Email :</label>
        <input type="email" name="email" required>

        <div class="form-actions">
            <button type="submit" class="btn btn-save">Enregistrer</button>
            <a href="index.php" class="btn btn-cancel">Annuler</a>
        </div>
    </form>
</div>

<?php include "../includes/footer.php"; ?>