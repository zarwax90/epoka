<?php

// variables pour configurer l'accès à la base de données 
$server = "localhost";  // peut-être remplacé par l'adresse IP 
$base  = "epoka";
$userdb = "root";
$userpwd = "root";

//Ouverture de la connexion vers le moteur de la base de données
try {
    $bdd = new PDO("mysql:host=$server;dbname=$base; charset=UTF8", $userdb, $userpwd);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
