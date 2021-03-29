<?php
include '../php/connexionBdd.php';

// récupération des variables du formulaire 
$ville1 = $_POST['ville1'];
$ville2 = $_POST['ville2'];
$km = $_POST['km'];

try {
    $req = $bdd->prepare("SELECT ville.id FROM ville WHERE ville.vil_nom = :ville1");
    $req->execute(array(
        'ville1' => $ville1
    ));
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

try {
    $req2 = $bdd->prepare("SELECT ville.id FROM ville WHERE ville.vil_nom = :ville2");
    $req2->execute(array(
        'ville2' => $ville2
    ));
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$donnees = $req->fetch();
$ville1 = $donnees['id'];

$donnees = $req2->fetch();
$ville2 = $donnees['id'];

try {
    $req3 = $bdd->prepare("INSERT INTO distance (idVille1, idVille2, Km) VALUES (:idVille1, :idVille2, :km)");
    $req3->execute(array(
        'idVille1' => $ville1,
        'idVille2' => $ville2,
        'km' => $km
    ));
    header('Location: ../page_php/parametre.php');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
