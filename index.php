<?php

?>

<!DOCTYPE html>
<html ng-app='DrakeWeb'>
<head>
	<title></title>

	<title>Social App</title>
    <!-- jquery -->
	<script src="/UMBC/Client/js/jquery-2.1.4.js"></script>

	<!-- bootstrap & css-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="/UMBC/Client/css/clear.css">
	<link rel="stylesheet" type="text/css" href="/UMBC/Client/css/main.css">

    <!-- angular -->
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular-resource.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-router/0.3.1/angular-ui-router.min.js"></script>


    <!-- self js files, controllers -->
    <script src="/UMBC/Client/js/app.js"></script>
    <script src="/UMBC/Client/js/controller/SignUpCtrl.js"></script>
    <script src="/UMBC/Client/js/controller/homectrl.js"></script>
    <script src="/UMBC/Client/js/controller/profilectrl.js"></script>
    <script src="/UMBC/Client/js/controller/aboutmectrl.js"></script>
    <script src="/UMBC/Client/js/controller/loginctrl.js"></script>

</head>
<body>
	<div class='container'>
		<nav class='navbar navbar-inverse navbar-fixed-top' role='navigation' id='nav-bar'>
			<!-- nav bar content -->
			<div class='container'>
				<div class='row' id='nav-row'>
					<div class='col-sm-2'>
						<a ui-sref="home"><h2>Home</h2></a>
					</div>

					<div class='col-sm-2'>
						<a ui-sref="about"><h2>Service</h2></a>
					</div>

					<div class='col-sm-4'>
						<a ui-sref="profile"><h2>Profile</h2></a>
					</div>

					<div class='col-sm-2'>
						<div class='row' id='index-login-link'>
							<a ui-sref="login"><strong>Login</strong></a>
						</div>
					</div>
				</div>
			</div> <!-- end of nav bar container -->
		</nav>
	</div>

	<!-- main content -->
	<div class="container" id="main-body">
        <div ui-view></div>
    </div>
</body>
</html>