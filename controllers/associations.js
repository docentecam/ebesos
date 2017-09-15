angular.module('spaApp')

	.controller('AssociationsCtrl', function ($scope) {

		$http({
			method : "GET",
			url : "models/users.php"
		}).then(function mySucces (response) {
			$scope.names = response.data;
			
		}, function myError (response) {
			$scope.names = response.statusText;
		});

		

	});