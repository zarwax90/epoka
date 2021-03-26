<?php
include '../php/connexionBdd.php';

// récupération des variables du formulaire 
$nom = $_POST['nom'];
$ville = $_POST['ville'];

try {
    $req = $bdd->prepare("INSERT INTO agence (nom, idVille) VALUES (:nom, :ville)");
    $req->execute(array(
        'nom' => $nom,
        'ville' => $ville
    ));
    header('Location: addAgence.php');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
