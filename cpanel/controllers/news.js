angular.module('spaApp')
 .controller('NewsCtrl', function($scope, $http) {
			$scope.showDiv=false;
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
			$scope.showDiv=true;
			$http({
				
				method : "GET",
				url : "models/news.php?acc=newSel"+$scope.idNew
			}).then(function mySucces (response) {
				$scope.newSelect = response.data;
				console.log($scope.newSelect);
				console.log("llega2");
			}, function myError (response) {
				$scope.newSelect = response.statusText;
				console.log("llega3");
			});
		
		}

	});
