<?php
require "../config/db.php";
require "../includes/functions.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit;
}
$id = $_GET['id'];

try {
    // Les contraintes FK (ON DELETE RESTRICT) empêchent la suppression
    // si la classe contient des inscriptions ou des affectations.
    $stmt = $pdo->prepare("DELETE FROM classes WHERE id_classe = ?");
    $stmt->execute([$id]);

    header("Location: index.php?success=1");
    exit;
} catch (PDOException $e) {
    $msg = messageErreurBD(
        $e,
        "Impossible de supprimer cette classe : elle contient des inscriptions ou des affectations."
    );
    header("Location: index.php?error=" . urlencode($msg));
    exit;
}