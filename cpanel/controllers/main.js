angular.module('spaApp')
.controller('MainCtrl', function($scope, $http) {
$scope.loading=true;
$scope.showLogOff=true;

$http({
		method : "GET",
		url : "models/main.php?acc=main"
	}).then(function mySucces (response) {
		$scope.assoTopImages=response.data;
	}, function myError (response) {
		$scope.assoTopImages = response.statusText;
	})
	.finally(function(){
			$scope.loading=false;
	});				
	$scope.showDisconnect = function(){
		if ($scope.showLogOff = !$scope.showLogOff) {
			
		}			
	};
	
});