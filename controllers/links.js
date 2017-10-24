angular.module('spaApp')															 
.controller('LinksCtrl', function($scope, $http) {
$scope.loading=true;
$http({
		method : "GET",
		url : "models/links.php?acc=links"
	}).then(function mySucces (response) {
		$scope.links=response.data;
	}, function myError (response) {
		$scope.links = response.statusText;
		$scope.loading=true;
	})
	.finally(function() {
		$scope.loading=false;
	});
	
});		