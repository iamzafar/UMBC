myApp.controller('SignUpCtrl', ['$scope', '$http', '$location', '$window', function($scope, $http, $location, $window) {

	console.log("signup is called");

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
		var userInfo = {
			"firstname" : $scope.userInfo.firstname,
			"lastname" : $scope.userInfo.lastname,
			"email" : $scope.userInfo.email,
			"password" : $scope.userInfo.password,
			"re_pwd" : $scope.userInfo.re_pwd 
		}

		if($scope.userInfo.password !== $scope.userInfo.re_pwd) {
			console.log("invalid input");
			alert("Password doesn't match");
			return;
		} else if($scope.userInfo.firstname === undefined || $scope.userInfo.lastname === undefined || $scope.userInfo.email === undefined || $scope.userInfo.password === undefined || $scope.userInfo.re_pwd === undefined) {
			console.log("invalid input");
			alert("Invalid input");
			return;
		} else if($scope.userInfo.firstname === "" || $scope.userInfo.lastname === "" || $scope.userInfo.email === "" || $scope.userInfo.password === "" || $scope.userInfo.re_pwd === "") {
			console.log("invalid input");
			alert("Invalid input");
			return;
		} else {

			$http.post("ServerFiles/signupfiles/signup.php", userInfo).success(function(res) {
				if(res.status == "userfound") {
					alert("userfound");
				}
				console.log(res.status);
			}).error(function(err) {
				console.log(error(err));
			});
		}
	}

}]);