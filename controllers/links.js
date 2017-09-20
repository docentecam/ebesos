// alert("hola");
// 	angular.module('spaApp')

// 	.controller('LinksCtrl', function($scope, $http) {
		
// 		//var enl = $scope.links;
// 	$http({
// 			method : "GET",
// 			url : "models/links.php?acc=links"
// 		}).then(function mySucces (response) {
// 			console.log(response.data);
// 			$scope.links=response.data;
// 			console.log("lol "+$scope.links);
			
// 		}, function myError (response) {
// 			console.log("lal "+scope.links);

// 			$scope.enl = "pepitaaaaaaa";//response.statusText;
// 		});
// 			console.log("los Link Son: "+$scope.links);
// 	});


angular.module('spaApp')															 
.controller('LinksCtrl', function($scope, $http) {

$http({

		method : "GET",
		url : "models/links.php?acc=links"
	}).then(function mySucces (response) {
		$scope.links=response.data;
		console.log($scope.links);
	}, function myError (response) {
		$scope.links = response.statusText;
	});
});
		