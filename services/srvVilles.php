<?php
include '../php/connexionBdd.php';

$req = $bdd->prepare("SELECT * FROM ville LIMIT 50");
$req->execute();

// $return_arr['villes'] = array();
// while ($resultat = $req->fetch()) {
//     array_push($return_arr['villes'], array(
//         'id' => $resultat['id'],
//         'cp' => $resultat['cp'],
//         'nom' => $resultat['nom']
//     ));
// }
foreach ($req->fetchAll() as $ligne) {
    $output[] = array(
        'id' => $ligne['id'],
        'cp' => $ligne['cp'],
        'nom' => $ligne['nom']
    );
};
echo (json_encode($output));
