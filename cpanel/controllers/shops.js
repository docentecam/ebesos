angular.module('spaApp')
.controller('ShopsCtrl',['$scope','upload', function($scope, $http, $routeParams, upload) {
	$scope.showShop = false;
	$scope.shopOne = "[{{}}]";
	console.log($scope.showShop);
	$http({
		method : "GET",
		url : "models/shops.php?acc=list"
	}).then(function mySucces(response) {
		console.log(response.data);
		$scope.shopsList = response.data;
    $scope.loading = false;
	}, function myError(response) {
		$scope.shops = response.statusText;
	});

	$scope.shopOneEdit = function($idShop){
		$http({
			method : "GET",
			url : "models/shops.php?acc=edit&idShop=" + $idShop
		}).then(function mySucces (response) {
			$scope.shopOne = response.data;
			$scope.subCategoriesShop = $scope.shopOne[0].subCategoriesShop;
			$scope.images = $scope.shopOne[0].images;
			$scope.users = $scope.shopOne[0].users;
			$scope.subCategories = $scope.shopOne[0].subCategories;
			$scope.showShop = true;
			console.log($scope.showShop);
		}, function myError (response) {
			$scope.showShop = response.statusText;
		});
	};
	$scope.shopOneDelete = function($idShop){
		console.log($idShop);
		$http({
			method : "GET",
			url : "models/shops.php?acc=delete&idShop=" + $idShop
		}).then(function mySucces (response) {
			$scope.shopDeleted = response.data
			//shopOneEdit($idShop);
			console.log("hola: " + $scope.shopDeleted);
		}, function myError (response) {
			$scope.shopOne = response.statusText;
		});
	};
	$scope.shopOneAdd = function($idShop){
		$scope.showShop = true;
		$scope.type = "A";
	};

	$scope.preferredSubCat = function($idShopCategorySub){
		console.log($idShopCategorySub);

	};
	$scope.subCategory = function($idShopCategorySub){
		console.log($idShopCategorySub);

	};
	$scope.userOwner = function($idUser){
		console.log($idUser);

	};
	$scope.infoShop = function() {
		console.log("carga");
		var name= $scope.name;
		var file= $scope.file;
		upload.uploadForm(file,name);
		console.log(name + " " + file);
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
	this.uploadForm=function(file,name)
	{
		console.log("nombre en upload: "+name); 
			console.log("fichero en upload: "+file);
				var	deferred=$q.defer();
				var formData= new FormData();
				formData.append("name", name);
				formData.append("file",	file);
				return 	$http.post("models/subeFichero.php", formData,{
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