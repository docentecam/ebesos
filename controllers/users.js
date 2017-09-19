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
	$scope.idUser = $routeParams.idUser;
	$http({

			method : "GET",
			url : "models/users.php?acc=mail&idUser="+ $scope.idUser
		}).then(function mySucces (response) {
			$scope.email = response.data;
			
		}, function myError (response) {
			$scope.email = response.statusText;
		});

  console.log('Llega email'+$scope.email);
});

angular.module('spaApp')

.controller('AssociationsCtrl', function($scope, $http) {

  	$scope.showHistory = function(idUser){
		$http({
			method : "GET",
			url : "models/users.php?idUser="+idUser
		}).then(function mySucces (response) {
			templateUrl:'view/aboutUs.html'
			$scope.names = response.data;
			$scope.div4 = false;
			$scope.div3 = false;
			$scope.div1 = false;
			$scope.div2 = true;
		}, function myError (response) {
			$scope.names = response.statusText;
		});
	};

	$scope.showContact = function(idUser){
		$http({
			method : "GET",
			url : "models/users.php?acc=mail&idUser="+ $scope.idUser
		}).then(function mySucces (response) {
			templateUrl:'view/contact.html'
			$scope.email = response.data;
			$scope.div2 = false;
			$scope.div3 = false;
			$scope.div1 = false;
			$scope.div4 = true;
		}, function myError (response) {
			$scope.email = response.statusText;
		});
	};
});