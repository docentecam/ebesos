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
<body ng-app="myApp" ng-controller="LoginCtrl">
	<div id="loadingData" ng-show="loading">
		<center><img id="loadingIcon" src="../img/loading_icon.gif"></center>
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

			});
			
		</script>
</body>
</html>