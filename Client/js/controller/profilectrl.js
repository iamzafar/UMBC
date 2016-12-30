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


myApp.controller('ProfileCtrl', ['$scope', '$http', '$interval', '$window', function($scope, $http, $interval, $window) {

	//user id
	var local = JSON.parse(localStorage['user']);
	// user default image
	var defaultPath = "userprofile/";
	var user_image_link;
	var user_id = local['user']['user_id'];

	console.log(local['user']['image_link']);

	if(local != null) {
		if(local['user']['image_link'] != null) {
			user_image_link = local['user']['image_link'];
		} else {
			user_image_link = defaultPath + "default.jpg";
		}
	} else {
		user_image_link = defaultPath + "default.jpg";
	}

	$scope.username = "Hello User";
	
	// add image default
	$scope.myadimage = defaultPath + "default_ad.jpg";
	console.log(user_image_link);

	// user profile image
	$scope.myimage = user_image_link;

	// for hover effect
	$scope.message = "Hover over to know about me";
	$scope.showMsg = function() {
		console.log("hello");
	}

	$scope.changeprofile = function() {
		console.log("changeprofile is called");

		var files = $scope.files;
		var uploadUrl = "ServerFiles/uploadimages/upload.php";
		

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
			//$window.location.reload();
			if(res['status'] === '1') {
				alert("upload successfully");
				$scope.myimage = res['image_link'];
				var local2 = JSON.parse(localStorage['user']);
				local2['user']['image_link'] = res['image_link'];
				
				localStorage.setItem('user', JSON.stringify(local2));
				console.log(localStorage);
			} else {
				alert("failed to upload");
			}

		}).error(function(err) {
			console.error(err);
		});

	}

	// delete add
	$scope.deleteAd = function() {
		console.log("delete");
		var ad_id = "";
		// jquery 
		$(function() {
			ad_id = $('.del-btn').closest('tr').attr('id');
		});

		var adInfo = {
			'ad_id' : ad_id
		};

		$http.post("ServerFiles/adfiles/deletead.php", adInfo).success(function(res) {
			// call getAds function again to refresh
			console.log("hello");
			getAds();

		}).error(function(err) {
			console.error(err);
		})
	}

	// get user ads
	var getAds = function() {
		//console.log('it is called');
	 	var userInfo = {
	 		'user_id': user_id,
	 	};

	 	// send to php get ads
        $http.post("ServerFiles/adfiles/getads.php", userInfo).success(function(response) {
        		$scope.my_ads = response;
        		console.log("helO");
        	
        }).error(function(err) {
        	console.log("hahds");
        });
    };

    // get data when load in home page
    getAds();
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