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

angular.module('spaApp')
	.controller('NewCtrl', function($scope, $http, $routeParams) {
	$http({
			method: "GET",
			url: "models/news.php?acc=showNew&idNew=" + $routeParams.idNew
		}).then(function mySucces (response) {
				$scope.news = response.data;
				$scope.subNews=$scope.news[0]['media'];
		},function myError (response) {
				$scope.news = response.statusText;
		});
});
