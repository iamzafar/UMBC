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


myApp.controller('ProfileCtrl', ['$scope', '$http', '$interval', function($scope, $http, $interval) {
	$scope.my_ads = [];

	//user id
	var local = JSON.parse(localStorage['user']);
	var user_id = local['user']['user_id'];
	var user_image_link = local['user']['image_link'];

	$scope.username = "Hello User";
	// user default image
	var defaultPath = "userprofile/";

	// add image default
	$scope.myadimage = defaultPath + "default_ad.jpg";

	// user profile image
	$scope.myimage = (user_image_link.length === 0) ? defaultPath + "default.jpg" : user_image_link;

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
			
		    console.log(res);
			if(res['status'] === '1') {
				alert("upload successfully");
				$scope.myimage = res['image_link'];
				console.log(res['image_link'] + " wawawwaaw");
				localStorage.setItem('user', JSON.stringify({user: res}));
				
			} else {
				alert("failed to upload");
			}

		}).error(function(err) {
			console.error(err);
		});

	}

	// delete add
	$scope.deleteAd = function() {
		
		var ad_id = "";
		// jquery 
		$(function() {
			ad_id = $('.del-btn').closest('li').attr('id');
		});

		var adInfo = {
			'ad_id' : ad_id
		};

		$http.post("ServerFiles/adfiles/deletead.php", adInfo).success(function(res) {
			// call getAds function again to refresh
			getAds();

		}).error(function(err) {
			console.error(err);
		})
	}

	// get user ads
	var getAds = function(initial) {
		//console.log('it is called');
	 	var userInfo = {
	 		'user_id': user_id,
	 	};

	 	// send to php get ads
        $http.post("ServerFiles/adfiles/getads.php", userInfo).success(function(response) {
        	if(initial) {
        		$scope.my_ads = response;
        	} else {
        		if(response.length > $scope.all_ads.length) {
        			$scope.incomingAds = response;
        		}
        	}
        }).error(function(err) {
        	console.error(err);
        })
    };

	$interval(function() {
    	getAds(false);
    	console.log("called");
    	if($scope.incomingAds) {
    		$scope.difference = $scope.incomingAds.length - $scope.my_ads.length;
    	}
    }, 5000);

    $scope.setNewAds = function() {
    	if($scope.incomingAds) {
	    	$scope.my_ads = angular.copy($scope.incomingAds);
	    	$scope.incomingAds = undefined; // delete this incomingWastes because we copy it, and then set to undefined to hide the number of tweets after update
	    }
    };

    // get data when load in home page
    getAds(true);
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