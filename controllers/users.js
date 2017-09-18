angular.module('spaApp')

  .controller('AboutUsCtrl', function($scope, $http) {


		$http({
			method : "GET",
			url : "models/users.php?acc=history&idUser=1"
		}).then(function mySucces (response) {
			$scope.names = response.data;
			
		}, function myError (response) {
			$scope.names = response.statusText;
		});
			
	});

  angular.module('spaApp')  															 
.controller('ContactCtrlUser', function($scope, $http ,$routeParams) {
	
  $scope.userId = $routeParams.idUser;
console.log("llega"+$scope.userId);

$http({
			method : "GET",
			url : "models/users.php?acc=mail&userId="+ $scope.userId
		}).then(function mySucces (response) {
			$scope.email = response.data;
			
		}, function myError (response) {
			$scope.email = response.statusText;
		});
  console.log('Llega email'+$scope.email);
});