<?php
require 'config.php';

if (isset($_GET['id']) && isset($_GET['secret'])) {
    $current_userID = $_GET['id'];
    $current_userToken = $_GET['secret'];

    //HTMLChars and SQL Injectection Mitigation
    $current_userID = htmlspecialchars($current_userID);
    $current_userToken = htmlspecialchars($current_userToken);
    $current_userID = mysqli_real_escape_string($db_connection, $current_userID);
    $current_userToken = mysqli_real_escape_string($db_connection, $current_userToken);


    //Verifies that user is still active
    $user_check = "SELECT *  FROM `users` WHERE `id`='$current_userID'";
    $check = mysqli_query ($db_connection, $user_check);
    $count = mysqli_num_rows($check);


    if ($count !== 1) {
      //If user is not active then redirect to login page
      header("Location: ../login.php");
      exit();
    }
    





    //Check to see if id and secret are in the database
    $sql = "select * from profile_sharing where user_id = '$current_userID' and user_token = '$current_userToken'";
    $result = mysqli_query($db_connection, $sql);
    $count = mysqli_num_rows($result);
    if ($count !== 1) {
      //If id and secret do not match up then redirect to login page
      header("Location: ../login.php");
      exit();
    }
    
//Checks if user is logged in
} else if (isset($_SESSION['login_id'])) {
    $current_userID = $_SESSION['login_id'];

} else {
    header("Location: ../login.php");
    exit();
}

//Checks to see if the user is already in the database
$user_check = "SELECT * FROM user_profile WHERE user_id = '$current_userID'";
$result = mysqli_query($db_connection, $user_check);
$row = mysqli_fetch_assoc($result);

//If user is not in the database, add them
if($row['user_id'] == NULL){
    $sql = "INSERT INTO user_profile (user_id) VALUES ('$current_userID')";
    $result = mysqli_query($db_connection, $sql);

    //Gets info again after Insert
    $user_check = "SELECT * FROM user_profile WHERE user_id = '$current_userID'";
    $result = mysqli_query($db_connection, $user_check);
    $row = mysqli_fetch_assoc($result);
}

?>