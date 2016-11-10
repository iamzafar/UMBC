<?php

	/* need to include or require another php file to connect to database */


	/* if user passes the check and set this to true, now is set true to test */
	$isLoggin = true;
	$data = json_decode(file_get_contents("php://input"));

	/* check user info with database to match then send back to front end */

	/* php associative array can be used as json to send back to front end for JS, only send back to front if it passes the check */
	if($isLoggin) {
		$userData = ['email' => $data->email];
		/* send email back to front end to test if this end point is working */
		echo json_encode($userData);
	}

?>