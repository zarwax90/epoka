<?php
//======================================================================
// CONNECTION TO THE DATABASE
//======================================================================

try {
    $db = new \PDO("mysql:host=localhost;dbname=epoka; charset=UTF8", 'root', 'root');
    return $db;
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
