angular.module('spaApp')															 
.controller('AssoFooterCtrl', function($scope, $http) {

$http({
		method : "GET",
		url : "models/assoFooter.php?acc=assoFooter"
	}).then(function mySucces (response) {
		$scope.assoFooters=response.data;
	}, function myError (response) {
		$scope.assoFooters = response.statusText;
	});
});
		