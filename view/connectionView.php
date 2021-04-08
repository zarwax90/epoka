<?php $title = 'Connexion'; ?>

<?php ob_start(); ?>
<div class="container my-3">
    <?php if (isset($_SESSION['id'])) { ?>
        <div class="alert alert-warning" role="alert">
            Vous êtes connecté !
        </div>
    <?php } else { ?>
        <form method="POST" action="index.php?action=connexion" class="was-validated">
            <div class="row">
                <div class="form-group col-md-4 mb-3">
                    <label for="inputPassword4">Identifiant</label>
                    <input type="number" placeholder="Identifiant" class="form-control" id="id" name="id" min="1" required>
                </div>
                <div class="form-group col-md-4 mb-3">
                    <label for="inputPassword4">Mot de passe</label>
                    <input type="password" placeholder="Mot de passe" class="form-control" id="inputPassword4" name="password" required>
                </div>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Connexion</button>
            </div>
        <?php } ?>
        </form>
        <?php echo ($alert) ?>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>