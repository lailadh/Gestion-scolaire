<?php
require_once '../config/db.php';

// جلب البيانات من الجداول باستخدام أسماء الأعمدة الفعلية والمصححة في قاعدة البيانات
try {
    $enseignants = $pdo->query("SELECT id_enseignant, nom, prenom FROM enseignants ORDER BY nom ASC")->fetchAll();
    $classes     = $pdo->query("SELECT id_classe, nom_classe FROM classes ORDER BY nom_classe ASC")->fetchAll();
    $matieres    = $pdo->query("SELECT id_matiere, nom_matiere FROM matieres ORDER BY nom_matiere ASC")->fetchAll();
} catch (PDOException $e) {
    die("Erreur lors de la récupération des données : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une Affectation</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="container" style="padding: 20px; max-width: 600px; margin: 0 auto;">
        <h2>Ajouter une Nouvelle Affectation</h2>
        
        <form action="store.php" method="POST" style="background: #f9f9f9; padding: 20px; border-radius: 8px; border: 1px solid #ddd;">
            
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">Enseignant :</label>
                <select name="id_enseignant" required style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #ccc;">
                    <option value="">-- Choisir un enseignant --</option>
                    <?php foreach ($enseignants as $e): ?>
                        <option value="<?= $e['id_enseignant'] ?>"><?= htmlspecialchars($e['nom'] . ' ' . $e['prenom']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">Classe :</label>
                <select name="id_classe" required style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #ccc;">
                    <option value="">-- Choisir une classe --</option>
                    <?php foreach ($classes as $c): ?>
                        <option value="<?= $c['id_classe'] ?>"><?= htmlspecialchars($c['nom_classe']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">Matière :</label>
                <select name="id_matiere" required style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #ccc;">
                    <option value="">-- Choisir une matière --</option>
                    <?php foreach ($matieres as $m): ?>
                        <option value="<?= $m['id_matiere'] ?>"><?= htmlspecialchars($m['nom_matiere']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">Année Scolaire :</label>
                <input type="text" name="annee_scolaire" placeholder="Ex: 2025/2026" required style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #ccc; box-sizing: border-box;">
            </div>

            <div style="display: flex; gap: 10px;">
                <button type="submit" style="background-color: #2ecc71; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">Sauvegarder</button>
                <a href="index.php" style="background-color: #e74c3c; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px; font-weight: bold; text-align: center;">Annuler</a>
            </div>
        </form>
    </div>
</body>
</html>