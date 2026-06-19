<?php include "../includes/header.php"; ?>
<?php include "../includes/navbar.php"; ?>

<?php
require "../config/db.php";

try {
    $inscriptions = $pdo->query("SELECT * FROM inscriptions")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur de base de données : " . $e->getMessage());
}
?>

<h2>Liste des Inscriptions</h2>
<a href="create.php" class="btn btn-add">Ajouter une inscription</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Date d'inscription</th>
            <th>Année Scolaire</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($inscriptions as $i): ?>
        <tr>
            <td><?= htmlspecialchars($i['id_inscription'] ?? $i['id'] ?? '') ?></td>
            <td><?= htmlspecialchars($i['date_inscription'] ?? '') ?></td>
            <td><?= htmlspecialchars($i['annee_scolaire'] ?? '') ?></td>
            <td>
                <a href="edit.php?id=<?= $i['id_inscription'] ?? $i['id'] ?>" class="btn btn-edit">Edit</a>
                <a href="delete.php?id=<?= $i['id_inscription'] ?? $i['id'] ?>" class="btn btn-delete" onclick="return confirm('Sûr ?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include "../includes/footer.php"; ?>