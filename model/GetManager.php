<?php

require_once("Manager.php");

class GetManager extends Manager
{
    // Récupération des validations
    public function getValidation()
    {
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT user.name, user.surname, cities.cp, cities.city_name, missions.id, missions.start, missions.end, missions.validated, missions.payed 
        FROM missions, user, cities 
        WHERE missions.idDest = cities.id
        AND missions.idUser = user.id
        AND user.idResponsible =" . $_SESSION['id'] . "
        ORDER BY missions.validated");
        $req->execute();

        return $req;
    }

    // Récupération des Payements
    public function getPayment()
    {
        $db = $this->dbConnect();
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
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT * FROM settings");
        $req->execute();

        return $req;
    }

    // Récupération des villes
    public function getCities()
    {
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT * FROM cities");
        $req->execute();

        return $req;
    }

    // Connexion
    public function getConnexion($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT * FROM user WHERE id = :id");
        $req->execute(array(
            'id' => $id
        ));

        return $req;
    }

    // Récupération des distances
    public function getDistance()
    {
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT d.Km, v1.city_name AS city1, v2.city_name AS city2 
        FROM distance d 
        JOIN cities v1 ON v1.id = d.idcity1 
        JOIN cities v2 ON v2.id = d.idcity2");
        $req->execute();

        return $req;
    }

    // Récupération des distances
    public function getOneDistance($idCity1, $idCity2)
    {
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT *
        FROM distance d
        WHERE idCity1 = :city1
        AND idCity2 = :city2
        OR idCity1 = :city2
        AND idCity2 = :city1");
        $req->execute(array(
            'city1' => $idCity1,
            'city2' => $idCity2
        ));

        return $req;
    }

    // Récupération deu prix des trajets
    public function getPrice($id)
    {
        $db = $this->dbConnect();

        // récupération du nombre de km d'une mission
        $req = $db->prepare("SELECT d.Km
        FROM distance AS d
        WHERE d.idCity1 = (SELECT m.idDest FROM missions AS m WHERE m.id = :id) 
            AND d.idCity2 = (SELECT a.idCity FROM missions AS m,user AS u,agency AS a WHERE m.idUser = u.id AND u.idAgency = a.id AND m.id = :id)
            OR d.idCity2 = (SELECT m.idDest FROM missions AS m WHERE m.id = :id) 
            AND d.idCity1 = (SELECT a.idCity FROM missions AS m,user AS u,agency AS a WHERE m.idUser = u.id AND u.idAgency = a.id AND m.id = :id)");
        $req->execute(array(
            'id' => $id
        ));

        // nombre de jours
        $req2 = $db->prepare("SELECT DATEDIFF(end,start) AS duree
            FROM missions 
            WHERE id = :id");
        $req2->execute(array(
            'id' => $id
        ));

        $settings =  $this->getSettings();
        $settings = $settings->fetch();
        $resultat = $req->fetch();
        $duree = $req2->fetch();

        if ($resultat) {
            $price = ($resultat['Km'] * $settings['priceKm']) * 2 + ($settings['priceDay'] * $duree['duree']);
            $price = $price . " €";
        } else {
            $price = 'Distance non défini';
        }

        return $price;
    }

    public function getPriceMission($id)
    {
        $db = $this->dbConnect();

        // nombre de jours
        $req = $db->prepare("SELECT priceMission
                FROM missions 
                WHERE id = :id");
        $req->execute(array(
            'id' => $id
        ));
        $resultat = $req->fetch();
        if ($resultat['priceMission'] != NULL) {
            return $resultat['priceMission'];
        } else {
            $price = $this->getPrice($id);
            return $price;
        }
    }
}
