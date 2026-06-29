<?php
require "../config/db.php";
require "../includes/functions.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}

$id_enseignant  = $_POST['id_enseignant'] ?? '';
$id_classe      = $_POST['id_classe'] ?? '';
$id_matiere     = $_POST['id_matiere'] ?? '';
$annee_scolaire = trim($_POST['annee_scolaire'] ?? '');

if ($id_enseignant === '' || $id_classe === '' || $id_matiere === '' || $annee_scolaire === '') {
    header("Location: create.php?error=" . urlencode("Tous les champs sont obligatoires."));
    exit;
}

if (!preg_match('/^\d{4}-\d{4}$/', $annee_scolaire)) {
    header("Location: create.php?error=" . urlencode("L'année scolaire doit être au format 2025-2026."));
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO affectations (id_enseignant, id_classe, id_matiere, annee_scolaire) VALUES (?, ?, ?, ?)");
    $stmt->execute([$id_enseignant, $id_classe, $id_matiere, $annee_scolaire]);

    header("Location: index.php?success=1");
    exit;
} catch (PDOException $e) {
    $msg = messageErreurBD($e);
    if (stripos($e->getMessage(), 'uniq_affectation') !== false) {
        $msg = "Cet enseignant est déjà affecté à cette matière dans cette classe pour cette année.";
    }
    header("Location: create.php?error=" . urlencode($msg));
    exit;
}