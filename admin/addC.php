<?php
include '../php/connexionBdd.php';

// récupération des variables du formulaire 
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$valide = $_POST['valide'];
$paye = $_POST['paye'];
$agence = $_POST['agence'];

//Hachage du mot de passe 
$mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);


//  Récupération de l'utilisateur et de son pass hashé

try {
    $req = $bdd->prepare("INSERT INTO user (nom, prenom, mdp, peutValider, peutPayer, idAgence) VALUES (:nom, :prenom, :mdp, :valide, :paye, :agence)");
    $req->execute(array(
        'nom' => $nom,
        'prenom' => $prenom,
        'mdp' => $mdp,
        'valide' => $valide,
        'paye' => $paye,
        'agence' => $agence
    ));
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
