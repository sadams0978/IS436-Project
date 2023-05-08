<?php
require 'config.php';

if(!isset($_SESSION['login_id'])){
    header('Location: home.php');
    exit;
}


//Get the user's role
$user_id = $_SESSION['login_id'];
$role = mysqli_query($db_connection, "SELECT `role` FROM `users` WHERE `id` = '$user_id'");
$role = mysqli_fetch_assoc($role);
$role = $role['role'];


if ($role !== 'admin') {
    header('Location: https://my.umbc.edu/401');
    die();
}

if (!isset ($_GET['id']) ){
    echo ("Please make sure to enter in the UserID of the person who you want to delete.");
    die();
}


//If the user's role is admin, then delete the user from the database
if ($role == 'admin') {
    $user_to_delete = $_GET['id'];
//Delete user from Datbase
    $delete = mysqli_query($db_connection, "DELETE FROM `users` WHERE `id` = '$user_to_delete'");

    //If not successful in deleting the user, then display an error message
    if (!$delete) {
        echo ("Error: " . mysqli_error($db_connection));
        die();
    }
    //If successful, then redirect to the admin page
    header('Location: admin.php');
    exit;
}

?>