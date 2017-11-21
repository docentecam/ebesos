angular.module('spaApp')
.controller('PromotionsCtrl', function($scope, $http) {
  		
  	$scope.loadPromotions=true;

 			$scope.loading=true;
			$http({
				method : "GET",
				url : "models/promotions.php?acc=l"
			}).then(function mySucces (response) {
				
				$scope.promotionsList=response.data[0].dataPromotions;
				
			}, function myError (response) {
				$scope.promotionsList = response.statusText;
			})
			.finally(function() 
		{ 
		    $scope.loading=false; 
		})

		$scope.activePromotion=function(idPromotion,active){

			$scope.loading=true;
				$http({
					method : "GET",
					url : "models/promotions.php?acc=a&idPromotionSelected="+idPromotion+"&active="+active
				}).then(function mySucces (response) {
					$scope.shopsList = response.data[0].dataShops;
					$scope.promotionsList=response.data[0].dataPromotions;
					$scope.loadPromotions=true;
					
				}, function myError (response) {
					$scope.promotionsList = response.statusText;
				})
				.finally(function() 
			{ 
			    $scope.loading=false; 
			})

		}

		$scope.deletePromotion=function(idPromotion){

			$scope.loading=true;
			$scope.confirmDelete= confirm("Segur que vols esborrar la promoció?");

			if ($scope.confirmDelete==true) {

					$http({
						method : "GET",
						url : "models/promotions.php?acc=d&idPromotionSelected="+idPromotion
					}).then(function mySucces (response) {
						$scope.shopsList = response.data[0].dataShops;
						console.log("comercios"+$scope.shopsList);
						$scope.promotionsList=response.data[0].dataPromotions;
						$scope.loadPromotions=true;
					}	
					, function myError (response) {
						$scope.promotionsList = response.statusText;
					})
					.finally(function() 
				{ 
				    $scope.loading=false; 
				})
				
			}
			
		}


});

angular.module('spaApp')
.controller('PromotionCtrl', function($scope, $http,$routeParams,$q) {
	$scope.loadPromotions=false;


 		$scope.promotion={};
 		$scope.promotion.idPromotion=$routeParams.idPromotion;
 		$scope.promotion.image="";
 		$scope.promotion.conditionsVals="";
 		$scope.promotion.dateExpireVals="";
 		$scope.promotion.dateExpireEix="";
 		$scope.promotion.oferVals="";
 		$scope.promotion.conditionsEix="";
 		$scope.promotion.oferEix="";
 		$scope.promotion.shopSelected="-1";
 		
		if($scope.promotion.idPromotion==0) $scope.act="Afegir"; else $scope.act="Editar";

 		var d = new Date();
		var yyyy = d.getFullYear();
		var mm = d.getMonth() < 9 ? "0" + (d.getMonth() + 1) : (d.getMonth() + 1); // getMonth() is zero-based
		var dd  = d.getDate() < 10 ? "0" + d.getDate() : d.getDate();
		$scope.promotion.dateExpireVals =yyyy+"-"+mm+"-"+dd;

		$scope.promotion.dateExpireEix = yyyy+"-"+mm+"-"+dd;




	
		$scope.loadPromotions=false;
		$scope.imgForChange="";
 		
			
			$http({
				method : "GET",
				url : "models/promotions.php?acc=l&idPromotion="+$scope.promotion.idPromotion
			}).then(function mySucces (response) {
				$scope.shopsList = response.data[0].dataShops;
				$scope.promotionSel = response.data[0].dataPromotions;

		if ($scope.promotion.idPromotion!=0)
		{
				$scope.promotion.idPromotion=$scope.promotionSel[0].idPromotion;
				$scope.promotion.image=$scope.promotionSel[0].image;
				$scope.promotion.conditionsVals=$scope.promotionSel[0].conditionsVals;
				$scope.promotion.dateExpireVals=$scope.promotionSel[0].dateExpireVals;
				$scope.promotion.dateExpireEix=$scope.promotionSel[0].dateExpireEix;
				$scope.promotion.oferVals=$scope.promotionSel[0].oferVals;
				$scope.promotion.conditionsEix=$scope.promotionSel[0].conditionsEix;
				$scope.promotion.oferEix=$scope.promotionSel[0].oferEix;
				$scope.promotion.shopSelected=$scope.promotionSel[0].idShop;}
				console.log("comercios"+$scope.shopsList);

				
			}, function myError (response) {
				$scope.promotionsList = response.statusText;
			})
			.finally(function(){ 
		    $scope.loading=false; 
		})
	
		console.log($scope.promotion.shopSelected);
		if ($scope.promotion.shopSelected="") {alert("");}
	

	$scope.changeImg=function(e){

		$scope.imgForChange=e.files[0];
	}

	$scope.editPromotion=function()
	{
		

		if(($scope.promotion.conditionsVals=="" ||$scope.promotion.oferVals=="")&&($scope.promotion.conditionsEix=="" ||$scope.promotion.oferEix==""))
		{
			alert("N'hi ha un camp buit");
		}

		else if( $scope.promotion.shopSelected=="-1"){
			alert("tens que seleccionar un comerç");
		}

		else{
			console.log($scope.promotion);
		var data = new FormData();
		data.append("idPromotion", $scope.promotion.idPromotion);
		data.append("imageChange", $scope.imgForChange);
		data.append("imageActual", $scope.promotion.image);
		data.append("conditionsVals", $scope.promotion.conditionsVals);
		data.append("dateExpireVals", $scope.promotion.dateExpireVals);
		data.append("dateExpireEix", $scope.promotion.dateExpireEix);
		data.append("oferVals", $scope.promotion.oferVals);
		data.append("conditionsEix", $scope.promotion.conditionsEix);
		data.append("oferEix", $scope.promotion.oferEix);
		data.append("shopSelected", $scope.promotion.shopSelected);

		var deferred=$q.defer();
			return $http.post("models/promotions.php?acc=updatePromotion",data,{
				headers:{
					"Content-type":undefined
				},
				transformRequest:angular.identity
			})
			.then(function(res)
				{
					
					deferred.resolve(res);
					if ($scope.imgForChange!="") {
						console.log($scope.imgForChange.name);
						$scope.promotion.image=$scope.promotion.idPromotion+"-"+$scope.imgForChange.name;}	
				})
		}
		
	}


	



});