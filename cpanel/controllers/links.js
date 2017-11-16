angular.module('spaApp')															 
.controller('LinksCtrl', function($scope, $http) {
	$scope.loading=true;
	$scope.fail = false;
	$scope.tableLinks = true;
	$scope.formLinks = false;
	$scope.nameC = "";
	$scope.urlC = "";
	$scope.idLinkC = -1;

	$http({
			method : "GET",
			url : "models/links.php?acc=l"
		})
		.then(function mySucces (response) {
			$scope.linksList = response.data;
		}, function myError (response) {
			$scope.linksList = response.statusText;
		})
		.finally(function() 
		{ 
		    $scope.loading=false; 
		})

	$scope.deleteLink = function(idLink){
		$scope.deleteConfirm = confirm("Estàs segur que vols eliminar aquest enllaç?")
		if($scope.deleteConfirm == true)
		{
			$scope.loading=true;
			$http({
				method : "GET",
				url : "models/links.php?acc=deleteLink&idLink="+idLink
			})
			.then(function mySucces (response) {
				$scope.linksDelete = response.data;
				$scope.loading=true;
				$scope.fail = true;
				$scope.statusValidation = $scope.linksDelete[0]['status'];
				$scope.validation = true;
				if($scope.statusValidation == "Error al connectar")
				{
					$scope.validation = false;
				}
				$http({
					method : "GET",
					url : "models/links.php?acc=l"
				})
				.then(function mySucces (response) {
					$scope.linksList = response.data;
				}, function myError (response) {
					$scope.linksList = response.statusText;
				})
				.finally(function() 
				{ 
				    $scope.loading=false; 
				})
			}, function myError (response) {
				$scope.linksDelete = response.statusText;
			})
			.finally(function() 
			{ 
			    $scope.loading=false;
			})
		}
		
		
	}
	
});
angular.module('spaApp')															 
.controller('LinkCtrl', function($scope, $http, $routeParams) {
	$scope.action = $routeParams.acc;
	$scope.idLinkC = $routeParams.idLink;

	if($scope.idLinkC != -1)
	{
		$http({
			method : "GET",
			url : "models/links.php?acc=lu&idLink="+$scope.idLinkC
		})
		.then(function mySucces (response) {
			$scope.linksListU = response.data;
			$scope.nameC = $scope.linksListU[0].description;
			$scope.urlC = $scope.linksListU[0].url;
		}, function myError (response) {
			$scope.linksList = response.statusText;
		})
		.finally(function() 
		{ 
		    $scope.loading=false; 
		})
	}

	$scope.updateLink = function(){
		

		if($scope.nameC == "" || $scope.urlC == "")
		{
			$scope.statusValidation = "Hi ha camps sense omplir";
			$scope.fail = true;
			$scope.validation = false;
		}
		else if($scope.idLinkC == -1)
		{
			$scope.loading=true;
			$http({
				method : "GET",
				url : "models/links.php?acc=createLink&name="+$scope.nameC+"&url="+$scope.urlC
			})
			.then(function mySucces (response) {
				$scope.linksCreate = response.data;
				$scope.loading=true;
				$scope.fail = true;
				$scope.statusValidation = $scope.linksCreate[0]['status'];
				$scope.validation = true;
				if($scope.statusValidation == "Error al connectar")
				{
					$scope.validation = false;
				}
				
			}, function myError (response) {
				$scope.linksCreate = response.statusText;
			})
			.finally(function() 
			{ 
			    $scope.loading=false;
			    $scope.nameC = "";
				$scope.urlC = "";
			})
			
		}
		else
		{
			$scope.loading=true;
			$http({
				method : "GET",
				url : "models/links.php?acc=createLink&name="+$scope.nameC+"&url="+$scope.urlC+"&idLink="+$scope.idLinkC
			})
			.then(function mySucces (response) {
				$scope.linksCreate = response.data;
				$scope.loading=true;
				$scope.fail = true;
				$scope.statusValidation = $scope.linksCreate[0]['status'];
				$scope.validation = true;
				if($scope.statusValidation == "Error al connectar")
				{
					$scope.validation = false;
				}
				
			}, function myError (response) {
				$scope.linksCreate = response.statusText;
			})
			.finally(function() 
			{ 
			    $scope.loading=false;
			    $scope.nameC = "";
				$scope.urlC = "";
			})
			
		}
		

	}

});