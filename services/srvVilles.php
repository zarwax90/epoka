<?php
include '../php/connexionBdd.php';

$req = $bdd->prepare("SELECT * FROM ville WHERE cp LIKE '38%'");
$req->execute();

foreach ($req->fetchAll() as $ligne) {
    $output[] = array(
        'id' => $ligne['id'],
        'cp' => $ligne['cp'],
        'nom' => $ligne['vil_nom']
    );
};
echo (json_encode($output));
