angular.module('spaApp').factory('msgEdits', function(){
	return {data:{}};
});
angular.module('spaApp')															 
.controller('SliderCtrl', function($scope, $http, msgEdits ) {

	$scope.fail = false;
	$scope.listSliders=true;
	$scope.statusValidation=msgEdits.data.message;
	$scope.validation=msgEdits.data.validation;
	$scope.fail = msgEdits.data.fail;
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
				console.log('STATUS: '+$scope.statusValidation);
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
.controller('SliderDescCtrl', function($scope, $http, $routeParams, $q, $location, msgEdits) {
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
		console.log("Escollim foto"+e.files[0].name);
		if($scope.slider.image=="")
		{
			$scope.slider.image="0";
		} 
		$scope.slider.imageChange=e.files[0];
	}
	$scope.updateImgSlider = function(){
		console.log("Intentem enviar"+$scope.slider.image);
		
		if($scope.slider.image!="" && $scope.slider.description!="" && $scope.slider.title!="" && $scope.slider.subTitle!="" && $scope.slider.linkSlider!="")
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
			console.log($scope.slider.imageChange);
			var deferred=$q.defer();
			$http.post("models/slider.php?acc=updateSlider", data,{
			headers:{
				"Content-type":undefined
			},
			transformRequest:angular.identity
			})
			.then(function(res)
			{
				console.log("llega"+res.data);
				deferred.resolve(res);
				$scope.statusValidation = res.data;
				$scope.validation= true;
				$scope.loading=false;
				msgEdits.data.message=res.data;
				msgEdits.data.validation=true;
				msgEdits.data.fail=true;
				$location.url("/slider");
			})
  		}
  		else{
  			if($scope.slider.image=="") alert("Selecciona Imatge");
  			else alert("Tots els camps necessiten valor");
  		}
  	}
});

