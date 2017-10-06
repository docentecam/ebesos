angular.module('spaApp')
 .controller('AssociationsCtrl', function($scope, $http) {
			$http({

				method : "GET",
				url : "models/users.php?acc=loadUser&idUser=1" //modificar
			}).then(function mySucces (response) {
				$scope.names = response.data;
			}, function myError (response) {
				$scope.names = response.statusText;
			});
		

		
	});