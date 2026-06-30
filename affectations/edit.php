<?php
require "../config/db.php";
require "../includes/functions.php";

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}
$id = $_GET['id'];

try {
    $stmt = $pdo->prepare("SELECT * FROM affectations WHERE id_affectation = ?");
    $stmt->execute([$id]);
    $affectation = $stmt->fetch();

    if (!$affectation) {
        header("Location: index.php?error=" . urlencode("Affectation introuvable."));
        exit;
    }

    $enseignants = $pdo->query("SELECT id_enseignant, nom, prenom FROM enseignants ORDER BY nom ASC")->fetchAll();
    $classes     = $pdo->query("SELECT id_classe, nom_classe, annee_scolaire FROM classes ORDER BY nom_classe ASC")->fetchAll();
    $matieres    = $pdo->query("SELECT id_matiere, nom_matiere FROM matieres ORDER BY nom_matiere ASC")->fetchAll();
} catch (PDOException $e) {
die("Une erreur est survenue.");}

include "../includes/header.php";
include "../includes/navbar.php";
?>

<h2>Modifier l'Affectation</h2>

<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-error"><?= h($_GET['error']) ?></div>
<?php endif; ?>

<div class="form-box">
    <form action="update.php" method="POST">
        <input type="hidden" name="id_affectation" value="<?= h($affectation['id_affectation']) ?>">

        <label>Enseignant :</label>
        <select name="id_enseignant" required>
            <?php foreach ($enseignants as $e): ?>
                <option value="<?= $e['id_enseignant'] ?>" <?= $e['id_enseignant'] == $affectation['id_enseignant'] ? 'selected' : '' ?>>
                    <?= h($e['nom'] . ' ' . $e['prenom']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Classe :</label>
        <select name="id_classe" required>
            <?php foreach ($classes as $c): ?>
                <option value="<?= $c['id_classe'] ?>" <?= $c['id_classe'] == $affectation['id_classe'] ? 'selected' : '' ?>>
                    <?= h($c['nom_classe'] . ' (' . $c['annee_scolaire'] . ')') ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Matière :</label>
        <select name="id_matiere" required>
            <?php foreach ($matieres as $m): ?>
                <option value="<?= $m['id_matiere'] ?>" <?= $m['id_matiere'] == $affectation['id_matiere'] ? 'selected' : '' ?>>
                    <?= h($m['nom_matiere']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Année Scolaire :</label>
        <input type="text" name="annee_scolaire" value="<?= h($affectation['annee_scolaire']) ?>" pattern="\d{4}-\d{4}" required>

        <div class="form-actions">
            <button type="submit" class="btn btn-save">Mettre à jour</button>
            <a href="index.php" class="btn btn-cancel">Annuler</a>
        </div>
    </form>
</div>

<?php include "../includes/footer.php"; ?>