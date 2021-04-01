<?php

require_once("Manager.php");

class PostManager extends Manager
{
    // Ajout d'une distance
    public function postDistance($city1, $city2, $km)
    {
        $db = $this->dbConnect();
        try {
            $req = $db->prepare("INSERT INTO distance (idcity1, idcity2, Km) VALUES (:idcity1, :idcity2, :km)");
            $affectedLines = $req->execute(array(
                'idcity1' => $city1,
                'idcity2' => $city2,
                'km' => $km
            ));
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }

        return $affectedLines;
    }
}
