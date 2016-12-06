myApp.directive('hoverZoom', function() {
    return {
        // A: Attribute, C: Class name, E: Element  eg: <superman></superman> M: HTML comments
        restrict: "M", 
        link: function(scope, element){
           $(element).hoverZoom({speedView:600, speedRemove:400, showCaption:true, 
            speedCaption:600, debug:true, hoverIntent: true, loadingIndicatorPos: 'center'});
        }
    };
});


myApp.controller('HomeCtrl', ['$scope', '$http', '$interval', function($scope, $http, $interval) {
	// user default image
	var defaultPath = "userprofile/";
    var all_ads = "";

	// add image default
	$scope.adimage = defaultPath + "default_ad.jpg";

	// init the post in home page first, if no updates, no posts will be added
	function getAds(initial) {
	 	//console.log('it is called');

	 	// get user id;
	 	if(localStorage['user']) {
		 	var local = JSON.parse(localStorage['user']);
			var userInfo =  {
				'user_id': local['user']['user_id']
			}

	        $http.post("ServerFiles/homepage/getallads.php", userInfo).success(function(response) {
	        	if(initial) {
	        		//$scope.all_ads = response;
	                all_ads = response;
	                $scope.all_ads = angular.copy(all_ads);;
	                all_ads = undefined;
	        	} else {
	        		if(response.length > $scope.all_ads.length) {
	        			$scope.incomingAds = response;
	        		}
	        	}
	        });
	    }
    };

    // interval time of the post that should appear is 5 seconds
    $interval(function() {
    	getAds(false);
    	console.log("called");
    	if(localStorage['user']) {
	    	if($scope.incomingAds) {
	    		$scope.difference = $scope.incomingAds.length - $scope.all_ads.length;
	    	}
	    }
    }, 5000);

    $scope.setNewAds = function() {
    	if($scope.incomingAds) {
	    	$scope.all_ads = angular.copy($scope.incomingAds);
	    	$scope.incomingAds = undefined; // delete this incomingWastes because we copy it, and then set to undefined to hide the number of tweets after update
	    }
    };

    // ********************************************************
    // my updates
    $scope.currentPage = 0;
    $scope.defaultPageSize = 5;
    $scope.pageSize = 5;    
    $scope.numberOfPages=function(){
        
        // cannot get the SIZE of JSON array!!!!!
        var jsonArraylen;
        if($scope.all_ads == 'null' || $scope.all_ads == undefined){
            jsonArraylen = 0;
        }else{
            if (!Object.keys) {
                 Object.keys = function (obj) {
                var keys = [],
                    k;
                for (k in obj) {
                    if (Object.prototype.hasOwnProperty.call(obj, k)) {
                        keys.push(k);
                    }
                }
                    return keys;
                };
            }
            if($scope.all_ads !== undefined) {
                jsonArraylen = Object.keys($scope.all_ads).length; // here is the problem
                all_ads = undefined;
            } else {
            	jsonArraylen = 0;
            }
        }
        var len = Math.ceil(jsonArraylen/$scope.pageSize);
        $scope.pageArray = [];
        
        for( var i = 0; i < len; i++ )
        {
            $scope.pageArray.push( i);
        }
        
        return len;                
    }

    $(function(){
        (function() {
            $('img').on('click', function() {
                console.log("image");
            });
        }());
    });  


    // init
    getAds(true);
   
}]);

myApp.filter('startFrom', function() {
    return function(input, start) {
        if (!input || !input.length) { return; }
        start =+ start; //parse to int
        return input.slice(start);
    }
});
