angular.module('spaApp')
.controller('ShopsCtrl', function($scope, $http, usersList) {
	$scope.showShop = false;
	$scope.showList = true;
	$scope.loading = true;
	$scope.filterId = 1;
	$scope.userList = usersList.data.userList;

	$http({
		method : "GET",
		url : "models/shops.php?acc=l"
	}).then(function mySucces(response) {
		$scope.data = response.data;
		$scope.shopsList = $scope.data[0].list;
		$scope.name = $scope.shopsList[0].name.replace(/&quot;/g,'"').replace(/&quot/g,'"');
		$scope.description = $scope.shopsList[0].description.replace(/&quot;/g,'"').replace(/&quot/g,'"');
		$scope.descriptionLong = $scope.shopsList[0].descriptionLong.replace(/&quot;/g,'"').replace(/&quot/g,'"');
		$scope.allSubCat = $scope.data[0].allSubCat;
	}, function myError(response) {
		$scope.shops = response.statusText;
	}).finally(function(){
		$scope.loading = false;
	});

	$scope.shopOneDelete = function($idShop){
		console.log($idShop);
		var confirmed = confirm("Desitja esborrar aquest comerç?");
		if(confirmed)
		{
			$scope.loading = true;
			$http({
				method : "GET",
				url : "models/shops.php?acc=delete&idShop="+$idShop
			}).then(function mySucces (response) {
				$scope.data = response.data;
				$scope.shopsList = $scope.data[0].list;
				$scope.name = $scope.shopsList[0].name.replace(/&quot;/g,'"').replace(/&quot/g,'"');
				$scope.description = $scope.shopsList[0].description.replace(/&quot;/g,'"').replace(/&quot/g,'"');
				$scope.descriptionLong = $scope.shopsList[0].descriptionLong.replace(/&quot;/g,'"').replace(/&quot/g,'"');
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

	$scope.indexList = $routeParams.indexList;

	$scope.userList = usersList.data.userList;

	$scope.showShop = true;
	$scope.showList = false;
	if($scope.indexList == "a") $scope.new = true;

	$scope.shopOne = {};
	$scope.shopOne.idShop = $routeParams.idShop;
	console.log($scope.shopOne.idShop);
	$scope.name = "";
	$scope.shopOne.idUser = "";
	$scope.descriptionLong = "";
	$scope.description = "";
	$scope.shopOne.ciutat = "";
	$scope.shopOne.logo = "";
	$scope.shopOne.logoUp = "";
	$scope.shopOne.currentLogo = "";
	$scope.shopOne.web = "";
	$scope.shopOne.lat = "";
	$scope.shopOne.lng = "";
	$scope.shopOne.telephone = "";
	$scope.shopOne.cp = "";
	$scope.address = "";
	$scope.shopOne.schedule = "";
	$scope.shopOne.email = "";

	if($scope.shopOne.idShop != 0)
	{
		$http({
			method : "GET",
			url : "models/shops.php?acc=l&idShop="+$scope.shopOne.idShop
		}).then(function mySucces(response) {
			$scope.data = response.data;
			$scope.shopOne = $scope.data[0].list[0];
			$scope.name = $scope.shopOne.name.replace(/&quot;/g,'"').replace(/&quot/g,'"');
			$scope.description = $scope.shopOne.description.replace(/&quot;/g,'"').replace(/&quot/g,'"');
			$scope.descriptionLong = $scope.shopOne.descriptionLong.replace(/&quot;/g,'"').replace(/&quot/g,'"');
			$scope.address = $scope.shopOne.address.replace(/&quot;/g,'"').replace(/&quot/g,'"');
			$scope.shopOne.currentLogo = $scope.shopOne.logo;
			console.log($scope.shopOne.currentLogo)
			$scope.allSubCat = $scope.data[0].allSubCat;
			$scope.subCategoriesShop = $scope.data[0].subCategoriesShop;
			$scope.subCategories = $scope.data[0].subCategories;
			$scope.images = $scope.data[0].images;
			console.log($scope.data);
			console.log($scope.shopOne);
		}, function myError(response) {
			$scope.shops = response.statusText;
		}).finally(function(){
			$scope.loading = false;
		});
	}
	// $http({
	// 	method : "GET",
	// 	url : "models/shops.php?acc=list"
	// }).then(function mySucces(response) {
	// 	$scope.data = response.data;
	// 	$scope.shopsList = $scope.data[0].list;
	// 	$scope.allSubCat = $scope.data[0].allSubCat;
	// 	$scope.shopOne = $scope.shopsList[$scope.indexList];
	// 	if($scope.indexList != "a") $scope.currentShopLogo = $scope.shopOne.logo;
	// }, function myError(response) {
	// 	$scope.data = response.statusText;
	// }).finally(function(){
	// 	$scope.loading = false;
	// });

	// $scope.loading = true;
	// $http({
	// 	method : "GET",
	// 	url : "models/shops.php?acc=e&idShop="+$scope.shopOne.idShop
	// }).then(function mySucces(response) {
	// 	$scope.personalData = response.data;
	// 	$scope.subCategoriesShop = $scope.personalData[0].subCategoriesShop;
	// 	$scope.subCategories = $scope.personalData[0].subCategories;
	// 	$scope.images = $scope.personalData[0].images;
	// 	if($scope.indexList != "a")
	// 	{
	// 		$scope.currentIdPref = $scope.personalData[0].images[0].idShopImage;
	// 		$scope.currentImgPref = $scope.personalData[0].images[0].url;
	// 	}
	// }, function myError(response) {
	// 	$scope.personalData = response.statusText;
	// }).finally(function(){
	// 	$scope.loading = false;
	// });

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
			$scope.subCategoriesData = response.statusText;
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
			$scope.subCategoriesData = response.statusText;
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
			$scope.subCategoriesData = response.statusText;
		}).finally(function(){
			$scope.loading = false;
		});
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
			$scope.imagesData = response.statusText;
		}).finally(function(){
			$scope.loading = false;
		});
	}
	$scope.changeImagesShops=function(e, type){
		var formData = new FormData();
		formData.append("type",type);
		formData.append("uploadedFile",e.files[0]);
		formData.append("idShop",$scope.shopOne.idShop);
		formData.append("deleteImagePref",$scope.images[0].url);
		formData.append("idShopImage",$scope.images[0].idShopImage);
		console.log($scope.images[0].url);

		var deferred=$q.defer();
		$http.post("models/shops.php?acc=uploadImage&sentence="+type, formData,{
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
				console.log($scope.images[0].url);
			}, function myError(response) {
				$scope.shops = response.statusText;
			}).finally(function(){
				$scope.loading = false;
			});
		})
		return deferred.promise;
	}
	$scope.uploadLogo = function(e){
		console.log("Escollim foto"+e.files[0].name);
		$scope.shopOne.logoUp=e.files[0];
	}
	$scope.uploadFile = function(){
		if($scope.shopOne.idUser != "")
		{
			$scope.new = false;

			var formData = new FormData();
			formData.append("idShop", $scope.shopOne.idShop);
			console.log($scope.shopOne.idShop);
			formData.append("name", $scope.name);
			formData.append("idUser", $scope.shopOne.idUser);
			console.log($scope.shopOne.idUser);
			formData.append("descriptionLong", $scope.descriptionLong);
			formData.append("description", $scope.description);
			formData.append("ciutat", $scope.shopOne.ciutat);
			formData.append("logo", $scope.shopOne.logoUp);
			console.log($scope.shopOne.logoUp);
			formData.append("deleteLogo", $scope.shopOne.logo);
			console.log($scope.shopOne.logo);
			formData.append("web", $scope.shopOne.web);
			formData.append("lat", $scope.shopOne.lat);
			formData.append("lng", $scope.shopOne.lng);
			formData.append("telephone", $scope.shopOne.telephone);
			formData.append("cp", $scope.shopOne.cp);
			formData.append("address", $scope.address);
			formData.append("schedule", $scope.shopOne.schedule);
			formData.append("email", $scope.shopOne.email);

			var deferred=$q.defer();
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
				$scope.name = $scope.shopOne.name.replace(/&quot;/g,'"').replace(/&quot/g,'"');
				$scope.description = $scope.shopOne.description.replace(/&quot;/g,'"').replace(/&quot/g,'"');
				$scope.descriptionLong = $scope.shopOne.descriptionLong.replace(/&quot;/g,'"').replace(/&quot/g,'"');
				$scope.address = $scope.shopOne.address.replace(/&quot;/g,'"').replace(/&quot/g,'"');
				$scope.allSubCat = $scope.data.allSubCat;
				$scope.subCategoriesShop = $scope.data.subCategoriesShop;
				$scope.subCategories = $scope.data.subCategories;
				$scope.images = $scope.data.images;
				console.log(res.data[0]);
				console.log($scope.images);
				
			})
		}
		else alert("Has d'escollir una associació");
		//return deferred.promise;


		// var type = $scope.indexList;
		// var idShop = $scope.shopOne.idShop
		// var idShop = 1
		// var name = $scope.shopOne.name;
		// var idUser = $scope.idUser;
		// var descriptionLong = $scope.shopOne.descriptionLong;
		// var description = $scope.shopOne.description;
		// var ciutat = $scope.shopOne.ciutat;
		// var logo = $scope.shopOne.logo;
		// var web = $scope.shopOne.web;
		// var lat = $scope.shopOne.lat;
		// var lng = $scope.shopOne.lng;
		// var telephone = $scope.shopOne.telephone;
		// var cp = $scope.shopOne.cp;
		// var address = $scope.shopOne.address;
		// var schedule = $scope.shopOne.schedule;
		// var email = $scope.shopOne.email;
		// var variable = upload.uploadFile(type, idShop, name, idUser, descriptionLong, description, ciutat, logo, web, lat, lng, telephone, cp, address, schedule, email);
	}
})

