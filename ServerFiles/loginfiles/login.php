<?php
	require("../../Config/connect_db.php");
	require("../../Functions/phpfunctions.php");
	/* need to include or require another php file to connect to database */

	$isLoggin = false;

	$data = json_decode(file_get_contents("php://input"));

	//$email = $data->email;
	//$password = $data->password;
	
	// checks to see if email exists in database, then checks to see if
	// password is valid. if so, $isLogin is set to true
	if(emailExists($db, $connect, $data->email)) {
		//escape function trims and excapes input
		//hashes with sha256
		//echo $data->password . " before\n";
		$hashedPW = escape($db, hash('sha256',$data->password));
		//echo $data->email . " theemail\n";
		
		//pulls the corresponding password from the database and stores as dbPassword
		$dbPasswordObj = $db->prepare( "SELECT user_id, password, first_name, image_link FROM user WHERE email = '$data->email'" );
		$dbPasswordObj->execute();
		$dbPasswordObj->bind_result($user_id, $dbPassword, $first_name, $image_link);
		
		// if there is a record return
		if($dbPasswordObj->fetch()) {
			if(password_verify($hashedPW, $dbPassword)) {
				$isLoggin = true;
				$userData = ['status' => '1', 'user_id'=> $user_id, 'email' => $data->email, 'first_name' => $first_name, 'image_link' => $image_link];
				/* send email back to front end to test if this end point is working */
				echo json_encode($userData);
			} else {
				$userData = ['status' => '0'];
				/* send email back to front end to test if this end point is working */
				echo json_encode($userData);
			}	
		}
	}
?>