<?php
session_start();
include 'php/connexionBdd.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid ">
            <a class="navbar-brand" href="http://localhost/epoka/">Epoka</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php if (isset($_SESSION['id']) == false) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="http://localhost/epoka/">Connexion</a>
                        </li>
                        <?php }
                    if (isset($_SESSION['id']) and isset($_SESSION['nom']) and isset($_SESSION['prenom'])) {
                        if ($_SESSION['peutValider'] == 1) { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="http://localhost/epoka/page_php/validation.php">Validation des missions</a>
                            </li>
                        <?php }

                        if ($_SESSION['peutPayer'] == 1) { ?>
                            <li class="nav-item active">
                                <a class="nav-link" href="http://localhost/epoka/page_php/paiement.php">Paiement des frais</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="http://localhost/epoka/page_php/parametre.php">Paramétrage</a>
                            </li>
                        <?php } ?>
                    <?php } ?>


                </ul>
                <?php if (isset($_SESSION['id']) and isset($_SESSION['nom']) and isset($_SESSION['prenom'])) { ?>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php echo $_SESSION['nom'] . " " . $_SESSION['prenom']; ?>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="http://localhost/epoka/page_php/editMdp.php">Modifier mon mot de passe</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="http://localhost/epoka/php/deconnexion.php">Se déconnecter</a>
                            </div>
                        </li>
                    </ul>
                <?php } else {
                } ?>
            </div>
        </div>
    </nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>

</html>