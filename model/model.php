<?php

// Récupération des validations
function getValidation()
{
    $db = dbConnect();
    $req = $db->prepare("SELECT user.name, user.surname, cities.cp, cities.city_name, missions.id, missions.start, missions.end, missions.validated, missions.payed 
    FROM missions, user, cities 
    WHERE missions.idDest = cities.id
    AND missions.idUser = user.id
    AND user.idResponsible =" . $_SESSION['id']);
    $req->execute();

    return $req;
}

// Modification d'une validation
function postValidation($id)
{
    $db = dbConnect();
    $req = $db->prepare("UPDATE missions SET validated = :validate WHERE id = :id");
    $statutValidation = $req->execute(array(
        'validate' => 1,
        'id' => $id
    ));

    return $statutValidation;
}

// Récupération des Payements
function getPayment()
{
    $db = dbConnect();
    $req = $db->prepare("SELECT user.surname, user.name, cities.cp, cities.city_name, missions.id, missions.start, missions.end, missions.validated, missions.payed
    FROM missions, user, cities 
    WHERE missions.idDest = cities.id
    AND missions.idUser = user.id
    AND missions.validated = 1");
    $req->execute();

    return $req;
}
// Modification d'une validation
function postPayment($id)
{
    $db = dbConnect();
    $req = $db->prepare("UPDATE missions SET payed = :pay WHERE id = :id");
    $statutPayment = $req->execute(array(
        'pay' => 1,
        'id' => $id
    ));

    return $statutPayment;
}

// Récupération des paramètres
function getSettings()
{
    $db = dbConnect();
    $req = $db->prepare("SELECT * FROM settings");
    $req->execute();

    return $req;
}

// Récupération des villes
function getCities()
{
    $db = dbConnect();
    $req = $db->prepare("SELECT * FROM cities WHERE cp LIKE '38%'");
    $req->execute();

    return $req;
}

// Récupération des distances
function getDistance()
{
    $db = dbConnect();
    $req = $db->prepare("SELECT d.Km, v1.city_name AS city1, v2.city_name AS city2 
    FROM distance d 
    JOIN cities v1 ON v1.id = d.idcity1 
    JOIN cities v2 ON v2.id = d.idcity2");
    $req->execute();

    return $req;
}

// Modification des paramètres
function postSettings($km, $ind)
{
    $db = dbConnect();
    $req = $db->prepare('UPDATE settings SET priceKm = :km, priceDay = :day');
    $affectedLines = $req->execute(array(
        'km' => $km,
        'day' => $ind
    ));

    return $affectedLines;
}



// Ajout d'une distance
function postDistance($city1, $city2, $km)
{
    $db = dbConnect();
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


// Connexion
function connexion($id, $password)
{
    $db = dbConnect();

    $req = $db->prepare("SELECT * FROM user WHERE id = :id");
    $req->execute(array(
        'id' => $id
    ));

    return $req;
}

// Fonction permettant la connection à la base de données
function dbConnect()
{
    try {
        $db = new PDO("mysql:host=localhost;dbname=epoka; charset=UTF8", 'root', 'root');
        return $db;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}
