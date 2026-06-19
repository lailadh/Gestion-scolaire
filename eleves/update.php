<?php
require "../config/db.php";

// 1. قراءة المعرف الصحيح القادم من الفورم
$id = $_POST['id_eleve'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];

try {
    // 2. تحديث الاستعلام ليستهدف id_eleve
    $stmt = $pdo->prepare("UPDATE eleves SET nom=?, prenom=? WHERE id_eleve=?");
    $stmt->execute([$nom, $prenom, $id]);
} catch (PDOException $e) {
    die("Erreur de modification : " . $e->getMessage());
}

header("Location: index.php");
exit;