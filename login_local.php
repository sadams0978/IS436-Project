<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <title>Local Login</title>
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




<?php
include 'config.php';
session_start();
//Local Login
if(isset($_POST['email']) && isset($_POST['password'])){

    $email = mysqli_real_escape_string($db_connection, $_POST['email']);
    $password = mysqli_real_escape_string($db_connection, $_POST['password']);

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    //Setting up Variables for Regex
	$UMBC_email = '/umbc.edu$/';

	if (!preg_match($UMBC_email, $email)) {
        echo "<div class='fixed-top'> <h2> Please use an E-Mail Address ending in  <strong> umbc.edu </strong> </h2></div>";
        exit();
      }


    // checking user already exists or not and select id and password hash
    $get_user = mysqli_query($db_connection, "SELECT `id`, `password_hash`, `name` FROM `users` WHERE `email`='$email'");

    if(mysqli_num_rows($get_user) > 0){

    
        $row = mysqli_fetch_assoc($get_user);
   

        if (password_verify($password, $row['password_hash'])) {

            $_SESSION['login_id'] = $row['id']; 
            $_SESSION['user'] = $row['name'];

            echo ("<body> ");
            echo "<div class='d-flex justify-content-center'> <h2> Welcome, " . $_SESSION['user'] . " </h2>";
            echo ("<div class='spinner-border text-success' style='width: 3rem; height: 3rem;' role='status'>
              <span class='sr-only'></span>
            </div>
          </div>");
          echo ("</body>");
          
          header('Refresh: 3; URL=home.php');
          exit;

        }
        else{
            echo "<div class='fixed-top'> <h2> Invalid Email Address or Password </h2></div>";

        }




    }
    else{
      echo "<div class='fixed-top'> <h2> Invalid Email Address or Password </h2></div>";

    }

}
?>


  <body class="text-center">
    <form class="form-signin" action="login_local.php" method="post">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <label for="email" class="sr-only">Email address</label>
      <input type="email" name = "email" id="email" class="form-control" placeholder="Email address" required autofocus>
      <label for="password" class="sr-only">Password</label>
      <input type="password" name = "password"  id="password" class="form-control" placeholder="Password" required>
      <button type="submit" class="btn btn-primary">Submit</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2023</p>
    </form>
  </body>
</html>