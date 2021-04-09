<?php
//======================================================================
// MANAGER INSERT QUERIES
//======================================================================

require_once("Manager.php");
require_once("GetManager.php");

class PostManager extends Manager
{
    // Add distance
    public function postDistance($city1, $city2, $km)
    {
        $db = $this->dbConnect();

        $affectedLines = false;
        
        if ($city1 == $city2) {
            $affectedLines = 'equal';
            return $affectedLines;
        } else {
            $getManager = new GetManager();
            $req = $getManager->getOneDistance($city1, $city2);
            $resultat = $req->fetch();
            if (isset($resultat['idCity1'])) {
            } else {
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
            }
        }
        return $affectedLines;
    }
}
