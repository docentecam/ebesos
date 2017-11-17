angular.module('spaApp')
.controller('ShopsCtrl', function($scope, $http) {
	$scope.showShop = false;
	$scope.showList = true;
	
	$scope.filterId = 1;
	$scope.loading = true;
	$http({
		method : "GET",
		url : "models/users.php?acc=listUsers"
	}).then(function mySucces(response) {
		$scope.userList = response.data;
	}, function myError(response) {
		$scope.shops = response.statusText;
	}).finally(function(){
      $scope.loading = false;
  	});

	$scope.loading = true;
	$http({
		method : "GET",
		url : "models/shops.php?acc=list"
	}).then(function mySucces(response) {
		console.log(response.data);
		$scope.data = response.data;
		$scope.shopsList = $scope.data[0].list;
		$scope.allSubCat = $scope.data[0].allSubCat;
		console.log($scope.allSubCat);
	}, function myError(response) {
		$scope.shops = response.statusText;
	}).finally(function(){
			$scope.loading = false;
	});

	$scope.shopOneDelete = function($idShop){
		var confirmed = confirm("Desitja esborrar aquest comerç?");
		if(confirmed)
		{
			console.log($idShop);
			$scope.loading = true;
			$http({
				method : "GET",
				url : "models/shops.php?acc=delete&idShop="+$idShop
			}).then(function mySucces (response) {
				$scope.shopDeleted = response.data
				console.log("hola: " + $scope.shopDeleted);
			}, function myError (response) {
				$scope.shopOne = response.statusText;
			}).finally(function(){
				$scope.loading = false;
			});
		}
	};
});

