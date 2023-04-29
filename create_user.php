<?php
require 'config.php';
session_destroy();

//Local Login
if(isset($_POST['email']) && isset($_POST['password']) && isset ($_POST['name'])){

    $email = mysqli_real_escape_string($db_connection, $_POST['email']);
    $password = mysqli_real_escape_string($db_connection, $_POST['password']);
    $name = mysqli_real_escape_string($db_connection, $_POST['name']);

    //Setting up Variables for Regex
	$UMBC_email = '/umbc.edu$/';

	if (!preg_match($UMBC_email, $email)) {
    		echo "You are unauthorized, log in using an umbc.edu email address!";
		    echo $email;
    		die();
	}

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // checking user already exists or not
    $get_user = mysqli_query($db_connection, "SELECT `id` FROM `users` WHERE `email`='$email'");
    if(mysqli_num_rows($get_user) > 0){
      session_start();
        $row = mysqli_fetch_assoc($get_user);
         
        echo ("We have found an existing user with the same E-Mail, we are redirecting you to the login page in 5 seconds");
        header('Refresh: 5; URL=home.php');
        die();

    } else{
        //Create user in database
        $create_user = mysqli_query($db_connection, "INSERT INTO `users` (`login_type`,`id`, `name`, `email`, `role`, `password_hash`) VALUES ('Local' , NULL, '$name', '$email', 'default', '$password_hash')");
        if($create_user){
            session_start();
            echo ("Your account was created, we are redirecting you to the login page in 5 seconds");
            header('Refresh: 5; URL=login.php');
            exit;
        } else{
            echo "Sorry, something went wrong. Please try again later.";
        }

    } 
  } 
?>





<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <title>Create an Local Account</title>
    <style>
      html,
      body {
        height: 100%;
      }

      body {
        display: flex;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: auto;
      }

      .form-signin .checkbox {
        font-weight: 400;
      }

      .form-signin .form-floating:focus-within {
        z-index: 2;
      }

      .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
      }

      .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
      }
    </style>
  </head>

  <body class="text-center">
    <form class="form-signin" action="create_user.php" method="post">
      <h1 class="h3 mb-3 font-weight-normal">Create a User</h1>

      <label for='name'class="sr-only">Name:</label>
      <input type="text" name = "name" id="name" class="form-control" placeholder="Full Name" required autofocus>

      <label for="email" class="sr-only">Email address</label>
      <input type="email" name = "email" id="email" class="form-control" placeholder="Email address" required autofocus>

      <label for="password" class="sr-only">Password</label>
      <input type="password" name = "password"  id="password" class="form-control" placeholder="Password" required>
      
      <button type="submit" class="btn btn-primary">Submit</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2023</p>
    </form>
  </body>
</html>

