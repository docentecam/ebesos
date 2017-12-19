angular.module('spaApp')
.controller('MailsCtrl', function($scope, $http) {
  		
  	$scope.loadMails=true;
  	$scope.showMailing=false;
  	$scope.	messageNew=false;

  	$scope.loading=true;
			$http({
				method : "GET",
				url : "models/mailing.php?acc=l"
			}).then(function mySucces (response) {
				
				$scope.mailsList=response.data;
				
			}, function myError (response) {
				$scope.mailsList = response.statusText;
			})
			.finally(function() 
  	
		{ 
		    $scope.loading=false; 
		})


	 $scope.listUsersMailing=function(){
	 	$scope.loadMails=false;
	 	$scope.showMailing=false;
	 	$scope.showMailing=true;

	 	$http({
				method : "GET",
				url : "models/mailing.php?acc=listM"
			}).then(function mySucces (response) {
				
				$scope.mailsListMailing=response.data;
				
			}, function myError (response) {
				$scope.mailsListMailing = response.statusText;
			})
			.finally(function() 
  	
		{ 
		    $scope.loading=false; 
		})
	 }

	  $scope.newMessage=function(){
		$scope.	messageNew=true;
		$scope.loadMails=false;
		$scope.showMailing=false;
	  }



	$scope.newEmail={};
	$scope.newEmail.asunto="";
 	$scope.newEmail.fecha="";
 	$scope.newEmail.contenido="";

	 $scope.sendMails=function(){ 

	 	var correct=true;


	 	 if($scope.newEmail.asunto=="" ||$scope.newEmail.fecha==""||$scope.promotion.newEmail.contenido=="" )
		{
			alert("N'hi ha un camp buit");
			correct=false;
		}


  // 		var d = new Date();
		// var yyyy = d.getFullYear();
		// var mm = d.getMonth() < 9 ? "0" + (d.getMonth() + 1) : (d.getMonth() + 1); // getMonth() is zero-based
		// var dd  = d.getDate() < 10 ? "0" + d.getDate() : d.getDate();

		var data = new FormData();
		data.append("asunto",$scope.newEmail.asunto);
		data.append("fecha",$scope.newEmail.fecha);
		data.append("contenido",$scope.newEmail.contenido="");

			

		var deferred=$q.defer();
		$http.post("models/home.php?acc=emailNew",data,{
					headers:{
						"Content-type":undefined
					},
						transformRequest:angular.identity
					})
					.then(function(res)
					{
						deferred.resolve(res); 
						$scope.loading=false; 

					});
	}
	 
});