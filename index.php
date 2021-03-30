<?php
require('controller/controller.php');

if (isset($_GET['action'])) {
    // Validation
    if ($_GET['action'] == 'validation' and isset($_SESSION['id']) and $_SESSION['canValidate'] == 1) {
        listValidation();

        // MAJ validation
    } else if ($_GET['action'] == 'updateValidation' and isset($_SESSION['id']) and $_SESSION['canValidate'] == 1) {
        if (!empty($_POST['valide'])) {
            updateValidation($_POST['valide']);
        } else {
            echo 'Erreur : tous les champs ne sont pas remplis !';
        }

        // Payment
    } else if ($_GET['action'] == 'payment' and isset($_SESSION['id']) and $_SESSION['canPay'] == 1) {
        listPayment();

        // MAJ payment
    } else if ($_GET['action'] == 'updatePayment' and isset($_SESSION['id']) and $_SESSION['canPay'] == 1) {
        if (!empty($_POST['valide'])) {
            updatePayment($_POST['valide']);
        } else {
            echo 'Erreur : tous les champs ne sont pas remplis !';
        }

        // Parametre
    } else if ($_GET['action'] == 'parametre' and isset($_SESSION['id']) and $_SESSION['canPay'] == 1) {
        listSettings();

        // MAJ parametre
    } else if ($_GET['action'] == 'updateSettings' and isset($_SESSION['id']) and $_SESSION['canPay'] == 1) {
        if (!empty($_POST['inputKm']) && !empty($_POST['inputInd'])) {
            updateSettings($_POST['inputKm'], $_POST['inputInd']);
        } else {
            echo 'Erreur : tous les champs ne sont pas remplis !';
        }

        // Distance
    } else if ($_GET['action'] == 'distance' and isset($_SESSION['id']) and $_SESSION['canPay'] == 1) {
        if (!empty($_POST['ville1']) && !empty($_POST['ville2']) && !empty($_POST['km'])) {
            distance($_POST['ville1'], $_POST['ville2'], $_POST['km']);
        } else {
            echo 'Erreur : tous les champs ne sont pas remplis !';
        }

        // Déconnexion
    } else if ($_GET['action'] == 'deconnexion') {
        deconnexion();

        // Connexion
    } else if ($_GET['action'] == 'connexion') {
        if (!empty($_POST['id']) && !empty($_POST['password'])) {
            getConnexion($_POST['id'], $_POST['password']);
        } else {
            echo 'Erreur : tous les champs ne sont pas remplis !';
        }
    } else {
        header('Location: index.php');
    }
} else {
    index();
}
