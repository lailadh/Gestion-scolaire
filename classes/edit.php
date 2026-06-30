<?php
require "../config/db.php";
require "../includes/functions.php";

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}
$id = $_GET['id'];

try {
    $stmt = $pdo->prepare("SELECT * FROM classes WHERE id_classe = ?");
    $stmt->execute([$id]);
    $classe = $stmt->fetch();

    if (!$classe) {
        header("Location: index.php?error=" . urlencode("Classe introuvable."));
        exit;
    }
} catch (PDOException $e) {
    die("Une erreur est survenue.");
}

include "../includes/header.php";
include "../includes/navbar.php";
?>

<h2>Modifier la Classe</h2>

<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-error"><?= h($_GET['error']) ?></div>
<?php endif; ?>

<div class="form-box">
    <form action="update.php" method="POST">
        <input type="hidden" name="id_classe" value="<?= h($classe['id_classe']) ?>">

        <label>Nom de la classe :</label>
        <input type="text" name="nom_classe" value="<?= h($classe['nom_classe']) ?>" required>

        <label>Niveau :</label>
        <input type="text" name="niveau" value="<?= h($classe['niveau']) ?>" required>

        <label>Capacité maximale :</label>
        <input type="number" name="capacite_max" min="1" value="<?= h($classe['capacite_max']) ?>" required>

        <label>Année scolaire :</label>
        <input type="text" name="annee_scolaire" value="<?= h($classe['annee_scolaire']) ?>" pattern="\d{4}-\d{4}" required>

        <div class="form-actions">
            <button type="submit" class="btn btn-save">Mettre à jour</button>
            <a href="index.php" class="btn btn-cancel">Annuler</a>
        </div>
    </form>
</div>

<?php include "../includes/footer.php"; ?>