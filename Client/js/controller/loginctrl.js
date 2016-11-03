myApp.controller('LoginCtrl', ['$scope', '$http', '$state', '$stateParams', function($scope, $http, $state, $stateParams) {

	/* login info from user */
	$scope.userInfo = {
		"email" : undefined,
		"password" : undefined
	}

	var checkStatus = function() {
		if(localStorage["user"]) {
			$scope.loggedIn = true;
		} else {
			$scope.loggedIn = false;
		}
	}

	/* user loggin function */
	$scope.userLogin = function() {
		console.log("login func is called");
		var userData = {
			"email" : $scope.userInfo.email,
			"password" : $scope.userInfo.password
		}

		/* send data to end points php file*/
		$http.post("ServerFile/login.php", userData).success(function(res) {
			console.log(res);
			/* get user email or whatever is passed from end points, login icon will be changed to logged out */
			localStorage.setItem("user", JSON.stringify({user: res}));

			//$state.go($state.home, {}, {reload: true});

		}).error(function(error) {
			console.error(error);
		});
		
	}

	/* user logout function */
	$scope.userLogout = function() {
		console.log("logout func is called");
		localStorage.clear();
		checkStatus();
	}

	checkStatus();
}]);