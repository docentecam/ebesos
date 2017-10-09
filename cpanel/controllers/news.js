angular.module('spaApp')
 .controller('NewsCtrl', function($scope, $http) {
			$scope.showDiv=false;
			$scope.listNew=true;
			$scope.updateImgPreferred=false;
			$scope.updateNew=false;
			$scope.newNews=false;	
			$http({

				method : "GET",
				url : "models/news.php?acc=news"
			}).then(function mySucces (response) {
				$scope.news = response.data;
				console.log($scope.news);
				
			}, function myError (response) {
				$scope.news = response.statusText;
			});
		

		$scope.selNew = function(idNew)
		{  
			$http({
				method : "GET",
				url : "models/news.php?acc=newSel&idNew="+idNew
			}).then(function mySucces (response) {
				$scope.newSelect = response.data;
				$scope.showDiv=true;
				$scope.listNew=false;
				$scope.newNews=false;	
				$scope.updateImgPreferred=false;
				console.log($scope.newSelect);
				
			}, function myError (response) {
				$scope.newSelect = response.statusText;
			});
		}

		
		$scope.editNew = function()
		{ 
			$scope.updateImgPreferred=false;
			$scope.showDiv=false;
			$scope.listNew=false;
			$scope.updateNew=true;	
			$scope.updateImgNew=false;	
			$scope.newNews=false;		
		}

		$scope.changeImgP = function()
		{ 
			$scope.updateImgPreferred=true;
			$scope.showDiv=false;
			$scope.listNew=false;
			$scope.updateNew=false;
			$scope.updateImgNew=false;	
			$scope.newNews=false;
		}


		$scope.changeImgN = function()
		{ 
			$scope.updateImgPreferred=false;
			$scope.showDiv=false;
			$scope.listNew=false;
			$scope.updateNew=false;
			$scope.updateImgNew=true;
			$scope.newNews=false;	
		}
		

		$scope.newNew = function()
		{ 
			$scope.updateImgPreferred=false;
			$scope.showDiv=false;
			$scope.listNew=false;
			$scope.updateNew=false;
			$scope.updateImgNew=false;	
			$scope.newNews=true;	
		}

		$scope.changeImgPeferred = function(idNew)
		{  
			$http({	
				method : "GET",
				url : "models/news.php?acc=changeImgPeferred&idNew="+idNew
			}).then(function mySucces (response) {
				$scope.changeImgPreferred = response.data;
				console.log($scope.newSelect);
			}, function myError (response) {
				$scope.newSelect = response.statusText;				
			});
		}
	});
