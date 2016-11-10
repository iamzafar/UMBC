<?php
	//session_start();
	
	$_SESSION['email'] = "";
	$_SESSION['password'] = "";

	require "config/connect_db.php";
	require "functions/phpfunctions.php";

	$sessionEmail;
	$access = 0;
	// verifyData will check if user email, password, and email confirmation is valid;
	$verifyData = 0;
	// postVerify will check 
	$postVarify = 0;
	$emailValidate = 0;
	$tokenVarify = 0;
	$sessionVarify = 0;

	$error = array();

	$submit = isset( $_POST['loginbtn'] ) ? 1 : 0;

	
	// set sessions value;
	if( $submit ){
		//set sessions from user;
		$_SESSION['email'] = escape( $_POST['email'] );
		//first layer hash for the pwd;
		$_SESSION['password'] = escape( hash( 'sha256', $_POST['password'] ) );
		//password_hash( $pwd, PASSWORD_DEFAULT );	
	}

	//getting data from user;
	$token = $_POST['token'];
	$userEmail = ( $submit ) ? escape( trim( $_POST['email'] ) ) : $_SESSION['email'];
	$password = ( $submit ) ? escape( hash( 'sha256', $_POST['password'] ) ) : $_SESSION['password'];

	//verify tokens;  the set token from last page compare to variable token on this page
	$tokenVarify = ( isset( $_SESSION['token'] ) && $token = $_SESSION['token'] ) ? 1 : 0;
	//check session exist;
	$sessionExist = ( isset( $_SESSION['email'] ) && isset( $_SESSION[''] ) ) ? 1 : 0;


	//header( 'Refresh: 3; url=http://localhost/series/main/loginRegisterForm.php' );

	// checking in database;
	if( !$connect ){
		// put errors into array;
		$error[] = "Problem on Database Connection";

	} else{
		$tempPass = "";

		//echo $userEmail . '<br>';
		if( $result = $db->prepare( "SELECT User_Id, Password, Email FROM users WHERE Email = ?" ) ){
			$result->bind_param( "s", $userEmail );
			$result->execute();
			$result->bind_result($User_Id, $Password, $Email);

			if( $result->fetch() ){							
				$tempPass = $Password;

				if( $isMatch = password_verify( $password, $tempPass ) ){
									
					$verifyData = 1;
				}else{
					$error[] = "Email or Password doesn't match.";
				}

			} else {
				$verifyData = 0;
				//echo "No record exist.";
			}
		} else{
			$verifyData = 0;
		}

		/*if( $isMatch = password_verify( $password, $tempPass ) ){
			$verifyData = 1;
		}else{
			$error[] = "Email or Password doesn't match.";
		}*/
	}

	if( !$tokenVarify || !$verifyData ){
		$error[] = "Invalid Submission.";
	} else {
		$postVarify = 1;
	}

	// if postvarify won't match, session won't match;
	if( !$sessionExist || !$verifyData || !$tokenVarify ){
		$sessionVarify = 0;
	} else{
		$sessionVarify = 1;
	}

	$access = ( $submit ) ? $postVarify : $sessionVarify;
	if( $access ){
		// session for php to login;
		
		echo 1;


	}else{
		
		echo 0;
	}

?>