<?php
require "../config/db.php";
require "../includes/functions.php";
include "../includes/header.php";
include "../includes/navbar.php";

try {
    $enseignants = $pdo->query("SELECT * FROM enseignants ORDER BY nom ASC")->fetchAll();
} catch (PDOException $e) {
    die("Une erreur est survenue.");
}
?>

<h2>Liste des Enseignants</h2>

<?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success">Opération effectuée avec succès.</div>
<?php endif; ?>

<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-error"><?= h($_GET['error']) ?></div>
<?php endif; ?>

<div class="actions-bar">
    <a href="create.php" class="btn btn-add">+ Ajouter un enseignant</a>
</div>

<table>
    <thead>
        <tr>
            <th>Matricule</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($enseignants)): ?>
            <tr><td colspan="5" class="empty-row">Aucun enseignant trouvé.</td></tr>
        <?php else: ?>
            <?php foreach ($enseignants as $ens): ?>
            <tr>
                <td><?= h($ens['code_enseignant']) ?></td>
                <td><?= h($ens['nom']) ?></td>
                <td><?= h($ens['prenom']) ?></td>
                <td><?= h($ens['email']) ?></td>
                <td>
                    <a href="edit.php?id=<?= $ens['id_enseignant'] ?>" class="btn btn-edit">Modifier</a>
                    <a href="delete.php?id=<?= $ens['id_enseignant'] ?>" class="btn btn-delete" onclick="return confirm('Supprimer cet enseignant ?');">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

<?php include "../includes/footer.php"; ?>