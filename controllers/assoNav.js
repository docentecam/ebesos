angular.module('spaApp')															 
.controller('AssoNavCtrl', function($scope, $http) {

$http({
		method : "GET",
		url : "models/assoNav.php?acc=assoNav"
	}).then(function mySucces (response) {
		$scope.assoNavs=response.data;
		console.log($scope.assoNavs);
	}, function myError (response) {
		$scope.assoNavs = response.statusText;
	});
});
		