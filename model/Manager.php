<?php
//======================================================================
// MANAGE THE CONNECTION TO THE DATABASE
//======================================================================
class Manager
{
    // Connection to the database
    public function dbConnect()
    {
        try {
            $db = new \PDO("mysql:host=localhost;dbname=epoka; charset=UTF8", 'epoka', 'epoka');
            return $db;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
