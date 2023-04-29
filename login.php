<?php
require 'config.php';

if(isset($_SESSION['login_id'])){
    header('Location: home.php');
    exit;
}

require '/var/www/html/vendor/autoload.php';

// Creating new google client instance
$client = new Google_Client();

// Client ID
$client->setClientId($_ENV['Google_Client_ID']);
// Client Secrect
$client->setClientSecret($_ENV['Google_Client_Secret']);
//Redirect URL
$client->setRedirectUri('https://is436.arlcyber.me/login.php');

// Email and Profile Scopes Required by Google API
$client->addScope("email");
$client->addScope("profile");


if(isset($_GET['code'])):

    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

    if(!isset($token["error"])){

        $client->setAccessToken($token['access_token']);

        // getting profile information
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();
    
        // Storing data into database
        $id = mysqli_real_escape_string($db_connection, $google_account_info->id);
        $full_name = mysqli_real_escape_string($db_connection, trim($google_account_info->name));
        $email = mysqli_real_escape_string($db_connection, $google_account_info->email);
        $profile_pic = mysqli_real_escape_string($db_connection, $google_account_info->picture);
	    $role = mysqli_real_escape_string($db_connection, $google_account_info->role);

        $profile_pic = substr($profile_pic, 0, -2);

	//Setting up Variables for Regex
	$UMBC_email = '/umbc.edu$/';

	if (!preg_match($UMBC_email, $email)) {
    		echo "Sorry, You are unauthorized, log in using an @umbc.edu email address!";
    		die();
	}


        //Checking user already exists or not with the value of google_id

        $get_user = mysqli_query($db_connection, "SELECT `id` FROM `users` WHERE `google_id`='$id'");

        //If the user exists, then log them in
        if(mysqli_num_rows($get_user) > 0){

                //Get ID from Database and set it as the session variable
                $user_id_array = mysqli_fetch_assoc(mysqli_query($db_connection, "SELECT `id` FROM `users` WHERE `google_id`='$id'"));
                $user_id = $user_id_array['id'];
                $_SESSION['login_id'] = $user_id;
                header('Location: home.php');
            exit;

        }
        else if (mysqli_num_rows($get_user) == 0) {
            // if user not exists we will insert the user into the DB
            $insert = mysqli_query($db_connection, "INSERT INTO `users`(`login_type`,`google_id`,`name`,`email`,`profile_image`,`role`) VALUES('Google','$id','$full_name','$email','$profile_pic','default')");

            if($insert){
                //If successful insert, then it will log them in
                $user_id_array = mysqli_fetch_assoc(mysqli_query($db_connection, "SELECT `id` FROM `users` WHERE `google_id`='$id'"));
                $user_id = $user_id_array['id'];
                $_SESSION['login_id'] = $user_id;
                header('Location: home.php');

                exit;
            }
            else{
                echo "There may be another user registered in the system, please try again later!";
            }

        }

    }
    else{
        header('Location: login.php');
        exit;
    }
    
else: 
    // Google Login Url = $client->createAuthUrl(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
 
</head>
<body>

<div class="container" class= "text-center">
<style>
    .heading{
        font-size: 30px;
        font-weight: bold;
        margin-bottom: 30px;
    }
    body {
        background-color: #f5f5f5;
    }
</style>

<h2 class="heading">Login</h2>

<div class="container" >
  <div class="row" class="col" style="padding-top: 5%;">

    <a type="button" class="btn btn-primary btn-lg" href="login_local.php">
            Local Login
    </a>
</div>


<div class="row" class="col" style="padding-top: 5%;">

    <a type="button" class="btn btn-primary btn-lg" href="create_user.php">
            Create an Local User
    </a>
</div>

<div class="row" class="col" style="padding-top: 5%;">
    <a type="button" class="btn btn-primary btn-lg" href="<?php echo $client->createAuthUrl(); ?>">
            Sign in with Google
    </a>
</div>
    </div>
</body>
</html>


<?php endif; ?>
