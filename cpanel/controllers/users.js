angular.module('spaApp')
 .controller('AssociationsCtrl', function($scope, $http) {
 			$scope.formDataUser = true;
 			$scope.cUser = true;
			$scope.eUser = false;
			/*$scope.userClear = {
					nameClr: "",
					emailClr: "",
					emailPassClr: "",
					addressClr: "",
					telephoneClr: "",
					pswdClr: "",
					confirmPswdClr: "",
					currentPswdClr: "",
					historyClr: "",
					activeClr: ""
				};*/

			$http({
				method : "GET",
				url : "models/users.php?acc=lg"
			}).then(function mySucces (response) {
				$scope.lg = response.data;
				$scope.lgId = $scope.lg[0]['sessionIdUser'];
			}, function myError (response) {
				$scope.lg = response.statusText;
			});

			$http({
				method : "GET",
				url : "models/users.php?acc=loadUser&idUser=1" //modificar
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
				/*$scope.userClear = {
					nameClr: $scope.nameC,
					emailClr: $scope.emailC,
					emailPassClr: $scope.emailPassC,
					addressClr: $scope.addressC,
					telephoneClr: $scope.telephoneC,
					pswdClr: "",
					confirmPswdClr: "",
					currentPswdClr: "",
					historyClr: $scope.historyC,
					activeClr: $scope.activeC
				};*/
			}, function myError (response) {
				$scope.associations = response.statusText;
			});

			//var clearUser = angular.copy($scope.userClear);

			$http({
				method : "GET",
				url : "models/users.php?acc=listUsers"
			}).then(function mySucces (response) {
				$scope.users = response.data;
			}, function myError (response) {
				$scope.users = response.statusText;
			});
		
			$scope.changeDataUser = function(idUser=""){
				$scope.formDataUser = false;
				/*$scope.userClear = angular.copy(clearUser);
				$scope.dataUserForm.$setPristine();*/
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
				$scope.eUser = true;

				if(idUser != -1)
				{
					$scope.cUser = true;
					$scope.eUser = false;
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
				$scope.formDataUser = true;
			};
			$scope.showChangePass = function(){
  					$scope.changePass = true;
				};
			$scope.updateUser = function(){
  				$scope.name = dataUser['name'].value;
  				$scope.email = dataUser['email'].value;
  				$scope.pswdMail = dataUser['pswdMail'].value;
  				$scope.address = dataUser['address'].value;
  				$scope.telephone = dataUser['telephone'].value;
  				$scope.idUser = dataUser['userId'].value;
  				$scope.active = dataUser['active'].value;
  				$scope.history = dataUser['history'].value;
  				$scope.currentPswd = dataUser['currentPswd'].value;
  				$scope.confirmPswd = dataUser['confirmPswd'].value;
  				$scope.pswd = dataUser['pswd'].value;
  				if($scope.idUser != "")
  				{
  					if($scope.pswd == $scope.confirmPswd && $scope.confirmPswd != "" && $scope.pswd != "" && $scope.currentPswd != "")
  					{
						$http({
							method : "GET",
							url : "models/users.php?acc=updateUser&name="+$scope.name+"&email="+$scope.email+"&pswdMail="+$scope.pswdMail+"&address="+$scope.address+"&telephone="+$scope.telephone+"&idUser="+$scope.idUser+"&active="+$scope.active+"&history="+$scope.history+"&pswd="+$scope.pswd+"&currentPswd="+$scope.currentPswd
						}).then(function mySucces (response) {
							$scope.userUpdate = response.data;
						}, function myError (response) {
							$scope.userUpdate = response.statusText;
						});
  					}
  					else if($scope.pswd == "" && $scope.confirmPswd == "" && $scope.currentPswd == "")
  					{
  						$http({
							method : "GET",
							url : "models/users.php?acc=updateUser&name="+$scope.name+"&email="+$scope.email+"&pswdMail="+$scope.pswdMail+"&address="+$scope.address+"&telephone="+$scope.telephone+"&idUser="+$scope.idUser+"&active="+$scope.active+"&history="+$scope.history
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
  				else if($scope.pswd == $scope.confirmPswd && $scope.confirmPswd != "" && $scope.pswd != "" && $scope.idUser == "")
  				{
  					$http({
							method : "GET",
							url : "models/users.php?acc=createUser&name="+$scope.name+"&email="+$scope.email+"&pswdMail="+$scope.pswdMail+"&address="+$scope.address+"&telephone="+$scope.telephone+"&history="+$scope.history+"&pswd="+$scope.pswd
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


			$scope.showDisconnect = function(){

			$scope.showSignOff=true;
	}  				
			
	});