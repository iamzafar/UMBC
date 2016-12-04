<?php
    require("../../Config/connect_db.php");
	require("../../Functions/phpfunctions.php");

	// if connect to the database, $connect is a variable in connect_db.php file
	if($connect) {
		//gets data from front end
		$data = json_decode(file_get_contents("php://input"));
		$ad_id = $data->ad_id;

		// deletes ad in database based on the return ad_id
		$result = $db->prepare("DELETE FROM advertisement WHERE ad_id = '$ad_id'");

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