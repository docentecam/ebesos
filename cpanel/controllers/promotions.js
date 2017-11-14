angular.module('spaApp')
.controller('PromotionsCtrl', function($scope, $http) {
  		
  		
  		$scope.showPromotions=false;
 		$scope.loadPromotions=true;

		$scope.act="";
		
		$scope.accBbdd="";

 		$scope.promotion={};
 		$scope.promotion.image="";
 		$scope.promotion.conditionsVals="";
 		$scope.promotion.dateExpireVals="";
 		$scope.promotion.dateExpireEix="";
 		$scope.promotion.oferVals="";
 		$scope.promotion.conditionsEix="";
 		$scope.promotion.oferEix="";
 		

 		var d = new Date();
		var yyyy = d.getFullYear();
		var mm = d.getMonth() < 9 ? "0" + (d.getMonth() + 1) : (d.getMonth() + 1); // getMonth() is zero-based
		var dd  = d.getDate() < 10 ? "0" + d.getDate() : d.getDate();
		$scope.promotion.dateExpireVals =yyyy+"-"+mm+"-"+dd;

		$scope.promotion.dateExpireEix = yyyy+"-"+mm+"-"+dd;


 			$scope.loading=true;
			$http({
				method : "GET",
				url : "models/promotions.php?acc=l"
			}).then(function mySucces (response) {
				$scope.shopsList = response.data[0].dataShops;
				$scope.promotionsList=response.data[0].dataPromotions;
				
			}, function myError (response) {
				$scope.promotionsList = response.statusText;
			})
			.finally(function() 
		{ 
		    $scope.loading=false; 
		})

			


	$scope.dataPromotion = function(act="",idPromotion)
	{
		console.log(idPromotion);
		$scope.loadPromotions=false;
 		
		if (act=='Editar')
		{

			$scope.act=act;
			$scope.showPromotions=true;
			$scope.accBbdd="Update";


			$http({
				method : "GET",
				url : "models/promotions.php?acc=l&idPromotion="+idPromotion
			}).then(function mySucces (response) {
				$scope.promotionSel = response.data[0].dataPromotions;
				console.log($scope.promotionSel);
				$scope.promotion.idPromotion=$scope.promotionSel[0].idPromotion;
				$scope.promotion.image=$scope.promotionSel[0].image;
				$scope.promotion.conditionsVals=$scope.promotionSel[0].conditionsVals;
				$scope.promotion.dateExpireVals=$scope.promotionSel[0].dateExpireVals;
				$scope.promotion.dateExpireEix=$scope.promotionSel[0].dateExpireEix;
				$scope.promotion.oferVals=$scope.promotionSel[0].oferVals;
				$scope.promotion.conditionsEix=$scope.promotionSel[0].conditionsEix;
				$scope.promotion.oferEix=$scope.promotionSel[0].oferEix;
				$scope.promotion.shopSelected=$scope.promotionSel[0].idShop;
				console.log($scope.promotionSel[0].conditionsVals);

				
			}, function myError (response) {
				$scope.promotionsList = response.statusText;
			})
			.finally(function() 
		{ 
		    $scope.loading=false; 
		})


			
		}

		if (act=='Afegir')
		{
			$scope.act=act;
			$scope.showPromotions=true;
			
		}
	}

	$scope.editPromotion=function()
	{
		console.log($scope.promotion);
		var data = new FormData();
		data.append("idPromotion", $scope.idPromotion);
		data.append("image", $scope.image);
		data.append("conditionsVals", $scope.conditionsVals);
		data.append("dateExpireVals", $scope.dateExpireVals);
		data.append("dateExpireEix", $scope.dateExpireEix);
		data.append("oferVals", $scope.oferVals);
		data.append("conditionsEix", $scope.conditionsEix);
		data.append("oferEix", $scope.oferEix);
		data.append("shopSelected", $scope.shopSelected);
		var deferred=$q.defer();
			return $http.post("models/promotions.php?acc=updatePromotion", data,{
				headers:{
					"Content-type":undefined
				},
				transformRequest:angular.identity
			})
			.then(function(res)
				{
					
					deferred.resolve(res);
					
				})
	}

});