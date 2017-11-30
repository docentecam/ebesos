angular.module('spaApp')
.controller('ShopsCtrl', function($scope, $http, usersList) {
	$scope.showShop = false;
	$scope.showList = true;
	$scope.loading = true;

	$scope.filterId = 1;

	$scope.userList = usersList.data.userList;

	$scope.statusValidation = "";
	$scope.validation = "";
	$scope.fail = false;

	$http({
		method : "GET",
		url : "models/shops.php?acc=l"
	}).then(function mySucces(response) {
		$scope.data = response.data;
		$scope.shopsList = $scope.data[0].list;
		$scope.allSubCat = $scope.data[0].allSubCat;
	}, function myError(response) {
		$scope.shops = response.statusText;
	}).finally(function(){
		$scope.loading = false;
	});

	$scope.shopOneDelete = function($idShop){
		var confirmed = confirm("Desitja esborrar aquest comerç?");
		if(confirmed)
		{
			$scope.loading = true;
			$http({
				method : "GET",
				url : "models/shops.php?acc=delete&idShop="+$idShop
			}).then(function mySucces (response) {
				$scope.data = response.data;
				$scope.statusValidation = $scope.data.message;
				$scope.shopsList = $scope.data.list;
				$scope.fail = true
				if($scope.data.exit) $scope.validation = true;
			}, function myError (response) {
				$scope.shopDeleted = response.statusText;
			}).finally(function(){
				$scope.loading = false;
			});
		}
	};
});

