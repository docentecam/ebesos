angular.module('spaApp')
.controller('ShopsCtrl', function($scope, $http) {
	$http({
		method : "GET",
		url : "models/shops.php"
	}).then(function mySucces(response) {
		$scope.names = response.data;
		}, function myError(response) {
		$scope.names = response.statusText;
	});
	console.log($scope.names);
	/*$scope.showCategoriaData = function($idCategoria = 0){		
		$scope.loading = true;
		$scope.muestraDataCategorias = false;
		$scope.divCategories = false;
		$http({
			method : "GET",
			url : "../controller/categorias.php?acc=m&idCategoria="+$idCategoria
		}).then(function mySucces(response) {
			$scope.names_category = response.data;
			$scope.loading = false;
			$scope.muestraDataCategorias = true;
		}, function myError(response) {
			$scope.names_category = response.statusText;
		});
	};*/
});

/*if (isset($_GET['acc']) && $_GET['acc'] == 'l')
{
	listshops();
}*/
