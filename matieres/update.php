<?php
require "../config/db.php";
require "../includes/functions.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}

$id_matiere  = $_POST['id_matiere'] ?? '';
$nom_matiere = trim($_POST['nom_matiere'] ?? '');
$coefficient = $_POST['coefficient'] ?? '';

if ($nom_matiere === '' || $coefficient === '') {
    header("Location: edit.php?id=$id_matiere&error=" . urlencode("Tous les champs sont obligatoires."));
    exit;
}

if (!is_numeric($coefficient) || (float)$coefficient <= 0) {
    header("Location: edit.php?id=$id_matiere&error=" . urlencode("Le coefficient doit être un nombre positif."));
    exit;
}

try {
    $stmt = $pdo->prepare("UPDATE matieres SET nom_matiere = ?, coefficient = ? WHERE id_matiere = ?");
    $stmt->execute([$nom_matiere, (float)$coefficient, $id_matiere]);

    header("Location: index.php?success=1");
    exit;
} catch (PDOException $e) {
    $msg = messageErreurBD($e);
    if (stripos($e->getMessage(), 'nom_matiere') !== false) {
        $msg = "Cette matière existe déjà.";
    }
    header("Location: edit.php?id=$id_matiere&error=" . urlencode($msg));
    exit;
}