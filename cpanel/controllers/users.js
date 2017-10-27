angular.module('spaApp')
 .controller('AssociationsCtrl', function($scope, $http) {
 			$scope.cUser = true;

			
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
  			/*	$scope.nameC = dataUser['name'].value;
  				$scope.email = dataUser['email'].value;
  				$scope.pswdMail = dataUser['pswdMail'].value;
  				$scope.address = dataUser['address'].value;
  				$scope.telephone = dataUser['telephone'].value;
  				$scope.idUser = dataUser['userId'].value;
  				$scope.active = dataUser['active'].value;
  				$scope.history = dataUser['history'].value;
  				$scope.currentPswd = dataUser['currentPswd'].value;
  				$scope.confirmPswd = dataUser['confirmPswd'].value;
  				$scope.pswd = dataUser['pswd'].value;*/

  					console.log($scope.pswdC);
					console.log($scope.confirmPswdC);
					console.log($scope.currentPswdC);
					console.log($scope.idUserC);
					console.log($scope.nameC);
					console.log($scope.emailC);
					console.log($scope.emailPassC);
					console.log($scope.addressC);
					console.log($scope.telephoneC);
					console.log($scope.logoC);
					console.log($scope.footerC);
					console.log($scope.historyC);
					console.log($scope.activeC);
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
  				else if($scope.pswdC == $scope.confirmPswdC && $scope.confirmPswdC != "" && $scope.pswdC != "" && $scope.idUser == "")
  				{
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