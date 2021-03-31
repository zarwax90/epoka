<?php
include 'connexionBdd.php';

$idUser = $_GET['idUser'];
$idCity = $_GET['idVille'];
$start = $_GET['debut'];
$end = $_GET['fin'];

try {
    $req = $db->prepare("INSERT INTO missions (start, end, idDest, idUser) VALUES (:start, :end, :idDest, :idUser)");
    $req->execute(array(
        'start' => $start,
        'end' => $end,
        'idDest' => $idCity,
        'idUser' => $idUser
    ));
    echo ('Mission ajoutée avec succès');
} catch (Exception $e) {
    echo 'Exception reçue : ',  $e->getMessage(), "\n";
}
// http://localhost/epoka/services/srvAddMission.php?idUser=4&idVille=50&debut=2021-03-02&fin=2021-03-17