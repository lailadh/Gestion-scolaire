<?php
require "../config/db.php";
require "../includes/functions.php";

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}
$id = (int) $_GET['id'];
try {
    $stmt = $pdo->prepare("SELECT * FROM matieres WHERE id_matiere = ?");
    $stmt->execute([$id]);
    $matiere = $stmt->fetch();

    if (!$matiere) {
        header("Location: index.php?error=" . urlencode("Matière introuvable."));
        exit;
    }
} catch (PDOException $e) {
    die("Une erreur est survenue.");
}

include "../includes/header.php";
include "../includes/navbar.php";
?>

<h2>Modifier la Matière</h2>

<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-error"><?= h($_GET['error']) ?></div>
<?php endif; ?>

<div class="form-box">
    <form action="update.php" method="POST">
        <input type="hidden" name="id_matiere" value="<?= h($matiere['id_matiere']) ?>">

        <label>Nom de la matière :</label>
        <input type="text" name="nom_matiere" value="<?= h($matiere['nom_matiere']) ?>" required>

        <label>Coefficient :</label>
        <input type="number" name="coefficient" step="0.5" min="0.5" value="<?= h($matiere['coefficient']) ?>" required>

        <div class="form-actions">
            <button type="submit" class="btn btn-save">Mettre à jour</button>
            <a href="index.php" class="btn btn-cancel">Annuler</a>
        </div>
    </form>
</div>

<?php include "../includes/footer.php"; ?>