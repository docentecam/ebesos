angular.module('spaApp')

  .controller('NewsCtrl', function($scope, $http) {

		$http({
			method : "GET",
			url : "models/news.php?acc=news&idUser=1"
		}).then(function mySucces (response) {
			$scope.news = response.data;
			
		}, function myError (response) {
			$scope.news = response.statusText;
		});
			
	});