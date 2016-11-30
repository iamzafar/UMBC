var myApp = angular.module('DrakeWeb', ['ngRoute', 'ngResource']).config(
	function($routeProvider) {
		
		$routeProvider
		.when('/home', {
			templateUrl: '/UMBC/Client/home.html',
			controller: 'HomeCtrl'
		}).
		when('/signup', {
			templateUrl: '/UMBC/Client/register.html',
			controller: 'SignUpCtrl'
		}).
		when('/login', {
			templateUrl: '/UMBC/Client/signin.html',
			controller: 'LoginCtrl'
		}).
		when('/profile', {
			url:'/aboutme',
			templateUrl: '/UMBC/Client/profile.html',
			controller: 'ProfileCtrl',
			authenticate: false
		}).
		when('/service', {
			url:'/service',
			templateUrl: '/UMBC/Client/service.html',
			controller: 'ServiceCtrl'		
		});

		$routeProvider.otherwise({redirectTo: '/login'});

});

