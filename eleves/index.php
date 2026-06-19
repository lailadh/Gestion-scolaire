<?php include "../includes/header.php"; ?>
<?php include "../includes/navbar.php"; ?>

<?php
require "../config/db.php";

try {
    // جلب جميع التلاميذ من قاعدة البيانات
    $eleves = $pdo->query("SELECT * FROM eleves")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur de base de données : " . $e->getMessage());
}
?>

<h2>Liste des Élèves</h2>
<a href="create.php" class="btn btn-add">Ajouter un élève</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($eleves as $el): ?>
        <tr>
            <td><?= htmlspecialchars($el['id_eleve'] ?? '') ?></td>
            <td><?= htmlspecialchars($el['nom'] ?? '') ?></td>
            <td><?= htmlspecialchars($el['prenom'] ?? '') ?></td>
            <td>
                <a href="edit.php?id=<?= $el['id_eleve'] ?>" class="btn btn-edit">Edit</a>
                <a href="delete.php?id=<?= $el['id_eleve'] ?>" class="btn btn-delete" onclick="return confirm('Sûr ?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include "../includes/footer.php"; ?>