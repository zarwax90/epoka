<?php
include '../php/connexionBdd.php';

// récupération des variables du formulaire 
$km = $_POST['inputKm'];
$ind = $_POST['inputInd'];

try {
    $req = $bdd->prepare("UPDATE settings SET priceKm = :km, priceDay = :day");
    $req->execute(array(
        'km' => $km,
        'day' => $ind
    ));
    header('Location: ../page_php/parametre.php');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
