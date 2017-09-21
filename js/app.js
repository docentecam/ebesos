var app= angular.module('spaApp', ['ngRoute']);
app.config(['$routeProvider', function ($routeProvider) {
    $routeProvider
    // .when('/', {
    //     templateUrl: 'views/comercialMap.html',
    //     controller: 'ComercialMapCtrl',
    // })
	.when('/news/:idUser',{
	templateUrl:'views/news.html',
	controller:'NewsCtrl',

	})
	.when('/new/:idNew',{
		templateUrl:'views/new.html',
		controller:'NewCtrl',
	})
	.when('/promotions',{
		templateUrl:'views/promotions.html',
		controller:'PromotionsCtrl',
	})
	.when('/associations/:idUser',{
		templateUrl:'views/associations.html',
		controller:'AssociCtrl',
	})
	.when('/formation',{
		templateUrl:'views/formation.html',
		controller:'FormationCtrl',
	})
	.when('/contact/:idUser',{
		templateUrl:'views/contact.html',
		controller:'ContactCtrlUser',
	})
	.when('/users/:idUser',{
		templateUrl:'views/aboutUs.html',
		controller:'AboutUsCtrl',
	})
	

    .otherwise({
        redirectTo: '/'
    });
}]); 
 
//ENVIAR USUARIOS DEPENDIENDO DE QUIEN ESTA CONECTADO DEL 1-4