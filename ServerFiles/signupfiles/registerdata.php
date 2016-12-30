<?php

	session_start();
	require "../functions/phpfunctions.php";
	require '../config/connect_db.php';


	$isSubmit = ( isset( $_POST['submit'] ) ? 1 : 0 );
	//$arr = array('email' => '', 'register' => 1 );

	
	if( $isSubmit ) {
		
		$email = strtolower( escape( $db, trim( $_POST['email'] ) ) );

		// hash the email
        $emailBegin = emailBegin($email);
        $emailEnd = emailEnd($email);
        // set the salt of the encrypion to begin email md5;
        $_SESSION['salt'] = md5( $emailBegin ); 
        // encrypt email;
        $emailEncrypt = encrypt( $emailBegin, $_SESSION['salt'] ) . $emailEnd;
        // replace the + sign with /;
        $email = replacePlus( $emailEncrypt );

		$siteurl = escape( $db, trim( $_SESSION['siteurl'] ) );
	
		$firstname = strtolower( escape( $db, trim( $_POST['firstname'] ) ) );

		$lastname = strtolower( escape( $db, trim( $_POST['lastname'] ) ) );
		
		//Hash password: first layer;
		$password = hash( 'sha256', escape( $db, $_POST['password'] ) );

	
		// not include email validation yet;
		//second layer hash password;
		$passwordHash = password_hash( $password, PASSWORD_DEFAULT );
		$result = $db->prepare( "INSERT INTO users ( FirstName, LastName, Email, Site_Url, Password ) VALUES( ?, ?, ?, ?, ? )" );
		$result->bind_param("sssss", $firstname, $lastname, $email, $siteurl, $passwordHash );



		if( !$result->execute() ){
			$result->close();
			echo 0;
			// get the userId of the new registered client from users table;
		} else{
			$result->close();
			echo 1;
		}
		

		

	}		
?>


