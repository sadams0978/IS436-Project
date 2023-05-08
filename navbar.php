<?php
if(!isset($_SESSION['login_id'])){
   header('Location: login.php');
    exit;
}

$id = $_SESSION['login_id'];


//Get User Details from session ID
$get_user = mysqli_query($db_connection, "SELECT * FROM `users` WHERE `id`='$id'");

//Save User Details into Session Variable for future use
if(mysqli_num_rows($get_user) > 0){
    $user = mysqli_fetch_assoc($get_user);
    $_SESSION['name'] = $user['name'];
    $_SESSION['email'] = $user['email'];
//    $_SESSION['image'] = $user['image'];
    $_SESSION['role'] = $user['role'];
    $_SESSION['id'] = $user['id'];
    $_SESSION['login_type'] = $user['login_type'];


}

?>


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
        <li><a href="404.html" class="nav-link px-2">Features</a></li> 
        <li><a href="404.html" class="nav-link px-2">Pricing</a></li>
        <li><a href="404.html" class="nav-link px-2">FAQs</a></li>
        <li><a href="404.html" class="nav-link px-2">About</a></li>
        <?php 
        if ($_SESSION['role'] == 'admin') {
          echo ('<li><a href="admin.php" class="nav-link px-2">Admin</a></li>');
        }
        ?>
        
      </ul>

      <div class="col-md-3 text-end">
        <a class="btn btn-primary" href="user_profile.php" role="button"> My Account</a>
        <a class="btn btn-primary" href="logout.php" role="button">Logout</a>
      </div>
    </header>
  </div>
