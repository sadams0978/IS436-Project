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
include 'navbar.php';

?>


<body>

<section style="background-color: #eee;">
  <div class="container py-5">
    <div class="row">
      <div class="col">
      </div>
    </div>
	
	<div class="col-lg-13">
        <div class="card mb-4 mb-md-0">
          <div class="card-body">
            <div class="row">
                <p id="Custom_4_Detail"  Style="font-size:180%;text-align:center;color:blue;">
				QR Code Web Application User Guide </p>
            </div>
          </div>
        </div>

    </div>

    <div class="row">
      <div class="col-lg-4">
        
        <div class="card mb-4 mb-lg-0">
          <div class="card-body p-0">
            <ul class="list-group list-group-flush rounded-3">
			  <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <p class="mb-0"><b>Table of Content </b></p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <p  class="mb-0"> <a href="#intro">Introduction </a></p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <p  class="mb-0"><a href="#overview">Overview</a></p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <p  class="mb-0"><a href="#interface">User Interface</a></p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <p class="mb-0"><a href="#qr">Scanning a QR Code</a></p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <p class="mb-0"><a href="#security">Security</a></p>
              </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <p  class="mb-0"><a href="#trouble">Troubleshooting</a></p>
              </li>
              
            </ul>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
		<div class="card mb-4">
			<div class="card-body">
				<div class="row">
					<p id="intro" class="mb-0" style="font-size:120%"><b>Introduction</b></br></br></p>
				</div>
				<div class="row">
					<p class="text-muted mb-0">Welcome to the QR code web application user guide. 
					This document provides an overview of the features and functionalities of the 
					application, and guides you on how to use the different components of the system. </br></br></p>
				</div>
				<hr>
				<div class="row">
					<p id="overview" class="mb-0" style="font-size:120%"><b>Overview</b></br></br></p>
				</div>
				<div class="row">
					<p class="text-muted mb-0">The QR code web application is a system designed to 
					help businesses generate and manage QR codes that can be used to provide users 
					with access to specific information or actions. The system consists of a mobile 
					app and a web app, and allows administrators to create, edit, and delete QR codes, 
					as well as view analytics and insights.</br></br></p>
				</div>
				<hr>
				<div class="row">
					<p id= "interface" class="mb-0" style="font-size:120%"><b>User Interface </b></br></br></p>
				</div>
				<div class="row">
					<p class="text-muted mb-0">The user interface of the QR code web application 
					consists of a mobile app and a web app. The mobile app is available on both iOS 
					and Android platforms, and allows users to scan QR codes and access the associated 
					information. The web app is used by administrators to manage the system.</br></br></p>
				</div>
				<hr>
				<div class="row">
					<p id="qr" class="mb-0" style="font-size:120%"><b>Scanning a QR Code </b></br></br></p>
				</div>
				<div class="row">
					<p class="text-muted mb-0">To scan a QR code using the mobile app, simply open 
					the app and point your phone’s camera at the code. The app will automatically 
					recognize the code and display the associated information or action. To scan a 
					QR code using the web app, simply go to the URL associated with the code and follow 
					the instructions provided.</br></br></p>
				</div>
				<hr>
				<div class="row">
					<p id="security" class="mb-0" style="font-size:120%"><b>Security </b></br></br></p>
				</div>
				<div class="row">
					<p class="text-muted mb-0">To scan a QR code using the mobile app, simply open 
					the app and point your phone’s camera at the code. The app will automatically 
					recognize the code and display the associated information or action. To scan a QR 
					code using the web app, simply go to the URL associated with the code and follow 
					the instructions provided.</br></br></p>
				</div>
				<hr>
				<div class="row">
					<p id="trouble" class="mb-0" style="font-size:120%"><b>Troubleshooting </b></br></br></p>
				</div>
				<div class="row">
					<p class="text-muted mb-0"> If you encounter any issues or have any questions, 
					please refer to the FAQ section of the user guide or contact our support team 
					for assistance.</br></br></p>
				</div>
			</div>
        </div>
      </div>
       
    </div>
  </div>

  
</section>
           
</body></html>