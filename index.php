<?php

?>

<!DOCTYPE html>
<html ng-app='DrakeWeb'>
<head>
	<title>Barking Bazaar</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- jquery -->
	<script src="/UMBC/Client/js/jquery-2.1.4.js"></script>

	<!-- bootstrap & css-->
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous"> -->
	<link rel="stylesheet" type="text/css" href="/UMBC/Client/css/clear.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!-- main css file -->
	<!-- ****************************************************************************************************** -->
	<link rel="stylesheet" type="text/css" href="/test/Client/css/design.css"> 
	<!-- ****************************************************************************************************** -->
	<!-- google font, zarfar -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Arimo|Merriweather:400,700|Poppins:400,600|Ubuntu:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">

    <!-- angular -->
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular-resource.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-router/0.3.1/angular-ui-router.min.js"></script> 
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.7/angular-route.js"></script>

    <!-- self js files, controllers -->
    <script src="/UMBC/Client/js/app.js"></script>
    <script src="/UMBC/Client/js/controller/SignUpCtrl.js"></script>
    <script src="/UMBC/Client/js/controller/homectrl.js"></script>
    <script src="/UMBC/Client/js/controller/profilectrl.js"></script>
    <script src="/UMBC/Client/js/controller/aboutmectrl.js"></script>
    <script src="/UMBC/Client/js/controller/loginctrl.js"></script>
    <script src="/UMBC/Client/js/controller/servicectrl.js"></script>
    <!-- <script src="/UMBC/Client/js/controller/indexctrl.js"></script> -->

</head>
<body>	
		<nav class="navbar navbar-inverse navbar-fixed-top" role='navigation' id='nav-bar'>
			<!-- nav bar content -->
			<div class='container' ng-controller="LoginCtrl">
				<div ng-show="loggedIn" class='row' id='nav-row'>		

				<!-- 	<div class='col-sm-2'>
						<a href ="#home"><h2>Home</h2></a>
					</div>

					<div class='col-sm-2'>
						<a href="#service"><h2>Service</h2></a>
					</div>

					<div class='col-sm-2'>
						<a href="#profile"><h2>Profile</h2></a>
					</div> 

					<div class='col-sm-4'>
						<div id="user_name" ng-model="first_name"> 

							<h1>Welcome BOB</h1>
						</div>
					</div> -->

					<!-- uses indexctrl to check login part -->
				<!-- 	 <div class='col-sm-2'>
						<a id="logout" ng-click="userLogout()"> 
							<span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
						</a>
					</div> --> 
					<!-- Navigation header  -->
					<div class="navbar-header">
			      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			       
			      </button>
			      <a class="navbar-brand" href="#myPage">Barking-Bazaar</a>
    			</div>
    			<!-- Navigation bar -->
    			<!-- Put extra navigation here -->
					<div class="collapse navbar-collapse" id="myNavbar">
			      <ul class="nav navbar-nav navbar-left">			      	
			        <li><a href="#home">Home</a></li>
			        <li><a href="#service">Service</a></li>
			        <li><a href="#profile">Profile</a></li>			        	       	       
			      </ul>		
			      <!-- Log out part of the navigation -->
   					<ul  class="nav navbar-nav navbar-right">
   						<li>
   							<a href="#">
   								<span id="user_name" ng-model="first_name">
   								Welcome {{first_name}}
   							</span>   
   							</a>   														
   						</li>
   						<li>
   							<a id="logout" ng-click="userLogout()"> 
									<span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Log-out
								</a>
   						</li>
   					</ul>
    			</div>

    			</div>
    		</div>

    			 <!-- end of nav bar tab loggined content-->
				
				<!-- <div ng-show="!loggedIn" class='row' id='index'>
				<div class='col-sm-4' id="login">
					<a href="#login"><strong>Login</strong></a>
				</div>
			</div>  -->
			<!-- end of nav bar container -->
			<!-- ng-show is for toggle between login and logout icon -->
		</nav>
	

		
	<!-- main content -->
	<div class="container" id="main-body">
        <div ng-view></div>
    </div>
</body>
</html>