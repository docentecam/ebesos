angular.module('spaApp')
.controller('ShopsCtrl', function($scope, $http, $routeParams) {
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
});