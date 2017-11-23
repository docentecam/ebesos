angular.module('spaApp')															 
.controller('SubcategoriesCtrl', function($scope, $http) {
	$scope.loading=true;
	$scope.firstC = true;
	$scope.fail = false;
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
		$scope.fail = false;
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

	$scope.deleteSubCatT = function(idSubCategory){
			$scope.deleteConfirm = confirm("Estàs segur de voler eliminar aquesta subcategoria?");
			if($scope.deleteConfirm == true)
			{
				$http({
					method : "GET",
					url : "models/subCategories.php?acc=d&idSubCategory="+idSubCategory
				}).then(function mySucces (response) {
					$scope.deleteSubCat = response.data;
					$scope.loading=true;
					$scope.fail = true;
					$scope.statusValidation = $scope.deleteSubCat[0]['status'];
					$scope.validation = true;
					if($scope.statusValidation == "Error al connectar")
					{
						$scope.validation = false;
					}
					else if($scope.statusValidation == "")
					{
						$scope.validation = false;
						$scope.statusValidation = "Aquesta subcategoria no es pot eliminar, ja que té com a mínim una tenda associada";
					}
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
			
	}
});
angular.module('spaApp')															 
.controller('SubcategoriyCtrl', function($scope, $http, $routeParams) {
	$scope.accA = $routeParams.action;
	$scope.idSubCategorySC = $routeParams.idSubCategory;
	$scope.nameSC = $routeParams.name;
	$scope.subCatTable = false;
	$scope.btnName = false;
	$scope.fail = false;

	if($scope.idSubCategorySC == -1)
	{
		$scope.nameSC = "";
		$scope.btnName = true;
	}
	$scope.loading=true;
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
	
	$scope.addBBDDSubCat = function(){
		$scope.idC = subCategoresAE['CategoryName'].value;
		$scope.idSCName = subCategoresAE['nsc'].value;
		$scope.action = subCategoresAE['addAcc'].value;
		$scope.idSC = subCategoresAE['idSubC'].value;

		if($scope.idC == -1 || $scope.idSCName == "")
		{
			$scope.fail = true;
			$scope.statusValidation = "Camp buit";
			$scope.validation = false;
		}
		else if($scope.action == "a")
		{
			$scope.loading=true;
			$http({
				method : "GET",
				url : "models/subCategories.php?acc=c&idCategory="+$scope.idC+"&name="+$scope.idSCName
			}).then(function mySucces (response) {
				$scope.createSubCat = response.data;
				$scope.fail = true;
				$scope.statusValidation = $scope.createSubCat[0]['status'];
				$scope.validation = true;
				if($scope.statusValidation == "Error al connectar")
				{
					$scope.validation = false;
				}
			}, function myError (response) {
				$scope.createSubCat = response.statusText;
			})
			.finally(function() {
				$scope.loading=false;

			});
			$scope.nameSC = "";
		}
		else
		{
			$scope.loading=true;
			$http({
				method : "GET",
				url : "models/subCategories.php?acc=e&idCategory="+$scope.idC+"&name="+$scope.idSCName+"&idSubCategory="+$scope.idSC
			}).then(function mySucces (response) {
				$scope.editSubCat = response.data;
				$scope.fail = true;
				$scope.statusValidation = $scope.editSubCat[0]['status'];
				$scope.validation = true;
				if($scope.statusValidation == "Error al connectar")
				{
					$scope.validation = false;
				}
			}, function myError (response) {
				$scope.editSubCat = response.statusText;
			})
			.finally(function() {
				$scope.loading=false;
			});
		}
	}

});