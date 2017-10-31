angular.module('spaApp')															 
.controller('HomeCtrl', function($scope, $http) {
	$scope.loading=true;
	$http({
		method : "GET",
		url : "models/home.php?acc=home"
		}).then(function mySucces (response) {
			$scope.homeData=response.data;
			$scope.associations=$scope.homeData[0].associations;
			$scope.links=$scope.homeData[0].links;
			$scope.slider=$scope.homeData[0].slider;
			$scope.formation=$scope.homeData[0].formation[0].url;
		}, function myError (response) {
			$scope.homeData = response.statusText;
		})
		.finally(function() {
			$scope.loading=false;
		});	
});






	



	
		





			