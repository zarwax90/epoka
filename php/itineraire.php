<?php
include '../php/connexionBdd.php';

// récupération des variables du formulaire 
$ville1 = $_POST['ville1'];
$ville2 = $_POST['ville2'];
$km = $_POST['km'];

try {
    $req = $bdd->prepare("INSERT INTO distance (idVille1, idVille2, Km) VALUES (:idVille1, :idVille2, :km)");
    $req->execute(array(
        'idVille1' => $ville1,
        'idVille2' => $ville2,
        'km' => $km
    ));
    header('Location: ../page_php/parametre.php');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
