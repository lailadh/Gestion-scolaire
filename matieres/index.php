<?php
require "../config/db.php";
require "../includes/functions.php";
include "../includes/header.php";
include "../includes/navbar.php";

try {
    $matieres = $pdo->query("SELECT * FROM matieres ORDER BY nom_matiere ASC")->fetchAll();
}catch (PDOException $e) {
    die("Une erreur est survenue.");
}
?>

<h2>Liste des Matières</h2>

<?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success">Opération effectuée avec succès.</div>
<?php endif; ?>

<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-error"><?= h($_GET['error']) ?></div>
<?php endif; ?>

<div class="actions-bar">
    <a href="create.php" class="btn btn-add">+ Ajouter une matière</a>
</div>

<table>
    <thead>
        <tr>
            <th>Nom de la matière</th>
            <th>Coefficient</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($matieres)): ?>
            <tr><td colspan="3" class="empty-row">Aucune matière trouvée.</td></tr>
        <?php else: ?>
            <?php foreach ($matieres as $m): ?>
            <tr>
                <td><?= h($m['nom_matiere']) ?></td>
                <td><?= h($m['coefficient']) ?></td>
                <td>
                    <a href="edit.php?id=<?= $m['id_matiere'] ?>" class="btn btn-edit">Modifier</a>
                    <a href="delete.php?id=<?= $m['id_matiere'] ?>" class="btn btn-delete" onclick="return confirm('Supprimer cette matière ?');">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

<?php include "../includes/footer.php"; ?>