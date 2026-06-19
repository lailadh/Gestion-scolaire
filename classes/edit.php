<?php include "../includes/header.php"; ?>
<?php include "../includes/navbar.php"; ?>

<?php
require "../config/db.php";

// التأكد من أن المعرف كاين في الرابط
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

try {
    // جلب بيانات القسم المختار باستعمال id_classe
    $stmt = $pdo->prepare("SELECT * FROM classes WHERE id_classe = ?");
    $stmt->execute([$id]);
    $classe = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$classe) {
        die("Classe introuvable !");
    }
} catch (PDOException $e) {
    die("Erreur de base de données : " . $e->getMessage());
}
?>

<h2>Modifier la Classe</h2>

<!-- الفورم كتحول البيانات لملف update.php -->
<form action="update.php" method="POST">
    <!-- حقل مخفي لتمرير id_classe -->
    <input type="hidden" name="id_classe" value="<?= htmlspecialchars($classe['id_classe']) ?>">
    
    <label>Nom de Classe:</label>
    <input name="nom" value="<?= htmlspecialchars($classe['nom_classe'] ?? '') ?>" required>
    
    <label>Niveau:</label>
    <input name="niveau" value="<?= htmlspecialchars($classe['niveau'] ?? '') ?>" required>
    
    <label>Capacité Max:</label>
    <input name="capacite" type="number" value="<?= htmlspecialchars($classe['capacite_max'] ?? '') ?>" required>
    
    <button type="submit">Modifier</button>
</form>

<?php include "../includes/footer.php"; ?>