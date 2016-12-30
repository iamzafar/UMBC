<?php
	// session is used for user salt
	session_start();
	require '../../Config/connect_db.php';
	require '../../functions/phpfunctions.php';

	if($connect) {

		$userAds = array();
		$query = "SELECT create_date, title, content, email FROM advertisement, user WHERE user_id = user_user_id ORDER BY ad_id DESC";

		$result = $db->query($query);
		if($result->num_rows) {
			$row = "";
			while($row = $result->fetch_assoc()) {
				/* decrypt user email */ 
				$email = $row['email'];
				$emailBegin = emailBegin($email);
				$emailEnd = emailEnd($email);
				for($i = 0; $i < strlen($emailBegin); $i++) {
		          if($emailBegin[$i] == '*') {
		            $emailBegin[$i] = '+';
		          }
		        }
		   
		        $emailDecrypt = decrypt($emailBegin, $_SESSION['salt']);
		        
		        $row['email'] = $emailDecrypt . $emailEnd;


				$userAds[] = $row;
			}

			$result->close();
		} 
		echo json_encode($userAds);
	} 

?>