<?php include "../includes/header.php"; ?>
<?php include "../includes/navbar.php"; ?>

<?php
require "../config/db.php";

try {
    $matieres = $pdo->query("SELECT * FROM matieres")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur de base de données : " . $e->getMessage());
}
?>

<h2>Liste des Matières</h2>
<a href="create.php" class="btn btn-add">Ajouter une matière</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom de la Matière</th>
            <th>Coefficient</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($matieres as $m): ?>
        <tr>
            <td><?= htmlspecialchars($m['id_matiere'] ?? $m['id'] ?? '') ?></td>
            <td><?= htmlspecialchars($m['nom_matiere'] ?? $m['nom'] ?? '') ?></td>
            <td><?= htmlspecialchars($m['coefficient'] ?? '') ?></td>
            <td>
                <a href="edit.php?id=<?= $m['id_matiere'] ?? $m['id'] ?>" class="btn btn-edit">Edit</a>
                <a href="delete.php?id=<?= $m['id_matiere'] ?? $m['id'] ?>" class="btn btn-delete" onclick="return confirm('Sûr ?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include "../includes/footer.php"; ?>