<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/be0f7619b0.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="link.js"></script>
    <script src="profile_update.js"></script>

    <style type="text/css">
        button{
            border : none;
            background-color: transparent;
        }
    </style>

</head>
<body>


<?php
require 'config.php';
include 'update_db.php';
include 'navbar.php';

?>


<section style="background-color: #eee;">
  <div class="container py-5">
    <div class="row">
      <div class="col">
      </div>
    </div>

    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <?php 
            $get_user = mysqli_query($db_connection, "SELECT * FROM `users` WHERE `id`='$id'");

            if(mysqli_num_rows($get_user) > 0){
                $user = mysqli_fetch_assoc($get_user);
            }
            else{
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
            <h5  class="my-3"><?php echo $_SESSION['name'] ?>  </h5>
            <p id="DetailField" name = "editable" class="text-muted mb-1"><?php echo $row['DetailField'] ?> </p> 
            <p id="City_State" name = "editable" class="text-muted mb-4"><?php echo $row['City_State'] ?> </p>
            <div class="d-flex justify-content-center mb-2">
              <button type="button" class="btn btn-primary">Follow</button>
              <button type="button" class="btn btn-outline-primary ms-1">Message</button>
              <button onclick="window.location.href='profile/qr_code.php'" type="button" class="btn btn-secondary">QR Code</button>
              <button id="copyButton" type="button" class="btn btn-light">Link</button>

            </div>
            <button onclick="changeToEditable()" id="editButton" name="editButton" > <i  class="fa-solid fa-user-pen"> </i>Edit</button>

          </div>
        </div>
        <div class="card mb-4 mb-lg-0">
          <div class="card-body p-0">
            <ul class="list-group list-group-flush rounded-3">
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fas fa-globe fa-lg text-warning"></i>
                <p id="Web_URL" name = "editable" class="mb-0"><?php echo $row['Web_URL'] ?> </p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fab fa-github fa-lg" style="color: #333333;"></i>
                <p id="GitHub_URL" name = "editable" class="mb-0"><?php echo $row['GitHub_URL'] ?></p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
                <p id="Twitter_URL" name = "editable" class="mb-0"><?php echo $row['Twitter_URL'] ?></p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                <p  id="Instagram_URL" name = "editable" class="mb-0"><?php echo $row['Instagram_URL'] ?></p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                <p  id="Facebook_URL" name = "editable" class="mb-0"><?php echo $row['Facebook_URL'] ?></p>
              </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fab fa-linkedin-in fa-lg" style="color: #3b5998;"></i>
                <p  id="Linkedin_URL" name = "editable" class="mb-0"><?php echo $row['Linkedin_URL'] ?></p>
              </li>
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
                <p  class="text-muted mb-0"><?php echo $_SESSION['name'] ?> </p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $_SESSION['email'] ?> </p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p id="Custom_1" name = "editable" class="mb-0"><?php echo $row['Custom_1'] ?></p>
              </div>
              <div class="col-sm-9">
                <p id="Custom_1_Detail" name = "editable" class="text-muted mb-0"><?php echo $row['Custom_1_Detail'] ?> </p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p id="Custom_2" name = "editable"  class="mb-0"><?php echo $row['Custom_2'] ?> </p>
              </div>
              <div class="col-sm-9">
                <p id="Custom_2_Detail" name = "editable" class="mb-0"><?php echo $row['Custom_2_Detail'] ?></p>

              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p id="Custom_3" name = "editable" class="mb-0"><?php echo $row['Custom_3'] ?></p>
              </div>
              <div class="col-sm-9">
              <p id="Custom_3_Detail" name = "editable" class="mb-0"><?php echo $row['Custom_3_Detail'] ?></p>

              </div>
            </div>
          </div>
        </div>
       

<!-- Second Collection of Items -->
  <div class="col-lg-13">
        <div class="card mb-4 mb-md-0">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p id="Custom_4" name="editable" class="mb-0"><?php echo $row['Custom_4'] ?></p>
              </div>
              <div class="col-sm-9">
                <p id="Custom_4_Detail"  name="editable" class="text-muted mb-0"><?php echo $row['Custom_4_Detail'] ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p id="Custom_5" name="editable" class="mb-0"><?php echo $row['Custom_5'] ?></p>
              </div>
              <div class="col-sm-9">
                <p id="Custom_5_Detail" name="editable" class="text-muted mb-0"><?php echo $row['Custom_5_Detail'] ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p id="Custom_6" name = "editable" class="mb-0"><?php echo $row['Custom_6'] ?></p>
              </div>
              <div class="col-sm-9">
                <p id="Custom_6_Detail" name = "editable" class="text-muted mb-0"><?php echo $row['Custom_6_Detail'] ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p id="Custom_7" name = "editable"  class="mb-0"><?php echo $row['Custom_7'] ?></p>
              </div>
              <div class="col-sm-9">
                <p id="Custom_7_Detail" name = "editable" class="mb-0"><?php echo $row['Custom_7_Detail'] ?></p>

              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p id="Custom_8" name = "editable" class="mb-0"><?php echo $row['Custom_8'] ?></p>
              </div>
              <div class="col-sm-9">
              <p id="Custom_8_Detail" name = "editable" class="mb-0"><?php echo $row['Custom_8_Detail'] ?> </p>

              </div>
            </div>
          </div>
        </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>           
</html>