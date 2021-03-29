<?php
include("../navbar.php");
if (isset($_SESSION['id'])) {
    if ($_SESSION['canValidate'] == 1) {

        // récupération des variables du formulaire 
        $id = $_POST['valide'];

        try {
            $req = $bdd->prepare("UPDATE missions SET validated = :validate WHERE id = :id");
            $req->execute(array(
                'validate' => 1,
                'id' => $id
            ));
            header('Location: ../page_php/validation.php');
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}

