angular.module('spaApp')
.factory('usersList', function(){
	return{
		data: {}
	};
});
angular.module('spaApp')
.controller('MainCtrl', function($scope, $http, usersList) {
$scope.loading=true;
$scope.showLogOff=true;

	$http({
		method : "GET",
		url : "models/users.php?acc=listUsers"
	}).then(function mySucces(response) {
		$scope.userList = response.data;
		usersList.data.userList = $scope.userList;
	}, function myError(response) {
		$scope.shops = response.statusText;
	}).finally(function(){
	  $scope.loading = false;
		});
	$scope.showDisconnect = function(){
		if ($scope.showLogOff = !$scope.showLogOff) {
			
		}			
	};
	
});