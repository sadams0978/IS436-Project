<?php

require_once '../vendor/autoload.php';
require '../config.php';

//Check to see if id and secret are set from POST
if (!isset($_GET['id']) || !isset($_GET['secret'])) {
          //If id and secret are not set then redirect to login page
          header("Location: ../login.php");
          exit();
   
}
   

    //Get id and secret from POST
    $id = $_GET['id'];
    $secret = $_GET['secret'];

    //HTMLChars and SQL Injectection Mitigation
    $id = htmlspecialchars($id);
    $secret = htmlspecialchars($secret);
    $id = mysqli_real_escape_string($db_connection, $id);
    $secret = mysqli_real_escape_string($db_connection, $secret);



    //Check to see if id and secret are in the database
    $sql = "select * from profile_sharing where user_id = '$id' and user_token = '$secret'";
    $result = mysqli_query($db_connection, $sql);
    $count = mysqli_num_rows($result);

    //Verify that id and secret match up
    if ($count == 1) {
        //If id and secret match up then continue
        //echo "Success";
    } else {
        //If id and secret do not match up then redirect to login page
        header("Location: ../login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>
<body>

<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
      <div class="col-md-3 mb-2 mb-md-0">
        <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
            <!-- SVG Image for Logo -->
            <svg width="300" height="100">
            <rect x="50" y="20" rx="20" ry="20" width="200" height="67"
                style="fill:#FFFFFF;stroke:black;stroke-width:5;opacity:1" />
            <text fill="#000000" font-size="20" font-family="Verdana" x="80" y="55">Business Card</text>
            </svg>
                
        </a>
      </div>

      <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="home.php" class="nav-link px-2 link-secondary">Home</a></li>
        <li><a href="#" class="nav-link px-2">Features</a></li>
        <li><a href="#" class="nav-link px-2">Pricing</a></li>
        <li><a href="#" class="nav-link px-2">FAQs</a></li>
        <li><a href="#" class="nav-link px-2">About</a></li>        
      </ul>
      
    </header>
  </div>


<?php

    $get_user = mysqli_query($db_connection, "SELECT * FROM `users` WHERE `id`='$id'");
    if (mysqli_num_rows($get_user) > 0) {
        $user = mysqli_fetch_assoc($get_user);
    } else {
        header('Location: logout.php');
        exit;
    }

    if (is_NULL($user['profile_image'])) {
            
        $profileImage = "https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp"; 
    
    } else {
        $profileImage = $user['profile_image'];
        $profileImage = substr($profileImage, 0, -2);
        $profileImage = $profileImage . "500";
      }

      ?>
      <img src=<?php echo $profileImage ?> alt="avatar"
        class="rounded-circle img-fluid" style="width: 150px;">
      <h5 class="my-3"><?php echo $user['name'] ?></h5>
      <p class="text-muted mb-1">Full Stack Developer</p>
      <p class="text-muted mb-4">Bay Area, San Francisco, CA</p>
      <div class="d-flex justify-content-center mb-2">
      </div>
    </div>
  </div>
  <div class="card mb-4 mb-lg-0">
    <div class="card-body p-0">
      <ul class="list-group list-group-flush rounded-3">
        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
          <i class="fas fa-globe fa-lg text-warning"></i>
          <p class="mb-0">https://mdbootstrap.com</p>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
          <i class="fab fa-github fa-lg" style="color: #333333;"></i>
          <p class="mb-0">mdbootstrap</p>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
          <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
          <p class="mb-0">@mdbootstrap</p>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
          <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
          <p class="mb-0">mdbootstrap</p>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
          <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
          <p class="mb-0">mdbootstrap</p>
        </li>
      </ul>
    </div>
  </div>
</div>
<div class="col-lg-8">
  <div class="card mb-4">
    <div class="card-body">
      <div class="row">
        <div class="col-sm-3">
          <p class="mb-0">Full Name</p>
        </div>
        <div class="col-sm-9">
          <p class="text-muted mb-0"><?php echo $user['name'] ?></p>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-sm-3">
          <p class="mb-0">Email</p>
        </div>
        <div class="col-sm-9">
          <p class="text-muted mb-0"><?php echo $user['email'] ?></p>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-sm-3">
          <p class="mb-0">Phone</p>
        </div>
        <div class="col-sm-9">
          <p class="text-muted mb-0">(097) 234-5678</p>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-sm-3">
          <p class="mb-0">Mobile</p>
        </div>
        <div class="col-sm-9">
          <p class="text-muted mb-0">(098) 765-4321</p>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-sm-3">
          <p class="mb-0">Address</p>
        </div>
        <div class="col-sm-9">
          <p class="text-muted mb-0">Bay Area, San Francisco, CA</p>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="card mb-4 mb-md-0">
        <div class="card-body">
          <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
          </p>
          <p class="mb-1" style="font-size: .77rem;">Web Design</p>
          <div class="progress rounded" style="height: 5px;">
            <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
              aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
          <div class="progress rounded" style="height: 5px;">
            <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
              aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
          <div class="progress rounded" style="height: 5px;">
            <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
              aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
          <div class="progress rounded" style="height: 5px;">
            <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
              aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
          <div class="progress rounded mb-2" style="height: 5px;">
            <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
              aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card mb-4 mb-md-0">
        <div class="card-body">
          <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
          </p>
          <p class="mb-1" style="font-size: .77rem;">Web Design</p>
          <div class="progress rounded" style="height: 5px;">
            <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
              aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
          <div class="progress rounded" style="height: 5px;">
            <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
              aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
          <div class="progress rounded" style="height: 5px;">
            <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
              aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
          <div class="progress rounded" style="height: 5px;">
            <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
              aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
          <div class="progress rounded mb-2" style="height: 5px;">
            <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
              aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</section>