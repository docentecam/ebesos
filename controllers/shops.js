angular.module('spaApp')

  .controller('ShopsCtrl', function($scope, $http) {


		$http({
			method : "GET",
			url : "models/shops.php"
		}).then(function mySucces (response) {
			$scope.names = response.data;
			
		}, function myError (response) {
			$scope.names = response.statusText;
		});
			
	});

/*if (isset($_GET['acc']) && $_GET['acc'] == 'l')
{
	listshops();
}*/
