<?php
require "../config/db.php";
require "../includes/functions.php";
include "../includes/header.php";
include "../includes/navbar.php";

try {
    $sql = "SELECT i.id_inscription, i.date_inscription, i.annee_scolaire,
                   e.nom AS eleve_nom, e.prenom AS eleve_prenom, e.code_eleve,
                   c.nom_classe
            FROM inscriptions i
            JOIN eleves e  ON i.id_eleve  = e.id_eleve
            JOIN classes c ON i.id_classe = c.id_classe
            ORDER BY i.annee_scolaire DESC, c.nom_classe ASC";
    $inscriptions = $pdo->query($sql)->fetchAll();
} catch (PDOException $e) {
    die("Erreur de base de données : " . $e->getMessage());
}
?>

<h2>Liste des Inscriptions</h2>

<?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success">Opération effectuée avec succès.</div>
<?php endif; ?>

<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-error"><?= h($_GET['error']) ?></div>
<?php endif; ?>

<div class="actions-bar">
    <a href="create.php" class="btn btn-add">+ Ajouter une inscription</a>
</div>

<table>
    <thead>
        <tr>
            <th>Élève</th>
            <th>Matricule</th>
            <th>Classe</th>
            <th>Date d'inscription</th>
            <th>Année Scolaire</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($inscriptions)): ?>
            <tr><td colspan="6" class="empty-row">Aucune inscription trouvée.</td></tr>
        <?php else: ?>
            <?php foreach ($inscriptions as $i): ?>
            <tr>
                <td><?= h($i['eleve_nom'] . ' ' . $i['eleve_prenom']) ?></td>
                <td><?= h($i['code_eleve']) ?></td>
                <td><?= h($i['nom_classe']) ?></td>
                <td><?= h($i['date_inscription']) ?></td>
                <td><?= h($i['annee_scolaire']) ?></td>
                <td>
                    <a href="edit.php?id=<?= $i['id_inscription'] ?>" class="btn btn-edit">Modifier</a>
                    <a href="delete.php?id=<?= $i['id_inscription'] ?>" class="btn btn-delete" onclick="return confirm('Supprimer cette inscription ?');">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

<?php include "../includes/footer.php"; ?>