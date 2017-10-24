angular.module('spaApp')															 
.controller('SliderCtrl', function($scope, $http) {
$scope.loading=true;
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
		