angular.module('spaApp')															 
.controller('AssoNavCtrl', function($scope, $http) {
$scope.loading=true;
$http({
		method : "GET",
		url : "models/assoNav.php?acc=assoNav"
	}).then(function mySucces (response) {
		$scope.assoNavs=response.data;
	}, function myError (response) {
		$scope.assoNavs = response.statusText;
	})
	.finally(function() {
		$scope.loading=false;
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
	})
	.finally(function() {
		$scope.loading=false;
	});
	
});

		