myApp.controller('AboutMeCtrl', ['$scope', function($scope) {
	$scope.message = "Hover over to see Info";
	$scope.showMsg = function() {
		console.log("hello");
	}
}]);

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