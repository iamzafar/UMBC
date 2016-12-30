<?php
	require("../../Config/connect_db.php");
	require("../../Functions/phpfunctions.php");

	if($connect) {
		if(!empty($_FILES)) {
			//$headEmail = strstr( $email, '@', true );
			$file_name = $_FILES['file']['name'];
			$user_id = $_POST["user_id"];
			
			//$file_name = strstr($file_name, '.', true) . $user_id . $file_type;
			$filepath = "userprofile/$user_id/" . basename($_FILES['file']['name']);
			
			if(!is_dir("userprofile/$user_id/")) {
				if(mkdir("userprofile/$user_id/", 0700, true)) {
					if(move_uploaded_file($_FILES['file']['tmp_name'], $filepath)) {

						// store to database
						$result = $db->prepare("UPDATE user SET image_link = ? WHERE user_id = '2'");
						$result->bind_param("s", $filepath);

						if($result->execute()) {
							$userData = ['status' => '1', 'image_link' => $filepath];
							echo json_encode($userData);
						} else {
							$userData = ['status' => '0', 'image_link' => $filepath];
							echo json_encode($userData);
						}

						$db->close();
					} 

				}
			} else {

				// if file exist
				if(file_exists($filepath)) {
					$result = $db->prepare("UPDATE user SET image_link = ? WHERE user_id = '2'");
					$result->bind_param("s", $filepath);

					if($result->execute()) {
						$db->close();
						$userData = ['status' => '1', 'image_link' => $filepath];
						echo json_encode($userData);
					} else {
						$db->close();
						$userData = ['status' => '0', 'image_link' => $filepath];
						echo json_encode($userData);
					}

				} else {
					move_uploaded_file($_FILES['file']['tmp_name'], $filepath);
					// store to database
					$result = $db->prepare("UPDATE user SET image_link = ? WHERE user_id = '2'");
					$result->bind_param("s", $filepath);

					if($result->execute()) {
						$db->close();
						$userData = ['status' => '1', 'image_link' => $filepath];
						echo json_encode($userData);
					} else {
						$db->close();
						$userData = ['status' => '0', 'image_link' => $filepath];
						echo json_encode($userData);
					}
				}
			}
		}

	} else {
		echo 0;
	}
	
?>