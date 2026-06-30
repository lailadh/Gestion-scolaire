<?php
require "../config/db.php";
require "../includes/functions.php";
include "../includes/header.php";
include "../includes/navbar.php";

try {
    $sql = "SELECT a.id_affectation, a.annee_scolaire,
                   e.nom AS prof_nom, e.prenom AS prof_prenom,
                   c.nom_classe, m.nom_matiere
            FROM affectations a
            JOIN enseignants e ON a.id_enseignant = e.id_enseignant
            JOIN classes c     ON a.id_classe     = c.id_classe
            JOIN matieres m    ON a.id_matiere    = m.id_matiere
            ORDER BY a.annee_scolaire DESC, c.nom_classe ASC";
    $affectations = $pdo->query($sql)->fetchAll();
} catch (PDOException $e) {
die("Une erreur est survenue.");}
?>

<h2>Gestion des Affectations des Enseignants</h2>

<?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success">Opération effectuée avec succès.</div>
<?php endif; ?>

<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-error"><?= h($_GET['error']) ?></div>
<?php endif; ?>

<div class="actions-bar">
    <a href="create.php" class="btn btn-add">+ Affecter un Enseignant</a>
</div>

<table>
    <thead>
        <tr>
            <th>Enseignant</th>
            <th>Classe</th>
            <th>Matière</th>
            <th>Année Scolaire</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($affectations)): ?>
            <tr><td colspan="5" class="empty-row">Aucune affectation trouvée.</td></tr>
        <?php else: ?>
            <?php foreach ($affectations as $aff): ?>
            <tr>
                <td><?= h($aff['prof_nom'] . ' ' . $aff['prof_prenom']) ?></td>
                <td><?= h($aff['nom_classe']) ?></td>
                <td><?= h($aff['nom_matiere']) ?></td>
                <td><?= h($aff['annee_scolaire']) ?></td>
                <td>
                    <a href="edit.php?id=<?= $aff['id_affectation'] ?>" class="btn btn-edit">Modifier</a>
                    <a href="delete.php?id=<?= $aff['id_affectation'] ?>" class="btn btn-delete" onclick="return confirm('Supprimer cette affectation ?');">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

<?php include "../includes/footer.php"; ?>