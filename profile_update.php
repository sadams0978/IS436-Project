<?php
include 'config.php';
//Checks if user is logged in

if(!isset($_SESSION['id'])){
    header("login.php");
    exit;
}


//Updates User Information based on what is passed in via POST

//Checks if POST is set 
if(isset($_POST['field']) && isset($_POST['value'])){
    //Gets info from JS AJAX POST and Scrubs it
    $current_userID = $_SESSION['id'];
    $field = $_POST['field'];
    $value = $_POST['value'];
    
    $field = htmlspecialchars($field);
    $value = htmlspecialchars($value);
    $field = mysqli_real_escape_string($db_connection, $field);
    $value = mysqli_real_escape_string($db_connection, $value);
    
    //Updates database with new information from the POST
    $sql = "UPDATE user_profile SET $field = '$value' WHERE user_id  = '$current_userID'";
    $result = mysqli_query($db_connection, $sql);
    
    //If result is false, then there was an error
    if(!$result){
        echo "Error: " . $sql . "<br>" . mysqli_error($db_connection);
    }    

}
?>