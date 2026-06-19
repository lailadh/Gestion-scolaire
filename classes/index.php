<?php include "../includes/header.php"; ?>
<?php include "../includes/navbar.php"; ?>

<?php
require "../config/db.php";

try {
    $classes = $pdo->query("SELECT * FROM classes")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur de base de données : " . $e->getMessage());
}
?>

<h2>Liste des Classes</h2>
<a href="create.php" class="btn btn-add">Ajouter une classe</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom de Classe</th>
            <th>Niveau</th>
            <th>Capacité Max</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($classes as $c): ?>
        <tr>
            <td><?= htmlspecialchars($c['id_classe'] ?? $c['id'] ?? '') ?></td>
            <td><?= htmlspecialchars($c['nom_classe'] ?? $c['nom'] ?? '') ?></td>
            <td><?= htmlspecialchars($c['niveau'] ?? '') ?></td>
            <td><?= htmlspecialchars($c['capacite_max'] ?? '') ?></td>
            <td>
                <a href="edit.php?id=<?= $c['id_classe'] ?? $c['id'] ?>" class="btn btn-edit">Edit</a>
                <a href="delete.php?id=<?= $c['id_classe'] ?? $c['id'] ?>" class="btn btn-delete" onclick="return confirm('Sûr ?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include "../includes/footer.php"; ?>