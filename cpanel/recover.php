<!DOCTYPE html>
<html>
<head>
	<title>EIX COMERCIAL</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script data-require="jquery@*" data-semver="2.1.1" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular.js"></script>
	<script data-require="ng-route@1.2.0" data-semver="1.2.0" src="http://code.angularjs.org/1.2.0-rc.3/angular-route.js"></script>
	<script type='text/javascript' src="./bower_components/angular/angular.js"></script>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<link rel="shortcut icon" href="../img/logos-assoc/4.png">



</head>
<body ng-app="myApp" ng-controller="RecoverCtrl">
	<div id="loadingData" ng-show="loading">
		<center><img id="loadingIcon" src="../img/loading_icon.gif"></center>
	</div>

	<div>
		<div class="row log250"></div>
		<div class="row">
			<div class="col-sm-12 col-md-6 col-lg-4 col-lg-offset-4">
				<div class="row">
					<h3>MODIFICAR CONTRASENYA	</h3>
					<div class="row log20"></div>
					<div ng-show="fail">
						<div ng-class="validation ? 'alert alert-success' : 'alert alert-danger'">
							<i class="fa fa-times" ng-hide="validation" aria-hidden="true"></i>
							<i class="fa fa-check" ng-show="validation" aria-hidden="true"></i>
							<b>{{statusValidation}}</b>
						</div>
					</div>
					<form id="check">
						<div class="row">
							<div class="col-lg-3"><label>Contrasenya: </label></div>
							<div class="col-lg-6">
								<input type="password" id="user" placeholder="Contrasenya" class="loginRadius" ng-model="pass">
							</div>
						</div>
						<input type="text" id="hid" value="<?php echo $_GET['rt'] ?>" hidden>
						<div class="row log20"></div>
						<div class="row">
							<div class="col-lg-3">
								<label>Confirmar contrasenya: </label>
							</div>
							<div class="col-lg-6">
								<input type="password" id="pswd" placeholder="Contrasenya" class="loginRadius" ng-model="cPass">
							</div>
							<div class="col-lg-3">
								<input type="button" value="Enviar" class="btn btn-default" ng-click="rPassword();" class="loginRadius">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row" id="footerLogin">
		<footer class="footer-bs" id="footer">
			<div class="col-xs-7 footerLog">
				<div class="row">
					<div class="col-xs-12 col-lg-10 col-lg-offset-3 pull-right">
						<img class="img-responsive col-lg-4 col-xs-7 col-sm-4" src="../img/logo_ayuntamiento.svg">
						<div class="icoFooterEix" ng-repeat="ftr in footer">
							<img class="img-responsive col-lg-2 col-xs-4 col-sm-2" src="../img/logos-assoc/{{ftr.footerL}}">
						</div>
					</div>
				</div>					
			</div>
    	</footer>
    </div>
		<script> var app = angular.module('myApp', []);</script>
		<script>
			app.controller ('RecoverCtrl', function($scope, $http, $window) {
				$scope.loading = true;
				$scope.fail = false;
				$scope.cPass = "";
				$scope.pass = "";
				

				$http({
						method : "GET",
						url : "models/users.php?acc=footer"
					}).then(function mySucces (response) {
						$scope.footer=response.data;
					}, function myError (response) {
						$scope.footer = response.statusText;
					}).finally(function(){
						$scope.loading = false;
					});

				$scope.rPassword = function()
				{
					
					$scope.loading = true;
					if($scope.pass == $scope.cPass && $scope.pass != "" &&  $scope.cPass != "")
					{
						$scope.get = $('#hid').attr('value');
						$http({
								method : "GET",
								url : "models/users.php?acc=crPass&password="+$scope.pass+"&fToken="+$scope.get
							}).then(function mySucces (response) {
								$scope.rPass=response.data;
								$scope.statusValidation = $scope.rPass[0]['status'];
								$scope.validation = false;
								if($scope.statusValidation == "La contrasenya s'ha actualitzat")
								{
									$scope.validation = true;
								}
								$scope.fail = true;
							}, function myError (response) {
								$scope.rPass = response.statusText;
							}).finally(function(){
								$scope.loading = false;
							});
					}
					else
					{
							$scope.statusValidation = "Contrasenya i confirmar contrasenya no coincideixen";
							$scope.loading = false;
							$scope.validation = false;
							$scope.fail = true;
					}
					$scope.cPass = "";
					$scope.pass = "";
				}

			});

			
		</script>
</body>
</html>