<?php
require "../config/db.php";
require "../includes/functions.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}

$nom_classe     = trim($_POST['nom_classe'] ?? '');
$niveau         = trim($_POST['niveau'] ?? '');
$capacite_max   = $_POST['capacite_max'] ?? '';
$annee_scolaire = trim($_POST['annee_scolaire'] ?? '');

if ($nom_classe === '' || $niveau === '' || $capacite_max === '' || $annee_scolaire === '') {
    header("Location: create.php?error=" . urlencode("Tous les champs sont obligatoires."));
    exit;
}

if (!ctype_digit((string)$capacite_max) || (int)$capacite_max <= 0) {
    header("Location: create.php?error=" . urlencode("La capacité maximale doit être un nombre positif."));
    exit;
}

if (!preg_match('/^\d{4}-\d{4}$/', $annee_scolaire)) {
    header("Location: create.php?error=" . urlencode("L'année scolaire doit être au format 2025-2026."));
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO classes (nom_classe, niveau, capacite_max, annee_scolaire) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nom_classe, $niveau, (int)$capacite_max, $annee_scolaire]);

    header("Location: index.php?success=1");
    exit;
} catch (PDOException $e) {
    $msg = messageErreurBD($e);
    if (stripos($e->getMessage(), 'uniq_classe_annee') !== false) {
        $msg = "Une classe avec ce nom existe déjà pour cette année scolaire.";
    }
    header("Location: create.php?error=" . urlencode($msg));
    exit;
}