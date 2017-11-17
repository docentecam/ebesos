var app= angular.module('spaApp', ['ngRoute']);
app.config(['$routeProvider', function ($routeProvider) {
    $routeProvider
	.when('/', {
		templateUrl:'views/associations.php',
		controller:'AssociationsCtrl',
	})
	.when('/news',{
	templateUrl:'views/news.php',
	controller:'NewsCtrl',
	})
	.when('/news/:idNew',{
	templateUrl:'views/news.php',
	controller:'NewsEditCtrl',

	})
	.when('/associations',{
		templateUrl:'views/associations.php',
		controller:'AssociationsCtrl',
	})
	.when('/shops',{
		templateUrl:'views/shops.php',
		controller:'ShopsCtrl',
	})




	.when('/slider',{
		templateUrl:'views/slider.php',
		controller:'SliderCtrl',
	})

	.when('/slider/:idSlider',{
		templateUrl:'views/slider.php',
		controller:'SliderDescCtrl',
	})





	.when('/settings',{
		templateUrl:'views/settings.php',
		controller:'SettingsCtrl',
	})
	.when('/promotions',{
		templateUrl:'views/promotions.php',
		controller:'PromotionsCtrl',
	})
	.when('/subcategories',{
		templateUrl:'views/subcategories.php',
		controller:'SubcategoriesCtrl',
	})
	.when('/formFichero',{
		templateUrl:'views/formFichero.html',
		controller:'SubirCtrl',
	})
	.when('/links',{
		templateUrl:'views/links.php',
		controller:'LinksCtrl',
	})
	

    .otherwise({
        redirectTo: '/'
    });
}]); 
 
//ENVIAR USUARIOS DEPENDIENDO DE QUIEN ESTA CONECTADO DEL 1-4