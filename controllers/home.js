angular.module('spaApp')															 
.controller('HomeCtrl', function($scope, $http) {
	$scope.loading=true;
	$http({
		method : "GET",
		url : "models/assoFooter.php?acc=assoFooter"
		}).then(function mySucces (response) {
			$scope.assoFooters=response.data;
		}, function myError (response) {
			$scope.assoFooters = response.statusText;
			$scope.loading=true;
		})
		.finally(function() {
			$scope.loading=false;
		});	

		$http({
		method : "GET",
		url : "models/assoNav.php?acc=assoNav"
		}).then(function mySucces (response) {
		$scope.assoNavs=response.data;
		}, function myError (response) {
		$scope.assoNavs = response.statusText;
		})
		.finally(function() {
		$scope.loading=false;
		});	

		$http({
		method : "GET",
		url : "models/assoNav.php?acc=assoTopImage"
		}).then(function mySucces (response) {
		$scope.assoTopImages=response.data;
		}, function myError (response) {
		$scope.assoTopImages = response.statusText;
		})
		.finally(function() {
		$scope.loading=false;
		});

		$http({
		method : "GET",
		url : "models/links.php?acc=links"
		}).then(function mySucces (response) {
			$scope.links=response.data;
		}, function myError (response) {
			$scope.links = response.statusText;
			$scope.loading=true;
		})
		.finally(function() {
			$scope.loading=false;
		});

		$http({
			method : "GET",
			url : "models/slider.php?acc=imgSlider"
		}).then(function mySucces (response) {
			$scope.slider=response.data;
		}, function myError (response) {
			$scope.slider = response.statusText;
			$scope.loading=true;
		})
		.finally(function() {
			$scope.loading=false;
		});
	
});










	



	
		





			