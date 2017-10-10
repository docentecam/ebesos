angular.module('spaApp')
.controller('AssoTopImageCtrl', function($scope, $http) {

$http({
		method : "GET",
		url : "models/assoLogoTop.php?acc=assoTopImage"
	}).then(function mySucces (response) {
		$scope.assoTopImages=response.data;
	}, function myError (response) {
		$scope.assoTopImages = response.statusText;
	});
});