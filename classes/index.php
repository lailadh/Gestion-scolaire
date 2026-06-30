<?php
require "../config/db.php";
require "../includes/functions.php";
include "../includes/header.php";
include "../includes/navbar.php";

try {
    $classes = $pdo->query("SELECT * FROM classes ORDER BY annee_scolaire DESC, nom_classe ASC")->fetchAll();
}catch (PDOException $e) {
    die("Une erreur est survenue.");
}
?>

<h2>Liste des Classes</h2>

<?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success">Opération effectuée avec succès.</div>
<?php endif; ?>

<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-error"><?= h($_GET['error']) ?></div>
<?php endif; ?>

<div class="actions-bar">
    <a href="create.php" class="btn btn-add">+ Ajouter une classe</a>
</div>

<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Niveau</th>
            <th>Capacité Max</th>
            <th>Année Scolaire</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($classes)): ?>
            <tr><td colspan="5" class="empty-row">Aucune classe trouvée.</td></tr>
        <?php else: ?>
            <?php foreach ($classes as $c): ?>
            <tr>
                <td><?= h($c['nom_classe']) ?></td>
                <td><?= h($c['niveau']) ?></td>
                <td><?= h($c['capacite_max']) ?></td>
                <td><?= h($c['annee_scolaire']) ?></td>
                <td>
                    <a href="edit.php?id=<?= $c['id_classe'] ?>" class="btn btn-edit">Modifier</a>
                    <a href="delete.php?id=<?= $c['id_classe'] ?>" class="btn btn-delete" onclick="return confirm('Supprimer cette classe ?');">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

<?php include "../includes/footer.php"; ?>