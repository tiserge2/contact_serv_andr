<?php 

    $initialize_db ='CREATE DATABASE IF NOT EXISTS contact_db;
    use contact_db;

    #DROP TABLE contact_tb;
    CREATE TABLE IF NOT EXISTS contact_tb(
        id INT PRIMARY KEY AUTO_INCREMENT,
        firstname VARCHAR(50) DEFAULT "",
        lastname VARCHAR(50) DEFAULT "",
        email VARCHAR(50) NOT NULL DEFAULT "z@z.com"
    );';

	$DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
	$DATABASE_NAME = 'contact_db';
	
    try {
        $connection = new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
    	echo "ECHEC CONNEXION";
    }
?>