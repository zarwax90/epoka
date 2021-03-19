<?php
include '../php/connexionBdd.php';
// $stmt = $pdo->prepare("SELECT nom FROM commune WHERE nom like :debut", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
// $stmt->bindValue(":debut", $_GET["debut"] . "%", PDO::PARAM_STR);
// $stmt->execute();
// foreach ($stmt->fetchAll() as $ligne) {
//     //echo ($ligne [0] . "\n");
//     $output[] = $ligne;
// };
// echo (json_encode($output));


// récupération des variables du formulaire 
$id = $_GET['id'];
$mdp = $_GET['mdp'];

//  Récupération de l'utilisateur et de son pass hashé
$req = $bdd->prepare("SELECT id, nom, prenom, mdp, peutValider, peutPayer, idAgence FROM user WHERE id = :id");
$req->execute(array(
    'id' => $id
));
$resultat = $req->fetch();

// Comparaison du pass envoyé via le formulaire avec la base
$isPasswordCorrect = password_verify($mdp, $resultat['mdp']);

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