angular.module('spaApp')
.controller('ShopsEditCtrl', function($scope, $http, $routeParams, $q, usersList) {
	$scope.showShop = true;
	$scope.showList = false;

	$scope.indexList = $routeParams.indexList;

	$scope.userList = usersList.data.userList;

	if($scope.indexList == "a") $scope.new = true;

	$scope.shopOne = {};
	$scope.shopOne.idShop = $routeParams.idShop;
	$scope.shopOne.name = "";
	$scope.shopOne.idUser = "";
	$scope.shopOne.password = "";
	$scope.shopOne.descriptionLong = "";
	$scope.shopOne.description = "";
	$scope.shopOne.ciutat = "";
	$scope.shopOne.logo = "";
	$scope.shopOne.logoUp = "";
	$scope.shopOne.currentLogo = "";
	$scope.shopOne.web = "";
	$scope.shopOne.lat = "";
	$scope.shopOne.lng = "";
	$scope.shopOne.telephone = "";
	$scope.shopOne.cp = "";
	$scope.shopOne.address = "";
	$scope.shopOne.schedule = "";
	$scope.shopOne.email = "";
	$scope.shopOne.userWa = "";
	$scope.shopOne.userFb = "";
	$scope.shopOne.userTt = "";
	$scope.shopOne.userIg = "";

	if($scope.shopOne.idShop != 0)
	{
		$http({
			method : "GET",
			url : "models/shops.php?acc=l&idShop="+$scope.shopOne.idShop
		}).then(function mySucces(response) {
			$scope.data = response.data;
			$scope.shopOne = $scope.data[0].list[0];
			$scope.shopOne.currentLogo = $scope.shopOne.logo;
			$scope.allSubCat = $scope.data[0].allSubCat;
			$scope.subCategoriesShop = $scope.data[0].subCategoriesShop;
			$scope.subCategories = $scope.data[0].subCategories;
			$scope.images = $scope.data[0].images;
		}, function myError(response) {
			$scope.shops = response.statusText;
		}).finally(function(){
			$scope.loading = false;
		});
	}
	$scope.shopOneAdd = function($idShop){
		$scope.showShop = true;
		$scope.showList = false;
	};
	$scope.listChange = function($idUserL){
		if($idUserL==1) $scope.filterShops="!1";
		else $scope.filterShops = $idUserL;
	};
	$scope.preferredSubCat = function($idSubCategory, $idShop){
		$scope.loading = true;
		$http({
			method : "GET",
			url : "models/shops.php?acc=ePrefSubCat&idShop="+$idShop+"&idSubCategory="+$idSubCategory
		}).then(function mySucces(response) {
			$scope.subCategoriesData = response.data;
			$scope.subCategoriesShop = $scope.subCategoriesData[0].shopCategories;
			$scope.subCategories = $scope.subCategoriesData[0].subCategories;
		}, function myError(response) {
			$scope.subCategoriesData = response.statusText;
		}).finally(function(){
			$scope.loading = false;
		});
	};
	$scope.subCategory = function($idSubCategory, $idShop){
		$scope.loading = true;
		$http({
			method : "GET",
			url : "models/shops.php?acc=eSubCat&idShop="+$idShop+"&idSubCategory="+$idSubCategory
		}).then(function mySucces(response) {
			$scope.subCategoriesData = response.data;
			$scope.subCategoriesShop = $scope.subCategoriesData[0].shopCategories;
			$scope.subCategories = $scope.subCategoriesData[0].subCategories;
		}, function myError(response) {
			$scope.subCategoriesData = response.statusText;
		}).finally(function(){
			$scope.loading = false;
		});
	};
	$scope.deleteSubCategory = function($idShopCategorySub, $idShop){
		$scope.loading = true;
		$http({
			method : "GET",
			url : "models/shops.php?acc=delsc&idShop="+$idShop+"&idShopCategorySub="+$idShopCategorySub
		}).then(function mySucces(response) {
			$scope.subCategoriesData = response.data;
			$scope.subCategoriesShop = $scope.subCategoriesData[0].shopCategories;
			$scope.subCategories = $scope.subCategoriesData[0].subCategories;
		}, function myError(response) {
			$scope.subCategoriesData = response.statusText;
		}).finally(function(){
			$scope.loading = false;
		});
	};
	$scope.deleteImage = function($idShopImage, $url, $idShop){
		$scope.loading = true;
		$http({
			method : "GET",
			url : "models/shops.php?acc=delis&idShopImage="+$idShopImage+"&url="+$url+"&idShop="+$idShop
		}).then(function mySucces(response) {
			$scope.imagesData = response.data;
			$scope.images = $scope.imagesData[0].images;
		}, function myError(response) {
			$scope.imagesData = response.statusText;
		}).finally(function(){
			$scope.loading = false;
		});
	}
	$scope.changeImagesShops = function(e, type){
		var formData = new FormData();
		formData.append("type",type);
		formData.append("uploadedFile",e.files[0]);
		formData.append("idShop",$scope.shopOne.idShop);
		formData.append("deleteImagePref",$scope.images[0].url);
		formData.append("idShopImage",$scope.images[0].idShopImage);

		var deferred = $q.defer();
		$http.post("models/shops.php?acc=uploadImage&sentence="+type, formData,{
		headers:{
		"Content-type":undefined
		},
			transformRequest:angular.identity
		})
		.then(function(res)
		{
			deferred.resolve(res);
			$scope.loading = true;
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
	$scope.uploadLogo = function(e){
		$scope.shopOne.logoUp = e.files[0];
	}
	$scope.uploadFile = function(){
		if($scope.shopOne.idUser != "")
		{
			$scope.new = false;

			var formData = new FormData();

			formData.append("idShop", $scope.shopOne.idShop);
			formData.append("name", $scope.shopOne.name);
			formData.append("idUser", $scope.shopOne.idUser);
			formData.append("password", $scope.shopOne.password);
			formData.append("descriptionLong", $scope.shopOne.descriptionLong);
			formData.append("description", $scope.shopOne.description);
			formData.append("ciutat", $scope.shopOne.ciutat);
			formData.append("logo", $scope.shopOne.logoUp);
			formData.append("deleteLogo", $scope.shopOne.logo);
			formData.append("web", $scope.shopOne.web);
			formData.append("lat", $scope.shopOne.lat);
			formData.append("lng", $scope.shopOne.lng);
			formData.append("telephone", $scope.shopOne.telephone);
			formData.append("cp", $scope.shopOne.cp);
			formData.append("address", $scope.shopOne.address);
			formData.append("schedule", $scope.shopOne.schedule);
			formData.append("email", $scope.shopOne.email);
			formData.append("userWa", $scope.shopOne.userWa);
			formData.append("userFb", $scope.shopOne.userFb);
			formData.append("userTt", $scope.shopOne.userTt);
			formData.append("userIg", $scope.shopOne.userIg);

			var deferred = $q.defer();

			$http.post("models/shops.php?acc=upload", formData,{
			headers:{
			"Content-type":undefined
			},
				transformRequest:angular.identity
			})
			.then(function(res)
			{
				deferred.resolve(res);
				$scope.data = res.data[0];
				$scope.shopOne = $scope.data.list[0];
				$scope.allSubCat = $scope.data.allSubCat;
				$scope.subCategoriesShop = $scope.data.subCategoriesShop;
				$scope.subCategories = $scope.data.subCategories;
				$scope.images = $scope.data.images;
			})
		}
		else alert("Has d'escollir una associació");
	}
})