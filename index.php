<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>

<div style="text-align: center; margin-top: 50px;">
    <h1>🏫 Bienvenue dans l'application de Gestion Scolaire</h1>
    <p style="color: #666; font-size: 18px;">Sélectionnez une rubrique dans la barre de navigation ci-dessus pour commencer à gérer votre établissement.</p>
</div>

<div style="max-width: 600px; margin: 40px auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
    <h3 style="color: #2c3e50; border-bottom: 1px solid #eee; padding-bottom: 10px;">Accès Rapide :</h3>
    <ul style="list-style: none; padding: 0;">
        <li style="margin: 10px 0;"><a href="eleves/" class="btn btn-edit" style="width: 100%; text-align: center; box-sizing: border-box;">👨‍🎓 Gestion des Élèves</a></li>
        <li style="margin: 10px 0;"><a href="classes/" class="btn btn-edit" style="width: 100%; text-align: center; box-sizing: border-box;">🏫 Gestion des Classes</a></li>
        <li style="margin: 10px 0;"><a href="enseignants/" class="btn btn-edit" style="width: 100%; text-align: center; box-sizing: border-box;">👨‍🏫 Gestion des Enseignants</a></li>
        <li style="margin: 10px 0;"><a href="matieres/" class="btn btn-edit" style="width: 100%; text-align: center; box-sizing: border-box;">📚 Gestion des Matières</a></li>
        
        <li style="margin: 10px 0;"><a href="affectations/" class="btn btn-edit" style="width: 100%; text-align: center; box-sizing: border-box;">💼 Gestion des Affectations</a></li>
    </ul>
</div>

<?php include "includes/footer.php"; ?>