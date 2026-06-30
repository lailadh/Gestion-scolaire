<?php
<<<<<<< HEAD
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
=======
require "../includes/functions.php";
include "../includes/header.php";
include "../includes/navbar.php";
?>

<h2>Ajouter un Enseignant</h2>

<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-error"><?= h($_GET['error']) ?></div>
<?php endif; ?>

<div class="form-box">
    <form action="store.php" method="POST">
        <label>Matricule (code enseignant) :</label>
        <input type="text" name="code_enseignant" required>

>>>>>>> ffbcf5db1f40f59fcdbf534f8a3de19c61a67984
        <label>Nom :</label>
        <input type="text" name="nom" required>

        <label>Prénom :</label>
        <input type="text" name="prenom" required>

        <label>Email :</label>
        <input type="email" name="email" required>

        <div class="form-actions">
            <button type="submit" class="btn btn-save">Enregistrer</button>
            <a href="index.php" class="btn btn-cancel">Annuler</a>
        </div>
    </form>
</div>

<?php include "../includes/footer.php"; ?>