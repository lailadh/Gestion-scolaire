<?php
require "../config/db.php";
require "../includes/functions.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit;
}
$id = $_GET['id'];

try {
    $stmt = $pdo->prepare("DELETE FROM inscriptions WHERE id_inscription = ?");
    $stmt->execute([$id]);

    header("Location: index.php?success=1");
    exit;
} catch (PDOException $e) {
    $msg = messageErreurBD($e);
    header("Location: index.php?error=" . urlencode($msg));
    exit;
}