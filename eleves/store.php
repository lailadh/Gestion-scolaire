<?php

require "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

$code_eleve = trim($_POST["code_eleve"] ?? "");
$nom = trim($_POST["nom"] ?? "");
$prenom = trim($_POST["prenom"] ?? "");
$email = trim($_POST["email"] ?? "");
$date_naissance = !empty($_POST["date_naissance"]) ? $_POST["date_naissance"] : null;

$errors = [];

if (empty($code_eleve)) {
    $errors[] = "Le code élève est obligatoire.";
}

if (empty($nom)) {
    $errors[] = "Le nom est obligatoire.";
}

if (empty($prenom)) {
    $errors[] = "Le prénom est obligatoire.";
}

if (empty($email)) {
    $errors[] = "L'email est obligatoire.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "L'email est invalide.";
}

if (!empty($errors)) {
    header("Location: create.php?error=" . urlencode(implode(" ", $errors)));
    exit;
}

try {

    $stmt = $pdo->prepare("
        INSERT INTO eleves
        (code_eleve, nom, prenom, email, date_naissance)
        VALUES (?, ?, ?, ?, ?)
    ");

    $stmt->execute([
        $code_eleve,
        $nom,
        $prenom,
        $email,
        $date_naissance
    ]);

    header("Location: index.php?success=1");
    exit;

} catch (PDOException $e) {

    header("Location: create.php?error=" . urlencode("Le code élève ou l'email existe déjà."));
    exit;

}