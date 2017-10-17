angular.module('spaApp')															 
.controller('SliderCtrl', function($scope, $http) {

$http({
		method : "GET",
		url : "models/slider.php?acc=imgSlider"
	}).then(function mySucces (response) {
		$scope.slider = response.data;
		console.log($scope.slider);
	}, function myError (response) {
		$scope.slider = response.statusText;
	});

	$scope.addImgSlide = function(){
		$scope.spanEditarImatges = true;
		$scope.btnAfegir = true;
		$scope.sliderSetting = true;
		$scope.sliderAdding = true;
		$http({
				method : "GET",
				url : "models/slider.php?acc=newSlider&idSlider="+$idSlider
			}).then(function mySucces (response) {
				$scope.onlyInfoSlider = response.data;
			}, function myError (response) {
				$scope.onlyInfoSlider = response.statusText;
		});
	};
	$scope.editImgSlide = function($idSlider){
		$scope.spanEditarImatges = true;
		$scope.btnAfegir = true;
		$scope.sliderSetting = true;
		$scope.sliderEditing = true;
		$http({
				method : "GET",
				url : "models/slider.php?acc=showOnlySlider&idSlider="+$idSlider
			}).then(function mySucces (response) {
				$scope.onlyInfoSlider = response.data;
				console.log($idSlider);
			}, function myError (response) {
				$scope.onlyInfoSlider = response.statusText;
		});
	};
	$scope.backSettingSlide = function(){
		$scope.spanEditarImatges = false;
		$scope.btnAfegir = false;
		$scope.sliderSetting = false;
		$scope.sliderAdding = false;
		$scope.sliderEditing = false;
  		$scope.editDescription = editingForm['description'].value;
  		$scope.editSlider = editingForm['hidEditSlider'].value;
		$http({
				method : "GET",
				url : "models/slider.php?acc=updateSlider&description="+$scope.editDescription+"&idSlider="+$scope.editSlider
			}).then(function mySucces (response) {
				$scope.updateSlider = response.data;
			}, function myError (response) {
				$scope.updateSlider = response.statusText;
		});
	};
});
	