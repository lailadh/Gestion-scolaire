<?php include "../includes/header.php"; ?>
<?php include "../includes/navbar.php"; ?>

<?php
require "../config/db.php";

// التأكد من أن المعرف مرسل في الرابط
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

try {
    // البحث باستعمال id_eleve
    $e = $pdo->prepare("SELECT * FROM eleves WHERE id_eleve = ?");
    $e->execute([$id]);
    $eleve = $e->fetch(PDO::FETCH_ASSOC);

    if (!$eleve) {
        die("Élève introuvable !");
    }
} catch (PDOException $ex) {
    die("Erreur de base de données : " . $ex->getMessage());
}
?>

<h2>Modifier l'Élève</h2>

<form action="update.php" method="POST">
    <input type="hidden" name="id_eleve" value="<?= htmlspecialchars($eleve['id_eleve']) ?>">
    
    <label>Nom:</label>
    <input type="text" name="nom" value="<?= htmlspecialchars($eleve['nom'] ?? '') ?>" required>
    
    <label>Prénom:</label>
    <input type="text" name="prenom" value="<?= htmlspecialchars($eleve['prenom'] ?? '') ?>" required>
    
    <button type="submit">Update</button>
</form>

<?php include "../includes/footer.php"; ?>