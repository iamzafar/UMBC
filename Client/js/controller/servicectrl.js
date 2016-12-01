myApp.controller('ServiceCtrl', ['$scope', '$http', '$location', '$window', function($scope, $http, $location, $window) {
	// deguging
	console.log("service controller is called");

	var local = JSON.parse(localStorage['user']);
	var user_id = local['user']['user_id']; // get loggedin person's identity
	
	$scope.user = {
		"adsTitle" : "",
		"adsContent" : ""
	};

	// save the ad afer Post your AD is clicked
	$scope.save_advertisement = function() {
		console.log("save ad is called");
		var userAdsInfo = {
			"user_id" : user_id,
			"adsTitle" : $scope.user.adsTitle,
			"adsContent" : $scope.user.adsContent
			//"adsImage" : $scope.user.adsImage
		};

		$http.post("ServerFiles/adfiles/createad.php", userAdsInfo).success(function(res) {
			console.log(res);

			if(res['status'] === '1') {
				console.log("success saved ads");
			} else {
				console.log("fail to save ads");
			}

		}).error(function(err) {
			console.log(error(err));
		});
	}

	// upload image
	$scope.upload_picture = function() {
		console.log("upload is called");
		var preview = document.querySelector('img');
       var file    = document.querySelector('input[type=file]').files[0];
       var reader  = new FileReader();

       reader.onloadend = function () {
           preview.src = reader.result;
       }

       if (file) {
           reader.readAsDataURL(file); //reads the data as a URL
       } else {
           preview.src = "";
       }
	}
}]);