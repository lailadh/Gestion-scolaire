<?php

require "../config/db.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET['id'];

try {

    $stmt = $pdo->prepare("DELETE FROM eleves WHERE id_eleve = ?");
    $stmt->execute([$id]);

    header("Location: index.php?success=1");
    exit;

} catch (PDOException $e) {

    header("Location: index.php?error=" . urlencode("Impossible de supprimer cet élève."));
    exit;

}