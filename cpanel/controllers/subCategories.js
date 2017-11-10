angular.module('spaApp')															 
.controller('SubcategoriesCtrl', function($scope, $http) {
	$scope.loading=true;
	$scope.firstC = true;
	$http({
			method : "GET",
			url : "models/subCategories.php?acc=l"
		}).then(function mySucces (response) {
			$scope.categories = response.data;
		}, function myError (response) {
			$scope.categories = response.statusText;
		})
		.finally(function() {
			$scope.loading=false;
		});
		$scope.changeCat = function(idCategory,name,urlPicto1){
			$scope.firstC = false;
			$scope.idCategoryC = idCategory;
			$scope.nameC = name;
			$scope.urlPicto1C = urlPicto1;
		}
});