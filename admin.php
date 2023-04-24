<html>
<head>
	<title>Admin Page</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
		<h1>Admin Page</h1>
		<p>Welcome, you are logged in as an Admin user</p>
		<p><a href="logout.php">Logout</a></p>
	</div>
</body>
</html>


<?php
require 'config.php';

if(!isset($_SESSION['login_id'])){
    header('Location: login.php');
    exit;
}

$id = $_SESSION['login_id'];

$get_user = mysqli_query($db_connection, "SELECT * FROM `users` WHERE `id`='$id'");

if(mysqli_num_rows($get_user) > 0){
    $user = mysqli_fetch_assoc($get_user);
	if ($user['role'] != 'admin') {
		echo ('Sorry, you are not an Admin user, try again later');
		die();
	}
}

//Select all users from Database and display them in a table along with buttons to reset their password or delete them
$query = 'select * from users';
$result = mysqli_query($db_connection, $query);
if (mysqli_num_rows($result) > 0) {
	echo '<table class="table">';
	echo '
	<tr><th scope="col">User ID</th> 
	<th scope="col">Login Provider </th> 
	<th scope="col">Full Name</th>
	<th scope="col">E-Mail Address</th>
	<th scope="col">Profile Image</th>
	<th scope="col">Role</th>
	<th scope="col">Reset Password</th>
	<th scope="col">Delete User</th></tr>';
	while ($row = mysqli_fetch_assoc($result)) {

		echo '<tr scope="row">';
		echo '<td>' . $row['id'] . '</td>';
		echo '<td>' . $row['login_type'] . '</td>';

		if ($row['login_type'] == 'Google') {
			$auth = $row['login_type'];
			$row['login_type'] = '<img src="https://img.icons8.com/color/48/000000/google-logo.png" width="48" height="48" title="Google" alt="Google" /> ' . $row['login_type'];
			
		} else {
			$auth = "Local";
		}

		echo '<td>' . $row['name'] . '</td>';
		echo '<td>' . $row['email'] . '</td>';

		if ($row['profile_image'] == '') {
			$row['profile_image'] = 'https://img.icons8.com/color/48/000000/user.png';
		}
		echo '<td>' . '<img src="'. $row['profile_image'] . '" width="50" height="50"/>'  . '</td>';

		echo '<td>' . $row['role'] . '</td>';
		if ($auth == 'Google') {
			echo '<td>Not Available</td>';
			echo '<td>Not Available</td>';
		} else {
			echo '<td><a href="reset_password.php?id=' . $row['id'] . '">Reset Password</a></td>';
			echo '<td><a href="delete_user.php?id=' . $row['id'] . '">Delete User</a></td>';
		}

		echo '</tr>';
	}
	echo '</table>';
} else {
	echo "No results found";
}
?>



