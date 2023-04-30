<?php
//Getting some required files and functions ready
namespace chillerlan\QRCodeExamples;
require '../config.php';
require_once '../vendor/autoload.php';
use chillerlan\QRCode\{QRCode, QROptions};

//Chekcs if user is logged in
if(!isset($_SESSION['id'])){
    header('Location: ../index.php');
    exit;
}


//Get the user_id from the session
$user_id = $_SESSION['id'];

//Check if user_id value is in database, if so then get the secret
$check = "select * from profile_sharing where user_id = '$user_id'";
$result = mysqli_query($db_connection, $check);
if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
    $secret = $row['user_token'];
} else{
    //Generate a random secret
    $secret = bin2hex(random_bytes(50));
    
    //Insert the secret into the database
    $insert = "insert into profile_sharing (user_id, user_token) values ('$user_id', '$secret')";
    mysqli_query($db_connection, $insert);
}


//Generate the Link
$link = "https://is436.arlcyber.me/profile/index.php?id=$user_id&secret=$secret";


//Generate the QR code and return it back to the user
$data = $link;
echo '<img src="'.(new QRCode)->render($data).'" alt="QR Code" />';



?>
