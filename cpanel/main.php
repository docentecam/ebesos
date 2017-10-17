<!DOCTYPE html>
<?php
session_start();
$_SESSION['idUser']="1";
if(!isset($_SESSION['idUser'])) header("Location: index.html");
?>
	<html>
	<head>
		<title>EIX COMERCIAL BACKEND</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script data-require="jquery@*" data-semver="2.1.1" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular.js"></script>
		<script data-require="ng-route@1.2.0" data-semver="1.2.0" src="http://code.angularjs.org/1.2.0-rc.3/angular-route.js"></script>
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<script>
			$( document ).ready(function() {
				});
		</script>

		<link rel="stylesheet" href="css/styles.css">
		<script src="js/app.js"></script>
		<script src="controllers/news.js"></script>
		<script src="controllers/shops.js"></script>
		<script src="controllers/test.js"></script>
		<script src="controllers/slider.js"></script>
		<script src="controllers/users.js"></script>
		<script src="controllers/settings.js"></script>
		<script src="controllers/assoLogoTop.js"></script>
	</head>
	<body id="container" data-ng-app="spaApp"  ng-controller="AssoTopImageCtrl">
		
		<div class="row">
			<div class="col-xs-2" style="padding: 0px; background-color: #B9B9F2;">
				<div class="col-xs-7 col-lg-7">
					<h4>Eix</h4>
				</div>
				<div style="padding: 0px; background-color: #FD00F4;" class="col-xs-5" ng-repeat="assoTopImage in assoTopImages">
					<a href="#"><img style="padding: 0px;" class="col-xs-12 img-responsive" src="img/logos-assoc/{{assoTopImage.logo}}"></a>
				</div>
			</div>
			</div>
			
			<div col-xs-1 col-xs-offset-6 id="imagen">
				
			</div>
			<div col-xs-1 id="img-user">

			</div>
			<div col-xs-2 id="desplegable">
				
			</div>
		</div>
		<div class="row">
			<div class="col-xs-2" style="padding: 0px">
				<div class="sidebar-nav">
					<div class="navbar navbar-default" role="navigation">
    					<div class="navbar-header">
      						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
					            <span class="sr-only">Toggle navigation</span>
					            <span class="icon-bar"></span>
					            <span class="icon-bar"></span>
					            <span class="icon-bar"></span>
      						</button>
      						<div>
      							<span class="visible-xs navbar-brand">Backend</span>
      							<div>Logo?</div>
      						</div>      						
    					</div>
    					<div class="navbar-collapse collapse sidebar-navbar-collapse" >
							<ul class="nav navbar-nav" >
								 <li role="presentation" class="mainNav"><a href="#/associations">Associacions</a></li>						   
							    <li role="presentation" class="mainNav"><a href="#/shops">Comerços</a></li>
							    <li role="presentation" class="mainNav"><a href="#/promotions">Promocions</a></li>
							    <li role="presentation" class="mainNav"><a href="#/news">Notícies</a></li>
							    <li role="presentation" class="mainNav"><a href="#/slider">Slider</a></li>
							    <li role="presentation" class="mainNav"><a href="#/subcategories">Subcategories</a></li>
							    <li role="presentation" class="mainNav"><a href="#/settings">Paràmetres</a></li>
							    
							    
							    <li role="presentation" class="mainNav"><a href="#/formFichero">Enllaços del footer</a></li>
							</ul>
    					</div><!--/.nav-collapse -->
  					</div>
				</div>  					
			</div>
			<div class="col-xs-9" data-ng-view="">
			
			</div>
		</div>		
	</body>	
</html>