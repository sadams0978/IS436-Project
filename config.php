<?php
require_once ('vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

session_start();

// Use Database
$db_connection = mysqli_connect($_ENV['db_hostname'],$_ENV['db_username'],$_ENV['db_password'],"google_login");
// CHECK DATABASE CONNECTION
if(mysqli_connect_errno()){
    echo "Connection Failed".mysqli_connect_error();
    exit;
}
