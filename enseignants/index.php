<?php
// 1. الاتصال بقاعدة البيانات
require "../config/db.php";

try {
    // 2. جلب البيانات من جدول enseignants بالجمع
    $enseignants = $pdo->query("SELECT * FROM enseignants")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
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
        .btn { padding: 5px 10px; text-decoration: none; border-radius: 3px; display: inline-block; font-family: sans-serif; font-size: 14px; }
        .btn-add { background: #28a745; color: white; }
        .btn-edit { background: #ffc107; color: black; }
        .btn-delete { background: #dc3545; color: white; }
        .btn-secondary { background: #6c757d; color: white; border: none; cursor: pointer; padding: 7px 12px; }
        .btn-secondary:hover { background: #5a6268; }
    </style>
</head>
<body>

    <h2>Liste des Enseignants</h2>
    
    <div style="margin-bottom: 20px;">
        <button onclick="history.back()" class="btn btn-secondary">← Retour</button>
        <a href="create.php" class="btn btn-add" style="margin-left: 5px;">Ajouter un enseignant</a>
    </div>

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
                <?php 
                    // نأخذ المعرف الحقيقي مباشرة
                    $current_id = $ens['id_enseignant'] ?? $ens['id'] ?? ''; 
                ?>
                <tr>
                    <td><?= htmlspecialchars($current_id) ?></td>
                    <td><?= htmlspecialchars($ens['nom'] ?? '') ?></td>
                    <td><?= htmlspecialchars($ens['prenom'] ?? '') ?></td>
                    <td>
                        <a href="edit.php?id=<?= $current_id ?>" class="btn btn-edit">Edit</a>
                        <a href="delete.php?id=<?= $current_id ?>" class="btn btn-delete" onclick="return confirm('Êtes-vous sûr ?')">Delete</a>
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