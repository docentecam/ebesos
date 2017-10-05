angular.module('spaApp')															 
.controller('LinksCtrl', function($scope, $http) {

$http({
		method : "GET",
		url : "models/links.php?acc=links"
	}).then(function mySucces (response) {
		$scope.links=response.data;
	}, function myError (response) {
		$scope.links = response.statusText;
	});
});		