<?php
	/*function escape( $db, $string ){
		$newString = mysqli_real_escape_string( $db, htmlentities($string) );
		return $newString;
	}*/

	function escape( $db, $string ){
		$newString = mysqli_real_escape_string( $db, htmlentities($string) );
		return $newString;
	}

	//check if email exist;
	/*function emailExists( $email ){
		require '../config/connect_db.php';
		if( $connect ){
			$result = $db->query( "SELECT User_Id FROM users WHERE Email = '$email'" );
			if( $result->num_rows ){
				return true;
			}else{
				return false;
			}
		}
	}*/
	function emailExists($db, $connect, $email ){
		if( $connect ){
			$result = $db->query( "SELECT user_Id FROM user WHERE email = '$email'" );
			if( $result->num_rows ){
				return true;
			}else{
				return false;
			}
		}
	}

	//check if Site Url exist;
	function urlExists( $url ){
		require '../config/connect_db.php';
		if( $connect ){
			$result = $db->query( "SELECT User_Id FROM users WHERE Site_Url = '$url'" );
			if( $result->num_rows ){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	//rest of the @email;

	function emailEnd( $email ){
		$rest = strstr( $email, '@' );
		return $rest;
	}

	// store image link
	function storeImage($user_id, $imagename, $db) {
		$result = $db->prepare("UPDATE user SET image_link = ? WHERE user_id = '$user_id'");
		$result->bind_param("s", $filepath);

		if($result->execute()) {
			echo true;
		} else {
			echo false;
		}

		
	}

	//get before the @email.com;
	function emailBegin( $email ){
		$headEmail = strstr( $email, '@', true );
		return $headEmail;
	}

	function replacePlus( $email ){
		$string = str_replace( "+", "/", $email );
		return $string;
	}

	function encrypt( $string, $key ){
		$string = rtrim( base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, $key, $string, MCRYPT_MODE_ECB ) ) );
		return $string;
	}	
	// key for the email is 'kaico', email code key is username for each user;
	function decrypt( $string, $key ){
		$string = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, $key, base64_decode( $string ), MCRYPT_MODE_ECB ) );
		return $string;
	}


	// store address information from new location page;
	function insertAddress( $address, $radius, $lat, $lng, $Store_Site, $query, $db ){

		if( $result = $db->prepare( $query ) ){
			$result->bind_param( "isddi", $Store_Site, $address, $lat, $lng, $radius );
			if( !$result->execute() ){
				$result->close();
				return false;
			}else{

				$result->close();
				return true;
			}

		}else{
			$result->close();
			return false;
		}
	}

	function checkAddress( $address, $Store_Site, $db ){

		$query = "SELECT Store_Address FROM store WHERE Store_Site = '$Store_Site' AND Store_Address = '$address'";
		$result = $db->query($query);
		if( $result->num_rows ){
			return true;
		}else{
			return false;
		}
	}

	// get the user Id info from database users;
	function returnUserID( $userurl, $db ){

		// first get the user id based on $userurl from store;
		$queryUsers = "SELECT User_Id FROM users WHERE Site_Url = '$userurl'";
		$resultFromUsers = $db->query( $queryUsers );
		if( $resultFromUsers->num_rows ){
			$recordsFromUsers = $resultFromUsers->fetch_assoc();
			$resultFromUsers->close();
			return $recordsFromUsers['User_Id'];
		} else {
			return null;
		}
	}

	// get store info according to user_Id from database store;
	function returnStoreInfo( $user_Id, $db ){
		$queryStore = "SELECT * FROM store WHERE Store_Site = '$user_Id' ORDER BY Radius ";
		$resultFromStore = $db->query($queryStore);
		$arr = array();
		if( $resultFromStore->num_rows ){
			while( $recordsFromStore = $resultFromStore->fetch_assoc() ){
				// access it by indexing;
				$arr[] = $recordsFromStore;
			}
			$resultFromStore->close();
			return $arr;
		} else{
			return 0;
		}
	}


	/* Gets list of coupons that user has on account */
	function returnUserCoupons( $id, $db ) {
		$arr = array();
		$queryCoupons = "SELECT * FROM coupon WHERE CouponOwner = '$id'";
		$rows = $db->query($queryCoupons);
		if ( $rows->num_rows ) {
			$arrs = "";
			while ( $arrs = $rows->fetch_assoc() ){
				$arr[] = $row;
			}
			$rows -> close();
			return $arr;
		} else {
			return 0;
		}
	}

	// Deletes a promo from coupon table
	function deleteCoupon( $couponId, $db) {
		$sql = "DELETE FROM coupon WHERE Coupon_Id = '$couponId'";
		$result = $db->query($sql);
		return $result ? 1 : 0;
	}

	//delete multi rows from mysql;
	function delMulti( $idArr, $db ){
		$result='';
		$length = count($idArr);
		for( $i = 0; $i < $length; $i++ ){
			$dataId = $idArr[$i];
			$sql = "DELETE FROM store WHERE Store_Id = '$dataId'";
			$result = $db->query($sql);
		}
		if($result){
			return 1;
		}else{
			return 0;
		}
	}

	//update password
	function updatePwd( $emailEncrypt, $newhashPwd, $db ){
		$query = "UPDATE users SET Password = ? WHERE Email = '$emailEncrypt'";
		$result = $db->prepare($query);
		$result->bind_param( 's', $newhashPwd );
		if( $result->execute() ){
			return true;
		}else{
			return false;
		}
	}

	//update address
	function updateaddr( $Store_Id, $Store_Address, $Lat, $Lng, $Radius, $db ){

		$query = "UPDATE store SET Store_Address = ?, Lat = ?, lng = ?, Radius = ? WHERE Store_Id = '$Store_Id'";
		$results = $db->prepare($query);
		$results->bind_param( 'sddi', $Store_Address, $Lat, $Lng, $Radius );
		if( $results->execute() ){
			return true;
		}else{
			return false;
		}
	}

	//get the last store id
	function getlastID(){
		require '../config/connect_db.php';
		$results = $db->query( "SELECT MAX( Store_Id ) AS id FROM store" );
		$record = $results->fetch_assoc();
		//echo $record['id'];
		return $record['id'];

	}


?>
