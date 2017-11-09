angular.module('spaApp')
.controller('PromotionsCtrl', function($scope, $http) {
  		
  		$scope.loading=true;
  		$scope.showPromotions=false;
 		$scope.loadPromotions=true;

		$scope.act="";

 		$scope.promotions=[];
 		$scope.promotions.image="";


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


	$scope.editPromotions = function(act="",idPromotion)
	{

		$scope.loadPromotions=false;
 		
	
		if (act=='Editar')
		{
			$scope.act=act;
			$scope.showPromotions=true;
			
		}

		if (act=='Afegir')
		{
			$scope.act=act;
			$scope.showPromotions=true;
			
		}
	}

});