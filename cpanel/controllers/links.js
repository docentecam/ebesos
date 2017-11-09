angular.module('spaApp')															 
.controller('LinksCtrl', function($scope, $http) {
	$scope.loading=true;

	$http({
			method : "GET",
			url : "models/links.php?acc=l"
		})
		.then(function mySucces (response) {
			$scope.linksList = response.data;
		}, function myError (response) {
			$scope.linksList = response.statusText;
		})
		.finally(function() 
		{ 
		    $scope.loading=false; 
		})

	});