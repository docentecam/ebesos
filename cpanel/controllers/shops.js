angular.module('spaApp')
.controller('ShopsCtrl', function($scope, $http, $routeParams, upload) {
	$scope.showShop = false;
	$scope.shopOne = "[{{}}]";
	$scope.filterId = 1;
	$scope.loading = true;
	console.log($scope.showShop);
	$http({
		method : "GET",
		url : "models/users.php?acc=lg"
	}).then(function mySucces(response) {
		$scope.userLg = response.data;
		$scope.idUserLg = $scope.userLg[0].sessionIdUser
		$scope.privilegesLg = $scope.userLg[0].sessionPrivileges
		if($scope.idUserLg==1) $scope.filterShops="!1";
		else $scope.filterShops = $scope.idUserLg;
	}, function myError(response) {
		$scope.shops = response.statusText;
	}).finally(function(){
      $scope.loading = false;
  	});

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

	$scope.shopOneEdit = function(index, $type, $idShop){
		$scope.loading = true;
		$http({
			method : "GET",
			url : "models/shops.php?acc=e&idShop="+$idShop
		}).then(function mySucces(response) {
			$scope.personalData = response.data;
			$scope.subCategoriesShop = $scope.personalData[0].subCategoriesShop;
			$scope.subCategories = $scope.personalData[0].subCategories;
			$scope.images = $scope.personalData[0].images;
			console.log($scope.personalData);
		}, function myError(response) {
			$scope.shops = response.statusText;
		}).finally(function(){
			$scope.loading = false;
		});
		$scope.shopOne = $scope.shopsList[index];
		$scope.type = $type;
		console.log($scope.type);
		// $scope.subCategoriesShop = $scope.showShop[index].subCategoriesShop;
		// $scope.images = $scope.showShop[index].images;
		// $scope.users = $scope.showShop[index].users;
		// $scope.subCategories = $scope.showShop[index].subCategories;
		$scope.showShop = true;
	};
	$scope.shopOneDelete = function($idShop){
		console.log($idShop);
		$scope.loading = true;
		$http({
			method : "GET",
			url : "models/shops.php?acc=delete&idShop=" + $idShop
		}).then(function mySucces (response) {
			$scope.shopDeleted = response.data
			//shopOneEdit($idShop);
			console.log("hola: " + $scope.shopDeleted);
		}, function myError (response) {
			$scope.shopOne = response.statusText;
		}).finally(function(){
			$scope.loading = false;
		});
	};
	$scope.shopOneAdd = function($idShop){
		$scope.showShop = true;
		$scope.type = "A";
	};

	$scope.listChange = function($idUserL){
		if($idUserL==1) $scope.filterShops="!1";
		else $scope.filterShops = $idUserL;
	};

	$scope.preferredSubCat = function($idShopCategorySub, $idShop){
		$scope.loading = true;
		$http({
			method : "GET",
			url : "models/shops.php?acc=ePrefSubCat&idShop="+$idShop+"&idShopCategorySub="+$idShopCategorySub
		}).then(function mySucces(response) {
			//console.log(response.data);
			$scope.subCategoriesData = response.data;
			$scope.subCategoriesShop = $scope.subCategoriesData[0].shopCategories;
			$scope.subCategories = $scope.personalData[0].subCategories;
			
			// console.log($scope.subCategoriesData);
			// console.log($scope.subCategoriesShop);
			//console.log($scope.subCategories);
	    
		}, function myError(response) {
			$scope.shops = response.statusText;
		}).finally(function(){
			$scope.loading = false;
		});
		console.log($idShopCategorySub);

	};
	$scope.subCategory = function($idShopCategorySub){
		console.log($idShopCategorySub);
	};
	$scope.deleteSubCategory = function($idShopCategorySub, $idShop){
		$scope.loading = true;
		$http({
			method : "GET",
			url : "models/shops.php?acc=delsc&idShop="+$idShop+"&idShopCategorySub="+$idShopCategorySub
		}).then(function mySucces(response) {
			//console.log(response.data);
			$scope.subCategoriesData = response.data;
			$scope.subCategoriesShop = $scope.subCategoriesData[0].shopCategories;
			$scope.subCategories = $scope.subCategoriesData[0].categoriesSub;
			
			console.log($scope.subCategoriesData);
			console.log($scope.subCategoriesShop);
			//console.log($scope.subCategories);
	    
		}, function myError(response) {
			$scope.shops = response.statusText;
		}).finally(function(){
			$scope.loading = false;
		});
		console.log($scope.subCategoriesShop);
		console.log($idShop);
		console.log($idShopCategorySub);
	};
	$scope.userOwner = function($idUser){
		console.log($idUser);
	};
	$scope.uploadFile = function(){
		console.log("carga");
		var type = $scope.type;
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
		//var file= $scope.file;
		console.log(name);
		console.log(type);
		console.log(logo);
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
		console.log("nombre en upload: "+name);
		console.log("nombre en upload: "+logo); 
			//console.log("fichero en upload: "+file);
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
					// console.log	("lo sube"+ res);
					// //deferred.resolve(res);
					// console.log	(deferred.resolve(res));
					console.log	("lo sube");
				})
//.error(function(msg,code)
//{
//deferred.reject(msg);
//})
//return deferred.promise;
}

}]);