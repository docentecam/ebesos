angular.module('spaApp')
 .controller('NewsCtrl', function($scope, $http) {
			$scope.showDiv=false;
			$scope.listNew=true;
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

			console.log("llega");

			console.log("recibo la "+idNew);
			$http({
				
				method : "GET",
				url : "models/news.php?acc=newSel&idNew="+idNew
			}).then(function mySucces (response) {
				$scope.newSelect = response.data;
				$scope.showDiv=true;
				$scope.listNew=false;
				console.log($scope.newSelect);
				
			}, function myError (response) {
				$scope.newSelect = response.statusText;
				
			});
		
		}

	});
