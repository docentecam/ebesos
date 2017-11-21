angular.module('spaApp')
 .controller('AssociationsCtrl', function($scope, $http, $q) {
 			$scope.cUser = true;
 			$scope.activeCY = 'Y';
 			$scope.activeCN = 'N';
 			$scope.pswdC = "";
			$scope.confirmPswdC = "";
			$scope.currentPswdC = "";
			$scope.loading = true;
			$scope.fail = false;
			$scope.fail2 = false;
			$http({
				method : "GET",
				url : "models/users.php?acc=loadUser" 
			}).then(function mySucces (response) {
				$scope.associations = response.data;
				$scope.idUserC = $scope.associations[0]['idUser'];
				$scope.nameC = $scope.associations[0]['name'].replace(/&quot;/g,'"').replace(/&quot/g,'"');
				$scope.emailC = $scope.associations[0]['email'];
				$scope.emailPassC = $scope.associations[0]['emailPass'];
				$scope.addressC = $scope.associations[0]['address'];
				$scope.telephoneC = $scope.associations[0]['telephone'];
				$scope.logoC = $scope.associations[0]['logo'];
				$scope.footerC = $scope.associations[0]['footer'];
				$scope.historyC = $scope.associations[0]['history'].replace(/&quot;/g,'"').replace(/&quot/g,'"');
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
						$scope.nameC = $scope.associations[0]['name'].replace(/&quot;/g,'"').replace(/&quot/g,'"');
						$scope.emailC = $scope.associations[0]['email'];
						$scope.emailPassC = $scope.associations[0]['emailPass'];
						$scope.addressC = $scope.associations[0]['address'];
						$scope.telephoneC = $scope.associations[0]['telephone'];
						$scope.logoC = $scope.associations[0]['logo'];
						$scope.footerC = $scope.associations[0]['footer'];
						$scope.historyC = $scope.associations[0]['history'].replace(/&quot;/g,'"').replace(/&quot/g,'"');
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
	  					$scope.slashInv = false;
  						for($i=0;$i<$scope.historyC.length;$i++)
  						{
  							if($scope.historyC[$i] == '\\')
  							{
  								$scope.slashInv = true;
  							}
  						}
  						for($i=0;$i<$scope.nameC.length;$i++)
  						{
  							if($scope.nameC[$i] == '\\')
  							{
  								$scope.slashInv = true;
  							}
  						}
  						if($scope.slashInv == false)
  						{
	  						$scope.loading = true;

	  						var data = new FormData();
							data.append("name",$scope.nameC);
							data.append("email",$scope.emailC);
							data.append("pswdMail",$scope.emailPassC);
							data.append("address",$scope.addressC);
							data.append("telephone",$scope.telephoneC);
							data.append("idUser",$scope.idUserC);
							data.append("active",$scope.activeC);
							data.append("history",$scope.historyC);
							data.append("pswd",$scope.pswdC);
							data.append("currentPswd",$scope.currentPswdC);


							var deferred=$q.defer();
							$http.post("models/users.php?acc=updateUser", data,{
							headers:{
							"Content-type":undefined
							},
							transformRequest:angular.identity
							})
							.then(function(res)
							{
								deferred.resolve(res);
								$scope.statusValidation =  res.data[0]['status'];
								$scope.validation = false;
								$scope.fail = true;
								if($scope.statusValidation == "L'usuari s'ha actualitzat")
								{
									$scope.validation = true;
								}

							})
							$scope.loading = false;
						}
  						else
  						{
  							$scope.fail = true;
  							$scope.validation = false;
  							$scope.statusValidation = "Error, el símbol \\ no es pot utilitzar";
  						}

  					}
  					else if($scope.pswdC == "" && $scope.confirmPswdC == "" && $scope.currentPswdC == "")
  					{
  						
  						$scope.slashInv = false;
  						for($i=0;$i<$scope.historyC.length;$i++)
  						{
  							if($scope.historyC[$i] == '\\')
  							{
  								$scope.slashInv = true;
  							}
  						}
  						for($i=0;$i<$scope.nameC.length;$i++)
  						{
  							if($scope.nameC[$i] == '\\')
  							{
  								$scope.slashInv = true;
  							}
  						}
  						if($scope.slashInv == false)
  						{
  							$scope.loading = true;

	  						var data = new FormData();
							data.append("name",$scope.nameC);
							data.append("email",$scope.emailC);
							data.append("pswdMail",$scope.emailPassC);
							data.append("address",$scope.addressC);
							data.append("telephone",$scope.telephoneC);
							data.append("idUser",$scope.idUserC);
							data.append("active",$scope.activeC);
							data.append("history",$scope.historyC);
							

							var deferred=$q.defer();
							$http.post("models/users.php?acc=updateUser", data,{
							headers:{
							"Content-type":undefined
							},
							transformRequest:angular.identity
							})
							.then(function(res)
							{
								deferred.resolve(res);
								$scope.statusValidation =  res.data[0]['status'];
								$scope.validation = false;
								$scope.fail = true;
								if($scope.statusValidation == "L'usuari s'ha actualitzat")
								{
									$scope.validation = true;
								}

							})
							$scope.loading = false;
  						}
  						else
  						{
  							$scope.fail = true;
  							$scope.validation = false;
  							$scope.statusValidation = "Error, el símbol \\ no es pot utilitzar";
  						}
  						
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
	  				$scope.slashInv = false;
  						for($i=0;$i<$scope.historyC.length;$i++)
  						{
  							if($scope.historyC[$i] == '\\')
  							{
  								$scope.slashInv = true;
  							}
  						}
  						for($i=0;$i<$scope.nameC.length;$i++)
  						{
  							if($scope.nameC[$i] == '\\')
  							{
  								$scope.slashInv = true;
  							}
  						}
  						if($scope.slashInv == false)
  						{
	  						$scope.loading = true;

	  						var data = new FormData();
							data.append("name",$scope.nameC);
							data.append("email",$scope.emailC);
							data.append("pswdMail",$scope.emailPassC);
							data.append("address",$scope.addressC);
							data.append("telephone",$scope.telephoneC);
							data.append("idUser",$scope.idUserC);
							data.append("active",$scope.activeC);
							data.append("history",$scope.historyC);
							data.append("pswd",$scope.pswdC);


							var deferred=$q.defer();
							$http.post("models/users.php?acc=createUser", data,{
							headers:{
							"Content-type":undefined
							},
							transformRequest:angular.identity
							})
							.then(function(res)
							{
								deferred.resolve(res);
								$scope.statusValidation =  res.data[0]['status'];
								$scope.validation = false;
								$scope.fail = true;
								if($scope.statusValidation == "S'ha creat l'usuari")
								{
									$scope.validation = true;
								}
								$scope.loading = true;
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

							})
						$scope.loading = false;
					}
					else
					{
						$scope.fail = true;
						$scope.validation = false;
						$scope.statusValidation = "Error, el símbol \\ no es pot utilitzar";
					}

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
  				$scope.loading = true;
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
						$scope.footerC = $scope.idUserC+"f-"+e.files[0].name;
					}
					$scope.statusValidation2 = "La imatge s'ha inserit correctament";
					$scope.validation2 = true;
				})
				
				return
				 deferred.promise;
				 $scope.loading = false;

			}
 
	});

