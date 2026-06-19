<?php
require "../config/db.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // 1. أولاً: مسح جميع التعيينات المرتبطة بهاد الأستاذ من جدول affectations
        $stmt1 = $pdo->prepare("DELETE FROM affectations WHERE id_enseignant = ?");
        $stmt1->execute([$id]);

        // 2. ثانياً: دابا قاعدة البيانات غاتخلينا نمسحو الأستاذ حيت مابقاش متبوع ف حتى شي بلاصة
        $stmt2 = $pdo->prepare("DELETE FROM enseignants WHERE id_enseignant = ?");
        $stmt2->execute([$id]);

    } catch (PDOException $e) {
        die("Erreur de suppression : " . $e->getMessage());
    }
}

// الرجوع مباشرة لصفحة جدول الأساتذة
header("Location: index.php");
exit();
?>