<?php

require_once("Manager.php");

class GetManager extends Manager
{
    // Récupération des validations
    public function getValidation()
    {
        $db = Manager::dbConnect();
        $req = $db->prepare("SELECT user.name, user.surname, cities.cp, cities.city_name, missions.id, missions.start, missions.end, missions.validated, missions.payed 
    FROM missions, user, cities 
    WHERE missions.idDest = cities.id
    AND missions.idUser = user.id
    AND user.idResponsible =" . $_SESSION['id']);
        $req->execute();

        return $req;
    }

    // Récupération des Payements
    public function getPayment()
    {
        $db = Manager::dbConnect();
        $req = $db->prepare("SELECT user.surname, user.name, cities.cp, cities.city_name, missions.id, missions.start, missions.end, missions.validated, missions.payed
    FROM missions, user, cities 
    WHERE missions.idDest = cities.id
    AND missions.idUser = user.id
    AND missions.validated = 1");
        $req->execute();

        return $req;
    }

    // Récupération des paramètres
    public function getSettings()
    {
        $db = Manager::dbConnect();
        $req = $db->prepare("SELECT * FROM settings");
        $req->execute();

        return $req;
    }

    // Récupération des villes
    public function getCities()
    {
        $db = Manager::dbConnect();
        $req = $db->prepare("SELECT * FROM cities WHERE cp LIKE '38%'");
        $req->execute();

        return $req;
    }

    // Connexion
    public function connexion($id, $password)
    {
        $db = Manager::dbConnect();
        $req = $db->prepare("SELECT * FROM user WHERE id = :id");
        $req->execute(array(
            'id' => $id
        ));

        return $req;
    }

    // Récupération des distances
    public function getDistance()
    {
        $db = Manager::dbConnect();
        $req = $db->prepare("SELECT d.Km, v1.city_name AS city1, v2.city_name AS city2 
    FROM distance d 
    JOIN cities v1 ON v1.id = d.idcity1 
    JOIN cities v2 ON v2.id = d.idcity2");
        $req->execute();

        return $req;
    }
}