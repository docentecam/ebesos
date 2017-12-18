angular.module('spaApp')															 
.controller('HomeCtrl', function($scope, $http,$q) {
	$scope.loading=true;
	$scope.answer=false;
	$http({
		method : "GET",
		url : "models/home.php?acc=home"
		}).then(function mySucces (response) {
			$scope.homeData=response.data;
			$scope.associations=$scope.homeData[0].associations;
			$scope.links=$scope.homeData[0].links;
			$scope.slider=$scope.homeData[0].slider;
			$scope.formation=$scope.homeData[0].formation[0].url;
		}, function myError (response) {
			$scope.homeData = response.statusText;
		})
		.finally(function() {
			$scope.loading=false;
		});	


	$scope.newNewsletter={};
	$scope.newNewsletter.email="";
 	$scope.newNewsletter.nomContacte="";

	$scope.newsletter= function(){
		$scope.loading=true;

		var data = new FormData();
		data.append("email", $scope.newNewsletter.email);
		data.append("nomContacte", $scope.newNewsletter.nomContacte);

			

var deferred=$q.defer();
		$http.post("models/home.php?acc=n",data,{
					headers:{
						"Content-type":undefined
					},
						transformRequest:angular.identity
					})
					.then(function(res)
					{
						deferred.resolve(res); 
						$scope.loading=false;
						$scope.answer=true;
						$scope.newNewsletter.email="";
 						$scope.newNewsletter.nomContacte="";

					});


	}


});






	



	
		





			