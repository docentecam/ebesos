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
			console.log("acaba");
	});

angular.module('spaApp')
	.controller('NewCtrl', function($scope, $http, $routeParams) {
	$scope.idUser = $routeParams.idUser;
	console.log("Llega: "+$scope.idUser);

	$http({
			method: "GET",
			url: "models/news.php?acc=showNew&idUser=" + $scope.idUser
		}).then(function mySucces (response) {
				$scope.news = response.data;
				console.log('Llega new'+$scope.news);
		},function myError (response) {
				$scope.news = response.statusText;
		});
});
