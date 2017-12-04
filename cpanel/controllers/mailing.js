angular.module('spaApp')
.controller('MailCtrl', function($scope, $http) {
  		
  	$scope.loadMails=true;

  	$scope.loading=true;
			$http({
				method : "GET",
				url : "models/mailing.php?acc=l"
			}).then(function mySucces (response) {
				
				$scope.mailsList=response.data[0].dataMails;
				
			}, function myError (response) {
				$scope.mailsList = response.statusText;
			})
			.finally(function() 
  	
		{ 
		    $scope.loading=false; 
		})
});