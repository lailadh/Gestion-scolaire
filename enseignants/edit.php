<?php
require "../config/db.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // جلب بيانات الأستاذ الحالي
    $stmt = $pdo->prepare("SELECT * FROM enseignants WHERE id_enseignant = ?");
    $stmt->execute([$id]);
    $ens = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$ens) {
        die("Enseignant introuvable !");
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];

    try {
        $stmt = $pdo->prepare("UPDATE enseignants SET nom_enseignant = ?, prenom_enseignant = ? WHERE id_enseignant = ?");
        $stmt->execute([$nom, $prenom, $id]);
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        die("Erreur de modification : " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un Enseignant</title>
</head>
<body>
    <h2>Modifier les informations de l'enseignant</h2>
    <form action="edit.php" method="POST">
        <input type="hidden" name="id" value="<?= $ens['id_enseignant'] ?>">

        <label>Nom :</label>
        <input type="text" name="nom" value="<?= htmlspecialchars($ens['nom_enseignant']) ?>" required><br><br>
        
        <label>Prénom :</label>
        <input type="text" name="prenom" value="<?= htmlspecialchars($ens['prenom_enseignant']) ?>" required><br><br>
        
        <button type="submit">Modifier</button>
        <a href="index.php">Annuler</a>
    </form>
</body>
</html>