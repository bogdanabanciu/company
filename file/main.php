<?php
    include("files.php");
    define("FULLTIME", 40);     //40 ore pe saptamana
    define("PARTIME4H", 20);    //20 ore pe saptamana
    define("PARTIME6H", 30);    //30 ore pe saptamana

    $database = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $database->connectToDatabase();

//    echo "Employee: ", $employee; // asta o sa mearga pt ca Bogdi implementeaza si functia _toString ;)
?>