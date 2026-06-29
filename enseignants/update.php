<?php
require "../config/db.php";
require "../includes/functions.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}

$id_enseignant   = $_POST['id_enseignant'] ?? '';
$code_enseignant = trim($_POST['code_enseignant'] ?? '');
$nom             = trim($_POST['nom'] ?? '');
$prenom          = trim($_POST['prenom'] ?? '');
$email           = trim($_POST['email'] ?? '');

if ($code_enseignant === '' || $nom === '' || $prenom === '' || $email === '') {
    header("Location: edit.php?id=$id_enseignant&error=" . urlencode("Tous les champs sont obligatoires."));
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: edit.php?id=$id_enseignant&error=" . urlencode("L'adresse email n'est pas valide."));
    exit;
}

try {
    $stmt = $pdo->prepare("UPDATE enseignants SET code_enseignant = ?, nom = ?, prenom = ?, email = ? WHERE id_enseignant = ?");
    $stmt->execute([$code_enseignant, $nom, $prenom, $email, $id_enseignant]);

    header("Location: index.php?success=1");
    exit;
} catch (PDOException $e) {
    $msg = messageErreurBD($e);
    if (stripos($e->getMessage(), 'code_enseignant') !== false) {
        $msg = "Ce matricule existe déjà, il doit être unique.";
    } elseif (stripos($e->getMessage(), 'email') !== false) {
        $msg = "Cet email est déjà utilisé par un autre enseignant.";
    }
    header("Location: edit.php?id=$id_enseignant&error=" . urlencode($msg));
    exit;
}