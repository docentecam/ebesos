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
		<script src="controllers/main.js"></script>
	</head>
	<body id="container" data-ng-app="spaApp"  ng-controller="MainCtrl">
		<div class="row">
			<div class="col-xs-6 col-md-2 col-lg-2 " style="padding: 0px;">				
				<div style="padding: 0px; background-color: #6E79BF;" class="col-xs-5 col-lg-5">
					<a href="#"><img style="padding: 0px;" class="img-responsive" src="../img/logos-assoc/<?php echo $_SESSION['user']['logo']; ?>"></a>					
				</div>
				<div class="col-xs-7 col-lg-7" style="height: 88px;">
					<h4 style="margin-top: 37%"><?php echo $_SESSION['user']['name']; ?></h4>
				</div>
			</div>		
			<div class="col-lg-3 pull-right">
				<div class="row">
					<div class="col-xs-2 col-lg-4 col-lg-push-7 deleteUnderlineSignUp" ng-click="showDisconnect()" style="margin-top:5%;">
						<div class="colorLoginHidden">
							<i class="fa fa-user-circle-o fa-2x" aria-hidden="true" title="Inicia Sessió"></i>
							<i class="fa fa-caret-down fa-lg" style="margin-left: 10px;" aria-hidden="true"></i>
						</div>						
					</div>	
				</div>
				<div class="row" ng-hide="showLogOff">
					<div class="col-xs-2 col-lg-6 col-lg-push-4" style="background-color: #D5D5D5; position: absolute; top: 120%; right: 0%; height: 40px; text-align: center; padding-top: 8.4px; border-top: 3px solid #7CA3E3;">
						<i class="fa fa-sign-out" aria-hidden="true"></i>
						<a href="models/users.php?acc=logout">Tancar Sessió</a>
					</div>
				</div>			
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
      						</div>      						
    					</div>
    					<div class="navbar-collapse collapse sidebar-navbar-collapse" >
							<ul class="nav navbar-nav" >
								<?php if($_SESSION['user']['privileges'] =='E' || $_SESSION['user']['privileges'] =='A') echo '<li role="presentation" class="mainNav"><a href="#/associations">Associacions</a></li>
								<li role="presentation" class="mainNav"><a href="#/shops">Comerços</a></li>' ?>
							    <li role="presentation" class="mainNav"><a href="#/promotions">Promocions</a></li>
							    <?php if($_SESSION['user']['privileges'] =='E' || $_SESSION['user']['privileges'] =='A') echo '<li role="presentation" class="mainNav"><a href="#/news">Notícies</a></li>' ?>
							    <?php if($_SESSION['user']['privileges'] =='E') echo '<li role="presentation" class="mainNav"><a href="#/slider">Slider</a></li>
							    <li role="presentation" class="mainNav"><a href="#/subcategories">Subcategories</a></li>
							    <li role="presentation" class="mainNav"><a href="#/settings">Paràmetres</a></li>
							    <li role="presentation" class="mainNav"><a href="#/formFichero">Enllaços del footer</a></li>' ?>
							</ul>
    					</div><!--/.nav-collapse -->
  					</div>
				</div>  					
			</div>
			<div id="loadingData" ng-show="loading">
					<center><!--TODO eliminar <img  src="../img/loading_icon.gif" style="margin-top: 21%;"> --><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i> 
<!--TODO eliminar <span class="sr-only">Loading...</span> -->
</center>	
				</div> 	
				<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9 editNgView" data-ng-view="" ng-hide="loading"> 				
  				</div>
  			</div>
		</div>
	</body>	
</html>