myApp.controller('AboutMeCtrl', ['$scope', '$http', function($scope, $http) {
	$scope.message = "Hover over to know about me";
	$scope.showMsg = function() {
		console.log("hello");
	}

	/* static adds right now*/
	$scope.my_adds = [
		{
			"title" : "Testing add 1",
			"description" : "Testing description 1, this is a static data that just to show how this is will be looked"
		}
	]
	$scope.my_adds.push(
		{
			"title" : "Testing add 12",
			"description" : "Testing description 2, this is a static data that just to show how this is will be looked"
		}
	)


}]);