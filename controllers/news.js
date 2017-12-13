angular.module('spaApp')
 .controller('NewsCtrl', function($scope, $http) {
  	$scope.loading=true;
			$http({
				method : "GET",
				url : "models/news.php?acc=news&idUser=1"
			}).then(function mySucces (response) {
				$scope.news = response.data;
				
			}, function myError (response) {
				$scope.news = response.statusText;
			}).finally(function() {
				$scope.loading=false;
			});
		
	});

angular.module('spaApp')
	.controller('NewCtrl', function($scope, $http, $routeParams) {
	$scope.loading=true;
	$http({
			method: "GET",
			url: "models/news.php?acc=showNew&idNew=" + $routeParams.idNew
		}).then(function mySucces (response) {
				$scope.news = response.data;
				$scope.medias=$scope.news[0]['media'];
		},function myError (response) {
				$scope.news = response.statusText;
		}).finally(function() {
			$scope.loading=false;
		});	

});

app.filter('trusted', ['$sce', function ($sce) {
    return function(url) {
        return $sce.trustAsResourceUrl("https://www.youtube.com/embed/" + url);
    };
}]);
