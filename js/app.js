var app= angular.module('spaApp', ['ngRoute']);
app.config(['$routeProvider', function ($routeProvider) {
    $routeProvider
    .when('/', {
        templateUrl: 'view/comercialMap.html',
        controller: 'ComercialMapCtrl',
    })
    .when('/news',{
	templateUrl:'view/news.html',
	controller:'NewsCtrl',
	})
	.when('/promotions',{
		templateUrl:'view/promotions.html',
		controller:'PromotionsCtrl',
	})
	.when('/associations',{
		templateUrl:'view/associations.html',
		controller:'AssociationsCtrl',
	})
	.when('/formation',{
		templateUrl:'view/formation.html',
		controller:'FormationCtrl',
	})
	.when('/contact',{
		templateUrl:'view/contact.html',
		controller:'ContactCtrl',
	})
	.when('/aboutUs',{
		templateUrl:'view/aboutUs.html',
		controller:'AboutUsCtrl',
	})
    .otherwise({
        redirectTo: '/'
    });
}]);