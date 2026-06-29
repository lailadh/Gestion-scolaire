<?php
require "../config/db.php";
require "../includes/functions.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}

$id_classe      = $_POST['id_classe'] ?? '';
$nom_classe     = trim($_POST['nom_classe'] ?? '');
$niveau         = trim($_POST['niveau'] ?? '');
$capacite_max   = $_POST['capacite_max'] ?? '';
$annee_scolaire = trim($_POST['annee_scolaire'] ?? '');

if ($nom_classe === '' || $niveau === '' || $capacite_max === '' || $annee_scolaire === '') {
    header("Location: edit.php?id=$id_classe&error=" . urlencode("Tous les champs sont obligatoires."));
    exit;
}

if (!ctype_digit((string)$capacite_max) || (int)$capacite_max <= 0) {
    header("Location: edit.php?id=$id_classe&error=" . urlencode("La capacité maximale doit être un nombre positif."));
    exit;
}

if (!preg_match('/^\d{4}-\d{4}$/', $annee_scolaire)) {
    header("Location: edit.php?id=$id_classe&error=" . urlencode("L'année scolaire doit être au format 2025-2026."));
    exit;
}

try {
    // On ne peut pas réduire la capacité en-dessous du nombre d'élèves déjà inscrits
    $stmtCount = $pdo->prepare("SELECT COUNT(*) FROM inscriptions WHERE id_classe = ?");
    $stmtCount->execute([$id_classe]);
    $nbInscrits = (int)$stmtCount->fetchColumn();

    if ((int)$capacite_max < $nbInscrits) {
        header("Location: edit.php?id=$id_classe&error=" . urlencode("La capacité ne peut pas être inférieure au nombre d'élèves déjà inscrits ($nbInscrits)."));
        exit;
    }

    $stmt = $pdo->prepare("UPDATE classes SET nom_classe = ?, niveau = ?, capacite_max = ?, annee_scolaire = ? WHERE id_classe = ?");
    $stmt->execute([$nom_classe, $niveau, (int)$capacite_max, $annee_scolaire, $id_classe]);

    header("Location: index.php?success=1");
    exit;
} catch (PDOException $e) {
    $msg = messageErreurBD($e);
    if (stripos($e->getMessage(), 'uniq_classe_annee') !== false) {
        $msg = "Une classe avec ce nom existe déjà pour cette année scolaire.";
    }
    header("Location: edit.php?id=$id_classe&error=" . urlencode($msg));
    exit;
}