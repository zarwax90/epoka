<?php
include '../services/connexionBdd.php';

// récupération des variables du formulaire 
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$valide = $_POST['valide'];
$paye = $_POST['paye'];
$agence = $_POST['agence'];
$resp = $_POST['resp'];

//Hachage du mot de passe 
$mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);


//  Récupération de l'utilisateur et de son pass hashé

try {
    $req = $db->prepare("INSERT INTO user (surname, name, password, canValidate, canPay, idAgency, idResponsible) VALUES (:nom, :prenom, :mdp, :valide, :paye, :agence, :resp)");
    $req->execute(array(
        'nom' => $nom,
        'prenom' => $prenom,
        'mdp' => $mdp,
        'valide' => $valide,
        'paye' => $paye,
        'agence' => $agence,
        'resp' => $resp
    ));
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
