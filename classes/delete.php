<?php
require "../config/db.php";

// التأكد من أن الـ id كاين في الرابط
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // تغيير id إلى id_classe ليتوافق مع قاعدة البيانات
        $stmt = $pdo->prepare("DELETE FROM classes WHERE id_classe = ?");
        $stmt->execute([$id]);
    } catch (PDOException $e) {
        die("Erreur de suppression : " . $e->getMessage());
    }
}

// الرجوع لصفحة الجدول
header("Location: index.php");
exit();
?>