// .directive('uploaderModel', ["$parse",function($parse){
// 	return{
// 		restrict:'A',
// 		link: 	function(scope, iElement, iAtrrs){
// 				iElement.on("change",
// 				function(e)
// 				{
// 					$parse(iAtrrs.uploaderModel).assign(scope,
// 						iElement[0].files[0]);
// 				});
// 		}
// 	};
// }])

// .service('upload',["$http","$q", function($http,$q)
// {
// 	this.uploadFile=function(type, idShop, name, idUser, descriptionLong, description, ciutat, logo, web, lat, lng, telephone, cp, address, schedule, email)
// 	{
// 		var	deferred=$q.defer();
// 		var formData= new FormData();

// 		formData.append("idShop", idShop);
// 		formData.append("name", name);
// 		formData.append("idUser", idUser);
// 		formData.append("descriptionLong", descriptionLong);
// 		formData.append("description", description);
// 		formData.append("ciutat", ciutat);
// 		formData.append("logo", logo);
// 		formData.append("web", web);
// 		formData.append("lat", lat);
// 		formData.append("lng", lng);
// 		formData.append("telephone", telephone);
// 		formData.append("cp", cp);
// 		formData.append("address", address);
// 		formData.append("schedule", schedule);
// 		formData.append("email", email);

// 		$http.post("models/shops.php?acc=upload&sentence="+type, formData,{
// 			headers:{
// 				"Content-type":undefined
// 			},
// 			transformRequest:angular.identity
// 		})
// 		.then(function()
// 		{
// 		})
// 	}
	
// }]);