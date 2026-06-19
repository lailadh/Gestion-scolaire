<?php
require_once '../config/db.php';

// التأكد من إرسال المعرّف (ID) عبر رابط الصفحة
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_affectation = $_GET['id'];

    try {
        // استعلام الحذف المتوافق مع اسم الجدول والمفتاح الأساسي لديك
        $sql = "DELETE FROM affectations WHERE id_affectation = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id_affectation]);

        // إعادة التوجيه إلى الصفحة الرئيسية للتعيينات مع رسالة الحذف
        header('Location: index.php?deleted=1');
        exit;

    } catch (PDOException $e) {
        die("Erreur lors de la suppression de l'affectation : " . $e->getMessage());
    }
} else {
    header('Location: index.php');
    exit;
}