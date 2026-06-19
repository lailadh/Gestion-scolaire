<?php
require "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];

    if (!empty($nom) && !empty($prenom)) {
        try {
            // التصحيح النهائي: استهداف الأعمدة الحقيقية nom و prenom
            $stmt = $pdo->prepare("INSERT INTO enseignants (nom, prenom) VALUES (?, ?)");
            $stmt->execute([$nom, $prenom]);
            
            // الرجوع لصفحة الجدول بعد الإضافة بنجاح
            header("Location: index.php");
            exit();
        } catch (PDOException $e) {
            die("Erreur d'insertion : " . $e->getMessage());
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Enseignant</title>
</head>
<body>
    <h2>Ajouter un nouvel enseignant</h2>
    
    <form action="create.php" method="POST">
        <label>Nom :</label>
        <input type="text" name="nom" required><br><br>
        
        <label>Prénom :</label>
        <input type="text" name="prenom" required><br><br>
        
        <button type="submit">Enregistrer</button>
        <a href="index.php">Annuler</a>
    </form>
</body>
</html>