// jquery lib
(function() {
myApp.controller('LoginCtrl', ['$scope', '$http', '$location', '$window', function($scope, $http, $location, $window) {

	if(localStorage['user']) {
    	$scope.loggedIn = true;
    } else {
    	$scope.loggedIn = false;
    }

	/* login info from user */
	$scope.local_user = "";
	
	// parse the json;
	if($scope.loggedIn) {
		var local = JSON.parse(localStorage['user']);
		$scope.first_name = local['user']['first_name'];
		console.log(local);
	} else {
		console.log("no");
	}

	$scope.userInfo = {
		"email" : undefined,
		"password" : undefined
	}

	

	/* user loggin function */
	$scope.userLogin = function() {
		console.log("login func is called");
		var userData = {
			"email" : $scope.userInfo.email,
			"password" : $scope.userInfo.password
		}

		/* send data to end points php file*/
		/* $function is the jquery starting signature*/
		
			$http.post("ServerFiles/loginfiles/login.php", userData).success(function(res) {
				if(res['status'] === '1') {
					
					/* get user email or whatever is passed from end points, login icon will be changed to logged out !!!!!!!!!!!!!!!*/
					localStorage.setItem('user', JSON.stringify({user: res}));
					$scope.loggedIn = true;
					$location.path('/home');
					
					// jquery function
					$(function(){
					(function() {
						$("#exampleInputPassword3").val("").placeholder("password");
					});
					});
				
					$window.location.reload();
				} else {
					$location.path('/login');
					
					// jquery function
					$(function(){
					(function() {
						$("#exampleInputPassword3").val("").attr("placeholder", "Invalid password of user email");
					}());
					});
					
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

}());
