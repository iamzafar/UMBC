var myApp = angular.module('DrakeWeb', ['ui.router', 'ngResource']).config(
	function($stateProvider, $urlRouterProvider) {
		$urlRouterProvider.otherwise('/');

		$stateProvider

		.state('home', {
			url: '/home',
			templateUrl: '/UMBC/Client/home.html',
			controller: 'HomeCtrl'
		}).
		state('signup', {
			url: '/signup',
			templateUrl: '/UMBC/Client/register.html',
			controller: 'SignUpCtrl'
		}).
		state('profile', {
			url:'/aboutme',
			templateUrl: '/UMBC/Client/profile.html',
			controller: 'ProfileCtrl'
		}).
		state('login', {
			url:'/',
			templateUrl: '/UMBC/Client/signin.html',
			params: { 
		      'toState': 'home', // default state to proceed to after login
		      'toParams': {}
		    },
			controller: 'LoginCtrl'
		}).
		state('service', {
			url:'/service',
			templateUrl: '/UMBC/Client/service.html',
			controller: 'AboutMeCtrl'		
		});
});