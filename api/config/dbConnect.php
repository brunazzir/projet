<?php

function connectDB() {
    $server = '127.0.0.1';
    $pseudo = 'root';
    $pwd = '';
    $dbname = 'cookingdata';

    static $db = null;

    if ($db === null) {
        try {
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $db = new PDO("mysql:host=$server;dbname=$dbname", $pseudo, $pwd, $pdo_options);
            $db->exec('SET CHARACTER SET utf8');
        } catch (Exception $exc) {
            //die('Impossible de se connecter Ã  la base de donnÃ©es. Veuillez essayer ultÃ©rieurement !');
            throw $exc;
        }
    }
    return $db;
}


