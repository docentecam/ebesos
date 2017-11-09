angular.module('spaApp')															 
.controller('SliderCtrl', function($scope, $http, $q) {
	$scope.loading=true;
	$http({
			method : "GET",
			url : "models/slider.php?acc=imgSlider"
		}).then(function mySucces (response) {
			$scope.slider = response.data;
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
			}, function myError (response) {
				$scope.slider = response.statusText;
			})
			.finally(function() {
				$scope.loading=false;
			});
  		
	};
	$scope.uploadedImgFileC  = function(e){
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

	$scope.updateImgSlide = function(){
		$scope.spanEditarImatges = false;
		$scope.btnAfegir = false;
		$scope.sliderSetting = false;
		$scope.sliderEditing = false;
  		

  		$scope.editDescription = editingForm['description'].value;
  		$scope.editTitle = editingForm['title'].value;
  		$scope.editSubTitle = editingForm['subTitle'].value;
  		$scope.editLink = editingForm['linkSlider'].value;
  		$scope.editSlider = editingForm['hidEditSlider'].value;
  		$scope.loading=true;
  		
		$http({
				method : "GET",
				url : "models/slider.php?acc=updateSliderNI&description="+$scope.editDescription+"&idSlider="+$scope.editSlider+"&title="+$scope.editTitle+"&subTitle="+$scope.editSubTitle+"&linkSlider="+$scope.editLink
			}).then(function mySucces (response) {
				$scope.updateSlider = response.data;
				$scope.loading=true;
				$http({
						method : "GET",
						url : "models/slider.php?acc=imgSlider"
					}).then(function mySucces (response) {
						$scope.slider = response.data;
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
	$scope.uploadedImgFileE  = function(e){
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
						}, function myError (response) {
							$scope.slider = response.statusText;
						})
						.finally(function() {
							$scope.loading=false;
						});
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
	