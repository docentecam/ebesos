angular.module('spaApp')

  .controller('AssociationsCtrl', function($scope, $http) {

		$scope.listShops = function(idUser){		
			$http({
				method : "GET",
				url : "models/shops.php?idUser="+idUser
			}).then(function mySucces(response) {
				templateUrl:'view/shops.html'
				$scope.names = response.data;
				$scope.div4 = false;
				$scope.div3 = false;
				$scope.div2 = false;
				$scope.div1 = true;
			}, function myError(response) {
				$scope.names = response.statusText;
			});
		};

	});
