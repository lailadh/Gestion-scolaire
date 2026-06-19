<?php
require_once '../config/db.php';

try {
    // الاستعلام الصحيح والمطابق تماماً لبنية قاعدة بياناتك الحالية
    $sql = "SELECT a.id_affectation, a.annee_scolaire, 
                   e.nom AS prof_nom, e.prenom AS prof_prenom, 
                   c.nom_classe AS nom_classe, m.nom_matiere AS nom_matiere
            FROM affectations a
            JOIN enseignants e ON a.id_enseignant = e.id_enseignant
            JOIN classes c ON a.id_classe = c.id_classe
            JOIN matieres m ON a.id_matiere = m.id_matiere
            ORDER BY a.annee_scolaire DESC, c.nom_classe ASC";

    $affectations = $pdo->query($sql)->fetchAll();
} catch (PDOException $e) {
    // عرض الخطأ بوضوح إذا حدث أي تضارب آخر
    die("Erreur SQL : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Affectations</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="container" style="padding: 20px; max-width: 1200px; margin: 0 auto;">
        
        <h2>Gestion des Affectations des Enseignants</h2>
        
        <?php if (isset($_GET['success'])): ?>
            <div class="alert" style="color: green; background-color: #e6f4ea; padding: 10px; margin-bottom: 15px; border-radius: 4px;">
                Affectation enregistrée avec succès !
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['deleted'])): ?>
            <div class="alert" style="color: #c5221f; background-color: #fce8e6; padding: 10px; margin-bottom: 15px; border-radius: 4px;">
                L'affectation a été supprimée avec succès.
            </div>
        <?php endif; ?>

        <div style="margin-bottom: 20px;">
            <a href="create.php" class="btn" style="background-color: #007BFF; color: white; padding: 10px 15px; text-decoration: none; display: inline-block; border-radius: 4px; font-weight: bold;">
                + Affecter un Enseignant
            </a>
        </div>

        <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th>Enseignant</th>
                    <th>Classe</th>
                    <th>Matière</th>
                    <th>Année Scolaire</th>
                    <th style="text-align: center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($affectations)): ?>
                    <tr>
                        <td colspan="5" style="text-align: center; color: #666;">Aucune affectation trouvée.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($affectations as $aff): ?>
                        <tr>
                            <td><?= htmlspecialchars($aff['prof_nom'] . ' ' . $aff['prof_prenom']) ?></td>
                            <td><?= htmlspecialchars($aff['nom_classe']) ?></td>
                            <td><?= htmlspecialchars($aff['nom_matiere']) ?></td>
                            <td><?= htmlspecialchars($aff['annee_scolaire']) ?></td>
                            <td style="text-align: center;">
                                <a href="delete.php?id=<?= $aff['id_affectation'] ?>" 
                                   onclick="return confirm('Voulez-vous vraiment supprimer cette affectation ?');" 
                                   style="color: #dc3545; text-decoration: none; font-weight: bold;">
                                   Supprimer
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        
    </div>
</body>
</html>