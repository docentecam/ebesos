angular.module('spaApp')
.controller('PromotionsCtrl', function($scope, $http) {
	$scope.loading=true;

	$http({
		method : "GET",
		url : "models/promotions.php?acc=l"
	}).then(function mySucces (response) {
		$scope.data=response.data;
		$scope.promos=$scope.data[0].promotions;
		$scope.filters=$scope.data[0].filters;
		}, function myError (response) {
		$scope.data = response.statusText;
	})
	.finally (function(){
		$scope.loading=false;
	});

	$scope.filterCat = function(idCategory)
	{
		$scope.idCategorySearch=idCategory;
	}
});

angular.module('spaApp')
.controller('PromotionCtrl', function($scope, $http, $routeParams) {
		$scope.loading=true;
		$http({
			method : "GET",
			url : "models/promotions.php?acc=s&idPromo=" + $routeParams.idPromotion
		}).then(function mySucces (response) {
			$scope.promoSelArray=response.data;
			$scope.promoSel=$scope.promoSelArray[0].promotion;
		}, function myError (response) {
			$scope.promoSel = response.statusText;
		})
		.finally (function(){
			$scope.loading=false;
		});
});