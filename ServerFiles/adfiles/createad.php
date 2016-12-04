<?php
    require("../../Config/connect_db.php");
	require("../../Functions/phpfunctions.php");

	// if connect to the database, $connect is a variable in connect_db.php file
	if($connect) {
		//retrieves data from front end
		$data = json_decode(file_get_contents("php://input"));
		$user_id = $data->user_id;
		$adsTitle = $data->adsTitle;
		$adsContent = $data->adsContent;

		// stores the ad to the database, using given front end data
		$result = $db->prepare("INSERT INTO advertisement (title, content, user_user_id) VALUES(?, ?, ?)");
		$result->bind_param("ssi", $adsTitle, $adsContent, $user_id);

		//returns 1 if successful
		if($result->execute()) {
			$return = ["status" => '1'];
			echo json_encode($return);
		//returns 0 if unsuccessful 
		} else {
			$return = ["status" => '0'];
			echo json_encode($return);
		}

	//returns 0 if unsuccessful
	} else {
		echo json_encode(["status" => '0']);
	}

?>