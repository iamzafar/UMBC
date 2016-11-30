myApp.directive('showsMessageWhenHovered', function() {
	return {
		// A: Attribute, C: Class name, E: Element  eg: <superman></superman> M: HTML comments
		restrict: "A", 

		link: function(scope, element, attributes) {
			var originalMessage = scope.message;

			element.bind("mouseenter", function() {
				scope.message = attributes.message;
				scope.$apply();
			});
			element.bind("mouseleave", function() {
				scope.message = originalMessage;
				scope.$apply();
			})
		}
	}
});

// for upload files;
myApp.directive("fileInput", ['$parse', function($parse) {	
	return {
		// element will the html tag
		restrict: 'A',
		link: function(scope, element, attrs) {
			var model = $parse(attrs.fileInput);
	        var modelSetter = model.assign;

	        element.bind('change', function(){
	            scope.$apply(function(){
	                modelSetter(scope, element[0].files[0]);
	            });
	        });
		}
	}
}]);


myApp.controller('ProfileCtrl', ['$scope', '$http',  function($scope, $http) {
	$scope.username = "Hello User";
	// user default image
	var defaultPath = "userprofile/";
	$scope.myimage = defaultPath + "default.jpg";

	var local = JSON.parse(localStorage['user']);

	// for hover effect
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
	
	$scope.changeprofile = function() {
		console.log("changeprofile is called");

		var files = $scope.files;
		var uploadUrl = "ServerFiles/uploadimages/upload.php";
		var local = JSON.parse(localStorage['user']);
		var user_id = local['user']['user_id'];

		//fileUpload.uploadFile(files, uploadUrl, user_id);

		var form_data = new FormData();

		form_data.append('file', files);
		form_data.append('user_id', user_id);
		console.log(files);
		
		// upload image 
		$http.post(uploadUrl, form_data, {
			transformRequest: angular.identity,
			method: 'POST',
			headers: {'Content-Type': undefined, 'Process-Data': false}
		}).success(function(res) {
			
		    console.log(res);
			if(res['status'] === '1') {
				alert("upload successfully");
				$scope.myimage = res['image'];
			} else {
				alert("failed to upload");
			}

		}).error(function(err) {
			console.error(err);
		});

	}

	// select the new uploaded image
	$scope.select = function() {
		$http.get("select.php")
	}

}]);

/*myApp.service('fileUpload', ['$http', function($http) {
	this.uploadFile = function(file, uploadUrl, user_id) {
		var form_data = new FormData();

		form_data.append('file', file);
		form_data.append('user_id', user_id);
		console.log(file);
		
		// upload image 
		$http.post(uploadUrl, form_data, {
			transformRequest: angular.identity,
			method: 'POST',
			headers: {'Content-Type': undefined, 'Process-Data': false}
		}).success(function(res) {
			
		    console.log(res);
			if(res['status'] === '1') {
				alert("upload successfully");
				
			} else {
				alert("failed to upload");
			}

		}).error(function(err) {
			console.error(err);
		});
	}
}]);*/