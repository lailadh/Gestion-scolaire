<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>

<div style="text-align: center; margin-top: 30px;">
    <h1>🏫 Bienvenue dans l'application de Gestion Scolaire</h1>
    <p style="color: #666; font-size: 17px;">
        Sélectionnez une rubrique dans la barre de navigation pour commencer à gérer votre établissement.
    </p>
</div>

<div class="form-box" style="margin: 30px auto;">
    <h3 style="margin-top:0; border-bottom: 1px solid #eee; padding-bottom: 10px;">Accès Rapide</h3>
    <ul style="list-style: none; padding: 0;">
        <li style="margin: 10px 0;"><a href="eleves/index.php" class="btn btn-edit" style="width:100%; text-align:center; display:block;">👨‍🎓 Gestion des Élèves</a></li>
        <li style="margin: 10px 0;"><a href="classes/index.php" class="btn btn-edit" style="width:100%; text-align:center; display:block;">🏫 Gestion des Classes</a></li>
        <li style="margin: 10px 0;"><a href="enseignants/index.php" class="btn btn-edit" style="width:100%; text-align:center; display:block;">👨‍🏫 Gestion des Enseignants</a></li>
        <li style="margin: 10px 0;"><a href="matieres/index.php" class="btn btn-edit" style="width:100%; text-align:center; display:block;">📚 Gestion des Matières</a></li>
        <li style="margin: 10px 0;"><a href="inscriptions/index.php" class="btn btn-edit" style="width:100%; text-align:center; display:block;">📝 Gestion des Inscriptions</a></li>
        <li style="margin: 10px 0;"><a href="affectations/index.php" class="btn btn-edit" style="width:100%; text-align:center; display:block;">💼 Gestion des Affectations</a></li>
    </ul>
</div>

<?php include "includes/footer.php"; ?>
