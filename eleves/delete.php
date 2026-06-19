<?php
require "../config/db.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // 1. غانمسحو أي سطر مرتبط بهاد التلميذ في جدول التسجيلات أولاً
        $stmt1 = $pdo->prepare("DELETE FROM inscriptions WHERE id_eleve = ?");
        $stmt1->execute([$id]);

        // 2. دابا قاعدة البيانات غاتخلينا نمسحو التلميذ حيت مابقاش مرتبط بـ حتى شي تسجيل
        $stmt2 = $pdo->prepare("DELETE FROM eleves WHERE id_eleve = ?");
        $stmt2->execute([$id]);

    } catch (PDOException $e) {
        die("Erreur de suppression : " . $e->getMessage());
    }
}

// رجوع لصفحة الجدول
header("Location: index.php");
exit();
?>