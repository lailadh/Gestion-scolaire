<?php
require "../config/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // استقبال البيانات من الفورم (create.php)
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];

    try {
        // تغيير أسماء الأعمدة لـ nom و prenom ليتطابق مع قاعدة البيانات عندك
        $stmt = $pdo->prepare("INSERT INTO enseignants (nom, prenom) VALUES (?, ?)");
        $stmt->execute([$nom, $prenom]);
        
        // الرجوع لصفحة الجدول بعد الإضافة بنجاح
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        die("Erreur d'insertion : " . $e->getMessage());
    }
}
?>