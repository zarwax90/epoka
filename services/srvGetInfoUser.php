<?php
//======================================================================
// USER SELECTION SERVICE
//======================================================================

include 'connexionBdd.php';

$req = $db->prepare("SELECT id, surname, name FROM user");
$req->execute();

foreach ($req->fetchAll() as $ligne) {
    $output[] = array(
        'id' => $ligne['id'],
        'surname' => $ligne['surname'],
        'name' => $ligne['name']
    );
};
echo (json_encode($output));