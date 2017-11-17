angular.module('spaApp')															 
.controller('SliderCtrl', function($scope, $http) {
	$scope.fail = false;
	$scope.listSliders=true;

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
	$scope.deleteImgSlide = function($idSlider, $imageSlider){
		confirmDelete=confirm("Segur vols esborrar?");
		if(confirmDelete)
		{
			$scope.loading=true;
			$http({
				method : "GET",
				url : "models/slider.php?acc=deleteSlider&idSlider="+$idSlider+"&image="+$imageSlider
			}).then(function mySucces (response) {
				$scope.updateSlider = response.data;
				$scope.statusValidation = $scope.updateSlider[0]['status'];
				$scope.fail = true;
				$scope.validation = false;
				if($scope.statusValidation == "S'ha eliminat la imatge del slider")
				{
					$scope.validation = true;
				}
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
		}
	};
});

angular.module('spaApp')															 
.controller('SliderDescCtrl', function($scope, $http, $routeParams, $q) {
	$scope.listSliders=false;
	$scope.loading=false;
	$scope.slider={};
	$scope.slider.idSlider=$routeParams.idSlider;	
console.log($scope.slider.idSlider);
	$scope.slider.title="";
	$scope.slider.subtitle="";
	$scope.slider.description="";
	$scope.slider.linkSlider="";
	$scope.slider.image="";
	$scope.slider.imageChange="";
	$scope.fail = false;
	$scope.spanEditarImatges = true;
	$scope.btnAfegir = true;
	

	if($scope.slider.idSlider!=0)
		{
			$scope.loading=true;
		$http({
				method : "GET",
				url : "models/slider.php?acc=imgSlider&idSlider="+$scope.slider.idSlider
			}).then(function mySucces (response) {
				console.log('entra12');
				$scope.onlyInfoSlider = response.data;
				$scope.slider.title=$scope.onlyInfoSlider[0].title;
				$scope.slider.subtitle=$scope.onlyInfoSlider[0].subtitle;
				$scope.slider.description=$scope.onlyInfoSlider[0].description;
				$scope.slider.linkSlider=$scope.onlyInfoSlider[0].linkSlider;
				$scope.slider.image=$scope.onlyInfoSlider[0].image;
			}, function myError (response) {
				$scope.onlyInfoSlider = response.statusText;
		}).finally(function() {
			$scope.loading=false;
		});
	}
	
	console.log('entra3');
	$scope.uploadedImgFileE  = function(e){
		if($scope.slider.image!="")
		{
			$scope.slider.image=0;
		} 
		$scope.slider.imageChange=e.files[0];
	}
	$scope.updateImgSlide = function(){
		if($scope.slider.image!="")
		{
	  		$scope.loading=true;
	  		console.log("arriba");
	  		var data = new FormData();
  			data.append("idSlider",$scope.slider.idSlider);
			data.append("description",$scope.slider.description);
			data.append("title",$scope.slider.title);
			data.append("subTitle",$scope.slider.subtitle);
			data.append("linkSlider",$scope.slider.linkSlider);
			data.append("image",$scope.slider.image);
			data.append("imageChange",$scope.slider.imageChange);
			var deferred=$q.defer();
			return $http.post("models/slider.php?acc=updateSlider", data,{
			headers:{
				"Content-type":undefined
			},
			transformRequest:angular.identity
			})
			.then(function(res)
			{
				console.log(res.data);
				deferred.resolve(res);
				$scope.statusValidation = res.data;
				$scope.validation= true;
			})
			return
			deferred.promise;
  		}
  	}
});


		// $http({
		// 		method : "GET",
		// 		url : "models/slider.php?acc=updateSlider&idSlider="+$scope.slider.idSlider
		// 	}).then(function mySucces (response) {
		// 		$scope.updateSlider = response.data;
		// 		$scope.statusValidation = $scope.updateSlider[0]['status'];
		// 		$scope.fail = true;
		// 		$scope.validation = false;
		// 		if($scope.statusValidation == "S'ha modificat la imatge del slider")
		// 		{
		// 			$scope.validation = true;
		// 		}
		// 		$scope.loading=true;
		// 		$http({
		// 				method : "GET",
		// 				url : "models/slider.php?acc=imgSlider"
		// 			}).then(function mySucces (response) {
		// 				$scope.slider = response.data;
		// 			}, function myError (response) {
		// 				$scope.slider = response.statusText;
		// 			})
		// 			.finally(function() {
		// 				$scope.loading=false;
		// 			});
		// 	}, function myError (response) {
		// 		$scope.updateSlider = response.statusText;
		// 	}).finally(function() {
		// 		$scope.loading=false;
		// 	});
  		
		
	
	// TODO $scope.createImgSlide  = function(){
	
	// 	$scope.loading=true;
	// 	$http({
	// 			method : "GET",
	// 			url : "models/slider.php?acc=imgSlider"
	// 		}).then(function mySucces (response) {
	// 			$scope.slider = response.data;
	// 			$scope.statusValidation = "S'ha creat la imatge del slider";
	// 			$scope.fail = true;
	// 			$scope.validation = true;
	// 			if(isset($scope.slider[0]['status']))
	// 			{	
	// 				$scope.statusValidation = $scope.slider[0]['status'];
	// 				$scope.validation = false;
	// 			}
	// 		}, function myError (response) {
	// 			$scope.slider = response.statusText;
	// 		})
	// 		.finally(function() {
	// 			$scope.loading=false;
	// 		});
  		
	// };
	// $scope.uploadedImgFileC  = function(e){
	// 		var data = new FormData();
	// 		data.append("description",$scope.slider.description);
	// 		data.append("title",$scope.slider.title);
	// 		data.append("subTitle",$scope.slider.subtitle);
	// 		data.append("link",$scope.slider.linkSlider);
	// 		data.append("uploadedFile",e.files[0]);

	// 		$scope.fail = true;
	// 		$scope.statusValidation = "Error";
	// 		$scope.validation = false;
	// 		var deferred=$q.defer();
	// 		return $http.post("models/slider.php?acc=createSlider", data,{
	// 		headers:{
	// 		"Content-type":undefined
	// 		},
	// 		transformRequest:angular.identity
	// 		})
	// 		.then(function(res)
	// 		{
	// 		deferred.resolve(res);
	// 		$scope.statusValidation = "S'ha creat la imatge del slider";
	// 		$scope.validation= true;

	// 		})
	// 		return
	// 		deferred.promise;
	// 	}
	// $scope.uploadedImgFileE  = function(e){
	// 		var data = new FormData();
	// 		data.append("description",editingForm['description'].value);
	// 		data.append("title",editingForm['title'].value);
	// 		data.append("subTitle",editingForm['subTitle'].value);
	// 		data.append("link",editingForm['linkSlider'].value);
	// 		data.append("idSlider",editingForm['hidEditSlider'].value);
	// 		data.append("image",editingForm['hidImage'].value);
	// 		data.append("uploadedFile",e.files[0]);
			
	// 		$scope.fail = true;
	// 		$scope.statusValidation = "Error";
	// 		$scope.validation = false;
	// 		var deferred=$q.defer();
	// 		return $http.post("models/slider.php?acc=updateSlider", data,{
	// 		headers:{
	// 		"Content-type":undefined
	// 		},
	// 		transformRequest:angular.identity
	// 		})
	// 		.then(function(res)
	// 		{
	// 		deferred.resolve(res);
	// 		$scope.statusValidation = "S'ha modificat la imatge del slider";
	// 		$scope.validation= true;

	// 		})
	// 		return
	// 		deferred.promise;
	// 	}
	

	