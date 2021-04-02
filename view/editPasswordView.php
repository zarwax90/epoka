<?php $title = 'Modification du mot de passe'; ?>

<?php ob_start(); ?>

<div class="container my-3">
    <h1>Modification de votre mot de passe</h1>
    <form method="POST" action="index.php?action=updatePassword" class="was-validated">
        <div class="col-md-6">
            <label for="inputPassword" class="form-label">Mot de passe actuel</label>
            <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Mot de passe actuel" required>
        </div>
        <div class="col-md-6">
            <label for="inputNewPassword" class="form-label">Nouveau mot de passe</label>
            <input type="password" class="form-control" id="inputNewPassword" name="newPassword" placeholder="Nouveau mot de passe" required>
        </div>
        <div class="col-md-6">
            <label for="inputNewPassword2" class="form-label">Confirmer votre mot de passe</label>
            <input type="password" class="form-control" id="inputNewPassword2" name="newPassword2" placeholder="Confirmer votre mot de passe" required>
        </div>
        <button type="submit" class="btn btn-primary my-3">Modifier</button>
    </form>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>