<?php

//initialize variable to hold connection params
$username = 'root';
$dsn = 'mysql:host=localhost;dbname=register';
$password = '';

try{

    //create an instance of the PDO class with the required params
    $db =  new PDO($dsn, $username, $password);

    //set pdo errornode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //display success message
    echo 'Connected to the register db';

} catch(PDOException $e){

    //display success message

    echo "connection failed". $e->getMessage();
}



