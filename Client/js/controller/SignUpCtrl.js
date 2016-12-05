myApp.controller('SignUpCtrl', ['$scope', '$http', '$location', '$window', function($scope, $http, $location, $window) {

	console.log("signup is called");
	var error = [];
	// set user data variable
	$scope.userInfo = {
		"firstname" : "",
		"lastname" : "",
		"email" : "",
		"password" : "",
		"re_pwd" : ""
	};

	// signup function
	// re_pwd
	$scope.userSignup = function(event) {

		var email = $scope.userInfo.email;
		var atIndex = email.indexOf("@");
		console.log(atIndex);
		var subEmail = email.substring(atIndex+1);

		console.log(subEmail);

		var userInfo = {
			"firstname" : $scope.userInfo.firstname,
			"lastname" : $scope.userInfo.lastname,
			"email" : $scope.userInfo.email,
			"password" : $scope.userInfo.password,
			"re_pwd" : $scope.userInfo.re_pwd 
		}
		if(subEmail !== "umbc.edu") {
			console.log("invalid email");
			console.log(subEmail);
			error.push("User must be UMBC student, email is invalid");
		}
		else if($scope.userInfo.password !== $scope.userInfo.re_pwd) {
			console.log("invalid input");
			error.push("Password doesn't match");
			return;
		}
		else if($scope.userInfo.firstname === undefined || $scope.userInfo.lastname === undefined || $scope.userInfo.email === undefined || $scope.userInfo.password === undefined || $scope.userInfo.re_pwd === undefined) {
			console.log("invalid input");
			error.push("Invalid input");
			return;
		}
		else if($scope.userInfo.firstname === "" || $scope.userInfo.lastname === "" || $scope.userInfo.email === "" || $scope.userInfo.password === "" || $scope.userInfo.re_pwd === "") {
			console.log("invalid input");
			error.push("Invalid input");
			return;
		} 
		// if error free call the http post
		if(error.length !== 0) {
			alert(error.join('\n'));
			$scope.userInfo.email = "";
			error = [];
		} else {
			$http.post("ServerFiles/signupfiles/signup.php", userInfo).success(function(res) {
				if(res.status == "userfound") {
					alert("userfound");
				}
				$location.path('/login');
				$window.location.reload();
			}).error(function(err) {
				alert("unknown error, try again");
			});
		}
		
	}
}]);