<?php
include '../php/connexionBdd.php';

// récupération des variables du formulaire 
$city1 = $_POST['ville1'];
$city2 = $_POST['ville2'];
$km = $_POST['km'];

try {
    $req = $bdd->prepare("SELECT cities.id FROM cities WHERE cities.city_name = :city1");
    $req->execute(array(
        'city1' => $city1
    ));
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

try {
    $req2 = $bdd->prepare("SELECT cities.id FROM cities WHERE cities.city_name = :city2");
    $req2->execute(array(
        'city2' => $city2
    ));
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$data = $req->fetch();
$city1 = $data['id'];

$data = $req2->fetch();
$city2 = $data['id'];

try {
    $req3 = $bdd->prepare("INSERT INTO distance (idcity1, idcity2, Km) VALUES (:idcity1, :idcity2, :km)");
    $req3->execute(array(
        'idcity1' => $city1,
        'idcity2' => $city2,
        'km' => $km
    ));
    header('Location: ../page_php/parametre.php');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
