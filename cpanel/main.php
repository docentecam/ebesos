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
			<div class="col-xs-6 col-md-2 col-lg-2 " style="padding: 0px;">				
				<div style="padding: 0px; background-color: #6E79BF;" class="col-xs-5 col-lg-5" ng-repeat="assoTopImage in assoTopImages">
					<a href="#"><img style="padding: 0px;" class="img-responsive" src="img/logos-assoc/{{assoTopImage.logo}}"></a>
				</div>
				<div class="col-xs-7 col-lg-7" style="height: 88px;">
					<h4 style="margin-top: 37%">Eix</h4>
				</div>
			</div>		
			<div class="col-lg-3 pull-right">
				<div class="row">
					<div class="col-xs-2 col-lg-4 col-lg-push-7" style="margin-top:5%;">
						<a href="" id="deleteUnderlineSignUp">
							<i class="fa fa-user-circle-o fa-2x colorLoginHidden" aria-hidden="true"  style=": #52A4B3" title="Inicia Sessió"></i>
							<i class="fa fa-caret-down fa-1x" style="margin-left: 10px;" aria-hidden="true" ng></i>
						</a>						
					</div>	
				</div>
				<div class="row">
					<div class="col-xs-2 col-lg-6 col-lg-push-4" style="background-color: #D5D5D5; position: absolute; top: 120%; right: 0%; height: 40px; text-align: center; padding-top: 8.4px; border-top: 3px solid #7CA3E3">
						<i class="fa fa-sign-out" aria-hidden="true"></i>
						Tancar Sessió
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
			<div class="container-fluid row">  
				<div ng-show="loading" id="loadingData">
					<svg class="lds-spinner" width="200px"  height="200px"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" style="background: none;">
						<g transform="rotate(0 50 50)">
						<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.99s" repeatCount="indefinite">
						    	</animate>
							</rect>
						</g>
						<g transform="rotate(3.6 50 50)">
						<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
					   			<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.98s" repeatCount="indefinite">					   			
					   			</animate>
							</rect>
						</g>
						<g transform="rotate(7.2 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.97s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(10.8 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.96s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(14.4 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.95s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(18 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.94s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(21.6 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.93s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(25.2 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.92s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(28.8 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.91s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(32.4 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.9s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(36 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.89s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(39.6 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.88s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(43.2 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.87s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(46.8 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.86s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(50.4 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.85s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(54 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.84s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(57.6 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.83s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(61.2 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.82s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(64.8 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.81s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(68.4 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.8s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(72 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.79s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(75.6 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.78s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(79.2 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.77s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(82.8 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.76s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(86.4 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.75s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(90 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.74s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(93.6 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.73s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(97.2 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.72s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(100.8 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.71s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(104.4 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.7s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(108 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.69s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(111.6 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.68s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(115.2 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.67s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(118.8 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.66s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(122.4 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.65s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(126 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.64s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(129.6 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.63s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(133.2 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.62s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(136.8 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.61s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(140.4 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.6s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(144 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.59s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(147.6 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.58s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(151.2 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.57s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(154.8 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.56s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(158.4 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.55s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(162 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.54s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(165.6 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.53s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(169.2 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.52s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(172.8 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.51s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(176.4 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.5s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(180 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.49s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(183.6 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.48s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(187.2 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.47s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(190.8 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.46s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(194.4 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.45s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(198 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.44s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(201.6 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.43s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(205.2 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.42s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(208.8 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.41s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(212.4 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.4s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(216 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.39s" repeatCount="indefinite">
						 	   	
						    </animate>
						  </rect>
						</g>
						<g transform="rotate(219.6 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.38s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(223.2 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.37s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(226.8 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.36s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(230.4 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.35s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(234 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.34s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(237.6 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.33s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(241.2 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.32s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(244.8 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.31s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(248.4 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.3s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(252 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.29s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(255.6 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.28s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(259.2 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.27s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(262.8 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.26s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(266.4 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.25s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(270 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.24s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(273.6 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.23s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(277.2 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.22s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(280.8 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.21s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(284.4 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.2s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(288 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.19s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(291.6 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.18s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(295.2 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.17s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(298.8 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.16s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(302.4 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.15s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(306 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.14s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(309.6 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.13s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(313.2 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.12s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(316.8 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.11s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(320.4 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.1s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(324 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.09s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(327.6 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.08s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(331.2 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.07s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(334.8 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.06s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(338.4 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.05s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(342 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.04s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(345.6 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.03s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(349.2 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.02s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(352.8 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.01s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
						<g transform="rotate(356.4 50 50)">
							<rect x="41.5" y="28" rx="12.035" ry="8.120000000000001" width="17" height="10" fill="#4b5ed1">
						    	<animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="0s" repeatCount="indefinite">					    	
						    	</animate>
						  </rect>
						</g>
					</svg>
				</div> 	
				<div class="col-xs-9 editNgView" data-ng-view="" ng-hide="loading"> 				
  				</div>
  			</div>
		</div>
	</body>	
</html>