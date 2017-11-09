angular.module('spaApp')
.controller('PromotionsCtrl', function($scope, $http) {
  	
			$http({
				method : "GET",
				url : "models/promotions.php?acc=l"
			}).then(function mySucces (response) {
				$scope.promotionsList = response.data;
				
			}, function myError (response) {
				$scope.promotionsList = response.statusText;
			})
			.finally(function() 
		{ 
		    $scope.loading=false; 
		})

		
});