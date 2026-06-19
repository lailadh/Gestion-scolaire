<?php
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // استقبال البيانات القادمة من نموذج الإضافة
    $id_enseignant  = $_POST['id_enseignant'];
    $id_classe      = $_POST['id_classe'];
    $id_matiere     = $_POST['id_matiere'];
    $annee_scolaire = $_POST['annee_scolaire'];

    // التأكد من أن جميع الحقول ليست فارغة
    if (!empty($id_enseignant) && !empty($id_classe) && !empty($id_matiere) && !empty($annee_scolaire)) {
        try {
            // استعلام إدخال البيانات متوافق تماماً مع بنية جدولك الحالي
            $sql = "INSERT INTO affectations (id_enseignant, id_classe, id_matiere, annee_scolaire) 
                    VALUES (?, ?, ?, ?)";
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id_enseignant, $id_classe, $id_matiere, $annee_scolaire]);

            // إعادة التوجيه إلى صفحة العرض الرئيسية مع رسالة نجاح
            header('Location: index.php?success=1');
            exit;
            
        } catch (PDOException $e) {
            die("Erreur lors de l'enregistrement de l'affectation : " . $e->getMessage());
        }
    } else {
        die("Veuillez remplir tous les champs obligatoires.");
    }
} else {
    header('Location: index.php');
    exit;
}