<?php

// récupération des variables du formulaire 
$id = $_POST['id'];
$mdp = $_POST['mdp'];

include 'connexionBdd.php';
include '../navbar.php';

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
    <p class="text-center"><strong>Mauvais mot de passe...</strong></p>
    <div class="d-flex justify-content-center">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Mauvais mot de passe ...</span>
        </div>
    </div>
    <script>
        window.setTimeout("location=('http://localhost/epoka/');", 3000);
    </script>
    <?php
} else {
    if ($isPasswordCorrect) {
        $_SESSION['id'] = $resultat['id'];
        $_SESSION['nom'] = $resultat['nom'];
        $_SESSION['prenom'] = $resultat['prenom'];
        $_SESSION['peutValider'] = $resultat['peutValider'];
        $_SESSION['peutPayer'] = $resultat['peutPayer'];
    ?>
        <p class="text-center"><strong>Connexion en cours...</strong></p>
        <div class="d-flex justify-content-center">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Connexion en cours...</span>
            </div>
        </div>
        <?php
        if ($_SESSION['peutPayer'] == 1) { ?>
            <script>
                window.setTimeout("location=('http://localhost/epoka/page_php/paiement.php');");
            </script>
        <?php } else if ($_SESSION['peutValider'] == 1) { ?>
            <script>
                window.setTimeout("location=('http://localhost/epoka/page_php/validation.php');");
            </script>
        <?php } else { ?>
            <script>
                window.setTimeout("location=('http://localhost/epoka/');");
            </script>
        <?php } ?>

        }else{
        ?>
    <?php
    } else {
    ?>
        <p class="text-center"><strong>Mauvais mot de passe...</strong></p>
        <div class="d-flex justify-content-center">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Mauvais mot de passe...</span>
            </div>
        </div>
        <script>
            window.setTimeout("location=('http://localhost/epoka/');", 3000);
        </script>
<?php
    }
}
?>