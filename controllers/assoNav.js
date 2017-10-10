angular.module('spaApp')															 
.controller('AssoNavCtrl', function($scope, $http) {

$http({
		method : "GET",
		url : "models/assoNav.php?acc=assoNav"
	}).then(function mySucces (response) {
		$scope.assoNavs=response.data;
	}, function myError (response) {
		$scope.assoNavs = response.statusText;
	});
});

angular.module('spaApp')
.controller('AssoTopImageCtrl', function($scope, $http) {

$http({
		method : "GET",
		url : "models/assoNav.php?acc=assoTopImage"
	}).then(function mySucces (response) {
		$scope.assoTopImages=response.data;
	}, function myError (response) {
		$scope.assoTopImages = response.statusText;
	});
});

		