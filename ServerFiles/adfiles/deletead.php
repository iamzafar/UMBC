<?php
    require("../../Config/connect_db.php");
	require("../../Functions/phpfunctions.php");

	// if connect to the database, $connect is a variable in connect_db.php file
	if($connect) {
		$data = json_decode(file_get_contents("php://input"));
		$ad_id = $data->ad_id;

		// store to the database
		$result = $db->prepare("DELETE FROM advertisement WHERE ad_id = '$ad_id'");

		if($result->execute()) {
			$return = ["status" => '1'];
			echo json_encode($return);
		} else {
			$return = ["status" => '0'];
			echo json_encode($return);
		}

		
	} else {
		echo json_encode(["status" => '0']);
	}

?>