<?php
	$connect = 0;
	$dragonFlyDB = array(
		'host' => 'localhost',
		'user' => 'root',
		'password' => '',
		'dbName' => 'dragonfly' );

	try{
		$db = new mysqli(
			$dragonFlyDB['host'],
			$dragonFlyDB['user'],
			$dragonFlyDB['password'],
			$dragonFlyDB['dbName'] );

		if( $db -> connect_errno > 0 ){
			throw new Exception("Error Processing Request", 1);
		} else {
			$connect = 1;
		}
	} catch ( Exeption $e ){
		echo "Connection error!" . $db -> connect_error;
	}

?>
