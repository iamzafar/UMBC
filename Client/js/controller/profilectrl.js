myApp.controller('ProfileCtrl', ['$scope', '$http', function($scope, $http) {
	$scope.username = "Hello User";

	$scope.changeprofile = function() {
		console.log("changeprofile is called");
	}
}]);