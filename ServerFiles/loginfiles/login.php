<?php
    require("../../Config/connect_db.php");
	require("../../Functions/phpfunctions.php");

	
	/* if user passes the check and set this to true, now is set true to test */
	$isLogin = false;
	//pulls data from front end
	$data = json_decode(file_get_contents("php://input"));

	//$email = $data->email;
	//$password = $data->password;
	
	// checks to see if email exists in database, then checks to see if
	// password is valid. if so, $isLogin is set to true
	if(emailExists($db, $connect, $data->email)) {
		//escape function trims and excapes input
		//hashes with sha256
		echo $data->password . " before\n";
		$hashedPW = escape($db, hash('sha256',$data->password));
		echo $data->email . " theemail\n";
		
		//pulls the corresponding password from the database and stores as dbPassword
		$dbPasswordObj = $db->prepare( "SELECT password FROM user WHERE email = '$data->email'" );
		$dbPasswordObj->execute();
		$dbPasswordObj->bind_result($dbPassword);
		$dbPasswordObj->fetch();
		
		echo $dbPassword . " dpPassword\n";
		echo $hashedPW . " hashedPW\n";
		
		if(password_verify($hashedPW, $dbPassword)) {
			echo $data->email . "\n";
			$isLogin = true;
		}
		
	}

	/* php associative array can be used as json to send back to front end for JS, only send back to front if it passes the check */
	if($isLogin) {
		$userData = ['email' => $data->email];
		/* send email back to front end to test if this end point is working */
		echo json_encode($userData);
	}

?>