<?php
include '../php/connexionBdd.php';

$idUser = $_GET['idUser'];
$idVille = $_GET['idVille'];
$debut = $_GET['debut'];
$fin = $_GET['fin'];

try {
    $req = $bdd->prepare("INSERT INTO mission (debut, fin, idDest, idUser) VALUES (:debut, :fin, :idDest, :idUser)");
    $req->execute(array(
        'debut' => $debut,
        'fin' => $fin,
        'idDest' => $idVille,
        'idUser' => $idUser
    ));
    echo ('Mission ajoutée avec succès');
} catch (Exception $e) {
    echo 'Exception reçue : ',  $e->getMessage(), "\n";
}
// http://localhost/epoka/services/srvAddMission.php?idUser=4&idVille=50&debut=2021-03-02&fin=2021-03-17