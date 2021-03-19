<?php
include '../php/connexionBdd.php';
$req = $bdd->prepare("SELECT cp FROM ville GROUP BY cp");
$req->execute();

$return_arr['cp'] = array();
while ($resultat = $req->fetch()) {
    array_push($return_arr['cp'], array(
        'cp'=>$resultat['cp']
    ));
}
echo json_encode($return_arr);