<?php
require "../config/db.php";
require "../includes/functions.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit;
}
$id = (int) $_GET['id'];
try {
    // La contrainte FK (ON DELETE RESTRICT) empêche la suppression
    // si la matière est utilisée dans une affectation.
    $stmt = $pdo->prepare("DELETE FROM matieres WHERE id_matiere = ?");
    $stmt->execute([$id]);

    header("Location: index.php?success=1");
    exit;
} catch (PDOException $e) {
    $msg = messageErreurBD(
        $e,
        "Impossible de supprimer cette matière : elle est utilisée dans une affectation."
    );
    header("Location: index.php?error=" . urlencode($msg));
    exit;
}