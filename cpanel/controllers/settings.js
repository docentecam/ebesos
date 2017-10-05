angular.module('spaApp')
.controller('SettingsCtrl', function($scope, $http, $routeParams) {
	$scope.showShop = false;
	$scope.shopOne = "[{{}}]";
	console.log($scope.showShop);
	$http({
		method : "GET",
		url : "models/shops.php?acc=list"
	}).then(function mySucces(response) {
		$scope.shopsList = response.data;
    $scope.loading = false;
	}, function myError(response) {
		$scope.shops = response.statusText;
	});

	$scope.shopOneEdit = function($idShop){
		$http({
			method : "GET",
			url : "models/shops.php?acc=edit&idShop=" + $idShop
		}).then(function mySucces (response) {
			$scope.shopOne = response.data;
			$scope.showShop = true;
		}, function myError (response) {
			$scope.showShop = response.statusText;
		});
	};
	$scope.shopOneDelete = function($idShop){
		console.log($idShop);
		$http({
			method : "GET",
			url : "models/shops.php?acc=delete&idShop=" + $idShop
		}).then(function mySucces (response) {
			$scope.shopDeleted = response.data
			//shopOneEdit($idShop);
		}, function myError (response) {
			$scope.shopOne = response.statusText;
		});
	};
	$scope.shopOneAdd = function($idShop){
		$scope.showShop = true;
	};
});