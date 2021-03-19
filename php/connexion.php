<?php

    // récupération des variables du formulaire 
    $id = $_POST['id'];
    $mdp = $_POST['mdp'];

    include 'connexionBdd.php';

    //  Récupération de l'utilisateur et de son pass hashé
    $req = $bdd->prepare("SELECT * FROM user WHERE id = :id");
    $req->execute(array(
        'id' => $id
    ));
    $resultat = $req->fetch();

    // Comparaison du pass envoyé via le formulaire avec la base
    $isPasswordCorrect = password_verify($_POST['mdp'], $resultat['mdp']);

    if (!$resultat) {
    ?>
        <script>
            window.setTimeout("location=('http://localhost/epoka/');", 3000);
        </script>
        <p class="text-center"><strong>Mauvais mot de passe...</strong></p>
        <div class="d-flex justify-content-center">
            <div class="spinner-border" role="status">
                <span class="sr-only">Mauvais mot de passe ...</span>
            </div>
        </div>
        <?php
    } else {
        if ($isPasswordCorrect) {
            session_start();
            $_SESSION['id'] = $resultat['id'];
            $_SESSION['nom'] = $resultat['nom'];
            $_SESSION['prenom'] = $resultat['prenom'];
        ?>
            <script>
                window.setTimeout("location=('http://localhost/epoka/');");
            </script>
            <p class="text-center"><strong>Connexion en cours...</strong></p>
            <div class="d-flex justify-content-center">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Connexion en cours...</span>
                </div>
            </div>
        <?php
        } else {
        ?>
            <script>
                window.setTimeout("location=('http://localhost/epoka/');", 3000);
            </script>
            <p class="text-center"><strong>Mauvais mot de passe...</strong></p>
            <div class="d-flex justify-content-center">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Mauvais mot de passe...</span>
                </div>
            </div>
    <?php
        }
    }
    ?>