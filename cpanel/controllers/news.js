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
			$scope.showDiv=true;
			$http({

				method : "POST",
				url : "models/news.php?acc=newSel"+$scope.idNew
			}).then(function mySucces (response) {
				$scope.newSel = response.data;
				console.log($scope.newSel);
				
			}, function myError (response) {
				$scope.newSel = response.statusText;
			});
		
		}

	});
