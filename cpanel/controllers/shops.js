angular.module('spaApp')
.controller('ShopsCtrl', function($scope, $http, $routeParams) {
	$scope.showShop = false;
	$scope.shopOne = "[{{}}]";
	console.log($scope.showShop);
	$http({
		method : "GET",
		url : "models/shops.php?acc=list"
	}).then(function mySucces(response) {
		console.log(response.data);
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
			console.log($scope.shopOne);
			console.log($scope.shopOne[0].name);
			$scope.showShop = true;
			console.log($scope.showShop);
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
			console.log("hola: " + $scope.shopDeleted);
		}, function myError (response) {
			$scope.shopOne = response.statusText;
		});
	};
	$scope.shopOneAdd = function($idShop){
		$scope.showShop = true;
	};
});