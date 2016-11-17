<?php
	$connect = 0;
	$cmsc447DB = array(
		'host' => 'localhost',
		'user' => 'root',
		'password' => '',
		'dbName' => 'cmsc447' );

	try{
		// this is the obj for database use $db anywhere in other files if need to access to database
		$db = new mysqli(
			$cmsc447DB['host'],
			$cmsc447DB['user'],
			$cmsc447DB['password'],
			$cmsc447DB['dbName'] );

		if( $db -> connect_errno > 0 ){
			throw new Exception("Error Processing Request", 1);
		} else {
			$connect = 1;
		}
	} catch ( Exeption $e ){
		echo "Connection error!" . $db -> connect_error;
	}

?>
