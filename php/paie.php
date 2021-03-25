<?php
include("../navbar.php");
if (isset($_SESSION['id'])) {
    if ($_SESSION['peutPayer'] == 1) {
        

        // récupération des variables du formulaire 
        $id = $_POST['valide'];

        try {
            $req = $bdd->prepare("UPDATE mission SET payée = :paie WHERE id = :id");
            $req->execute(array(
                'paie' => 1,
                'id' => $id
            ));
            header('Location: ../page_php/paiement.php');
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
