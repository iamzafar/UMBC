<?php
	require("../../Config/connect_db.php");
	require("../../Functions/phpfunctions.php");

	if($connect) {
		if(!empty($_FILES)) {
			//$headEmail = strstr( $email, '@', true );
			$file_name = $_FILES['file']['name'];
			$user_id = $_POST["user_id"];
			
			$filepath = "userprofile/$user_id/ads/" . basename($_FILES['file']['name']);
			
			if(!is_dir("userprofile/$user_id/ads/")) {
				if(mkdir("userprofile/$user_id/ads/", 0700, true)) {
					if(move_uploaded_file($_FILES['file']['tmp_name'], $filepath)) {

						// store to database
						$result = $db->prepare("UPDATE advertisement SET add_image_url = ? WHERE user_user_id = '$user_id'");
						$result->bind_param("s", $filepath);

						if($result->execute()) {
							$userData = ['status' => '1', 'add_image_link' => $filepath];
							echo json_encode($userData);
						} else {
							$userData = ['status' => '0', 'add_image_link' => $filepath];
							echo json_encode($userData);
						}

						$db->close();
					} 

				}
			} else {

				// if file exist
				if(file_exists($filepath)) {
					$result = $db->prepare("UPDATE advertisement SET image_link = ? WHERE user_id = '$user_id'");
					$result->bind_param("s", $filepath);

					if($result->execute()) {
						$db->close();
						$userData = ['status' => '1', 'add_image_link' => $filepath];
						echo json_encode($userData);
					} else {
						$db->close();
						$userData = ['status' => '0', 'add_image_link' => $filepath];
						echo json_encode($userData);
					}

				} else {
					move_uploaded_file($_FILES['file']['tmp_name'], $filepath);
					// store to database
					$result = $db->prepare("UPDATE advertisement SET add_image_link = ? WHERE user_id = '$user_id'");
					$result->bind_param("s", $filepath);

					if($result->execute()) {
						$db->close();
						$userData = ['status' => '1', 'add_image_link' => $filepath];
						echo json_encode($userData);
					} else {
						$db->close();
						$userData = ['status' => '0', 'add_image_link' => $filepath];
						echo json_encode($userData);
					}
				}
			}
		}

	} else {
		echo 0;
	}
	
?>