<?php
if (isset($_SESSION['id'])) {
    if ($_SESSION['peutValider'] == 1) {
        include '../php/connexionBdd.php';

        // récupération des variables du formulaire 
        $id = $_POST['valide'];

        try {
            $req = $bdd->prepare("UPDATE mission SET validée = :valide WHERE id = :id");
            $req->execute(array(
                'valide' => 1,
                'id' => $id
            ));
            header('Location: ../page_php/validation.php');
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}