angular.module('spaApp')
.controller('ShopsEditCtrl', function($scope, $http, $routeParams, $q, upload) {
	$scope.loading = true;
	$scope.idShop = $routeParams.idShop;
	$scope.indexList = $routeParams.indexList;
	$scope.shopOne = "[{{}}]";
	$http({
		method : "GET",
		url : "models/users.php?acc=listUsers"
	}).then(function mySucces(response) {
		$scope.userList = response.data;
	}, function myError(response) {
		$scope.shops = response.statusText;
	}).finally(function(){
      $scope.loading = false;
  	});

	$http({
		method : "GET",
		url : "models/shops.php?acc=list"
	}).then(function mySucces(response) {
		console.log(response.data);
		$scope.data = response.data;
		$scope.shopsList = $scope.data[0].list;
		$scope.allSubCat = $scope.data[0].allSubCat;
		$scope.shopOne = $scope.shopsList[$scope.indexList];
		console.log($scope.allSubCat);
	}, function myError(response) {
		$scope.shops = response.statusText;
	}).finally(function(){
			$scope.loading = false;
	});

	$scope.loading = true;
	$http({
		method : "GET",
		url : "models/shops.php?acc=e&idShop="+$scope.idShop
	}).then(function mySucces(response) {
		$scope.personalData = response.data;
		$scope.subCategoriesShop = $scope.personalData[0].subCategoriesShop;
		$scope.subCategories = $scope.personalData[0].subCategories;
		$scope.images = $scope.personalData[0].images;
		$scope.currentIdPref = $scope.personalData[0].images[0].idShopImage;
	}, function myError(response) {
		$scope.shops = response.statusText;
	}).finally(function(){
		$scope.loading = false;
	});

	$scope.currentShopLogo = $scope.shopOne.logo;
	$scope.showShop = true;
	$scope.showList = false;

	
	$scope.shopOneAdd = function($idShop){
		$scope.showShop = true;
		$scope.showList = false;
	};
	$scope.listChange = function($idUserL){
		if($idUserL==1) $scope.filterShops="!1";
		else $scope.filterShops = $idUserL;
	};
	$scope.preferredSubCat = function($idSubCategory, $idShop){
		$scope.loading=true;
		$http({
			method : "GET",
			url : "models/shops.php?acc=ePrefSubCat&idShop="+$idShop+"&idSubCategory="+$idSubCategory
		}).then(function mySucces(response) {
			$scope.subCategoriesData = response.data;
			$scope.subCategoriesShop = $scope.subCategoriesData[0].shopCategories;
			$scope.subCategories = $scope.subCategoriesData[0].subCategories;
		}, function myError(response) {
			$scope.shops = response.statusText;
		}).finally(function(){
			$scope.loading = false;
		});

	};
	$scope.subCategory = function($idSubCategory, $idShop){
		$scope.loading=true;
		$http({
			method : "GET",
			url : "models/shops.php?acc=eSubCat&idShop="+$idShop+"&idSubCategory="+$idSubCategory
		}).then(function mySucces(response) {
			$scope.subCategoriesData = response.data;
			$scope.subCategoriesShop = $scope.subCategoriesData[0].shopCategories;
			$scope.subCategories = $scope.subCategoriesData[0].subCategories;
		}, function myError(response) {
			$scope.shops = response.statusText;
		}).finally(function(){
			$scope.loading = false;
		});
	};
	$scope.deleteSubCategory = function($idShopCategorySub, $idShop){
		$scope.loading=true;
		$http({
			method : "GET",
			url : "models/shops.php?acc=delsc&idShop="+$idShop+"&idShopCategorySub="+$idShopCategorySub
		}).then(function mySucces(response) {
			$scope.subCategoriesData = response.data;
			$scope.subCategoriesShop = $scope.subCategoriesData[0].shopCategories;
			$scope.subCategories = $scope.subCategoriesData[0].subCategories;
		}, function myError(response) {
			$scope.shops = response.statusText;
		}).finally(function(){
			$scope.loading = false;
		});
	};
	$scope.userOwner = function($idUser){
		console.log($idUser);
	};
	$scope.deleteImage=function($idShopImage, $url, $idShop){
		$scope.loading=true;
		$http({
			method : "GET",
			url : "models/shops.php?acc=delis&idShopImage="+$idShopImage+"&url="+$url+"&idShop="+$idShop
		}).then(function mySucces(response) {
			$scope.imagesData = response.data;
			$scope.images = $scope.imagesData[0].images;
		}, function myError(response) {
			$scope.shops = response.statusText;
		}).finally(function(){
			$scope.loading = false;
		});
	}
	$scope.changeImagesShops=function(e, type){
		var formData = new FormData();

		formData.append("type",type);
		formData.append("uploadedFile",e.files[0]);
		formData.append("idShopImage",$scope.personalData[0].images[0].idShopImage);

		var deferred=$q.defer();
		return $http.post("models/shops.php?acc=uploadImage&sentence="+type, formData,{
		headers:{
		"Content-type":undefined
		},
			transformRequest:angular.identity
		})
		.then(function(res)
		{
			deferred.resolve(res);
			$scope.loading=true;
			$idShop = $scope.shopOne.idShop;
			$http({
				method : "GET",
				url : "models/shops.php?acc=listImages&idShop="+$idShop
			}).then(function mySucces(response) {
				$scope.imagesData = response.data;
				$scope.images = $scope.imagesData[0].images;
			}, function myError(response) {
				$scope.shops = response.statusText;
			}).finally(function(){
				$scope.loading = false;
			});
		})
		return deferred.promise;
	}
	$scope.uploadFile = function(){
		console.log("carga");
		var type = $scope.indexList;
		var idShop = $scope.shopOne.idShop
		var name = $scope.shopOne.name;
		var idUser = $scope.idUser;
		var descriptionLong = $scope.shopOne.descriptionLong;
		var description = $scope.shopOne.description;
		var ciutat = $scope.shopOne.ciutat;
		var logo = $scope.shopOne.logo;
		var web = $scope.shopOne.web;
		var lat = $scope.shopOne.lat;
		var lng = $scope.shopOne.lng;
		var telephone = $scope.shopOne.telephone;
		var cp = $scope.shopOne.cp;
		var address = $scope.shopOne.address;
		var schedule = $scope.shopOne.schedule;
		var email = $scope.shopOne.email;
		var variable = upload.uploadFile(type, idShop, name, idUser, descriptionLong, description, ciutat, logo, web, lat, lng, telephone, cp, address, schedule, email);
	}
})

.directive('uploaderModel', ["$parse",function($parse){
	return{
		restrict:'A',
		link: 	function(scope, iElement, iAtrrs){
				iElement.on("change",
				function(e)
				{
					$parse(iAtrrs.uploaderModel).assign(scope,
						iElement[0].files[0]);
				});
		}
	};
}])

.service('upload',["$http","$q", function($http,$q)
{
	this.uploadFile=function(type, idShop, name, idUser, descriptionLong, description, ciutat, logo, web, lat, lng, telephone, cp, address, schedule, email)
	{
		var	deferred=$q.defer();
		var formData= new FormData();
		formData.append("idShop", idShop);
		formData.append("name", name);
		formData.append("idUser", idUser);
		formData.append("descriptionLong", descriptionLong);
		formData.append("description", description);
		formData.append("ciutat", ciutat);
		formData.append("logo", logo);
		formData.append("web", web);
		formData.append("lat", lat);
		formData.append("lng", lng);
		formData.append("telephone", telephone);
		formData.append("cp", cp);
		formData.append("address", address);
		formData.append("schedule", schedule);
		formData.append("email", email);
		return 	$http.post("models/shops.php?acc=upload&sentence="+type, formData,{
			headers:{
				"Content-type":undefined
			},
			transformRequest:angular.identity
		})
		.then(function()
		{
		})
	}
}]);