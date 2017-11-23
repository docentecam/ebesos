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
		$scope.userList = response.statusText;
	}).finally(function(){
	  $scope.loading = false;
	});
	$scope.loading=true;
	$http({
		method : "GET",
		url : "models/main.php?acc=showActivePromotion"
	}).then(function mySucces(response) {
		$scope.notifyPromo = response.data;
		$scope.alertPromo = $scope.notifyPromo[0]['promos'];
		console.log($scope.alertPromo);
	}, function myError(response) {
		$scope.notifyPromo = response.statusText;
	}).finally(function(){
		$scope.loading = false;
	});	
	
	
	$scope.showDisconnect = function(){
		if ($scope.showLogOff = !$scope.showLogOff) {
			
		}			
	};
	
});