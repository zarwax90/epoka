<?php
require('navbar.php');
require_once('model/GetManager.php');
require_once('model/PostManager.php');
require_once('model/UpdateManager.php');

function index()
{
    require('view/connectionView.php');
}

function connexion($id, $password)
{

    $getManager = new GetManager();
    $req = $getManager->getConnexion($id, $password);

    $resultat = $req->fetch();

    // Comparaison du pass envoyé via le formulaire avec la base
    $isPasswordCorrect = password_verify($password, $resultat['password']);

    if (!$resultat) {
    } else {
        if ($isPasswordCorrect) {
            $_SESSION['id'] = $resultat['id'];
            $_SESSION['surname'] = $resultat['surname'];
            $_SESSION['name'] = $resultat['name'];
            $_SESSION['canValidate'] = $resultat['canValidate'];
            $_SESSION['canPay'] = $resultat['canPay'];
        } else {
            header('Location: index.php');
        }
    }
    if ($_SESSION['canPay'] == 1) {
        header('Location: index.php?action=payment');
    } else if ($_SESSION['canValidate'] == 1) {
        header('Location: index.php?action=validation');
    } else {
        header('Location: index.php');
    }
}

function deconnexion()
{
    $_SESSION = array();
    session_destroy();
    header('Location: index.php');
}

function listValidation()
{
    $getManager = new GetManager();
    $valide = $getManager->getValidation();

    require('view/validationView.php');
}

function listPayment()
{

    $getManager = new GetManager();
    $pay = $getManager->getPayment();

    require('view/paymentView.php');
}

function listSettings()
{

    $getManager = new GetManager();
    $settings = $getManager->getSettings();
    $cities = $getManager->getCities();
    $distance = $getManager->getDistance();

    require('view/settingsView.php');
}
function distance($city1, $city2, $km)
{

    $postManager = new PostManager();
    $affectedLines = $postManager->postDistance($city1, $city2, $km);

    if ($affectedLines === false) {
        die('Impossible d\'ajouter la distance !');
    } else {
        header('Location: index.php?action=parametre');
    }
}

function settings($km, $ind)
{


    $updateManager = new UpdateManager();
    $affectedLines = $updateManager->updateSettings($km, $ind);

    if ($affectedLines === false) {
        die('Impossible de mettre à jour les paramètres !');
    } else {
        header('Location: index.php?action=parametre');
    }
}

function validation($id)
{

    $updateManager = new UpdateManager();
    $statutValidation = $updateManager->updateValidation($id);


    if ($statutValidation === false) {
        die('Impossible de valider !');
    } else {
        header('Location: index.php?action=validation');
    }
}

function payment($id, $price)
{

    $updateManager = new UpdateManager();
    $statutPayment = $updateManager->updatePayment($id, $price);

    if ($statutPayment === false) {
        die('Impossible de valider !');
    } else {
        header('Location: index.php?action=payment');
    }
}
