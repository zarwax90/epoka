<?php

require_once("Manager.php");

class PostManager extends Manager
{
    // Ajout d'une distance
    public function postDistance($city1, $city2, $km)
    {
        $db = Manager::dbConnect();
        try {
            $req = $db->prepare("SELECT cities.id FROM cities WHERE cities.city_name = :city1");
            $req->execute(array(
                'city1' => $city1
            ));
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }

        try {
            $req2 = $db->prepare("SELECT cities.id FROM cities WHERE cities.city_name = :city2");
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
            $req3 = $db->prepare("INSERT INTO distance (idcity1, idcity2, Km) VALUES (:idcity1, :idcity2, :km)");
            $affectedLines = $req3->execute(array(
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
