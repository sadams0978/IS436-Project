<?php
require_once ('vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();




session_start();
session_regenerate_id(true);
// change the information according to your database
$db_connection = mysqli_connect($_ENV['db_hostname'],$_ENV['db_username'],$_ENV['db_password'],"google_login");
// CHECK DATABASE CONNECTION
if(mysqli_connect_errno()){
    echo "Connection Failed".mysqli_connect_error();
    exit;
}