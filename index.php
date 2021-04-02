<?php
require('controller/controller.php');

if (isset($_GET['action'])) {
    // Validation
    if ($_GET['action'] == 'validation' and isset($_SESSION['id']) and $_SESSION['canValidate'] == 1) {
        listValidation();

        // MAJ validation
    } else if ($_GET['action'] == 'updateValidation' and isset($_SESSION['id']) and $_SESSION['canValidate'] == 1) {
        if (!empty($_POST['valide'])) {
            validation($_POST['valide']);
        } else {
            header('Location: index.php?action=validation');
        }

        // Payment
    } else if ($_GET['action'] == 'payment' and isset($_SESSION['id']) and $_SESSION['canPay'] == 1) {
        listPayment();

        // MAJ payment
    } else if ($_GET['action'] == 'updatePayment' and isset($_SESSION['id']) and $_SESSION['canPay'] == 1) {
        if (!empty($_POST['valide']) && !empty($_POST['price'])) {
            payment($_POST['valide'], $_POST['price']);
        } else {
            header('Location: index.php?action=payment');
        }

        // Parametre
    } else if ($_GET['action'] == 'parametre' and isset($_SESSION['id']) and $_SESSION['canPay'] == 1) {
        listSettings();

        // MAJ parametre
    } else if ($_GET['action'] == 'updateSettings' and isset($_SESSION['id']) and $_SESSION['canPay'] == 1) {
        if (!empty($_POST['inputKm']) && !empty($_POST['inputInd'])) {
            settings($_POST['inputKm'], $_POST['inputInd']);
        } else {
            header('Location: index.php?action=parametre');
        }

        // Distance
    } else if ($_GET['action'] == 'distance' and isset($_SESSION['id']) and $_SESSION['canPay'] == 1) {
        if (!empty($_POST['text1']) && !empty($_POST['text2']) && !empty($_POST['km'])) {
            distance($_POST['text1'], $_POST['text2'], $_POST['km']);
        } else {
            header('Location: index.php?action=parametre');
        }

        // Formulaire pour modification mot de passe
    } else if ($_GET['action'] == 'editPassword' and isset($_SESSION['id'])) {
        password();

      // Modification du mot de passe
    } else if ($_GET['action'] == 'updatePassword' and isset($_SESSION['id'])) {
        if (!empty($_POST['password'] && $_SESSION['id'])) {
            newPassword($_POST['password'], $_SESSION['id']);
        } else {
            header('Location: index.php?action=parametre');
        }
        // Déconnexion
    } else if ($_GET['action'] == 'deconnexion') {
        deconnexion();

        // Connexion
    } else if ($_GET['action'] == 'connexion') {
        if (!empty($_POST['id']) && !empty($_POST['password'])) {
            connexion($_POST['id'], $_POST['password']);
        } else {
            echo 'Erreur : tous les champs ne sont pas remplis !';
        }
    } else {
        header('Location: index.php');
    }
} else {
    index();
}
