<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/dragon.png" />
    <title>Présentation</title>
</head>

<body>
    <?php include("../navbar.php");
    if (isset($_SESSION['id'])) {
    ?>

        <div class="container my-3">
            <h1>Modification de votre mot de passe</h1>
            <form method="POST" action="../php/editMdp.php" class="was-validated">
                <div class="col-md-6">
                    <label for="inputPassword" class="form-label">Mot de passe actuel</label>
                    <input type="password" class="form-control" id="inputPassword" name="mdp" placeholder="Mot de passe actuel" required>
                </div>
                <div class="col-md-6">
                    <label for="inputNewPassword" class="form-label">Nouveau mot de passe</label>
                    <input type="password" class="form-control" id="inputNewPassword" name="newMdp" placeholder="Nouveau mot de passe" required>
                </div>
                <div class="col-md-6">
                    <label for="inputNewPassword2" class="form-label">Confirmer votre mot de passe</label>
                    <input type="password" class="form-control" id="inputNewPassword2" name="newMdp2" placeholder="Confirmer votre mot de passe" required>
                </div>
                <button type="submit" class="btn btn-primary my-3">Modifier</button>
            </form>
        </div>
    <?php } else {
        echo "Vous n'êtes pas connecté !";
    } ?>
</body>

</html>