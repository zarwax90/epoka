<?php
//======================================================================
// AUTHENTICATION SERVICE
//======================================================================

include 'connexionBdd.php';

// récupération des variables du formulaire 
$id = $_GET['id'];
$password = $_GET['mdp'];

//  Récupération de l'utilisateur et de son pass hashé
$req = $db->prepare("SELECT id, surname, name, password, canValidate, canPay, idAgency FROM user WHERE id = :id");
$req->execute(array(
    'id' => $id
));
$resultat = $req->fetch();

// Comparaison du pass envoyé via le formulaire avec la base
$isPasswordCorrect = password_verify($password, $resultat['password']);

if (!$resultat) {
    echo 'user ou mdp incorrect';
} else {
    if ($isPasswordCorrect) {
        $output[] = $resultat;
        echo (json_encode($output));
    } else {
        echo 'user ou mdp incorrect';
    }
}
