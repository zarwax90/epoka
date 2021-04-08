<?php
//======================================================================
// CITY SELECTION SERVICE
//======================================================================

include 'connexionBdd.php';

$req = $db->prepare("SELECT * FROM cities WHERE cp LIKE '38%'");
$req->execute();

foreach ($req->fetchAll() as $ligne) {
    $output[] = array(
        'id' => $ligne['id'],
        'cp' => $ligne['cp'],
        'name' => $ligne['city_name']
    );
};
echo (json_encode($output));
