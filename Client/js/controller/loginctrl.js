myApp.controller('LoginCtrl', ['$scope', '$http', '$location', '$window', function($scope, $http, $location, $window) {

	/* login info from user */
	$scope.userInfo = {
		"email" : undefined,
		"password" : undefined
	}

	if(localStorage['user']) {
    	$scope.loggedIn = true;
    } else {
    	$scope.loggedIn = false;
    }

	/* user loggin function */
	$scope.userLogin = function() {
		console.log("login func is called");
		var userData = {
			"email" : $scope.userInfo.email,
			"password" : $scope.userInfo.password
		}

		/* send data to end points php file*/
		$http.post("ServerFiles/loginfiles/login.php", userData).success(function(res) {
			console.log(res);

			if(res.status === 1) {
				/* get user email or whatever is passed from end points, login icon will be changed to logged out !!!!!!!!!!!!!!!*/
				localStorage.setItem("user", JSON.stringify({user: res}));
				$scope.loggedIn = true;
				$location.path('/home');
				//$window.location.reload();
			} else {
				console.log('login failed');
				$location.path('/login');
			}

		}).error(function(error) {
			console.error(error);
		});
		
	}

	/* user logout function */
	$scope.userLogout = function() {
		console.log("logout func is called");
		localStorage.clear();
		
		$location.path('/login');
		$scope.loggedIn = false;
	}

}]);