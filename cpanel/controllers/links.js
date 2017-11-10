angular.module('spaApp')															 
.controller('LinksCtrl', function($scope, $http) {
	$scope.loading=true;
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

	$scope.createLink = function(){
		$scope.tableLinks = false;
		$scope.formLinks = true;
		$scope.idLinkC = -1;
				
	}
	$scope.editLink = function(idLink,name,url){
		$scope.tableLinks = false;
		$scope.formLinks = true;
		$scope.idLinkC = idLink;
		$scope.nameC = name;
		$scope.urlC = url;
	}
	$scope.deleteLink = function(idLink){
		$scope.loading=true;
			$http({
				method : "GET",
				url : "models/links.php?acc=deleteLink&idLink="+idLink
			})
			.then(function mySucces (response) {
				$scope.linksDelete = response.data;
				$scope.loading=true;
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
	$scope.updateLink = function(){
		

		if($scope.nameC == "" || $scope.urlC == "")
		{
			$scope.statusValidations = "Hi ha camps sense omplir";
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
				$scope.linksCreate = response.statusText;
			})
			.finally(function() 
			{ 
			    $scope.loading=false;
			    $scope.nameC = "";
				$scope.urlC = "";
			})
			$scope.tableLinks = true;
			$scope.formLinks = false;
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
				$scope.linksCreate = response.statusText;
			})
			.finally(function() 
			{ 
			    $scope.loading=false;
			    $scope.nameC = "";
				$scope.urlC = "";
			})
			$scope.tableLinks = true;
			$scope.formLinks = false;
		}
		

	}

});