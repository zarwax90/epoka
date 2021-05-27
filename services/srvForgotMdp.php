<?php
//======================================================================
// ADD FORGOT MDP
//======================================================================

include 'connexionBdd.php';

$idUser = $_GET['idUser'];

try {
    $req = $db->prepare("INSERT INTO assistance (idUser, request) VALUES (:id, :request)");
    $req->execute(array(
        'id' => $idUser,
        'request' => 'Mot de passe oublié'
    ));
    echo ('Demande de réinitialisation effectuée');
} catch (Exception $e) {
    echo 'Exception reçue : ',  $e->getMessage(), "\n";
}
// http://localhost/epoka/services/srvForgotMdp.php?idUser=4