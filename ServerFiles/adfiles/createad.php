<?php
    require("../../Config/connect_db.php");
	require("../../Functions/phpfunctions.php");

	// if connect to the database, $connect is a variable in connect_db.php file
	if($connect) {
		$data = json_decode(file_get_contents("php://input"));
		$user_id = $data->user_id;
		$adsTitle = $data->adsTitle;
		$adsContent = $data->adsContent;

		// store to the database
		$result = $db->prepare("INSERT INTO advertisement (title, content, user_user_id) VALUES(?, ?, ?)");
		$result->bind_param("ssi", $adsTitle, $adsContent, $user_id);

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