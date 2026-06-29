<?php
require "../config/db.php";
require "../includes/functions.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}

$id_affectation = $_POST['id_affectation'] ?? '';
$id_enseignant   = $_POST['id_enseignant'] ?? '';
$id_classe       = $_POST['id_classe'] ?? '';
$id_matiere      = $_POST['id_matiere'] ?? '';
$annee_scolaire  = trim($_POST['annee_scolaire'] ?? '');

if ($id_enseignant === '' || $id_classe === '' || $id_matiere === '' || $annee_scolaire === '') {
    header("Location: edit.php?id=$id_affectation&error=" . urlencode("Tous les champs sont obligatoires."));
    exit;
}

if (!preg_match('/^\d{4}-\d{4}$/', $annee_scolaire)) {
    header("Location: edit.php?id=$id_affectation&error=" . urlencode("L'année scolaire doit être au format 2025-2026."));
    exit;
}

try {
    $stmt = $pdo->prepare("UPDATE affectations SET id_enseignant = ?, id_classe = ?, id_matiere = ?, annee_scolaire = ? WHERE id_affectation = ?");
    $stmt->execute([$id_enseignant, $id_classe, $id_matiere, $annee_scolaire, $id_affectation]);

    header("Location: index.php?success=1");
    exit;
} catch (PDOException $e) {
    $msg = messageErreurBD($e);
    if (stripos($e->getMessage(), 'uniq_affectation') !== false) {
        $msg = "Cet enseignant est déjà affecté à cette matière dans cette classe pour cette année.";
    }
    header("Location: edit.php?id=$id_affectation&error=" . urlencode($msg));
    exit;
}