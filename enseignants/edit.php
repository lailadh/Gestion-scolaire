<?php
require "../config/db.php";

// 1. أولاً: التحقق من إرسال الفورم (POST) لتنفيذ التعديل
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];

    try {
        // التعديل باستعمال id_enseignant كمعرف، و nom/prenom كأعمدة
        $stmt = $pdo->prepare("UPDATE enseignants SET nom = ?, prenom = ? WHERE id_enseignant = ?");
        $stmt->execute([$nom, $prenom, $id]);
        
        // بعد نجاح التعديل نرجع مباشرة لـ index.php
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        die("Erreur de modification : " . $e->getMessage());
    }
}

// 2. ثانياً: جلب بيانات الأستاذ لعرضها داخل الفورم (GET)
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    try {
        // البحث باستعمال id_enseignant
        $stmt = $pdo->prepare("SELECT * FROM enseignants WHERE id_enseignant = ?");
        $stmt->execute([$id]);
        $ens = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$ens) {
            die("Enseignant introuvable !");
        }
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
} else {
    header("Location: index.php");
    exit();
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
    
    <form action="edit.php?id=<?= $ens['id_enseignant'] ?>" method="POST">
        <input type="hidden" name="id" value="<?= $ens['id_enseignant'] ?>">

        <p>
            <label>Nom :</label>
            <input type="text" name="nom" value="<?= htmlspecialchars($ens['nom'] ?? '') ?>" required>
        </p>
        
        <p>
            <label>Prénom :</label>
            <input type="text" name="prenom" value="<?= htmlspecialchars($ens['prenom'] ?? '') ?>" required>
        </p>
        
        <button type="submit">Modifier</button>
        <a href="index.php">Annuler</a>
    </form>
</body>
</html>