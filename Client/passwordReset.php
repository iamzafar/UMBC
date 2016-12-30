<?php
	session_start();
	require '../Functions/phpfunctions.php';
	require '../Config/connect_db.php';

	$emailEncrypt = $_GET['email'];
	
	$result = $db->query( "SELECT user_id FROM user WHERE email = '$emailEncrypt'" );
	if(isset($_POST['password']) && !empty($_POST['password'])){
		if( $result->num_rows ){

			echo "user found";
			$password = $_POST['password'];

			// first hash, using sha256
			$password = hash('sha256', escape($db, $password));
			// second using bcrypt
			//would not use the PASSWORD_DEFAULT, would use self made salt
			$passwordHash = password_hash($password, PASSWORD_DEFAULT);

			$result = updatePwd($emailEncrypt, $passwordHash, $db);
			if($result === true){
				echo "<div>Password has been successfully updated.</div>";
				header("Refresh: 1; url=http://localhost/UMBC/index.php");
				die();
			}
		}
	}
?>

<!DOCTYPE html>
<html ng-app='resetApp'>
<head>
	<script src="/Proximo/config/jquery-2.1.4.js"></script>
	<script src="/Proximo/config/jquery-ui.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<title>Reset password</title>
</head>
<body>
	
	<div class="container">
		<form action="#" method="post">
			<table class='table'>
				<thead>
					<tr>
						<th>New Password</th>
						<th>Verify Password</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><input name ='password' type='password' class="form-control" id='pwdreset' ></td>
						<td><input type='password' class="form-control" id='pwdreset' ></td>
						<td><button class="btn btn-primary">Reset</td>
					</tr>
				</tbody>
			</table>
			<div id='warn'></div>
		</form>
	</div>
</body>
</html>