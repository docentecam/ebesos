angular.module('spaApp')

  .controller('AboutUsCtrl', function($scope, $http) {

		$http({
			method : "GET",
			url : "models/users.php?acc=history&idUser=1"
		}).then(function mySucces (response) {
			$scope.names = response.data;
			
		}, function myError (response) {
			$scope.names = response.statusText;
		});
			
	});

angular.module('spaApp')															 
	.controller('ContactCtrlUser', function($scope, $http ,$routeParams) {
	$scope.idUser = $routeParams.idUser;

	$http({
			method : "GET",
			url : "models/users.php?acc=mail&idUser="+ $scope.idUser
		}).then(function mySucces (response) {
				$scope.email = response.data;
 				console.log('Llega email'+$scope.email);
		}, function myError (response) {
				$scope.email = response.statusText;
	});
});

angular.module('spaApp')

.controller('AssociationsCtrl', function($scope, $http, $routeParams) {
	
	$scope.idUser =$routeParams.idUser;
	$http({
			method : "GET",
			url : "models/users.php?acc=history&idUser="+$scope.idUser
		}).then(function mySucces (response) {
			$scope.histories = response.data;
			$scope.muestraDivC = false;
			$scope.muestraDivN = false;
			$scope.muestraDivCA = false;
			$scope.muestraDivH = true;
		}, function myError (response) {
			$scope.histories = response.statusText;
	});
	
  	$scope.showHistory = function(){
			$scope.muestraDivC = false;
			$scope.muestraDivN = false;
			$scope.muestraDivCA = false;
			$scope.muestraDivH = true;
	};

	$scope.showContact = function(idUser){
		$http({
			method : "GET",
			url : "models/users.php?acc=mail&idUser="+ $scope.idUser
		}).then(function mySucces (response) {
			$scope.email = response.data;
			$scope.muestraDivH = false;
			$scope.muestraDivN = false;
			$scope.muestraDivCA = false;
			$scope.muestraDivC = true;
		}, function myError (response) {
			$scope.email = response.statusText;
		});
	};

	// Captcha Script
		function checkform(theform){
			var error = "";
			if(theform.captchaInput.value == ""){
			error += "- Introdueix el CAPTCHA.";
			}
			if(theform.captchaInput.value != ""){
				if(ValidCaptcha(theform.captchaInput.value) == false){
				error += " El CAPTCHA és incorrecte.";
				}
			}
			if(error != ""){
				alert(error);
				return false;
			}
		}
		var a = Math.ceil(Math.random() * 9)+ '';
		var b = Math.ceil(Math.random() * 9)+ '';
		var c = Math.ceil(Math.random() * 9)+ '';
		var d = Math.ceil(Math.random() * 9)+ '';
		var e = Math.ceil(Math.random() * 9)+ '';
		var code = a + b + c + d + e;
		document.getElementById("txtCaptcha").value = code;
		document.getElementById("captchaDiv").innerHTML = code;

		function ValidCaptcha(){
			var str1 = removeSpaces(document.getElementById('txtCaptcha').value);
			var str2 = removeSpaces(document.getElementById('captchaInput').value);
			if (str1 == str2){
				return true;
			}
			else{
				return false;
			}
		}
		function removeSpaces(string){
		return string.split(' ').join('');
		}

	$scope.listShops = function(idUser){		
		$http({
			method : "GET",
			url : "models/shops.php?acc=l&idUser="+$scope.idUser
		}).then(function mySucces(response) {
			$scope.shops = response.data;
			$scope.muestraDivC = false;
			$scope.muestraDivN = false;
			$scope.muestraDivCA = true;
			$scope.muestraDivH = false;
		}, function myError(response) {
			$scope.shops = response.statusText;
		});
	};
	$scope.showNews = function(idUser){
		$http({
			method : "GET",
			url : "models/news.php?acc=news&idUser="+$scope.idUser
		}).then(function mySucces (response) {
			$scope.news = response.data;
			$scope.muestraDivC = false;
			$scope.muestraDivN = true;
			$scope.muestraDivCA = false;
			$scope.muestraDivH = false;
		}, function myError (response) {
			$scope.news = response.statusText;
		});
	};
});
