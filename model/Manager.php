<?php
//======================================================================
// MANAGE THE CONNECTION TO THE DATABASE
//======================================================================
class Manager
{
    // Fonction permettant la connection à la base de données
    public function dbConnect()
    {
        try {
            $db = new \PDO("mysql:host=localhost;dbname=epoka; charset=UTF8", 'root', 'root');
            return $db;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
