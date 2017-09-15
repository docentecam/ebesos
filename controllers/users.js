angular.module('spaApp')

  .controller('AboutUsCtrl', function($scope, $http) {


		$http({
			method : "GET",
			url : "models/users.php"
		}).then(function mySucces (response) {
			$scope.names = response.data;
			
		}, function myError (response) {
			$scope.names = response.statusText;
		});
			
	});

  angular.module('spaApp')  															 
.controller('ContactCtrlUser', function($scope, $routeParams) {
	console.log('Llega controler');
  $scope.userId =  $routeParams.userId;
});