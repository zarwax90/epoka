<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="images/dragon.png" />
    <title>Identification</title>
</head>

<body>
    <?php include("navbar.php"); ?>

    <div class="container my-3">


        <form method="POST" action="php/connexion.php" class="was-validated">
            <div class="row">
                <div class="form-group col-md-4 mb-3">
                    <label for="inputPassword4">Identifiant</label>
                    <input type="number" placeholder="Identifiant" class="form-control" id="id" name="id" min="1" required>
                </div>
                <div class="form-group col-md-4 mb-3">
                    <label for="inputPassword4">Mot de passe</label>
                    <input type="password" placeholder="Mot de passe" class="form-control" id="inputPassword4" name="mdp" required>
                </div>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Connexion</button>
            </div>
        </form>
        <?php if (isset($_SESSION['id'])) { ?>
            <div class="alert alert-warning" role="alert">
                Vous êtes connecté !
            </div>
        <?php } else { ?>
            <div class="alert alert-danger" role="alert">
                Vous n'êtes pas connecté !
            </div>
        <?php } ?>
    </div>
</body>

</html>