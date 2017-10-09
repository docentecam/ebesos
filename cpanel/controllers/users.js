angular.module('spaApp')
 .controller('AssociationsCtrl', function($scope, $http) {
			$http({

				method : "GET",
				url : "models/users.php?acc=loadUser&idUser=1" //modificar
			}).then(function mySucces (response) {
				$scope.associations = response.data;
				$scope.llega = "llega";
			}, function myError (response) {
				$scope.associations = response.statusText;
			});
		
			$scope.showChangePass = function(){
  					$scope.changePass = true;
				};
			$scope.updateUser = function(){
  					$scope.name = dataUser['name'].value;
  					$scope.email = dataUser['email'].value;
  					$scope.pswdMail = dataUser['pswdMail'].value;
  					$scope.address = dataUser['address'].value;
  					$scope.telephone = dataUser['telephone'].value;
				};
		
	});