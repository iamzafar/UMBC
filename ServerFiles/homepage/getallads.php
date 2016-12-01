<?php
	require '../../Config/connect_db.php';
	require '../../functions/phpfunctions.php';

	if($connect) {

		$userAds = array();
		$query = "SELECT create_date, title, content, email FROM advertisement, user WHERE user_id = user_user_id ORDER BY ad_id DESC";

		$result = $db->query($query);
		if($result->num_rows) {
			$row = "";
			while($row = $result->fetch_assoc()) {
				// get user email
				$userAds[] = $row;
			}

			$result->close();
		} 
		echo json_encode($userAds);
	} 

?>