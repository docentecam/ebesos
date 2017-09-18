angular.module('spaApp')

  .controller('ShopsCtrl', function($scope, $http) {


		/*$http({
			method : "GET",
			url : "models/shops.php"
		}).then(function mySucces (response) {
			$scope.names = response.data;
			
		}, function myError (response) {
			$scope.names = response.statusText;
		});*/
		$scope.listShops = function(idUser){		
			$http({
				method : "GET",
				url : "models/shops.php?idUser="+idUser
			}).then(function mySucces(response) {
				templateUrl:'view/shops.html'
				$scope.names = response.data;
			}, function myError(response) {
				$scope.names = response.statusText;
			});
		};

	});
