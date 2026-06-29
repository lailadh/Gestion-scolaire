<?php
require "../config/db.php";
require "../includes/functions.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}

$id_inscription   = $_POST['id_inscription'] ?? '';
$id_eleve         = $_POST['id_eleve'] ?? '';
$id_classe        = $_POST['id_classe'] ?? '';
$date_inscription = $_POST['date_inscription'] ?? '';
$annee_scolaire   = trim($_POST['annee_scolaire'] ?? '');

if ($id_eleve === '' || $id_classe === '' || $date_inscription === '' || $annee_scolaire === '') {
    header("Location: edit.php?id=$id_inscription&error=" . urlencode("Tous les champs sont obligatoires."));
    exit;
}

if (!preg_match('/^\d{4}-\d{4}$/', $annee_scolaire)) {
    header("Location: edit.php?id=$id_inscription&error=" . urlencode("L'année scolaire doit être au format 2025-2026."));
    exit;
}

try {
    // Règle : un élève appartient à une seule classe par année scolaire (hors cette inscription)
    $stmtCheck = $pdo->prepare("SELECT COUNT(*) FROM inscriptions WHERE id_eleve = ? AND annee_scolaire = ? AND id_inscription != ?");
    $stmtCheck->execute([$id_eleve, $annee_scolaire, $id_inscription]);
    if ($stmtCheck->fetchColumn() > 0) {
        header("Location: edit.php?id=$id_inscription&error=" . urlencode("Cet élève est déjà inscrit dans une classe pour cette année scolaire."));
        exit;
    }

    // Règle : capacité maximale de la classe (hors cette inscription)
    $stmtClasse = $pdo->prepare("SELECT capacite_max FROM classes WHERE id_classe = ?");
    $stmtClasse->execute([$id_classe]);
    $classe = $stmtClasse->fetch();

    if (!$classe) {
        header("Location: edit.php?id=$id_inscription&error=" . urlencode("Classe introuvable."));
        exit;
    }

    $stmtCount = $pdo->prepare("SELECT COUNT(*) FROM inscriptions WHERE id_classe = ? AND id_inscription != ?");
    $stmtCount->execute([$id_classe, $id_inscription]);
    $nbInscrits = (int)$stmtCount->fetchColumn();

    if ($nbInscrits >= (int)$classe['capacite_max']) {
        header("Location: edit.php?id=$id_inscription&error=" . urlencode("Cette classe a atteint sa capacité maximale (" . $classe['capacite_max'] . " élèves)."));
        exit;
    }

    $stmt = $pdo->prepare("UPDATE inscriptions SET id_eleve = ?, id_classe = ?, date_inscription = ?, annee_scolaire = ? WHERE id_inscription = ?");
    $stmt->execute([$id_eleve, $id_classe, $date_inscription, $annee_scolaire, $id_inscription]);

    header("Location: index.php?success=1");
    exit;
} catch (PDOException $e) {
    $msg = messageErreurBD($e);
    if (stripos($e->getMessage(), 'uniq_eleve_annee') !== false) {
        $msg = "Cet élève est déjà inscrit dans une classe pour cette année scolaire.";
    }
    header("Location: edit.php?id=$id_inscription&error=" . urlencode($msg));
    exit;
}