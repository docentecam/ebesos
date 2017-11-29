<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION['user']['idUser'])) header("Location: index.html");
?>
	<html>
<head>
		<link rel="shortcut icon" href="../img/logos-assoc/4.png">
		<title>EIX BESÒS MARESME</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script data-require="jquery@*" data-semver="2.1.1" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular.js"></script>
		<script data-require="ng-route@1.2.0" data-semver="1.2.0" src="http://code.angularjs.org/1.2.0-rc.3/angular-route.js"></script>
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- 	<script>
			$( document ).ready(function() {			
		}); 
		</script> -->
		<script>
				$(document).ready(function () {

  					$(".reduceNav").click(function(event) {
    				$(".navReduced").collapse('hide');
					});
					
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
		<script src="controllers/promotions.js"></script>
		<script src="controllers/main.js"></script>
		<script src="controllers/links.js"></script>
		<script src="controllers/subCategories.js"></script>
	</head>
	<body id="container" data-ng-app="spaApp"  ng-controller="MainCtrl">
		<div class="row">
			<div class="col-xs-6 col-md-4 col-lg-4 noPadding  divHeaderReduceSpace">				
				<div class="col-xs-4 col-lg-5 noPadding divClientLoggedImage">
					<a ng-href="#"><img class="img-responsive noPadding aLogoClient" ng-src="../img/logos-assoc/<?php echo $_SESSION['user']['logo']; ?>"></a>	
				</div>
				<div class="col-xs-7 col-lg-7 divClientLoggedName">
					<span id="nameAssoLogged"><?php echo $_SESSION['user']['name']; ?></span>
				</div>
			</div>		
			<div class=" col-xs-3 col-lg-3 pull-right">
				
				<!-- 	<div class="col-xs-12 col-lg-4 col-lg-push-7 deleteUnderlineSignUp">
						<div class="colorLoginHidden">
							<i class="fa fa-user-circle-o fa-2x" aria-hidden="true" title="Inicia Sessió"></i>
							<i class="fa fa-caret-down fa-lg arrowDown" aria-hidden="true"></i>
						</div>						
					</div>	
				</div>
				<div class="row" ng-hide="showLogOff"> -->
				<div class="col-xs-12 col-lg-6 col-lg-push-4 logOffDiv">
					<a ng-href="models/users.php?acc=logout"><i class="fa fa-sign-out" aria-hidden="true"></i>Tancar Sessió</a>				
				</div>							
			</div>		
		</div>		
		<div class="row navGeneral">
			<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 navGeneral2">
				<div class="sidebar-nav">
					<div class="navbar navbar-default navGlobal" role="navigation">
    					<div class="navbar-header">
      						<button type="button" class="navbar-toggle pull-left" data-toggle="collapse" data-target=".sidebar-navbar-collapse" id="eraseBorderNavMobile">
					            <span class="sr-only">Toggle navigation</span>
					            <span class="icon-bar"></span>
					            <span class="icon-bar"></span>
					            <span class="icon-bar"></span>
      						</button>     						
    					</div>
    					<div class="navbar-collapse collapse sidebar-navbar-collapse navReduced" id="divNavTabsGlobal">
							<ul class="nav navbar-nav">
								<?php if($_SESSION['user']['privileges'] =='E' || $_SESSION['user']['privileges'] =='A') echo '<li role="presentation" class="mainNav reduceNav col-lg-12"><a class="colorLinksNavMobile" ng-href="#/associations">Associacions</a></li>
								<li role="presentation" class="mainNav reduceNav col-lg-12"><a class="colorLinksNavMobile" ng-href="#/shops">Comerços</a></li>' ?>

							    <li role="presentation" class="mainNav reduceNav col-lg-12"><a class="colorLinksNavMobile" ng-href="#/promotions">Promocions</a><label id="positionNumberPromo" ng-model="alertPromo" ng-if="alertPromo!=0">{{alertPromo}}</label></li>

							    <?php if($_SESSION['user']['privileges'] =='E' || $_SESSION['user']['privileges'] =='A') echo '<li role="presentation" class="mainNav reduceNav  col-lg-12"><a class="colorLinksNavMobile" ng-href="#/news">Notícies</a></li>' ?>
							    <?php if($_SESSION['user']['privileges'] =='E') echo '<li role="presentation" class="mainNav reduceNav col-lg-12"><a class="colorLinksNavMobile" href="#/slider/f/l">Slider</a></li>
							    <li role="presentation" class="mainNav reduceNav col-lg-12"><a class="colorLinksNavMobile" ng-href="#/subcategories">Subcategories</a></li>
							    <li role="presentation" class="mainNav reduceNav col-lg-12"><a class="colorLinksNavMobile" ng-href="#/settings">Paràmetres</a></li>
							    <li role="presentation" class="mainNav reduceNav col-lg-12"><a class="colorLinksNavMobile" ng-href="#/links">Enllaços del footer</a></li>' ?>
							</ul>
    					</div><!--/.nav-collapse -->
  					</div>
				</div>  					
			</div>
			<div id="loadingData" ng-show="loading">
					<center><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></center>	
				</div> 	
				<div class="col-xs-11 col-sm-9 col-md-9 col-lg-9 editNgView" data-ng-view="" ng-hide="loading"> 				
  				</div>
  			</div>
		</div>
	</body>	
</html>