angular.module('spaApp')															 
.controller('SliderCtrl', function($scope, $http) {
	$scope.loading=true;
	$http({
			method : "GET",
			url : "models/slider.php?acc=imgSlider"
		}).then(function mySucces (response) {
			$scope.slider = response.data;
			console.log($scope.slider);
		}, function myError (response) {
			$scope.slider = response.statusText;
		})
		.finally(function() {
			$scope.loading=false;
		});

	$scope.addImgSlide = function(){
		$scope.spanEditarImatges = true;
		$scope.btnAfegir = true;
		$scope.sliderSetting = true;
		$scope.sliderAdding = true;
	};
	
	$scope.editImgSlide = function($idSlider, ){
		$scope.spanEditarImatges = true;
		$scope.btnAfegir = true;
		$scope.sliderSetting = true;
		$scope.sliderEditing = true;
		$scope.loading=true;
		$http({
				method : "GET",
				url : "models/slider.php?acc=showOnlySlider&idSlider="+$idSlider
			}).then(function mySucces (response) {
				$scope.onlyInfoSlider = response.data;
				console.log($idSlider);
			}, function myError (response) {
				$scope.onlyInfoSlider = response.statusText;
		}).finally(function() {
			$scope.loading=false;
		});
	};
	$scope.backSettingSlide = function(){
		$scope.spanEditarImatges = false;
		$scope.btnAfegir = false;
		$scope.sliderSetting = false;
		$scope.sliderAdding = false;
		$scope.sliderEditing = false;
  		$scope.editDescription = editingForm['description'].value;
  		$scope.editTitle = editingForm['title'].value;
  		$scope.editSubTitle = editingForm['subTitle'].value;
  		$scope.editLink = editingForm['linkSlider'].value;
  		$scope.editSlider = editingForm['hidEditSlider'].value;
  		$scope.loading=true;
		$http({
				method : "GET",
				url : "models/slider.php?acc=updateSlider&description="+$scope.editDescription+"&idSlider="+$scope.editSlider+"&title="+$scope.editTitle+"&subTitle="+$scope.editSubTitle+"&linkSlider="+$scope.editLink
			}).then(function mySucces (response) {
				$scope.updateSlider = response.data;
			}, function myError (response) {
				$scope.updateSlider = response.statusText;
		}).finally(function() {
			$scope.loading=false;
		});
	};
});
	