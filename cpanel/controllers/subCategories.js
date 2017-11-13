angular.module('spaApp')															 
.controller('SubcategoriesCtrl', function($scope, $http) {
	$scope.loading=true;
	$scope.firstC = true;
	$scope.subCatTable = true;
	$http({
			method : "GET",
			url : "models/subCategories.php?acc=l"
		}).then(function mySucces (response) {
			$scope.categories = response.data;
			$scope.urlPicto1C = $scope.categories[0]['urlPicto1'];
		}, function myError (response) {
			$scope.categories = response.statusText;
		})
		.finally(function() {
			$scope.loading=false;
	});
	$scope.loading=true;
	$http({
			method : "GET",
			url : "models/subCategories.php?acc=ls"
		}).then(function mySucces (response) {
			$scope.subCategories = response.data;
		}, function myError (response) {
			$scope.subCategories = response.statusText;
		})
		.finally(function() {
			$scope.loading=false;
	});
	$scope.changeCat = function(name){
		$scope.firstC = false;
		$scope.nameC = name;
		$scope.loading=true;
		$http({
				method : "GET",
				url : "models/subCategories.php?acc=l&name="+name
			}).then(function mySucces (response) {
				$scope.uCategories = response.data;
				$scope.urlPicto1C = $scope.uCategories[0]['urlPicto1'];
				$scope.idCategoryC = $scope.uCategories[0]['idCategory'];
				$scope.loading=true;
				$http({
						method : "GET",
						url : "models/subCategories.php?acc=ls&idCategory="+$scope.idCategoryC
					}).then(function mySucces (response) {
						$scope.subCategories = response.data;
					}, function myError (response) {
						$scope.subCategories = response.statusText;
					})
					.finally(function() {
						$scope.loading=false;
				});
			}, function myError (response) {
				$scope.uCategories = response.statusText;
			})
			.finally(function() {
				$scope.loading=false;
		});
	}
	$scope.addSubCat = function(action){
		$scope.subCatTable = false;
		$scope.btnName = true;
		$scope.nameSC = "";
		$scope.accA = action;
	}
	$scope.editSubCat = function(idSubCategory,name,action){
		$scope.subCatTable = false;
		$scope.btnName = false;
		$scope.nameSC = name;
		$scope.idSubCategorySC = idSubCategory;
		$scope.accA = action;
	}
	$scope.addBBDDSubCat = function(){
		$scope.idC = subCategoresAE['CategoryName'].value;
		$scope.idSCName = subCategoresAE['nsc'].value;
		$scope.action = subCategoresAE['addAcc'].value;
		$scope.idSC = subCategoresAE['idSubC'].value;

		if($scope.idC == -1 || $scope.idSCName == "")
		{
			alert("Camp buit");
		}
		else if($scope.action == "a")
		{
			$http({
				method : "GET",
				url : "models/subCategories.php?acc=c&idCategory="+$scope.idC+"&name="+$scope.idSCName
			}).then(function mySucces (response) {
				$scope.createSubCat = response.data;
				$scope.loading=true;
				$http({
					method : "GET",
					url : "models/subCategories.php?acc=l"
				}).then(function mySucces (response) {
					$scope.categories = response.data;
					$scope.urlPicto1C = $scope.categories[0]['urlPicto1'];
					$scope.nameC = $scope.categories[0]['name'];
					$scope.firstC = false;
				}, function myError (response) {
					$scope.categories = response.statusText;
				})
				.finally(function() {
					$scope.loading=false;
				});
				$scope.loading=true;
				$http({
						method : "GET",
						url : "models/subCategories.php?acc=ls"
					}).then(function mySucces (response) {
						$scope.subCategories = response.data;
						$scope.subCatTable = true;
					}, function myError (response) {
						$scope.subCategories = response.statusText;
					})
					.finally(function() {
						$scope.loading=false;
				});
			}, function myError (response) {
				$scope.createSubCat = response.statusText;
			})
			.finally(function() {
				$scope.loading=false;
			});
		}
		else
		{
			$http({
				method : "GET",
				url : "models/subCategories.php?acc=e&idCategory="+$scope.idC+"&name="+$scope.idSCName+"&idSubCategory="+$scope.idSC
			}).then(function mySucces (response) {
				$scope.editSubCat = response.data;
				$http({
					method : "GET",
					url : "models/subCategories.php?acc=l"
				}).then(function mySucces (response) {
					$scope.categories = response.data;
					$scope.urlPicto1C = $scope.categories[0]['urlPicto1'];
					$scope.nameC = $scope.categories[0]['name'];
					$scope.firstC = false;
				}, function myError (response) {
					$scope.categories = response.statusText;
				})
				.finally(function() {
					$scope.loading=false;
				});
				$scope.loading=true;
				$http({
						method : "GET",
						url : "models/subCategories.php?acc=ls"
					}).then(function mySucces (response) {
						$scope.subCategories = response.data;
						$scope.subCatTable = true;
					}, function myError (response) {
						$scope.subCategories = response.statusText;
					})
					.finally(function() {
						$scope.loading=false;
				});
			}, function myError (response) {
				$scope.editSubCat = response.statusText;
			})
			.finally(function() {
				$scope.loading=false;
			});
		}
	}
	$scope.deleteSubCat = function(idSubCategory){
			$http({
				method : "GET",
				url : "models/subCategories.php?acc=d&idSubCategory="+idSubCategory
			}).then(function mySucces (response) {
				$scope.deleteSubCat = response.data;
				$http({
					method : "GET",
					url : "models/subCategories.php?acc=l"
				}).then(function mySucces (response) {
					$scope.categories = response.data;
					$scope.urlPicto1C = $scope.categories[0]['urlPicto1'];
					$scope.nameC = $scope.categories[0]['name'];
					$scope.firstC = false;
				}, function myError (response) {
					$scope.categories = response.statusText;
				})
				.finally(function() {
					$scope.loading=false;
				});
				$scope.loading=true;
				$http({
						method : "GET",
						url : "models/subCategories.php?acc=ls"
					}).then(function mySucces (response) {
						$scope.subCategories = response.data;
						$scope.subCatTable = true;
					}, function myError (response) {
						$scope.subCategories = response.statusText;
					})
					.finally(function() {
						$scope.loading=false;
				});
			}, function myError (response) {
				$scope.deleteSubCat = response.statusText;
			})
			.finally(function() {
				$scope.loading=false;
			});
	}
});