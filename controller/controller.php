<?php
//======================================================================
// CONTROLLER
//======================================================================

require('navbar.php');
require_once('model/GetManager.php');
require_once('model/PostManager.php');
require_once('model/UpdateManager.php');

//----------------------------------------------------------------------
// VUE
//----------------------------------------------------------------------

// index (Connexion)
function index()
{
    if (isset($_SESSION['errorConnexion'])) {
        unset($_SESSION['errorConnexion']);
        $alert = '<div class="alert alert-danger" role="alert">Identifiant ou mot de passe incorrect !</div>';
    } else if (isset($_SESSION['id'])) {
        $alert = NULL;
    } else {
        $alert = '<div class="alert alert-danger" role="alert">Vous n\'êtes pas connecté ! </div>';
    }

    require('view/connectionView.php');
}

// Edit password
function password()
{
    if (isset($_SESSION['errorPassword'])) {
        unset($_SESSION['errorPassword']);
        $alert = '<div class="alert alert-danger my-3" role="alert">
                    Les mots de passe ne sont pas pareils !
                </div>';
    } else if (isset($_SESSION['errorNewPassword'])) {
        unset($_SESSION['errorNewPassword']);
        $alert = '<div class="alert alert-danger my-3" role="alert">
                    Mauvais mot de passe !
                </div>';
    } else if (isset($_SESSION['newPassword'])) {
        unset($_SESSION['newPassword']);
        $alert = '<div class="alert alert-warning my-3" role="alert">
                    Mot de passe modifié !
                </div>';
    } else {
        $alert = NULL;
    }
    require('view/editPasswordView.php');
}

// Validation 
function listValidation()
{
    $getManager = new GetManager();
    $valide = $getManager->getValidation();

    require('view/validationView.php');
}

// Payment
function listPayment()
{

    $getManager = new GetManager();
    $pay = $getManager->getPayment();

    require('view/paymentView.php');
}

// Settings
function listSettings($idUser)
{

    $getManager = new GetManager();
    $settings = $getManager->getSettings();
    $cities = $getManager->getCities();
    $distance = $getManager->getDistance();

    if (isset($_SESSION['errorDistance'])) {
        unset($_SESSION['errorDistance']);
        $alert = '<div class="alert alert-danger my-3" role="alert">
                    Distance déjà existante !
                </div>';
    } else if (isset($_SESSION['errorDistanceEqual'])) {
        unset($_SESSION['errorDistanceEqual']);
        $alert = '<div class="alert alert-danger my-3" role="alert">
                    Impossible de saisir les mêmes villes !
                </div>';
    } else {
        $alert = NULL;
    }
    require('view/settingsView.php');
}

//----------------------------------------------------------------------
// ACTION
//----------------------------------------------------------------------

// Edit password
function newPassword($password, $newPassword, $newPassword2, $id)
{
    $updateManager = new UpdateManager();
    $affectedLines = $updateManager->updatePassword($password, $newPassword, $newPassword2, $id);

    if ($affectedLines === false) {
        $_SESSION['errorPassword'] = true;
        header('Location: index.php?action=editPassword');
    } else if ($affectedLines != 1) {
        $_SESSION['errorNewPassword'] = true;
        header('Location: index.php?action=editPassword');
    } else {
        $_SESSION['newPassword'] = true;
        header('Location: index.php?action=editPassword');
    }
}

// Connexion
function connexion($id, $password)
{

    $getManager = new GetManager();
    $req = $getManager->getConnexion($id);
    $resultat = $req->fetch();

    if (!$resultat) {
        $_SESSION['errorConnexion'] = true;
        header('Location: index.php');
    } else {
        // Comparaison du pass envoyé via le formulaire avec la base
        $isPasswordCorrect = password_verify($password, $resultat['password']);

        if ($isPasswordCorrect) {
            $_SESSION['id'] = $resultat['id'];
            $_SESSION['surname'] = $resultat['surname'];
            $_SESSION['name'] = $resultat['name'];
            $_SESSION['canValidate'] = $resultat['canValidate'];
            $_SESSION['canPay'] = $resultat['canPay'];
            // setcookie("id", $resultat['id'], time() + 3600);
            // setcookie("surname", $resultat['surname'], time() + 3600);
            // setcookie("name", $resultat['name'], time() + 3600);
            // setcookie("canValidate", $resultat['canValidate'], time() + 3600);
            // setcookie("canPay", $resultat['canPay'], time() + 3600);
        } else {
            $_SESSION['errorConnexion'] = true;
            header('Location: index.php');
        }

        if ($_SESSION['canPay'] == 1) {
            header('Location: index.php?action=payment');
        } else if ($_SESSION['canValidate'] == 1) {
            header('Location: index.php?action=validation');
        } else {
            header('Location: index.php');
        }
    }
}

// Adding a distance
function distance($city1, $city2, $km)
{

    $postManager = new PostManager();
    $affectedLines = $postManager->postDistance($city1, $city2, $km);

    if ($affectedLines === false) {
        $_SESSION['errorDistance'] = true;
        header('Location: index.php?action=settings');
    } else if ($affectedLines != 1) {
        $_SESSION['errorDistanceEqual'] = true;
        header('Location: index.php?action=settings');
    } else {
        header('Location: index.php?action=settings');
    }
}

// Parameter modification
function settings($km, $ind)
{

    $updateManager = new UpdateManager();
    $affectedLines = $updateManager->updateSettings($km, $ind);

    if ($affectedLines === false) {
        die('Impossible de mettre à jour les paramètres !');
    } else {
        header('Location: index.php?action=settings');
    }
}

// Update validation
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

// Cancel validation
function validationCanceled($id)
{
    $updateManager = new UpdateManager();
    $statutValidation = $updateManager->cancelValidation($id);

    if ($statutValidation === false) {
        die('Impossible de valider !');
    } else {
        header('Location: index.php?action=validation');
    }
}

// Update payment 
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

// Cancel paayment
function paymentCanceled($id)
{
    $updateManager = new UpdateManager();
    $statutPayment = $updateManager->cancelPayment($id);

    if ($statutPayment === false) {
        die('Impossible de valider !');
    } else {
        header('Location: index.php?action=payment');
    }
}

// Deconnexion
function deconnexion()
{
    $_SESSION = array();
    session_destroy();
    header('Location: index.php');
}
