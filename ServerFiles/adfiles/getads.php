<?php
	require '../../Config/connect_db.php';
	require '../../functions/phpfunctions.php';

	if($connect) {
		$data = json_decode(file_get_contents("php://input"));

		$user_id = $data->user_id;
		$userAds = array();
		$query = "SELECT * FROM advertisement WHERE user_user_id='$user_id' ORDER BY ad_id DESC";

		$result = $db->query($query);
		if($result->num_rows) {
			$row = "";
			while($row = $result->fetch_assoc()) {
				$userAds[] = $row;
			}

			$result->close();
		} 
		echo json_encode($userAds);
	} 

?>