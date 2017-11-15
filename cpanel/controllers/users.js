angular.module('spaApp')
 .controller('AssociationsCtrl', function($scope, $http, $q) {
 			$scope.cUser = true;
 			$scope.activeCY = 'Y';
 			$scope.activeCN = 'N';
			$scope.loading = true;
			$scope.fail = false;
			$scope.fail2 = false;
			$http({
				method : "GET",
				url : "models/users.php?acc=loadUser" 
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
			}).finally(function(){
				$scope.loading = false;
			});

			$scope.loading = true;
			$http({
				method : "GET",
				url : "models/users.php?acc=listUsers"
			}).then(function mySucces (response) {
				$scope.users = response.data;
			}, function myError (response) {
				$scope.users = response.statusText;
			}).finally(function(){
				$scope.loading = false;
			});

		
			$scope.changeDataUser = function(idUser=""){
				$scope.pswdC = "";
				$scope.confirmPswdC = "";
				$scope.currentPswdC = "";
				$scope.fail = false;
				$scope.fail2 = false;

				if(idUser == -1)
				{
					$scope.idUserC = -1;
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
					$scope.loading = true;

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
					}).finally(function(){
							$scope.loading = false;
					});
				}
			};
			
			$scope.updateUser = function(){
  				$scope.active = dataUser['active'].value;
  				$scope.fail2 = false;

				if($scope.active == 'Y')
				{
					$scope.activeC = $scope.activeCY;
				}
				else
				{
					$scope.activeC = $scope.activeCN;
				}

  				if($scope.idUserC != -1)
  				{
  					if($scope.pswdC == $scope.confirmPswdC && $scope.confirmPswdC != "" && $scope.pswdC != "" && $scope.currentPswdC != "")
  					{
  						$scope.loading = true;
						$http({
							method : "GET",
							url : "models/users.php?acc=updateUser&name="+$scope.nameC+"&email="+$scope.emailC+"&pswdMail="+$scope.emailPassC+"&address="+$scope.addressC+"&telephone="+$scope.telephoneC+"&idUser="+$scope.idUser+"&active="+$scope.activeC+"&history="+$scope.historyC+"&pswd="+$scope.pswdC+"&currentPswd="+$scope.currentPswdC
						}).then(function mySucces (response) {
							$scope.userUpdate = response.data;
							$scope.statusValidation = $scope.userUpdate[0]['status'];
								$scope.validation = false;
								if($scope.statusValidation == "L'usuari s'ha actualitzat")
								{
									$scope.validation = true;
								}
								$scope.loading = true;
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
								}).finally(function(){
									$scope.loading = false;
								});
								$scope.loading = true;
								$http({
									method : "GET",
									url : "models/users.php?acc=listUsers"
								}).then(function mySucces (response) {
									$scope.users = response.data;
								}, function myError (response) {
									$scope.users = response.statusText;
								}).finally(function(){
									$scope.loading = false;
								});
								$scope.fail = true;
						}, function myError (response) {
							$scope.userUpdate = response.statusText;
						}).finally(function(){
								$scope.loading = false;
						});

  					}
  					else if($scope.pswdC == "" && $scope.confirmPswdC == "" && $scope.currentPswdC == "")
  					{
  						$scope.loading = true;
  						$http({
							method : "GET",
							url : "models/users.php?acc=updateUser&name="+$scope.nameC+"&email="+$scope.emailC+"&pswdMail="+$scope.emailPassC+"&address="+$scope.addressC+"&telephone="+$scope.telephoneC+"&idUser="+$scope.idUser+"&active="+$scope.activeC+"&history="+$scope.historyC
						}).then(function mySucces (response) {
							$scope.userUpdate = response.data;
							$scope.statusValidation = $scope.userUpdate[0]['status'];
								$scope.validation = false;
								if($scope.statusValidation == "L'usuari s'ha actualitzat")
								{
									$scope.validation = true;
								}
								$scope.loading = true;
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
								}).finally(function(){
									$scope.loading = false;
								});
								$scope.loading = true;
								$http({
									method : "GET",
									url : "models/users.php?acc=listUsers"
								}).then(function mySucces (response) {
									$scope.users = response.data;
								}, function myError (response) {
									$scope.users = response.statusText;
								}).finally(function(){
									$scope.loading = false;
								});
								$scope.fail = true;
						}, function myError (response) {
							$scope.userUpdate = response.statusText;
						}).finally(function(){
								$scope.loading = false;
						});

  					}
  					else if($scope.pswdC != $scope.confirmPswdC)
  					{
	  					$scope.validation = false;
	  					$scope.statusValidation = "Error";
	  					$scope.fail = true;
  					}
  				}
  				else if($scope.pswdC == $scope.confirmPswdC && $scope.confirmPswdC != "" && $scope.pswdC != "" && $scope.idUserC == -1)
  				{
  					$scope.loading = true;
  					$http({
							method : "GET",
							url : "models/users.php?acc=createUser&name="+$scope.nameC+"&email="+$scope.emailC+"&pswdMail="+$scope.emailPassC+"&address="+$scope.addressC+"&telephone="+$scope.telephoneC+"&history="+$scope.historyC+"&pswd="+$scope.pswdC
						}).then(function mySucces (response) {
							$scope.userCreate = response.data;
							$scope.statusValidation = $scope.userCreate[0]['status'];
							$scope.validation = false;
							if($scope.statusValidation == "S'ha creat l'usuari")
							{
								$scope.validation = true;
							}
							$scope.fail = true;
							$scope.idUserC = -1;
							$scope.nameC = "";
							$scope.emailC = "";
							$scope.emailPassC = "";
							$scope.addressC = "";
							$scope.telephoneC = "";
							$scope.logoC = "";
							$scope.footerC = "";
							$scope.historyC = "";
							$scope.activeC = "";
							$scope.pswdC = "";
							$scope.confirmPswdC = "";
							$scope.currentPswdC = "";
							$scope.loading = true;
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
								}).finally(function(){
									$scope.loading = false;
								});
							$scope.loading = true;
								$http({
									method : "GET",
									url : "models/users.php?acc=listUsers"
								}).then(function mySucces (response) {
									$scope.users = response.data;
								}, function myError (response) {
									$scope.users = response.statusText;
								}).finally(function(){
									$scope.loading = false;
								});
						}, function myError (response) {
							$scope.userUCreate = response.statusText;
						}).finally(function(){
							$scope.loading = false;
							$scope.cUser = true;
						});

  				}
  				else if($scope.pswdC != $scope.confirmPswdC)
  				{
  					$scope.validation = false;
  					$scope.statusValidation = "Error";
  					$scope.fail = true;
  				}
			};
  			$scope.showEdit = function(){
  				$scope.logoEdit = true;
  			};
  			$scope.showEdit2 = function(){
  				$scope.logoEdit2 = true;
  			};
  			$scope.selImages=function(e,nameField){
  				$scope.fail = false;
  				var data = new FormData();
				data.append("nameField",nameField);
				data.append("idUser",$scope.idUserC);
				data.append("uploadedFile",e.files[0]);
				if(nameField == 'logo')
				{
					data.append("deleteLogo",$scope.logoC);
				}
				else
				{
					data.append("deleteLogo",$scope.footerC);
				}
				console.log($scope.idUserC+"-"+e.files[0].name);
				$scope.fail2 = true;
				$scope.statusValidation2 = "Error";
				$scope.validation2 = false;
				var deferred=$q.defer();
				return $http.post("models/users.php?acc=updateImgAsso", data,{
				headers:{
				"Content-type":undefined
				},
				transformRequest:angular.identity
				})
				.then(function(res)
				{
				deferred.resolve(res);
					if(nameField == 'logo')
					{
						$scope.logoC = $scope.idUserC+"-"+e.files[0].name;
					}
					else
					{
						$scope.footerC = $scope.idUserC+"-"+e.files[0].name;
					}
					$scope.statusValidation2 = "La imatge s'ha inserit correctament";
					$scope.validation2 = true;
				})
				
				return
				 deferred.promise;


			}
 
	});

