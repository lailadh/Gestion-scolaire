<?php include "../includes/header.php"; ?>
<?php include "../includes/navbar.php"; ?>

<h2>Ajouter un Eleve</h2>

<div class="form-container">
    <form action="store.php" method="POST">
        <div class="form-group">
            <label>Code eleve (matricule) :</label>
            <input type="text" name="code_eleve" required placeholder="Ex: ELV011">
        </div>
        <div class="form-group">
            <label>Nom :</label>
            <input type="text" name="nom" required placeholder="Nom de famille">
        </div>
        <div class="form-group">
            <label>Prenom :</label>
            <input type="text" name="prenom" required placeholder="Prenom">
        </div>
        <div class="form-group">
            <label>Email :</label>
<input type="email" name="email" required placeholder="exemple@email.com">        </div>
        <div class="form-group">
            <label>Date de naissance :</label>
            <input type="date" name="date_naissance">
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-add">Enregistrer</button>
            <a href="index.php" class="btn btn-cancel">Annuler</a>
        </div>
    </form>
</div>

<?php include "../includes/footer.php"; ?>
