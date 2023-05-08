<?php
//Check if user is signed in using session variable
require 'config.php';

if(!isset($_SESSION['login_id'])){
     header('Location: login.php');
    exit;
}


$password = $_POST['password'];
$id = $_SESSION['login_id'];
$password = htmlspecialchars($password);
$password = mysqli_real_escape_string($db_connection, $password);
$password_hash = password_hash($password, PASSWORD_DEFAULT);

$update = mysqli_query($db_connection, "UPDATE `users` SET `password_hash`='$password_hash' WHERE `id`='$id'");

if($update){
    header ('Location: logout.php');
    exit();

}
else{
    echo "Sorry, something went wrong";
}


?>