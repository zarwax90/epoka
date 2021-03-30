<?php
require('navbar.php');
require('model/model.php');
function index()
{
    require('view/connectionView.php');
}

function getConnexion($id, $password)
{
    $req = connexion($id, $password);

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
    $valide = getValidation();

    require('view/validationView.php');
}

function listPayment()
{
    $pay = getPayment();

    require('view/paymentView.php');
}

function listSettings()
{
    $settings = getSettings();
    $cities = getCities();
    $distance = getDistance();

    require('view/settingsView.php');
}
function distance($city1, $city2, $km)
{
    $affectedLines = postDistance($city1, $city2, $km);

    if ($affectedLines === false) {
        die('Impossible d\'ajouter la distance !');
    } else {
        header('Location: index.php?action=parametre');
    }
}

function updateSettings($km, $ind)
{
    $affectedLines = postSettings($km, $ind);

    if ($affectedLines === false) {
        die('Impossible de mettre à jour les paramètres !');
    } else {
        header('Location: index.php?action=parametre');
    }
}

function updateValidation($id)
{
    $statutValidation = postValidation($id);
    if ($statutValidation === false) {
        die('Impossible de valider !');
    } else {
        header('Location: index.php?action=validation');
    }
}

function updatePayment($id)
{
    $statutPayment = postPayment($id);
    if ($statutPayment === false) {
        die('Impossible de valider !');
    } else {
        header('Location: index.php?action=payment');
    }
}
