<?php
require "../config/db.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM enseignants WHERE id_enseignant = ?");
        $stmt->execute([$id]);
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        die("Erreur de suppression : " . $e->getMessage());
    }
} else {
    header("Location: index.php");
    exit();
}
?>