var app= angular.module('spaApp', ['ngRoute']);
app.config(['$routeProvider', function ($routeProvider) {
    $routeProvider
    // .when('/', {
    //     templateUrl: 'views/comercialMap.html',
    //     controller: 'ComercialMapCtrl',
    // })
	.when('/news',{
	templateUrl:'views/news.html',
	controller:'NewsCtrl',

	})
	.when('/associations',{
		templateUrl:'views/associations.html',
		controller:'AssociationsCtrl',
	})
	.when('/shops',{
		templateUrl:'views/shops.html',
		controller:'ShopsCtrl',
	})
	.when('/slider',{
		templateUrl:'views/slider.html',
		controller:'SliderCtrl',
	})
	.when('/settings',{
		templateUrl:'views/settings.html',
		controller:'SettingsCtrl',
	})
	.when('/promotions',{
		templateUrl:'views/promotions.html',
		controller:'PromotionsCtrl',
	})
	.when('/subcategories',{
		templateUrl:'views/subcategories.html',
		controller:'SubcategoriesCtrl',
	})
	

    .otherwise({
        redirectTo: '/'
    });
}]); 
 
//ENVIAR USUARIOS DEPENDIENDO DE QUIEN ESTA CONECTADO DEL 1-4