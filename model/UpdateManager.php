<?php

require_once("Manager.php");

class UpdateManager extends Manager
{
    // Modification d'une validation
    public function updateValidation($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare("UPDATE missions SET validated = :validate WHERE id = :id");
        $statutValidation = $req->execute(array(
            'validate' => 1,
            'id' => $id
        ));

        return $statutValidation;
    }

    // Modification d'une validation
    public function updatePayment($id,$price)
    {
        $db = $this->dbConnect();
        $req = $db->prepare("UPDATE missions SET payed = :pay, priceMission = :price WHERE id = :id");
        $statutPayment = $req->execute(array(
            'pay' => 1,
            'id' => $id,
            'price' => $price
        ));

        return $statutPayment;
    }

    // Modification des paramètres
    public function updateSettings($km, $ind)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE settings SET priceKm = :km, priceDay = :day');
        $affectedLines = $req->execute(array(
            'km' => $km,
            'day' => $ind
        ));

        return $affectedLines;
    }
}
