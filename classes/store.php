<?php
require "../config/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // استقبال البيانات المرسلة من الفورم
    $nom = $_POST['nom'];
    $niveau = $_POST['niveau'];
    $capacite = $_POST['capacite'];

    try {
        // تصحيح أسماء الأعمدة لتتوافق مع قاعدة البيانات (nom_classe و capacite_max)
        $stmt = $pdo->prepare("INSERT INTO classes (nom_classe, niveau, capacite_max) VALUES (?, ?, ?)");
        $stmt->execute([$nom, $niveau, $capacite]);
        
        // الرجوع لصفحة الجدول بعد نجاح الإضافة
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        die("Erreur d'ajout : " . $e->getMessage());
    }
}
?>