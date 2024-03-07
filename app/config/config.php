<?php

session_start();

//povezivanje sa bazom

$servername = "localhost";
$db_username = "root";
$db_password = "";
$database_name = "shop";

$conn = mysqli_connect($servername,$db_username,$db_password,$database_name);

if(!$conn){
    die("Neuspesna konekcija");
}