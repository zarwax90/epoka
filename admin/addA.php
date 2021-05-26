<?php
include '../services/connexionBdd.php';

// récupération des variables du formulaire 
$nom = $_POST['nom'];
$ville = $_POST['ville'];

try {
    $req = $db->prepare("INSERT INTO agency (name, idCity) VALUES (:nom, :ville)");
    $req->execute(array(
        'nom' => $nom,
        'ville' => $ville
    ));
    header('Location: addAgence.php');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
