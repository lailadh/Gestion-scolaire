<?php include "../includes/header.php"; ?>
<?php include "../includes/navbar.php"; ?>

<?php
require "../config/db.php";

try {
    $eleves = $pdo->query("SELECT * FROM eleves ORDER BY nom, prenom")->fetchAll();
} catch (PDOException $e) {
die("<div class='alert alert-error'>Erreur de base de données.</div>");}
?>

<h2>Liste des Eleves</h2>

<?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success">Operation effectuee avec succes !</div>
<?php endif; ?>
<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-error"><?= htmlspecialchars($_GET['error']) ?></div>
<?php endif; ?>

<a href="create.php" class="btn btn-add">+ Ajouter un eleve</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Matricule</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($eleves) === 0): ?>
            <tr><td colspan="6" style="text-align:center">Aucun eleve trouve.</td></tr>
        <?php else: ?>
            <?php foreach ($eleves as $e): ?>
            <tr>
                <td><?= htmlspecialchars($e['id_eleve']) ?></td>
                <td><?= htmlspecialchars($e['code_eleve']) ?></td>
                <td><?= htmlspecialchars($e['nom']) ?></td>
                <td><?= htmlspecialchars($e['prenom']) ?></td>
                <td><?= htmlspecialchars($e['email'] ?? '-') ?></td>
                <td>
                    <a href="edit.php?id=<?= $e['id_eleve'] ?>" class="btn btn-edit">Modifier</a>
                    <a href="delete.php?id=<?= $e['id_eleve'] ?>" class="btn btn-delete" onclick="return confirm('Confirmer la suppression de cet eleve ?')">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

<?php include "../includes/footer.php"; ?>
