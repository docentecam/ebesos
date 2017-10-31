angular.module('spaApp')
 .controller('AssociationsCtrl', function($scope, $http) {
 			$scope.cUser = true;
 			$scope.activeCY = 'Y';
 			$scope.activeCN = 'N';
			
			$http({
				method : "GET",
				url : "models/users.php?acc=loadUser" //modificar
			}).then(function mySucces (response) {
				$scope.associations = response.data;
				$scope.idUserC = $scope.associations[0]['idUser'];
				$scope.nameC = $scope.associations[0]['name'];
				$scope.emailC = $scope.associations[0]['email'];
				$scope.emailPassC = $scope.associations[0]['emailPass'];
				$scope.addressC = $scope.associations[0]['address'];
				$scope.telephoneC = $scope.associations[0]['telephone'];
				$scope.logoC = $scope.associations[0]['logo'];
				$scope.footerC = $scope.associations[0]['footer'];
				$scope.historyC = $scope.associations[0]['history'];
				$scope.activeC = $scope.associations[0]['active'];
			}, function myError (response) {
				$scope.associations = response.statusText;
			});

			$http({
				method : "GET",
				url : "models/users.php?acc=listUsers"
			}).then(function mySucces (response) {
				$scope.users = response.data;
			}, function myError (response) {
				$scope.users = response.statusText;
			});
		
			$scope.changeDataUser = function(idUser=""){
				$scope.pswdC = "";
				$scope.confirmPswdC = "";
				$scope.currentPswdC = "";

				if(idUser == -1)
				{
					$scope.idUserC = "";
					$scope.nameC = "";
					$scope.emailC = "";
					$scope.emailPassC = "";
					$scope.addressC = "";
					$scope.telephoneC = "";
					$scope.logoC = "";
					$scope.footerC = "";
					$scope.historyC = "";
					$scope.activeC = "";
					$scope.cUser = false;
				}
				else
				{
					$scope.cUser = true;

					$http({
						method : "GET",
						url : "models/users.php?acc=loadUser&idUser="+idUser
					}).then(function mySucces (response) {
						$scope.associations = response.data;
						$scope.idUserC = $scope.associations[0]['idUser'];
						$scope.nameC = $scope.associations[0]['name'];
						$scope.emailC = $scope.associations[0]['email'];
						$scope.emailPassC = $scope.associations[0]['emailPass'];
						$scope.addressC = $scope.associations[0]['address'];
						$scope.telephoneC = $scope.associations[0]['telephone'];
						$scope.logoC = $scope.associations[0]['logo'];
						$scope.footerC = $scope.associations[0]['footer'];
						$scope.historyC = $scope.associations[0]['history'];
						$scope.activeC = $scope.associations[0]['active'];
						
					}, function myError (response) {
						$scope.associations = response.statusText;
					});
				}
			};
			
			$scope.updateUser = function(){
  				$scope.active = dataUser['active'].value;

				if($scope.active == 'Y')
				{
					$scope.activeC = $scope.activeCY;
				}
				else
				{
					$scope.activeC = $scope.activeCN;
				}

  				if($scope.idUserC != "")
  				{
  					if($scope.pswdC == $scope.confirmPswdC && $scope.confirmPswdC != "" && $scope.pswdC != "" && $scope.currentPswdC != "")
  					{
						$http({
							method : "GET",
							url : "models/users.php?acc=updateUser&name="+$scope.nameC+"&email="+$scope.emailC+"&pswdMail="+$scope.emailPassC+"&address="+$scope.addressC+"&telephone="+$scope.telephoneC+"&idUser="+$scope.idUser+"&active="+$scope.activeC+"&history="+$scope.historyC+"&pswd="+$scope.pswdC+"&currentPswd="+$scope.currentPswdC
						}).then(function mySucces (response) {
							$scope.userUpdate = response.data;
						}, function myError (response) {
							$scope.userUpdate = response.statusText;
						});
  					}
  					else if($scope.pswdC == "" && $scope.confirmPswdC == "" && $scope.currentPswdC == "")
  					{
  						$http({
							method : "GET",
							url : "models/users.php?acc=updateUser&name="+$scope.nameC+"&email="+$scope.emailC+"&pswdMail="+$scope.emailPassC+"&address="+$scope.addressC+"&telephone="+$scope.telephoneC+"&idUser="+$scope.idUser+"&active="+$scope.activeC+"&history="+$scope.historyC
						}).then(function mySucces (response) {
							$scope.userUpdate = response.data;
						}, function myError (response) {
							$scope.userUpdate = response.statusText;
						});
  					}
  					else
  					{
  						$scope.error = "Error";
  					}
  					
  				}
  				else if($scope.pswdC == $scope.confirmPswdC && $scope.confirmPswdC != "" && $scope.pswdC != "" && $scope.idUser == -1)
  				{
  					console.log("llega");
  					$http({
							method : "GET",
							url : "models/users.php?acc=createUser&name="+$scope.nameC+"&email="+$scope.emailC+"&pswdMail="+$scope.emailPassC+"&address="+$scope.addressC+"&telephone="+$scope.telephoneC+"&history="+$scope.historyC+"&pswd="+$scope.pswdC
						}).then(function mySucces (response) {
							$scope.userCreate = response.data;
							console.log($scope.userCreate);
						}, function myError (response) {
							$scope.userUCreate = response.statusText;
						});
  				}
  				else
  				{
  					$scope.error = "Error";
  				}
			};
  			$scope.showEdit = function(){
  				$scope.logoEdit = true;
  			};
  			$scope.showEdit2 = function(){
  				$scope.logoEdit2 = true;
  			};
 
	});