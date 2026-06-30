<?php include "../includes/header.php"; ?>
<?php include "../includes/navbar.php"; ?>

<?php
require "../config/db.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET['id'];

try {
    $stmt = $pdo->prepare("SELECT * FROM eleves WHERE id_eleve = ?");
    $stmt->execute([$id]);
    $eleve = $stmt->fetch();

    if (!$eleve) {
        die("<div class='alert alert-error'>Élève introuvable.</div>");
    }

} catch (PDOException $e) {
    die("<div class='alert alert-error'>Une erreur est survenue.</div>");
}
?>

<h2>Modifier l'Élève</h2>

<div class="form-container">
    <form action="update.php" method="POST">

        <input type="hidden" name="id_eleve" value="<?= htmlspecialchars($eleve['id_eleve']) ?>">

        <div class="form-group">
            <label>Code élève :</label>
            <input
                type="text"
                name="code_eleve"
                value="<?= htmlspecialchars($eleve['code_eleve']) ?>"
                required>
        </div>

        <div class="form-group">
            <label>Nom :</label>
            <input
                type="text"
                name="nom"
                value="<?= htmlspecialchars($eleve['nom']) ?>"
                required>
        </div>

        <div class="form-group">
            <label>Prénom :</label>
            <input
                type="text"
                name="prenom"
                value="<?= htmlspecialchars($eleve['prenom']) ?>"
                required>
        </div>

        <div class="form-group">
            <label>Email :</label>
            <input
                type="email"
                name="email"
                value="<?= htmlspecialchars($eleve['email']) ?>"
                required>
        </div>

        <div class="form-group">
            <label>Date de naissance :</label>
            <input
                type="date"
                name="date_naissance"
                value="<?= htmlspecialchars($eleve['date_naissance']) ?>">
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-edit">Modifier</button>
            <a href="index.php" class="btn btn-cancel">Annuler</a>
        </div>

    </form>
</div>

<?php include "../includes/footer.php"; ?>