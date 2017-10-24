angular.module('spaApp')															 
.controller('AssoFooterCtrl', function($scope, $http) {
$scope.loading=true;
$http({
		method : "GET",
		url : "models/assoFooter.php?acc=assoFooter"
	}).then(function mySucces (response) {
		$scope.assoFooters=response.data;
	}, function myError (response) {
		$scope.assoFooters = response.statusText;
		$scope.loading=true;
	})
	.finally(function() {
		$scope.loading=false;
	});

	
});
		