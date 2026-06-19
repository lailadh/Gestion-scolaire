<?php include "../includes/header.php"; ?>
<?php include "../includes/navbar.php"; ?>

<?php
require "../config/db.php";

try {
    // جلب البيانات من جدول eleves بالجمع
    $eleves = $pdo->query("SELECT * FROM eleves")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur de base de données : " . $e->getMessage());
}
?>

<h2>Liste des élèves</h2>

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
        <?php foreach($eleves as $e): ?>
        <tr>
            <td><?= htmlspecialchars($e['id_eleve'] ?? $e['id'] ?? '') ?></td>
            <td><?= htmlspecialchars($e['nom_eleve'] ?? $e['nom'] ?? '') ?></td>
            <td><?= htmlspecialchars($e['prenom_eleve'] ?? $e['prenom'] ?? '') ?></td>
            <td>
                <a href="edit.php?id=<?= $e['id_eleve'] ?? $e['id'] ?>" class="btn btn-edit">Edit</a>
                <a href="delete.php?id=<?= $e['id_eleve'] ?? $e['id'] ?>" class="btn btn-delete" onclick="return confirm('Sûr ?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include "../includes/footer.php"; ?>