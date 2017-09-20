angular.module('spaApp')

.controller('LoginCtrl', function($scope, $http) {

  	$scope.checking = function(email,password){
		$http({
			method : "GET",
			url : "models/users.php?acc=login&email="+email+"&password="+password
		}).then(function mySucces (response) {
			$scope.names = response.data;
			if($scope.names != "") 
			{
				templateUrl: 'main.html'
			}
			else
			{
				alert('Contrasenya o usurai icorrecte');
			}
		}, function myError (response) {
			$scope.names = response.statusText;
		});
	};
});