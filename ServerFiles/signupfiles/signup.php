<?php
	require("../../Config/connect_db.php");
	require("../../Functions/phpfunctions.php");
	/* need to include or require another php file to connect to database */

	if($connect) {
		
		$data = json_decode(file_get_contents("php://input"));

		$firstname = $data->firstname;
		$lastname = $data->lastname;
		$email = $data->email;
		$password = $data->password;
		$re_pwd = $data->re_pwd;

		// string process, most of the string process function are from phpfunction.php file
		// lower case the user input
		$firstname = strtolower(escape($db, trim($firstname)));
		$lastname = strtolower(escape($db, trim($lastname)));
		$email = strtolower(escape($db, trim($email)));

		$emailBegin = emailBegin($email);
		$emailEnd = emailEnd($email);

		// use string before @ from email to be the hahsed key
		$salt = md5($emailBegin);

		// encrypt email, and clean up the '+, /' character
		$email_hashed = encrypt($emailBegin, $salt).$emailEnd;
		$email_hashed = replacePlus($email_hashed);

		// hash the password using bcrypt with salt
		// first hash, using sha256
		$password = hash('sha256', escape($db, $password));
		// second using bcrypt
		$password = password_hash($password, PASSWORD_DEFAULT);

		// check if user has already existed
		$userExist = emailExists($db, $connect, $email);
		if($userExist) {
			$userData = ["status" => "userfound"];
			echo json_encode($userData);
		} else {
			// $db->prepare return an obj
			$result = $db->prepare("INSERT INTO user (first_name, last_name, password, email) VALUES(?, ?, ?, ?)");
			$result->bind_param("ssss", $firstname, $lastname, $password, $email);

			// if store the database failed
			if(!$result->execute()) {
				$result->close();
				$userData = ["status" => "failt", "email" => "$email_hashed", "firstname" => $firstname, "password" => $password];
				echo json_encode($userData);
			} else {
				$userData = ["status" => "success", "email" => $email_hashed, "firstname" => $firstname, "password" => $password];
				echo json_encode($userData);
			}
		}
	}

?>