<?php
// 1. الاتصال بقاعدة البيانات
require "../config/db.php";

try {
    // 2. جلب البيانات من جدول enseignants بالجمع
    $enseignants = $pdo->query("SELECT * FROM enseignants")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // إذا وقع مشكل ف قاعدة البيانات (مثلا الجدول باقي مارجعتيهش بالجمع ف phpMyAdmin) غايبان الغلط هنا
    die("Erreur de base de données : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Enseignants</title>
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
        .btn { padding: 5px 10px; text-decoration: none; border-radius: 3px; display: inline-block; }
        .btn-add { background: #28a745; color: white; }
        .btn-edit { background: #ffc107; color: black; }
        .btn-delete { background: #dc3545; color: white; }
    </style>
</head>
<body>

    <h2>Liste des Enseignants</h2>
    <a href="create.php" class="btn btn-add">Ajouter un enseignant</a>
    <br><br>

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
            <?php if (count($enseignants) > 0): ?>
                <?php foreach($enseignants as $ens): ?>
                <tr>
                    <td><?= htmlspecialchars($ens['id_enseignant'] ?? $ens['id'] ?? '') ?></td>
                    <td><?= htmlspecialchars($ens['nom_enseignant'] ?? $ens['nom'] ?? '') ?></td>
                    <td><?= htmlspecialchars($ens['prenom_enseignant'] ?? $ens['prenom'] ?? '') ?></td>
                    <td>
                        <a href="edit.php?id=<?= $ens['id_enseignant'] ?? $ens['id'] ?>" class="btn btn-edit">Edit</a>
                        <a href="delete.php?id=<?= $ens['id_enseignant'] ?? $ens['id'] ?>" class="btn btn-delete" onclick="return confirm('Êtes-vous sûr ?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" style="text-align: center;">Aucun enseignant trouvé.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>