angular.module('spaApp')

.controller('ShopsCtrl', function($scope, $http) {

	$scope.showShop = function(idShop){		
		$http({
			method : "GET",
			url : "models/shops.php?idShop="+idShop
		}).then(function mySucces(response) {
			templateUrl:'views/shop.html'
			$scope.names = response.data;
		}, function myError(response) {
			$scope.names = response.statusText;
		});
	};
});
