<?php
require "../config/db.php";
require "../includes/functions.php";

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}
$id = (int) $_GET['id'];
try {
    $stmt = $pdo->prepare("SELECT * FROM enseignants WHERE id_enseignant = ?");
    $stmt->execute([$id]);
    $ens = $stmt->fetch();

    if (!$ens) {
        header("Location: index.php?error=" . urlencode("Enseignant introuvable."));
        exit;
    }
}catch (PDOException $e) {
    die("Une erreur est survenue.");
}

include "../includes/header.php";
include "../includes/navbar.php";
?>

<h2>Modifier l'Enseignant</h2>

<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-error"><?= h($_GET['error']) ?></div>
<?php endif; ?>

<div class="form-box">
    <form action="update.php" method="POST">
        <input type="hidden" name="id_enseignant" value="<?= h($ens['id_enseignant']) ?>">

        <label>Matricule (code enseignant) :</label>
        <input type="text" name="code_enseignant" value="<?= h($ens['code_enseignant']) ?>" required>

        <label>Nom :</label>
        <input type="text" name="nom" value="<?= h($ens['nom']) ?>" required>

        <label>Prénom :</label>
        <input type="text" name="prenom" value="<?= h($ens['prenom']) ?>" required>

        <label>Email :</label>
        <input type="email" name="email" value="<?= h($ens['email']) ?>" required>

        <div class="form-actions">
            <button type="submit" class="btn btn-save">Mettre à jour</button>
            <a href="index.php" class="btn btn-cancel">Annuler</a>
        </div>
    </form>
</div>

<?php include "../includes/footer.php"; ?>