angular.module('spaApp')															 
.controller('SliderCtrl', function($scope, $http) {

$http({
		method : "GET",
		url : "models/slider.php?acc=imgSlider"
	}).then(function mySucces (response) {
		$scope.slider=response.data;
		console.log($scope.slider);
	}, function myError (response) {
		$scope.slider = response.statusText;
	});
});
		