<?php
include("../navbar.php");
if (isset($_SESSION['id'])) {
    if ($_SESSION['canPay'] == 1) {
        

        // récupération des variables du formulaire 
        $id = $_POST['valide'];

        try {
            $req = $bdd->prepare("UPDATE missions SET payed = :pay WHERE id = :id");
            $req->execute(array(
                'pay' => 1,
                'id' => $id
            ));
            header('Location: ../page_php/paiement.php');
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
