angular.module('spaApp')															 
.controller('SliderCtrl', function($scope, $http, $q) {
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
			}, function myError (response) {
				$scope.onlyInfoSlider = response.statusText;
		}).finally(function() {
			$scope.loading=false;
		});
	};
	$scope.createImgSlide  = function(){
		$scope.spanEditarImatges = false;
		$scope.btnAfegir = false;
		$scope.sliderSetting = false;
		$scope.sliderAdding = false;
		

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
  		
	};
	$scope.uploadedImgFileC  = function(e){
			console.log("llega");
			var data = new FormData();
			data.append("description",addingForm['descriptionC'].value);
			data.append("title",addingForm['titleC'].value);
			data.append("subTitle",addingForm['subTitleC'].value);
			data.append("link",addingForm['linkC'].value);
			data.append("uploadedFile",e.files[0]);

			

			var deferred=$q.defer();
			return $http.post("models/slider.php?acc=createSlider", data,{
			headers:{
			"Content-type":undefined
			},
			transformRequest:angular.identity
			})
			.then(function(res)
			{
			deferred.resolve(res);

			})
			return
			deferred.promise;
		}

	$scope.updateImgSlide = function(e){
		$scope.spanEditarImatges = false;
		$scope.btnAfegir = false;
		$scope.sliderSetting = false;
		$scope.sliderEditing = false;
  		
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
		
	};
	$scope.uploadedImgFileE  = function(e){
			console.log("llega");
			var data = new FormData();
			data.append("description",editingForm['description'].value);
			data.append("title",editingForm['title'].value);
			data.append("subTitle",editingForm['subTitle'].value);
			data.append("link",editingForm['linkSlider'].value);
			data.append("idSlider",editingForm['hidEditSlider'].value);
			data.append("image",editingForm['hidImage'].value);
			data.append("uploadedFile",e.files[0]);
			

			var deferred=$q.defer();
			return $http.post("models/slider.php?acc=updateSlider", data,{
			headers:{
			"Content-type":undefined
			},
			transformRequest:angular.identity
			})
			.then(function(res)
			{
			deferred.resolve(res);

			})
			return
			deferred.promise;
		}
	$scope.deleteImgSlide = function($idSlider, $imageSlider){
		$scope.loading=true;
		console.log($idSlider);
		$http({
				method : "GET",
				url : "models/slider.php?acc=deleteSlider&idSlider="+$idSlider+"&image="+$imageSlider
			}).then(function mySucces (response) {
				$scope.updateSlider = response.data;
				$http({
						method : "GET",
						url : "models/slider.php?acc=imgSlider"
					}).then(function mySucces (response) {
						$scope.slider = response.data;
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
						console.log("llega");
					}, function myError (response) {
						$scope.slider = response.statusText;
					})
					.finally(function() {
						$scope.loading=false;
					});
			}, function myError (response) {
				$scope.updateSlider = response.statusText;
		}).finally(function() {
			$scope.loading=false;
		});
	};
});
	