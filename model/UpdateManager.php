<?php
//======================================================================
// MANAGER UPDATE QUERIES
//======================================================================

require_once("Manager.php");

class UpdateManager extends Manager
{
    // Editing a validation
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

    // Editing a payment
    public function updatePayment($id, $price)
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

    // Settings modification
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

    // Edit password
    public function updatePassword($password, $newPassword, $newPassword2, $id)
    {
        $getManager = new GetManager();
        $req = $getManager->getInfoUser();
        $resultat = $req->fetch();
        $isPasswordCorrect = password_verify($password, $resultat['password']);

        if ($newPassword != $newPassword2) {
            $affectedLines = false;
            return $affectedLines;
        } else {
            if (!$resultat) {
                $affectedLines = "erreur";
                return $affectedLines;
            } else {
                if ($isPasswordCorrect) {
                    $db = $this->dbConnect();
                    $password = password_hash($newPassword, PASSWORD_DEFAULT);
                    $req = $db->prepare('UPDATE user SET password = :password WHERE id = :id');
                    $affectedLines = $req->execute(array(
                        'password' => $password,
                        'id' => $id
                    ));
                    return $affectedLines;
                }
            }
        }
    }

    // Cancel validation
    public function cancelValidation($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare("UPDATE missions SET validated = :validate WHERE id = :id");
        $statutValidation = $req->execute(array(
            'validate' => 0,
            'id' => $id
        ));

        return $statutValidation;
    }

    // Cancel payment
    public function cancelPayment($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare("UPDATE missions SET payed = :pay, priceMission = :price WHERE id = :id");
        $statutPayment = $req->execute(array(
            'pay' => 0,
            'id' => $id,
            'price' => NULL
        ));

        return $statutPayment;
    }
}
