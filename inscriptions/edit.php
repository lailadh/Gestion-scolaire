<?php
require "../config/db.php";
require "../includes/functions.php";

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}
$id = $_GET['id'];

try {
    $stmt = $pdo->prepare("SELECT * FROM inscriptions WHERE id_inscription = ?");
    $stmt->execute([$id]);
    $inscription = $stmt->fetch();

    if (!$inscription) {
        header("Location: index.php?error=" . urlencode("Inscription introuvable."));
        exit;
    }

    $eleves  = $pdo->query("SELECT id_eleve, code_eleve, nom, prenom FROM eleves ORDER BY nom ASC")->fetchAll();
    $classes = $pdo->query("SELECT id_classe, nom_classe, annee_scolaire, capacite_max FROM classes ORDER BY nom_classe ASC")->fetchAll();
} catch (PDOException $e) {
    die("Erreur de base de données : " . $e->getMessage());
}

include "../includes/header.php";
include "../includes/navbar.php";
?>

<h2>Modifier l'Inscription</h2>

<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-error"><?= h($_GET['error']) ?></div>
<?php endif; ?>

<div class="form-box">
    <form action="update.php" method="POST">
        <input type="hidden" name="id_inscription" value="<?= h($inscription['id_inscription']) ?>">

        <label>Élève :</label>
        <select name="id_eleve" required>
            <?php foreach ($eleves as $e): ?>
                <option value="<?= $e['id_eleve'] ?>" <?= $e['id_eleve'] == $inscription['id_eleve'] ? 'selected' : '' ?>>
                    <?= h($e['nom'] . ' ' . $e['prenom'] . ' (' . $e['code_eleve'] . ')') ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Classe :</label>
        <select name="id_classe" required>
            <?php foreach ($classes as $c): ?>
                <option value="<?= $c['id_classe'] ?>" <?= $c['id_classe'] == $inscription['id_classe'] ? 'selected' : '' ?>>
                    <?= h($c['nom_classe'] . ' (' . $c['annee_scolaire'] . ', max ' . $c['capacite_max'] . ')') ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Date d'inscription :</label>
        <input type="date" name="date_inscription" value="<?= h($inscription['date_inscription']) ?>" required>

        <label>Année scolaire :</label>
        <input type="text" name="annee_scolaire" value="<?= h($inscription['annee_scolaire']) ?>" pattern="\d{4}-\d{4}" required>

        <div class="form-actions">
            <button type="submit" class="btn btn-save">Mettre à jour</button>
            <a href="index.php" class="btn btn-cancel">Annuler</a>
        </div>
    </form>
</div>

<?php include "../includes/footer.php"; ?>