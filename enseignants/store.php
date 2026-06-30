<?php
require "../config/db.php";
require "../includes/functions.php";

<<<<<<< HEAD
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // استقبال البيانات من الفورم (create.php)
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];

    try {
        // الاستعلام الصحيح المتوافق مع قاعدة البيانات ديالك (nom و prenom)
        $stmt = $pdo->prepare("INSERT INTO enseignants (nom, prenom) VALUES (?, ?)");
        $stmt->execute([$nom, $prenom]);
        
        // الرجوع لصفحة الجدول بعد الإضافة بنجاح
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        die("Erreur d'insertion : " . $e->getMessage());
    }
=======
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
>>>>>>> ffbcf5db1f40f59fcdbf534f8a3de19c61a67984
}

$code_enseignant = trim($_POST['code_enseignant'] ?? '');
$nom              = trim($_POST['nom'] ?? '');
$prenom           = trim($_POST['prenom'] ?? '');
$email            = trim($_POST['email'] ?? '');

if ($code_enseignant === '' || $nom === '' || $prenom === '' || $email === '') {
    header("Location: create.php?error=" . urlencode("Tous les champs sont obligatoires."));
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: create.php?error=" . urlencode("L'adresse email n'est pas valide."));
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO enseignants (code_enseignant, nom, prenom, email) VALUES (?, ?, ?, ?)");
    $stmt->execute([$code_enseignant, $nom, $prenom, $email]);

    header("Location: index.php?success=1");
    exit;
} catch (PDOException $e) {
    $msg = messageErreurBD($e);
    if (stripos($e->getMessage(), 'code_enseignant') !== false) {
        $msg = "Ce matricule existe déjà, il doit être unique.";
    } elseif (stripos($e->getMessage(), 'email') !== false) {
        $msg = "Cet email est déjà utilisé par un autre enseignant.";
    }
    header("Location: create.php?error=" . urlencode($msg));
    exit;
}