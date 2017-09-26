angular.module('spaApp')
 .controller('NewsCtrl', function($scope, $http) {
  	console.log("llega");
			$http({
				method : "GET",
				url : "models/news.php?acc=news"
			}).then(function mySucces (response) {
				$scope.news = response.data;
				console.log($scope.news);
				
			}, function myError (response) {
				$scope.news = response.statusText;
			});
		
	});